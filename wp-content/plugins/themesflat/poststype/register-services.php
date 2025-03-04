<?php
add_action('init', 'themesflat_register_services_post_type');
/**
  * Register services post type
*/
function themesflat_register_services_post_type() {
    /*services*/
    $services_slug = 'services';
    $labels = array(
        'name'                  => esc_html__( 'Services', 'themesflat' ),
        'singular_name'         => esc_html__( 'Service', 'themesflat' ),
        'menu_name'             => esc_html__( 'Services', 'themesflat' ),
        'add_new'               => esc_html__( 'New Service', 'themesflat' ),
        'add_new_item'          => esc_html__( 'Add New Service', 'themesflat' ),
        'new_item'              => esc_html__( 'New Service Item', 'themesflat' ),
        'edit_item'             => esc_html__( 'Edit Service Item', 'themesflat' ),
        'view_item'             => esc_html__( 'View Service', 'themesflat' ),
        'all_items'             => esc_html__( 'All Services', 'themesflat' ),
        'search_items'          => esc_html__( 'Search Services', 'themesflat' ),
        'not_found'             => esc_html__( 'No Services Items Found', 'themesflat' ),
        'not_found_in_trash'    => esc_html__( 'No Services Items Found In Trash', 'themesflat' ),
        'parent_item_colon'     => esc_html__( 'Parent Services:', 'themesflat' )

    );
    $args = array(
        'labels'        => $labels,
        'rewrite'       => array( 'slug' => $services_slug ),
        'supports'    => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'elementor','comments' ),
        'public'        => true,
        'show_in_rest' => true,
        'has_archive' => true
    );
    register_post_type( 'services', $args );
    flush_rewrite_rules();
}

add_filter( 'post_updated_messages', 'themesflat_services_updated_messages' );
/**
  * services update messages.
*/
function themesflat_services_updated_messages ( $messages ) {
    Global $post, $post_ID;
    $messages[esc_html__( 'services' )] = array(
        0  => '',
        1  => sprintf( esc_html__( 'Services Updated. <a href="%s">View Services</a>', 'themesflat' ), esc_url( get_permalink( $post_ID ) ) ),
        2  => esc_html__( 'Custom Field Updated.', 'themesflat' ),
        3  => esc_html__( 'Custom Field Deleted.', 'themesflat' ),
        4  => esc_html__( 'Services Updated.', 'themesflat' ),
        5  => isset( $_GET['revision']) ? sprintf( esc_html__( 'Services Restored To Revision From %s', 'themesflat' ), wp_post_revision_title((int)$_GET['revision'], false)) : false,
        6  => sprintf( esc_html__( 'Services Published. <a href="%s">View Services</a>', 'themesflat' ), esc_url( get_permalink( $post_ID ) ) ),
        7  => esc_html__( 'Services Saved.', 'themesflat' ),
        8  => sprintf( esc_html__('Services Submitted. <a target="_blank" href="%s">Preview Services</a>', 'themesflat' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
        9  => sprintf( esc_html__( 'Services Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Services</a>', 'themesflat' ),date_i18n( esc_html__( 'M j, Y @ G:i', 'themesflat' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
        10 => sprintf( esc_html__( 'Services Draft Updated. <a target="_blank" href="%s">Preview Services</a>', 'themesflat' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
    );
    return $messages;
}

add_action( 'init', 'themesflat_register_services_taxonomy' );
/**
  * Register services taxonomy
*/
function themesflat_register_services_taxonomy() {
    /*services Categories*/
    $services_cat_slug = 'services_category';
    $labels = array(
        'name'                       => esc_html__( 'Services Categories', 'themesflat' ),
        'singular_name'              => esc_html__( 'Categories', 'themesflat' ),
        'search_items'               => esc_html__( 'Search Categories', 'themesflat' ),
        'menu_name'                  => esc_html__( 'Categories', 'themesflat' ),
        'all_items'                  => esc_html__( 'All Categories', 'themesflat' ),
        'parent_item'                => esc_html__( 'Parent Categories', 'themesflat' ),
        'parent_item_colon'          => esc_html__( 'Parent Categories:', 'themesflat' ),
        'new_item_name'              => esc_html__( 'New Categories Name', 'themesflat' ),
        'add_new_item'               => esc_html__( 'Add New Categories', 'themesflat' ),
        'edit_item'                  => esc_html__( 'Edit Categories', 'themesflat' ),
        'update_item'                => esc_html__( 'Update Categories', 'themesflat' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove Categories', 'themesflat' ),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used Categories', 'themesflat' ),
        'not_found'                  => esc_html__( 'No Categories found.' ),
    );
    $args = array(
        'labels'        => $labels,
        'rewrite'       => array('slug'=>$services_cat_slug),
        'hierarchical'  => true,
        'show_in_rest'  => true,
    );
    register_taxonomy( 'services_category', 'services', $args );
    flush_rewrite_rules();
}

add_action( 'init', 'themesflat_register_services_tag' );
/**
 * Register tag taxonomy
 */
function themesflat_register_services_tag() {
    $services_tag_slug = 'services_tag';

    $labels = array(
        'name'                       => esc_html__( 'Services Tags', 'themesflat' ),
        'singular_name'              => esc_html__( 'Services Tags', 'themesflat' ),
        'search_items'               => esc_html__( 'Search Tags', 'themesflat' ),
        'all_items'                  => esc_html__( 'All Tags', 'themesflat' ),
        'new_item_name'              => esc_html__( 'Add New Tag', 'themesflat' ),
        'add_new_item'               => esc_html__( 'New Tag Name', 'themesflat' ),
        'edit_item'                  => esc_html__( 'Edit Tag', 'themesflat' ),
        'update_item'                => esc_html__( 'Update Tag', 'themesflat' ),
        'menu_name'                  => esc_html__( 'Tags' ),
    );
    $args = array(
        'labels'       => $labels,
        'rewrite'       => array('slug'=>$services_tag_slug),
        'hierarchical' => true,
        'show_in_rest'  => true,
    );
    register_taxonomy( 'services_tag', 'services', $args );
    flush_rewrite_rules();
}