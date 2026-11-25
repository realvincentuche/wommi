<?php defined( 'ABSPATH' ) || exit; ?>
<footer class="site-footer wrap">
	<p>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
	<nav aria-label="<?php esc_attr_e( 'Footer navigation', 'wommi' ); ?>"><?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'fallback_cb' => 'wommi_menu_fallback' ) ); ?></nav>
</footer>
<?php wp_footer(); ?>
</body>
</html>
