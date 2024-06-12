<?php 

function university_post_types() {    

    // Event Post Type
    $eventLabels = array(
        'name' => _x( 'Event', 'Post type general name', 'event' ),
        'singular_name' => _x( 'Event', 'Post type singular name', 'event' ),
        'menu_name' => _x( 'Events', 'Admin Menu text', 'event' ),
        'name_admin_bar' => _x( 'Event', 'Add New on Toolbar', 'event' ),
        'add_new' => __( 'Add New Event', 'event' ),
        'add_new_item' => __( 'Add New Event', 'event' ),
        'new_item' => __( 'New Event', 'event' ),
        'edit_item' => __( 'Edit Event', 'event' ),
        'view_item' => __( 'View Event', 'event' ),
        'all_items' => __( 'All Events', 'event' )
        );
            
    $eventArgs = array(
            'labels' => $eventLabels,
            'capability_type' => 'event',
            'map_meta_cap' => true,
            'supports' => array('title', 'editor', 'excerpt'),
            'rewrite' => array('slug' => 'events'),
            'has_archive' => true,
            'public' => true,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-calendar-alt'
            );

    register_post_type('event', $eventArgs);

    // Program Post Type
    $programLabels = array(
        'name' => _x( 'Program', 'Post type general name', 'program' ),
        'singular_name' => _x( 'Program', 'Post type singular name', 'program' ),
        'menu_name' => _x( 'Programs', 'Admin Menu text', 'program' ),
        'name_admin_bar' => _x( 'Program', 'Add New on Toolbar', 'program' ),
        'add_new' => __( 'Add New Program', 'program' ),
        'add_new_item' => __( 'Add New Program', 'program' ),
        'new_item' => __( 'New Program', 'program' ),
        'edit_item' => __( 'Edit Program', 'program' ),
        'view_item' => __( 'View Program', 'program' ),
        'all_items' => __( 'All Programs', 'program' )
        );
            
    $programArgs = array(
            'labels' => $programLabels,
            'capability_type' => 'program',
            'map_meta_cap' => true,
            'supports' => array('title', 'editor'),
            'rewrite' => array('slug' => 'programs'),
            'has_archive' => true,
            'public' => true,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-awards'
            );

    register_post_type('program', $programArgs);

    // Professor Post Type
    $professorLabels = array(
        'name' => _x( 'Professor', 'Post type general name', 'professor' ),
        'singular_name' => _x( 'Professor', 'Post type singular name', 'professor' ),
        'menu_name' => _x( 'Professors', 'Admin Menu text', 'professor' ),
        'name_admin_bar' => _x( 'Professor', 'Add New on Toolbar', 'professor' ),
        'add_new' => __( 'Add New Professor', 'professor' ),
        'add_new_item' => __( 'Add New Professor', 'professor' ),
        'new_item' => __( 'New Professor', 'professor' ),
        'edit_item' => __( 'Edit Professor', 'professor' ),
        'view_item' => __( 'View Professors', 'professor' ),
        'all_items' => __( 'All Professors', 'professor' )
        );
            
    $professorArgs = array(
            'labels' => $professorLabels,
            'supports' => array('title', 'editor', 'thumbnail'),
            'rewrite' => array('slug' => 'professors'),
            'public' => true,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-welcome-learn-more'
            );

    register_post_type('professor', $professorArgs);   

    // Campus Post Type

    $campusLabels = array(
        'name' => _x( 'Campus', 'Post type general name', 'campus' ),
        'singular_name' => _x( 'Campus', 'Post type singular name', 'campus' ),
        'menu_name' => _x( 'Campuses', 'Admin Menu text', 'campus' ),
        'name_admin_bar' => _x( 'Campus', 'Add New on Toolbar', 'campus' ),
        'add_new' => __( 'Add New Campus', 'campus' ),
        'add_new_item' => __( 'Add New Campus', 'campus' ),
        'new_item' => __( 'New Campus', 'campus' ),
        'edit_item' => __( 'Edit Campus', 'campus' ),
        'view_item' => __( 'View Campus', 'campus' ),
        'all_items' => __( 'All Campuses', 'campus' )
        );
            
    $campusArgs = array(
            'labels' => $campusLabels,
            'capability_type' => 'campus',
            'map_meta_cap' => true,
            'supports' => array('title', 'editor', 'excerpt'),
            'rewrite' => array('slug' => 'campuses'),
            'has_archive' => true,
            'public' => true,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-location-alt'
            );

    register_post_type('campus', $campusArgs);           

    // Note Post Type
    $noteLabels = array(
        'name' => _x( 'Notes', 'Post type general name', 'note' ),
        'singular_name' => _x( 'Note', 'Post type singular name', 'note' ),
        'menu_name' => _x( 'Notes', 'Admin Menu text', 'note' ),
        'name_admin_bar' => _x( 'Note', 'Add New on Toolbar', 'note' ),
        'add_new' => __( 'Add New Note', 'note' ),
        'add_new_item' => __( 'Add New Note', 'note' ),
        'new_item' => __( 'New Note', 'note' ),
        'edit_item' => __( 'Edit Note', 'note' ),
        'view_item' => __( 'View Notes', 'note' ),
        'all_items' => __( 'All Notes', 'note' )
        );
            
    $noteArgs = array(
            'capability_type' => 'post',
            'map_meta_cap' => true,
            'labels' => $noteLabels,
            'supports' => array('title', 'editor'),
            'rewrite' => array('slug' => 'notes'),
            'public' => false,
            'show_ui' => true,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-welcome-write-blog'
            );

    register_post_type('note', $noteArgs);   


    $likeLabels = array(
        'name' => _x( 'Like', 'Post type general name', 'like' ),
        'singular_name' => _x( 'Like', 'Post type singular name', 'like' ),
        'menu_name' => _x( 'Likes', 'Admin Menu text', 'like' ),
        'name_admin_bar' => _x( 'Like', 'Add New on Toolbar', 'like' ),
        'add_new' => __( 'Add New Like', 'like' ),
        'add_new_item' => __( 'Add New Like', 'like' ),
        'new_item' => __( 'New Like', 'like' ),
        'edit_item' => __( 'Edit Like', 'like' ),
        'view_item' => __( 'View Likes', 'like' ),
        'all_items' => __( 'All Likes', 'like' )
        );
            
    $likeArgs = array(
            'capability_type' => 'like',
            'map_meta_cap' => true,
            'labels' => $likeLabels,
            'supports' => array('title'),
            'rewrite' => array('slug' => 'likes'),
            'public' => false,
            'show_ui' => true,
            'menu_icon' => 'dashicons-heart'
            );

    register_post_type('like', $likeArgs);   

}

add_action('init','university_post_types');

?>
