<?php

/**
 * Super Easy Breadcrumbs
 * 
 * Creates an unordered list for ancestor links.
 *
 * @example <?php easy_breadcrumbs(); ?>
 * @author Scott Nelle
 * @package wpbst_framework
 * @subpackage den_custom_hooks
**/

	function wpbst_breadcrumbs() {
		global $post;
	    $parent_id = $post->post_parent;
	    if ($parent_id == 0) { return false; }
	    else {
	        $output = '';
	        while ($parent_id != 0) {
	            $ancestor = get_post($parent_id);
	            $output = '<li><a href="'.get_permalink($ancestor->ID).'">'.$ancestor->post_title.'</a></li>' . $output;

	            $parent_id = $ancestor->post_parent;

	        }
	        echo '<div id="breadcrumbs"><div class="container"><ol class="breadcrumb"><li><a href="'.home_url().'">Home</a></li>' .$output.'<li class="active">' . $post->post_title . '</li></ol></div></div>';
	    }
	}

/**
 * Super Easy Child Pages
 * 
 * Creates a list of child pages using Bootstrap 3 panels and navs.
 *
 * @example <?php wpbst_breadcrumbs(); ?>
 * @author Darin Cassler
 * @package wpbst_framework
 * @subpackage wpbst_custom_hooks
**/

	function wpbst_children() {
		global $post; // Setup the global variable $post
		if ( is_page() && $post->post_parent ) // Make sure we are on a page and that the page is a parent
			$kiddies = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
		else
			$kiddies = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
		 
		if ( $kiddies ) {
			$html .= '<div class="panel panel-default">';
			$html .= '<div class="panel-heading">Further Reading</div>';
			$html .= '<div class="panel-body">';
			$html .= '<ul class="nav nav-pills">';
			$html .= $kiddies;
			$html .= '</ul>';
			$html .= '</div></div>';
			echo $html;
		}
	}

function wpbst_pager() {

	if($wp_query->max_num_pages > 1): ?>
	<ul class="pager">
		<li class="previous"><?php previous_posts_link('&laquo; Previous Page') ?></li>
		<li class="next"><?php next_posts_link('Next Page &raquo;') ?></li>
	</ul>
	<?php endif; ?>

	<?php if(is_single()) { ?>
	<ul class="pager">
		<li class="previous"><?php previous_post('%', '&laquo; Previous Post', 'no'); ?></li>
		<li class="next"><?php next_post('%', 'Next Post &raquo;', 'no') ?></li>
	</ul>
	<?php }}

?>