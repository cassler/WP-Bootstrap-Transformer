<?php
/**
 * Excerpts in Bootstrap
 *
 * @author Darin Cassler
 * @package wpbst
 * @subpackage wpbst_excerpts
**/

	function wpbst_continue_reading_link() {
			return '<p><a class="btn btn-default" href="'. get_permalink() . '">Read More <span class="glyphicon glyphicon-chevron-right"></span></a></p>';
		}

		function wpbst_auto_excerpt_more( $more ) {
			return '&hellip;</p>' . wpbst_continue_reading_link();
		}
		add_filter( 'excerpt_more', 'wpbst_auto_excerpt_more' );

		function wpbst_custom_excerpt_more( $output ) {
			if ( has_excerpt() && ! is_attachment() ) {
				$output .= wpbst_continue_reading_link();
			}
			return $output;
		}
	add_filter( 'get_the_excerpt', 'wpbst_custom_excerpt_more' );

/**
 * Filter widgets to be more bootstrapy
 *
 * @author Darin Cassler
 * @package wpbst
 * @subpackage wpbst_widgets
**/

	function add_slug_css_list_categories($list) {

	$cats = get_categories();
		foreach($cats as $cat) {
			$find = 'cat-item-' . $cat->term_id . '"';
			$replace = 'list-group-item category-' . $cat->slug . '"';
			$list = str_replace( $find, $replace, $list );
			$find = 'cat-item-' . $cat->term_id . ' ';
			$replace = 'category-' . $cat->slug . ' ';
			$list = str_replace( $find, $replace, $list );
		}
		return $list;
	}

	add_filter('wp_list_categories', 'add_slug_css_list_categories');

	function cat_count_span($links) {
  		$links = str_replace('</a> (', '</a> <span class="badge badge-primary">', $links);
  		$links = str_replace(')', '</span>', $links);
  		return $links;
	}
	add_filter('wp_list_categories', 'cat_count_span');

?>