<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Geon_Tile
 */

?>
<?php
	$is_account_page = false;
	if(! is_user_logged_in() && is_account_page()){
		//if is login page hide nav
		$is_account_page = true;
	} else {
		the_title( '<h1 class="entry-title">', '</h1>' );
	}			
?>

<!--<article id="post-<?php// the_ID(); ?>" <?php// post_class(); ?>>
	<!--<header class="entry-header">
		<?php//the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	<!--</header><!-- .entry-header -->

	<?php //geon_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		@@@@
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'geon' ),
			'after'  => '</div>',
		) );
		?>
	</div>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'geon' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
