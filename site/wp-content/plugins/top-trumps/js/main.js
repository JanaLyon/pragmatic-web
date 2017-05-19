jQuery(document).ready(function ($) {
    $('.tt_menu-button').click(function () {
        sortCards(this.innerText);
    })
});

/**
 * Sort cards based on attribute
 * @param attribute
 */
function sortCards(attribute) {
    //clean the incoming attribute
    attribute = attribute.toLowerCase().replace(' ', '_');

    var cardSet = document.querySelector('.tt_card-set'),
        ttNodeList = wrap.querySelectorAll('.tt_card-container'),
        // convert nodelist to a real array using a shortcut
        ttArray = Array.prototype.slice.call(ttNodeList);

    // Sort and put the elements back in the DOM card set
    sortByAttribute(ttArray, attribute, false).forEach(function (card) {
        cardSet.appendChild(card);
    });
}

/**
 * Array sort function based on data-attributes
 *
 * @param array - node with data elements
 * @param attribute - data-*attribute* to compare
 * @param asc - order defaults to desc
 * @returns {*|Array.<T>} - sorted array of nodes
 */
function sortByAttribute(array, attribute, asc) {
    // set a default of descending order
    asc = (typeof asc !== 'undefined') ? asc : false;
    switch (true) {
        case asc :
            return array.sort(function (a, b) {
                return parseInt(a.dataset[attribute]) > parseInt(b.dataset[attribute]) ? 1 : -1;
            });
            break;
        default :
            return array.sort(function (a, b) {
                return parseInt(a.dataset[attribute]) < parseInt(b.dataset[attribute]) ? 1 : -1;
            });
    }

}
