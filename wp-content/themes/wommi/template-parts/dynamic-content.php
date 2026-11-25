<?php
/** Optional database content, including Contact Form 7 shortcodes. */
defined( 'ABSPATH' ) || exit;
while ( have_posts() ) :
	the_post();
	if ( '' !== trim( get_the_content() ) ) : ?>
		<section class="dynamic-content wrap"><?php the_content(); wp_link_pages(); ?></section>
	<?php endif;
endwhile;
