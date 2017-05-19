<?php
/*
Template Name: Top Trump Set
Template Post Type: page
*/

get_header();

/*
 * TODO
 * Import styles and scripts with enqueue
 * Redo styling to work without bootstrap
 */
?>
    <link rel="stylesheet" href="<?php echo plugins_url('top-trumps/css/main.css') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bangers|Oswald">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo plugins_url('top-trumps/js/main.js') ?>"></script>

    <div class="tt_menu">
        <div class="wrap">
        <div class="tt_button-container">
            <div class="tt_menu-button">View favourites <i class="fa fa-heart" aria-hidden="true"></i></div>
            <div class="tt_menu-label">Sort by <i class="fa fa-caret-right" aria-hidden="true"></i></div>
            <div class="tt_menu-button">Name</div>
            <div class="tt_menu-button">Height</div>
            <div class="tt_menu-button">Intelligence</div>
            <div class="tt_menu-button">Strength</div>
            <div class="tt_menu-button">Agility</div>
            <div class="tt_menu-button">Fighting skills</div>
        </div>
        </div>
    </div>
    <div class="wrap">
        <?php tt_get_template("tt-card-set.php"); ?>
    </div>
<?php
get_footer();
?>