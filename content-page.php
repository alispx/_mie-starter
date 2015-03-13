<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package _mie
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'article' ); ?> itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
	<header class="entry-header">
		<h2 class="page-title" itemprop="headline"><?php the_title(); ?></h2>
	</header><!-- .entry-header -->

	<div class="entry-content" itemprop="text">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', '_mie' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', '_mie' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
