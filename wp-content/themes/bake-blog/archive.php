<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bake-blog
 */

get_header();
?>
<div class="block-gap clear">
	<div class="container">
		<main id="primary" class="site-main">
			<div class="archive-blog column-2 clear">
				<?php if ( have_posts() ) : ?>
					
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			</div>

		</main><!-- #main -->
		<?php get_sidebar(); ?>
	</div>
</div>

<?php
get_footer();
