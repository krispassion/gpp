<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file. 
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

function generatepress_child_enqueue_scripts() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'generatepress-rtl', trailingslashit( get_template_directory_uri() ) . 'rtl.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'generatepress_child_enqueue_scripts', 100 );



add_action( 'generate_after_entry_content', 'jam_custom_post_type_post_nav' );
function jam_custom_post_type_post_nav() {
	if ( 'project' == get_post_type() ) : ?>
		<footer class="entry-meta">
			<?php generate_entry_meta(); ?>
			<?php if ( is_single() ) generate_content_nav( 'nav-below' ); ?>
		</footer><!-- .entry-meta -->
	<?php endif;
}







function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Group.
	 */

	$labels = array(
		"name" => __( "Group", "" ),
		"singular_name" => __( "Group", "" ),
	);

	$args = array(
		"label" => __( "Group", "" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Group",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'group', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "group", array( "project" ), $args );
}

add_action( 'init', 'cptui_register_my_taxes' );



function cptui_register_my_taxes_group() {

	/**
	 * Taxonomy: Group.
	 */

	$labels = array(
		"name" => __( "Group", "" ),
		"singular_name" => __( "Group", "" ),
	);

	$args = array(
		"label" => __( "Group", "" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Group",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'group', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "group", array( "project" ), $args );
}

add_action( 'init', 'cptui_register_my_taxes_group' );







function my_cptui_add_post_types_to_archives( $query ) {
	// We do not want unintended consequences.
	if ( is_admin() || ! $query->is_main_query() ) {
		return;    
	}

	if ( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
		$cptui_post_types = cptui_get_post_type_slugs();

		$query->set(
			'post_type',
			array_merge(
				array( 'post' ),
				$cptui_post_types
			)
		);
	}
}
add_filter( 'pre_get_posts', 'my_cptui_add_post_types_to_archives' );
