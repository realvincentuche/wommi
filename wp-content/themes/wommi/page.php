<?php defined( 'ABSPATH' ) || exit; get_header(); ?>
<main id="main">
	<header class="page-heading wrap"><h1><?php echo esc_html( get_the_title( get_queried_object_id() ) ); ?></h1></header>
	<?php get_template_part( 'template-parts/dynamic-content' ); ?>
</main>
<?php get_footer(); ?>
