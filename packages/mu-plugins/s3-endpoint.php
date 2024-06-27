<?php

function tw_s3_uploads_s3_client_params( $params ) {
    $params["endpoint"] = S3_UPLOADS_ENDPOINT;
    $params["use_path_style_endpoint"] = true;
    return $params;
}

add_filter( "s3_uploads_s3_client_params", "tw_s3_uploads_s3_client_params");

/**
 * Add preconnect link to resource hints
 */
function custom_resource_hints( $hints, $relation_type ) {
    if ( 'preconnect' === $relation_type && defined('S3_UPLOADS_BUCKET_URL') && !empty(S3_UPLOADS_BUCKET_URL) ) {
        $hints[] = S3_UPLOADS_BUCKET_URL;
    }
    return $hints;
}
add_filter( 'wp_resource_hints', 'custom_resource_hints', 10, 2 );