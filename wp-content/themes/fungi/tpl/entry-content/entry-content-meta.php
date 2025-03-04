<?php
/**
 * @package fungi
 */
?>
<?php
echo '<div class="post-meta d-flex align-items-center flex-wrap">';
$meta_elements = themesflat_layout_draganddrop( themesflat_get_opt( 'meta_elements' ) );
foreach ( $meta_elements as $meta_element ) :
	if ( 'author' == $meta_element ) {
		echo '<div class="item-meta post-author"><span class="meta-icon"><i class="fa fa-user"></i>
</span>';
		printf(
			'<a href="' . get_the_author() . '" class="meta-text" title="%s" rel="author">%s</a>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( esc_html__( 'By %s', 'fungi' ), get_the_author() ) ) );
		echo '</div>';
	} elseif ( 'date' == $meta_element ) {
		$archive_year  = get_the_time( 'Y' );
		$archive_month = get_the_time( 'm' );
		$archive_day   = get_the_time( 'd' );
		echo '<div class="item-meta post-date"><span class="meta-icon">
		<i class="fas fa-calendar"></i>
		</span><a href="' . get_day_link( $archive_year, $archive_month, $archive_day ) . '">';
		echo '<span class="meta-text" >' . get_the_date() . '</span>';
		echo '</a></div>';
	} elseif ( 'category' == $meta_element ) {
		echo '<div class="item-meta post-categories">';
		echo '<span class="meta-icon"><i class="fa fas-folder"></i>
</span>';
		the_category( ', ' );
		echo '</div>';
	} elseif ( 'comment' == $meta_element ) {
		echo '<div class="item-meta post-comments"><span class="meta-icon"><i class="fas fa-comments"></i>
</span><span class="meta-text">';
		comments_number();
		echo '</span></div>';
	}
endforeach;
echo '</div>';
?>