<?php defined( 'ABSPATH' ) || exit; get_header(); ?>
<main id="main" class="wrap posts">
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class(); ?>>
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</article>
		<?php the_post_navigation(); ?>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>
