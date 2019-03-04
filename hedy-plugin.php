<?php
/*
Plugin Name: ITO Plugin for hedy.rhizomes.net
Description: Site specific code changes for hedy.rhizomes.net
*/
/* Start Adding Functions Below this Line */
 
/* Only see own posts */ 

function posts_for_current_author($query) {
    global $pagenow;
 
    if( 'edit.php' != $pagenow || !$query->is_admin )
        return $query;
 
    if( !current_user_can( 'edit_others_posts' ) ) {
        global $user_ID;
        $query->set('author', $user_ID );
    }
    return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');

/* end Only see own posts */
 
function shapeSpace_display_search_form() {
	$search_form = '<form method="get" id="search-form-alt" action="'. esc_url(home_url('/')) .'">
		<input type="text" name="search" id="s" placeholder="Refine Search.." style="width:50%;height:30px;">
	</form>';
	return $search_form;
}
add_shortcode('display_search_form', 'shapeSpace_display_search_form');
 
/**
 * Modify the "must_log_in" string of the comment form.
 *
 * @see http://wordpress.stackexchange.com/a/170492/26350
 */
add_filter( 'comment_form_defaults', function( $fields ) {
    $fields['must_log_in'] = sprintf( 
        __( '<p class="must-log-in">
                 You must <a href="http://hedy.rhizomes.net/join-in/">Register</a> or 
                 <a href="http://hedy.rhizomes.net/login/">Login</a> to post a comment.</p>' 
        ),
        wp_registration_url(),
        wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )   
    );
    return $fields;
});

 
/* Logged in Users Filter

function ito_stop_guests( $content ) {
    global $post;

    if ( $post->category-slug == 'extras' ) {
        if ( !is_user_logged_in() ) {
            $content = 'Please login to view this post';
        }
    }

    return $content;
}

add_filter( 'the_content', 'ito_stop_guests' );


/* end Logged In Users Filter*/
  
/* Stop Adding Functions Below this Line */
?>