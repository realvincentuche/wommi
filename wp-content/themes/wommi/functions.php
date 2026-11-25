<?php
/** Wommi theme setup and page creation. */
defined( 'ABSPATH' ) || exit;

function wommi_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	register_nav_menus( array( 'primary' => __( 'Primary menu', 'wommi' ), 'footer' => __( 'Footer menu', 'wommi' ) ) );
}
add_action( 'after_setup_theme', 'wommi_setup' );

function wommi_assets() {
	$version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'wommi-style', get_stylesheet_uri(), array(), $version );
	wp_enqueue_style( 'wommi-main', get_template_directory_uri() . '/assets/css/main.css', array( 'wommi-style' ), $version );
	wp_enqueue_script( 'wommi-main', get_template_directory_uri() . '/assets/js/main.js', array(), $version, true );
}
add_action( 'wp_enqueue_scripts', 'wommi_assets' );

function wommi_menu_fallback() {
	echo '<ul class="menu">';
	foreach ( array( '' => __( 'Home', 'wommi' ), 'about' => __( 'About', 'wommi' ), 'contact' => __( 'Contact', 'wommi' ) ) as $slug => $label ) {
		echo '<li><a href="' . esc_url( home_url( '/' . $slug . ( $slug ? '/' : '' ) ) ) . '">' . esc_html( $label ) . '</a></li>';
	}
	echo '</ul>';
}

function wommi_required_pages() {
	return array( 'home' => __( 'Home', 'wommi' ), 'about' => __( 'About', 'wommi' ), 'contact' => __( 'Contact', 'wommi' ) );
}

function wommi_seed_pages() {
	$ids = array();
	foreach ( wommi_required_pages() as $slug => $title ) {
		$page = get_page_by_path( $slug );
		$id = $page ? $page->ID : wp_insert_post( array( 'post_title' => $title, 'post_name' => $slug, 'post_type' => 'page', 'post_status' => 'publish', 'post_content' => '' ), true );
		if ( $id && ! is_wp_error( $id ) ) {
			$ids[ $slug ] = $id;
		}
	}
	if ( isset( $ids['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['home'] );
	}
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'wommi_seed_pages' );

function wommi_setup_notice() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$missing = array();
	foreach ( wommi_required_pages() as $slug => $title ) {
		if ( ! get_page_by_path( $slug ) ) {
			$missing[] = $title;
		}
	}
	if ( ! $missing ) {
		return;
	}
	$url = wp_nonce_url( admin_url( 'admin-post.php?action=wommi_setup_pages' ), 'wommi_setup_pages' );
	echo '<div class="notice notice-warning"><p>' . esc_html( 'Wommi: missing pages: ' . implode( ', ', $missing ) . '. ' ) . '<a href="' . esc_url( $url ) . '">' . esc_html__( 'Create pages now', 'wommi' ) . '</a></p></div>';
}
add_action( 'admin_notices', 'wommi_setup_notice' );

function wommi_setup_pages_handler() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Not allowed.', 'wommi' ) );
	}
	check_admin_referer( 'wommi_setup_pages' );
	wommi_seed_pages();
	wp_safe_redirect( admin_url( 'edit.php?post_type=page' ) );
	exit;
}
add_action( 'admin_post_wommi_setup_pages', 'wommi_setup_pages_handler' );
