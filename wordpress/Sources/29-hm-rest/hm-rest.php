<?php
/*
  Plugin Name: hm-rest
  License: GPLv2
 */

add_action('rest_api_init', 'hmrest_add_rests');

function hmrest_add_rests() {

    register_rest_route(
            'hmrest', 'users', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'hmrest_get_users'
            ), false
    );

    register_rest_route(
            'hmrest', 'user', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'hmrest_get_user',
        'args' => array(
            'user_id' => array(
                //'required' => true,
                'sanitize_callback' => 'absint',
                'default' => 1
            ),
            'user_name' => array(
                'required' => true,
            )
        )
            ), false
    );

    register_rest_route('hmrest', 'post', array(
        'methods' => WP_REST_Server::CREATABLE,
        'callback' => 'hmrest_get_post',
        'args' => array(
            'post_id' => array(
                'required' => true,
                'sanitize_callback' => 'absint'
            )
        )
    ));

    register_rest_route('hmrest', '/author/(?P<id>\d+)', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'hmrest_get_author',
        'args' => array(
            'id' => array(
                'sanitize_callback' => 'absint'
            )
        )
    ));

    register_rest_route('hmrest', '/(?P<type>[a-z]+)/(?P<id>\d+)', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'hmrest_get_author_new',
    ));
}

function hmrest_get_users() {
    global $wpdb;
    $query = "SELECT * FROM {$wpdb->users}";
    $response = new WP_REST_Response($wpdb->get_results($query));
    return $response;
}

function hmrest_get_user($request) {
    if ($request['user_id'] == 0) {
        return '0';
    }
    return $request['user_name'];
    $user = get_users('include=' . $request['user_id']);
    $response = new WP_REST_Response($user);
    return $response;
}

function hmrest_get_post($request) {
    $post_id = $request['post_id'];
    $response = new WP_REST_Response(get_post($post_id));
    return $response;
}

function hmrest_get_author($request) {
    //$user = get_users('include=' . $request['id']);
    //$response = new WP_REST_Response( $user );
    //return $response;
    return $request['id'];
}

function hmrest_get_author_new($request) {
    return $request['id'] . ' | ' . $request['type'];
}
