<?php

/*
Plugin Name: Top Trumps feature
Plugin URI:
Description: A custom post plugin for Pragmatic challenge
Author: Jana Lyon
Version: 1.0
Author URI: http://janalyon.com
*/


//Exit if accessed directly.
if( !defined( 'ABSPATH' ) ) exit;

//Register top trump post type
function tt_register_post_type(){

    $labels = array(
        'add_new_item'          => _x( "Add a new character", 'Add new text', 'top-trumps' ),
        'add_new'               => _x( "Add new character", 'Add new post', 'top-trumps' ),
        'edit_item'             => _x( "Edit character", 'Add new post', 'top-trumps' ),
        'name'                  => _x( "Character cards", 'Post type general name', 'top-trumps' ),
        'singular_name'         => _x( "Character card", 'Post type singular name', 'top-trumps' ),
        'menu_name'             => _x( "Top Trumps", 'Admin Menu text', 'top-trumps' ),
        'name_admin_bar'        => _x( "Trump card", 'Add New on Toolbar', 'top-trumps' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'top-trumps' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'author', 'thumbnail' ),
        'menu_icon'			 => 'dashicons-id-alt',
        'register_meta_box_cb' => 'add_top_trump_metaboxes',
    );

    register_post_type( 'tt_toptrumps', $args );
}

add_action( 'init', 'tt_register_post_type' );

//Register item type taxonomy

function tt_create_taxonomy(){

    $labels = array(
        'name'              => _x( 'Item Types', 'taxonomy general name', 'top-trumps' ),
        'singular_name'     => _x( 'Item Type', 'taxonomy singular name', 'top-trumps' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'top-trumps' ),
    );
    register_taxonomy( 'tt_item_type', 'tt_toptrumps', $args );

}
add_action( 'init', 'tt_create_taxonomy' );


