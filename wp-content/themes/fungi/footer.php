<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package fungi
 */
?>
</div><!-- #content -->
</div><!-- #main-content -->

<?php
$footer_wrap_classes = array(
	'footer_background',
	themesflat_get_opt_elementor( 'extra_classes_footer' ),
);
?>

<!-- Start Footer -->
<div class="<?php echo esc_attr( join( ' ', $footer_wrap_classes ) ); ?>">
    <!-- Bottom -->
	<?php if ( themesflat_get_opt( 'show_bottom' ) == 1 ): ?>
		<?php get_template_part( 'tpl/footer/bottom' ); ?>
	<?php endif; ?>

</div> <!-- Footer Background Image -->
<!-- End Footer -->
</div><!-- /#boxed -->
<?php wp_footer(); ?>
</body>
</html>