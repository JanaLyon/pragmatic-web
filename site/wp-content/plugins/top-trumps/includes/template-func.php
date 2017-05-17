<?php
// Add template functionality
function tt_locate_template( $template_name, $template_path = '', $default_path = '' ) {

    // Set default plugin templates path.
    if ( ! $default_path ) :
        $default_path = plugin_dir_path( __FILE__ ) . '../templates/'; // Path to the template folder
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
?>