function add_top_trump_metaboxes(){
    add_meta_box( 'tt_create_toptrump', 'Add character data', 'tt_create_toptrump', 'tt_toptrumps', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'add_top_trump_metaboxes' );

function tt_create_toptrump($post) {
    wp_nonce_field( 'tt_create_toptrump_meta_box', 'tt_create_toptrump_nonce' );

    $tt_height_value = get_post_meta( $post->ID,'_tt_create_height', true );
    $tt_intelligence_value = get_post_meta( $post->ID,'_tt_create_intelligence', true );
    $tt_strength_value = get_post_meta( $post->ID,'_tt_create_strength', true );
    $tt_speed_value = get_post_meta( $post->ID,'_tt_create_speed', true );
    $tt_agility_value = get_post_meta( $post->ID,'_tt_create_agility', true );
    $tt_fighting_skills_value = get_post_meta( $post->ID,'_tt_create_fighting_skills', true );

    echo '<label for="toptrump-height">'. 'Height' .'</label><br>';
    echo '<em>Add character height (cm): </em>';
    echo '<input type="number" id="toptrump-height" name="height_value" min="0" max="300" value="'. $tt_height_value .'" size="30"/><br><br>';

    echo '<label for="toptrump-intelligence">'. 'Intelligence' .'</label><br>';
    echo '<em>Add character intelligence score: </em>';
    echo '<input type="number" id="toptrump-intelligence" name="intelligence_value" min="0" max="100" value="'. $tt_intelligence_value .'" size="50"/><br><br>';

    echo '<label for="toptrump-strength">'. 'Strength' .'</label><br>';
    echo '<em>Add character strength score: </em>';
    echo '<input type="number" id="toptrump-strength" name="strength_value" min="0" max="100" value="'. $tt_strength_value .'" size="50"/><br><br>';

    echo '<label for="toptrump-speed">'. 'Speed' .'</label><br>';
    echo '<em>Add character speed score: </em>';
    echo '<input type="number" id="toptrump-speed" name="speed_value" min="0" max="100" value="'. $tt_speed_value .'" size="50"/><br><br>';

    echo '<label for="toptrump-agility">'. 'Agility' .'</label><br>';
    echo '<em>Add character agility score: </em>';
    echo '<input type="number" id="toptrump-agility" name="agility_value" min="0" max="100" value="'. $tt_agility_value .'" size="50"/><br><br>';

    echo '<label for="toptrump-fightingskills">'. 'Fighting skills' .'</label><br>';
    echo '<em>Add character fighting skills score: </em>';
    echo '<input type="number" id="toptrump-fightingskills" name="fighting_skills_value" min="0" max="100" value="'. $tt_fighting_skills_value .'" size="50"/><br><br>';


}
function save_toptrump_metaboxes($post_id){
    //check whether the user has the ability to edit a post
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    //check if the Nonce is set
    if ( ! isset( $_POST['tt_create_toptrump_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['tt_create_toptrump_nonce'], 'tt_create_toptrump_meta_box' ) ) {

        return;
    }

    //prevent the data from being auto-saved. Saving to be done once the "Save" or "Update" button has been clicked
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    //ensure our inputs, are set and ready before we submit the entries
    if ( ! isset( $_POST['height_value'] ) || ! isset( $_POST['intelligence_value'] ) || ! isset( $_POST['strength_value'] ) || ! isset( $_POST['speed_value'] ) || ! isset( $_POST['agility_value'] ) || ! isset( $_POST['fighting_skills_value'] ) ) {
        //return;
    }

    //check the entry is free from any unexpected characters that may compromise website security
    $height_value = sanitize_text_field( $_POST['height_value'] );
    $intelligence_value = sanitize_text_field( $_POST['intelligence_value'] );
    $strength_value = sanitize_text_field( $_POST['strength_value'] );
    $speed_value = sanitize_text_field( $_POST['speed_value'] );
    $agility_value = sanitize_text_field( $_POST['agility_value'] );
    $fighting_skills_value = sanitize_text_field( $_POST['fighting_skills_value'] );


    //save the entries into the database
    update_post_meta( $post_id, '_tt_create_height', $height_value );
    update_post_meta( $post_id, '_tt_create_intelligence', $intelligence_value );
    update_post_meta( $post_id, '_tt_create_strength', $strength_value );
    update_post_meta( $post_id, '_tt_create_speed', $speed_value );
    update_post_meta( $post_id, '_tt_create_agility', $agility_value );
    update_post_meta( $post_id, '_tt_create_fighting_skills', $fighting_skills_value );


}
add_action( 'save_post', 'save_toptrump_metaboxes' );


function tt_custom_template($single) {

    global $wp_query, $post;

    /* Checks for single template by post type */
    if ($post->post_type == "tt_toptrumps"){
        if(file_exists(plugin_dir_path( __FILE__ ) . '/tt_toptrumps.php'))
            return plugin_dir_path( __FILE__ ) . '/tt_toptrumps.php';
    }
    return $single;
}

/* Filter the single_template with our custom function*/
add_filter('single_template', 'tt_custom_template', 999);

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'myplugin_flush_rewrites' );
function myplugin_flush_rewrites() {
    // call your CPT registration function here (it should also be hooked into 'init')
    tt_register_post_type();
    flush_rewrite_rules();
}

// Add template functionality
function tt_locate_template( $template_name, $template_path = '', $default_path = '' ) {

    // Set default plugin templates path.
    if ( ! $default_path ) :
        $default_path = plugin_dir_path( __FILE__ ) . 'templates/'; // Path to the template folder
    endif;

    // Search template file in theme folder.
    $template = locate_template( array(
        $template_path . $template_name,
        $template_name
    ) );

    // Get plugins template file.
    if ( ! $template ) :
        $template = $default_path . $template_name;
    endif;

    return apply_filters( 'tt_locate_template', $template, $template_name, $template_path, $default_path );

}
// Get template
function tt_get_template( $template_name, $args = array(), $tempate_path = '', $default_path = '' ) {

    if ( is_array( $args ) && isset( $args ) ) :
        extract( $args );
    endif;

    $template_file = tt_locate_template( $template_name, $tempate_path, $default_path );

    if ( ! file_exists( $template_file ) ) :
        _doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );
        return;
    endif;

    include $template_file;

}