<?php

function pageBanner($args = NULL) {

	if (!$args['title']) {
		$args['title'] = get_the_title();
	}

	if (get_field('page_banner_subtitle')) {
		$args['subtitle'] = get_field('page_banner_subtitle');
	}

	if (get_field('page_banner_background_image')) {

		$args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];

	} elseif (get_theme_file_uri('/images/ocean.jpg')) { 

		$args['photo'] = get_theme_file_uri('/images/ocean.jpg');

	} else {

		$args['photo'] = 'https://images.unsplash.com/photo-1554189097-469e3847835d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80';

	}
?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
      <div class="page-banner__intro">
        <p><?php echo $args['subtitle']; ?></p>
      </div>
    </div>  
</div>

<?php }

// Add styles to the heade section and javasript to before closng body tag, it must include TRUE to lad the script at the bottom of the DOM
function university_file() {
	wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyD1xevXoRZ16d3eZb9ic-vt3KyUIClUEC0', NULL, '1.0', true);

	wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
	
	wp_enqueue_style('custom-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i" rel="stylesheet');
	wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css');
	wp_enqueue_style('university_main_styles', get_stylesheet_uri());
	wp_localize_script('main-university-js', 'universityData', array(
		'root_url' => get_site_url()
	));
}

add_action('wp_enqueue_scripts', 'university_file');
//

//Add interactive menu to the header and footer and add meta title to the all pages
function university_features() {
	register_nav_menu('headerMenuLocation', 'Header Menu Loction');
	register_nav_menu('footerMenuLocationOne', 'Footer Location One');
	register_nav_menu('footerMenuLocationTwo', 'Footer Location Two');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_image_size('professorLandscape', 400, 260, true);
	add_image_size('professorPortrait', 480, 650, true);
	add_image_size('pageBanner', 1500, 350, true);
}

add_action('after_setup_theme', 'university_features');

//


function add_current_nav_class( $classes, $item ) {
 
    // Getting the current post details
    global $post;
 
    // Getting the post type of the current post
    $current_post_type = get_post_type_object( get_post_type( $post->ID ) );
    $current_post_type_slug = $current_post_type->rewrite[ 'slug' ];
 
    // Getting the URL of the menu item
    $menu_slug = strtolower( trim( $item->url ) );
 
    // Unset current page parent css for non post pages
    $post_type = get_post_type( $post );
    if ( $post_type != 'post' ) {
        $index = array_search( 'current_page_parent', $classes );
        unset( $classes[ $index ] );
    }
 
    // If the menu item URL contains the current post types slug add the current-menu-item class
    if ( strpos( $menu_slug, $current_post_type_slug ) !== false ) {
        $classes[ ] = 'current_page_parent';
    }
 
    // Return the corrected set of classes to be added to the menu item
    return $classes;
 
}

add_action( 'nav_menu_css_class', 'add_current_nav_class', 10, 2 );

//Add modified WP query to Event Post Type archive page
function univeristy_adjust_queries($query) {
	if(!is_admin() AND is_post_type_archive('campus') AND $query->is_main_query()) {
		$query->set('posts_per_page', -1);
	}

	if(!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
		$query->set('orderby', 'title');
		$query->set('order', 'ASC');
		$query->set('posts_per_page', -1);
	}
	if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()){
		$today = date('Ymd');
		$query->set('meta_key' , 'event_date');
		$query->set('orderby' , 'meta_value_num');
		$query->set('order', 'ASC');
		$query->set('meta_query', array(
			array(
				'key' => 'event_date',
				'compare' => '>=',
				'value' => $today,
				'type' => 'numeric'
			)
		));
	}
}

add_action('pre_get_posts', 'univeristy_adjust_queries');
//

function universityMapKey($api) {

	$api['key'] = 'AIzaSyD1xevXoRZ16d3eZb9ic-vt3KyUIClUEC0';
	return $api;

}

add_filter('acf/fields/google_map/api', 'universityMapKey');
?>
