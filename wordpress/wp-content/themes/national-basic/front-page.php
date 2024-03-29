<?php
/**
 * The front page template.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @since 1.0.0
 */
get_header();

global $paged;
$bavotasan_theme_options = bavotasan_theme_options();

if ( 2 > $paged ) {
	// Display header image
	echo do_shortcode("[metaslider id=48]");

	// Display home page top widgetized area
	if ( is_active_sidebar( 'home-page-top-area' ) ) {
		?>
		<div id="home-page-widgets">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar( 'home-page-top-area' ); ?>
				</div>
			</div>
		</div>
		<?php
	}
	
	// Featured sticky post section
	$sticky = get_option( 'sticky_posts' );
	rsort( $sticky );
	$sticky = array_slice( $sticky, 0, 8 );
	if ( $sticky ) {
		$query = new WP_Query( array( 
			'post__in' => $sticky, 
			'ignore_sticky_posts' => 1,
		) );
	
		if ( $query->have_posts() ) {
			?>
			<div class="sticky-container clearfix">
				<ul class="cbp-rfgrid">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'sticky' ); ?><div><h3><span><?php the_title(); ?></span></h3></div></a></li>				
					<?php endwhile; ?>
				</ul>
			</div>
			<?php
		}
		wp_reset_query();
	}
}
?>

<div class="container">
	<div class="row">
		<?php
		if ( 'page' == get_option( 'show_on_front' ) ) {
			include( get_page_template() );
		} else {
			?>
			<div id="primary" <?php bavotasan_primary_attr(); ?>>
		        <?php
				if ( have_posts() ) {
					while ( have_posts() ) : the_post();
						get_template_part( 'content', get_post_format() );
					endwhile;
		
					bavotasan_pagination();
				} else {
					get_template_part( 'content', 'none' );
				}
				?>
			</div><!-- #primary -->
			<?php
			get_sidebar();
		}
		?>
	</div>
</div>
<?php
get_footer();