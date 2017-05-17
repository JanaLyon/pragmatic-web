<?php
/*
Template Name: Top Trump Set
Template Post Type: page
*/

get_header();

/*
 * TODO
 * Import styles and scripts with enqueue
 */
?>
    <link rel="stylesheet" href="<?php echo plugins_url('top-trumps/css/main.css') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bangers|Oswald">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="<?php echo plugins_url('top-trumps/js/main.js') ?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <div class="wrap">
        <?php tt_get_template( "tt-card-set.php" ); ?>
    </div>
<?php
get_footer();
?>