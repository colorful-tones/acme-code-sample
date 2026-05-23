<?php
if ( ! post_type_exists( 'team-member' ) ) {
    add_action( 'init', function () {
        register_post_type( 'team-member', [
            'label'        => 'Team Members',
            'labels'       => [ 'name' => 'Team Members', 'singular_name' => 'Team Member', 'add_new_item' => 'Add New Team Member', 'edit_item' => 'Edit Team Member' ],
            'public'       => true,
            'show_in_rest' => true,
            'supports'     => [ 'title', 'custom-fields' ],
            'menu_icon'    => 'dashicons-businessperson',
            'has_archive'  => false,
            'rewrite'      => [ 'slug' => 'team-member' ],
        ] );
    } );
}