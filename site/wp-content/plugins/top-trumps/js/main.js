jQuery(document).ready(function ($) {

    // used to keep the favourites state
    var favouritesShowing = false;
    //set an empty array in the cookie if it is not already set
    if(Cookies.get('favourites') == undefined){
        Cookies.set('favourites', []);
    }

    $('.tt_menu-label').click(function () {
        $('.tt_menu-attribute').toggle();
    })

    $('.tt_menu-attribute').click(function () {
        var ttNodeList = document.querySelectorAll('.tt_menu-attribute');
        // convert nodelist to a real array using a shortcut
        ttNodeList.forEach(function(item){
            item.classList.remove('selected')
        });
        this.classList.add('selected');
        //sort cards on attribute
        sortCards(this.innerText);
    })

    $('.tt_menu-favourites').click(function () {
        //show only those that have been added to favourites
        favouritesShowing = toggleFavourites(favouritesShowing);
        //toggle active state
        if (favouritesShowing){
            this.classList.add('selected')
        }else {

            this.classList.remove('selected')
        }
    })

    $('.tt_favourite').click(function(){
        //toggle add 'true'/'false' value to data-favourite
        toggleDataValue('favourite', this);
        //toggle display/hide selected icon
        toggleSelectedIcon('.fa-heart', this);
    })
    // .tt_compare removed due to lack of time
});

/**
 * Toggle showing favourites selected or everything
 * @param favouritesShowing
 * @returns {boolean|*}
 */
function toggleFavourites(favouritesShowing){
    //toggle the bool
    favouritesShowing = !favouritesShowing;

    var cardSet = document.querySelector('.tt_card-set'),
        ttNodeList = cardSet.querySelectorAll('.tt_card-wrapper[data-favourite="0"]');
        // convert nodelist to a real array using a shortcut
        ttNodeList.forEach(function(item){
            if (favouritesShowing){
                item.classList.add('hidden')
            }else {

                item.classList.remove('hidden')
            }
        });
    return favouritesShowing;
}

/**
 * Toggle selected state of favourites and compare
 * @param icon
 * @param btn
 */
function toggleSelectedIcon(icon, btn){
    //toggle display/hide selected icon
    var notSelected = btn.querySelector(icon + '-o'),
       selected = btn.querySelector(icon),
       selectedValue = selected.style.display;
        if(selectedValue == 'none'){
            selected.style.display = "block";
            notSelected.style.display = "none";
            //add to cookie
            addSelectedToCookie(btn);
        }else{
            selected.style.display = "none";
            notSelected.style.display = "block";
            //add to cookie
            removeSelectedToCookie(btn);
        }
}

/**
 * Toggle data value of favourite to turn favourite on or off
 * @param dataAttribute
 * @param card
 */
function toggleDataValue(dataAttribute, card){
    var cardWrapper = closest(card,'.tt_card-wrapper');

    if(cardWrapper.dataset[dataAttribute] == true){
        cardWrapper.dataset[dataAttribute] = 0;
    } else {
        cardWrapper.dataset[dataAttribute] = 1;
    }
}

/**
 * Add favourites as selected to cookie (as array)
 * @param card
 */
function addSelectedToCookie(card){
    var currentFavourites = Cookies.getJSON('favourites');
    var cardWrapper = closest(card,'.tt_card-wrapper');
    //get name and add to cookie
    currentFavourites.push(cardWrapper.dataset['name']);
    Cookies.set('favourites', currentFavourites);
}

/**
 * Checks to see if selected is already present and removes if it is
 * @param card
 */
function removeSelectedToCookie(card){
    var currentFavourites = Cookies.getJSON('favourites');
    var cardWrapper = closest(card,'.tt_card-wrapper');

    var i = currentFavourites.indexOf(cardWrapper.dataset['name']);
    if(i != -1) {
        currentFavourites.splice(i, 1);
    }
    Cookies.set('favourites', currentFavourites);
}

/**
 * Sort cards based on attribute
 * @param attribute
 */
function sortCards(attribute) {
    //clean the incoming attribute
    attribute = attribute.toLowerCase().replace(' ', '_');

    var cardSet = document.querySelector('.tt_card-set'),
        ttNodeList = cardSet.querySelectorAll('.tt_card-wrapper'),
        // convert nodelist to a real array using a shortcut
        ttArray = Array.prototype.slice.call(ttNodeList);

    // Sort and put the elements back in the DOM card set
    sortByAttribute(ttArray, attribute, false).forEach(function (card) {
        cardSet.appendChild(card);
    });
}

/**
 * Array sort function based on data-attributes
 * @param array - node with data elements
 * @param attribute - data-*attribute* to compare
 * @param asc - order defaults to desc
 * @returns {*|Array.<T>} - sorted array of nodes
 */
function sortByAttribute(array, dataAttribute, asc) {
    //check to see if the attribute is'name', as it is not a number
    if(dataAttribute =='name'){
        return array.sort(function(a,b){
            return a.dataset[dataAttribute].localeCompare(b.dataset[dataAttribute]);
        })
    } else {
        // set a default of descending order
        asc = (typeof asc !== 'undefined') ? asc : false;
        switch (true) {
            case asc :
                return array.sort(function (a, b) {
                    return parseInt(a.dataset[dataAttribute]) > parseInt(b.dataset[dataAttribute]) ? 1 : -1;
                });
                break;
            default :
                return array.sort(function (a, b) {
                    return parseInt(a.dataset[dataAttribute]) < parseInt(b.dataset[dataAttribute]) ? 1 : -1;
                });
        }
    }

}
/**
 * taken from http://stackoverflow.com/questions/14234560/javascript-how-to-get-parent-element-by-selector
 * @param el
 * @param selector
 * @param stopSelector
 * @returns {*}
 */
function closest(el, selector, stopSelector) {
    var retval = null;
    while (el) {
        if (el.matches(selector)) {
            retval = el;
            break
        } else if (stopSelector && el.matches(stopSelector)) {
            break
        }
        el = el.parentElement;
    }
    return retval;
}