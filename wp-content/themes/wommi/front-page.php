<?php defined( 'ABSPATH' ) || exit; get_header(); ?>
<main id="main">
	<section class="hero wrap">
		<p class="eyebrow">wommi.org</p>
		<h1><?php esc_html_e( 'Welcome to Wommi', 'wommi' ); ?></h1>
		<p><?php esc_html_e( 'Our website is taking shape. Check back soon.', 'wommi' ); ?></p>
	</section>
	<?php get_template_part( 'template-parts/dynamic-content' ); ?>
</main>
<?php get_footer(); ?>
