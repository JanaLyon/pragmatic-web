<?php
/*
Template Name: Top Trump Set
Template Post Type: page
*/

$topTrumpSet_query = new WP_Query(
    array(
        'post_type' => 'tt_toptrumps',
        'posts_per_page' => '-1',
        'order' => 'DESC',
    )
);

?>
Monkey


