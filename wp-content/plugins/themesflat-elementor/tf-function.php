<?php
defined( 'TF_TEMPLATE_DEBUG_MODE' ) || define( 'TF_TEMPLATE_DEBUG_MODE', false );
/**
 * Get plugin dir
 *
 * @param string $file
 *
 * @return string
 */
function tf_get_plugin_dir( $file = '' ) {
	return plugin_dir_path( TF_PLUGIN_FILE ) . $file;
}


/**
 * Get plugin url
 *
 * @param string $file
 *
 * @return string
 */
function tf_get_plugin_url( $file = '' ) {
	return trailingslashit( plugins_url( '/', TF_PLUGIN_FILE ) ) . $file;
}

/**
 * Get plugin data
 *
 * @return array
 */
function tf_get_plugin_data() {
	if ( ! function_exists( 'get_plugin_data' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}

	return get_plugin_data( TF_PLUGIN_FILE );
}

/**
 * Get template path for plugin template
 *
 * @return string
 */
function tf_template_path() {
	return apply_filters( 'tf_template_path', 'themesflat/' );
}

/**
 * Locate template
 *
 * @param $template_name
 * @param string $template_path
 * @param string $default_path
 *
 * @return string
 */
function tf_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	if ( ! $template_path ) {
		$template_path = tf_template_path();
	}

	if ( ! $default_path ) {
		$default_path = tf_get_plugin_dir( 'templates/' );
	}

	// Look within passed path within the theme - this is priority.
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
		)
	);

	// Get default template/
	if ( ! $template || TF_TEMPLATE_DEBUG_MODE ) {
		$template = $default_path . $template_name;
	}

	// Return what we found.
	return apply_filters( 'tf_locate_template', $template, $template_name, $template_path );
}

/**
 * Include template
 *
 * @param $template_name
 * @param array $args
 * @param string $template_path
 * @param string $default_path
 */
function tf_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	if ( ! empty( $args ) && is_array( $args ) ) {
		extract( $args );
	}

	$located = tf_locate_template( $template_name, $template_path, $default_path );

	if ( $located !== '' ) {
		$located = apply_filters( 'tf_get_template', $located, $template_name, $args, $template_path, $default_path );

		do_action( 'tf_before_template_part', $template_name, $template_path, $located, $args );

		include( $located );

		do_action( 'tf_after_template_part', $template_name, $template_path, $located, $args );
	}
}

if ( ! function_exists( 'flat_get_post_page_content' ) ) {
	function flat_get_post_page_content( $slug ) {
		$content_post = get_posts( array(
			'name'           => $slug,
			'posts_per_page' => 1,
			'post_type'      => 'elementor_library',
			'post_status'    => 'publish'
		) );
		if ( array_key_exists( 0, $content_post ) == true ) {
			$id = $content_post[0]->ID;

			return $id;
		}
	}
}

if ( ! function_exists( 'tf_header_enabled' ) ) {
	function tf_header_enabled() {
		$header_id = ThemesFlat_Addon_For_Elementor_Fungi::get_settings( 'type_header', '' );
		$status    = false;

		if ( '' !== $header_id ) {
			$status = true;
		}

		return apply_filters( 'tf_header_enabled', $status );
	}
}

if ( ! function_exists( 'tf_footer_enabled' ) ) {
	function tf_footer_enabled() {
		$header_id = ThemesFlat_Addon_For_Elementor_Fungi::get_settings( 'type_footer', '' );
		$status    = false;

		if ( '' !== $header_id ) {
			$status = true;
		}

		return apply_filters( 'tf_footer_enabled', $status );
	}
}

if ( ! function_exists( 'get_header_content' ) ) {
	function get_header_content() {
		$tf_get_header_id = ThemesFlat_Addon_For_Elementor_Fungi::tf_get_header_id();
		echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $tf_get_header_id );
	}
}

if ( ! function_exists( 'tf_get_template_widget' ) ) {
	function tf_get_template_widget( $template_name, $args = null, $return = false ) {
		$template_file  = $template_name . '.php';
		$default_folder = plugin_dir_path( __FILE__ ) . 'templates/';
		$theme_folder   = apply_filters( 'tf_templates_folder', dirname( plugin_basename( __FILE__ ) ) );
		$template       = locate_template( $theme_folder . '/' . $template_file );
		if ( ! $template ) {
			$template = $default_folder . $template_file;
		}
		if ( $args && is_array( $args ) ) {
			extract( $args );
		}
		if ( $return ) {
			ob_start();
		}
		if ( file_exists( $template ) ) {
			include $template;
		}
		if ( $return ) {
			return ob_get_clean();
		}

		return null;
	}
}

function tf_kses_post( $s ) {
	$s = wp_filter_kses( $s );
	$s = str_replace( '&amp;', '&', $s );

	return $s;
}

function tf_recursive_sanitize_text_field( $data ) {
	if ( is_array( $data ) ) {
		foreach ( $data as $key => $value ) {
			$data[ $key ] = tf_recursive_sanitize_text_field( $data[ $key ] );
		}
	} else if ( is_object( $data ) ) {
		foreach ( $data as $key => $value ) {
			$data->{$key} = tf_recursive_sanitize_text_field( $data->{$key} );
		}
	} else if ( is_string( $data ) ) {
		$data = sanitize_text_field( $data );
	}

	return $data;
}

function tf_get_img_meta( $id ) {
	$attachment = get_post( $id );
	if ( $attachment == null || $attachment->post_type != 'attachment' ) {
		return null;
	}

	$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
	if ( '' === $alt ) {
		$alt = $attachment->post_title;
	}

	return [
		'alt'         => $alt,
		'caption'     => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href'        => get_permalink( $attachment->ID ),
		'src'         => $attachment->guid,
		'title'       => $attachment->post_title
	];
}

function tf_get_color_schemes( $allow_default = true ) {
	$schemes = array();
	if ( $allow_default ) {
		$schemes[''] = esc_html__( 'Default', 'themesflat' );
	}

	foreach ( tf_color_schemes_configs() as $k => $v ) {
		$schemes[ $k ] = $v['label'];
	}

	return $schemes;
}

function tf_color_schemes_configs() {
	$schemes = apply_filters( 'tf_color_schemes_configs', array(
		"accent"    => array(
			'label' => __( 'Accent', 'themesflat' ),
			'color' => '#007bff'
		),
		"primary"   => array(
			'label' => __( 'Primary', 'themesflat' ),
			'color' => '#007bff'
		),
		"secondary" => array(
			'label' => __( 'Secondary', 'themesflat' ),
			'color' => '#6c757d'
		),
		"light"     => array(
			'label' => __( 'Light', 'themesflat' ),
			'color' => '#f8f9fa'
		),
		"dark"      => array(
			'label' => __( 'Dark', 'themesflat' ),
			'color' => '#343a40'
		),
		"success"   => array(
			'label' => __( 'Success', 'themesflat' ),
			'color' => '#28a745'
		),
		"danger"    => array(
			'label' => __( 'Danger', 'themesflat' ),
			'color' => '#dc3545'
		),
		"warning"   => array(
			'label' => __( 'Warning', 'themesflat' ),
			'color' => '#ffc107'
		),
		"info"      => array(
			'label' => __( 'Info', 'themesflat' ),
			'color' => '#17a2b8'
		),
	) );

	foreach ( tf_get_system_colors() as $k => $v ) {
		if ( isset( $schemes[ $v['_id'] ] ) ) {
			$schemes[ $v['_id'] ]['color'] = $v['color'];
		}
	}

	return $schemes;
}

function tf_get_system_colors() {

	if ( isset( $GLOBALS['tf_system_colors'] ) ) {
		return $GLOBALS['tf_system_colors'];
	}
	$kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();

	$kit      = Elementor\Plugin::$instance->documents->get( $kit_id );
	$meta_key = Elementor\Core\Settings\Page\Manager::META_KEY;

	$kit_raw_settings            = $kit->get_meta( $meta_key );
	$GLOBALS['tf_system_colors'] = isset( $kit_raw_settings['system_colors'] ) ? $kit_raw_settings['system_colors'] : array();

	return $GLOBALS['tf_system_colors'];
}

function tf_get_post_types() {
	$post_types = get_post_types( [ 'public' => true, 'show_in_nav_menus' => true ], 'objects' );
	$post_types = wp_list_pluck( $post_types, 'label', 'name' );

	return array_diff_key( $post_types, [ 'elementor_library', 'attachment' ] );
}

function tf_get_all_types_post() {
	$posts = get_posts( [
		'post_type'      => 'portfolio',
		'post_style'     => 'all_types',
		'post_status'    => 'publish',
		'posts_per_page' => '-1',
	] );

	if ( ! empty( $posts ) ) {
		return wp_list_pluck( $posts, 'post_title', 'ID' );
	}

	return [];
}

function tf_get_authors() {
	$users = get_users( [
		'who'                 => 'authors',
		'has_published_posts' => true,
		'fields'              => [
			'ID',
			'display_name',
		],
	] );

	if ( ! empty( $users ) ) {
		return wp_list_pluck( $users, 'display_name', 'ID' );
	}

	return [];
}

function tf_get_post_orderby_options() {
	$orderby = array(
		'ID'            => esc_html__( 'Post ID', 'themesflat' ),
		'author'        => esc_html__( 'Post Author', 'themesflat' ),
		'title'         => esc_html__( 'Title', 'themesflat' ),
		'date'          => esc_html__( 'Date', 'themesflat' ),
		'modified'      => esc_html__( 'Last Modified Date', 'themesflat' ),
		'parent'        => esc_html__( 'Parent Id', 'themesflat' ),
		'rand'          => esc_html__( 'Random', 'themesflat' ),
		'comment_count' => esc_html__( 'Comment Count', 'themesflat' ),
		'menu_order'    => esc_html__( 'Menu Order', 'themesflat' ),
	);

	return $orderby;
}

function tf_get_terms_as_list( $term_type = 'category', $length = 10, $id = false ) {

	if ( $term_type === 'category' ) {
		$terms = get_the_terms( $id, 'portfolio_category' );
	}
	if ( empty( $terms ) ) {
		return '';
	}

	$html  = '<ul class="tf-term-list list-inline">';
	$count = 0;
	if($terms){
		foreach ( $terms as $term ) {
			if ( $count === $length ) {
				break;
			}
			$link = ( $term_type === 'category' ) ? get_category_link( $term->term_id ) : get_tag_link( $term->term_id );
			$html .= '<li class="list-inline-item">';
			$html .= '<a href="' . esc_url( $link ) . '">';
			$html .= $term->name;
			$html .= '</a>';
			$html .= '</li>';
			$count ++;
		}
    }

	$html .= '</ul>';

	return $html;
}

function tf_get_portfolio_query_args( $settings = [] ) {
	$settings = wp_parse_args( $settings, [
		'post_type'      => 'portfolio',
		'posts_ids'      => [],
		'orderby'        => 'date',
		'order'          => 'desc',
		'posts_per_page' => 3,
		'offset'         => 0,
		'post__not_in'   => [],
	] );

	$args = [
		'orderby'             => $settings['orderby'],
		'order'               => $settings['order'],
		'ignore_sticky_posts' => 1,
		'post_status'         => 'publish',
		'posts_per_page'      => $settings['posts_per_page'] != '' ? $settings['posts_per_page'] : - 1,
		'offset'              => $settings['offset'],
	];

	if ( 'by_id' === $settings['post_type'] ) {
		$args['post_type'] = 'any';
		$args['post__in']  = empty( $settings['posts_ids'] ) ? [ 0 ] : $settings['posts_ids'];
	} else {
		$args['post_type'] = $settings['post_type'];

		if ( $args['post_type'] !== 'page' ) {
			$args['tax_query'] = [];
			$taxonomies        = get_object_taxonomies( $settings['post_type'], 'objects' );

			foreach ( $taxonomies as $object ) {
				$setting_key = $object->name . '_ids';
				if ( ! empty( $settings[ $setting_key ] ) ) {
					$args['tax_query'][] = [
						'taxonomy' => $object->name,
						'field'    => 'term_id',
						'terms'    => $settings[ $setting_key ],
					];
				}
			}

			if ( ! empty( $args['tax_query'] ) ) {
				$args['tax_query']['relation'] = 'AND';
			}
		}
	}

	if ( ! empty( $settings['authors'] ) ) {
		$args['author__in'] = $settings['authors'];
	}

	if ( ! empty( $settings['post__not_in'] ) ) {
		$args['post__not_in'] = $settings['post__not_in'];
	}

	return $args;
}

function tf_render_template_post( $args, $settings ) {
	$query      = new \WP_Query( $args );
	$i          = 0;
	$grid_items = array();
	if ( isset( $settings['post_grid_items'] ) ) {
		$grid_items = $settings['post_grid_items'];
	}
	ob_start();
	if ( $query->have_posts() ) :
		while ( $query->have_posts() ):
			$query->the_post();
			if ( isset( $settings['show_image'] ) && $settings['show_image'] == 'yes' ) {
				if ( isset( $settings['image_size_mode'] ) ) {
					$pd_top      = 66.6666666;
					$media_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
					if ( $media_image ) {
						$pd_top = ( $media_image[2] / $media_image[1] ) * 100;
					}

					if ( isset( $settings['image_size_mode'] ) && $settings['image_size_mode'] !== 'custom' && $settings['image_size_mode'] !== 'original' ) {
						$pd_top = $settings['image_size_mode'];
					}

					if ( isset( $settings['image_size_mode'] ) && $settings['image_size_mode'] === 'custom' ) {
						$img_width  = isset( $settings['image_size_width'] ) ? intval( $settings['image_size_width'] ) : 0;
						$img_height = isset( $settings['image_size_height'] ) ? intval( $settings['image_size_height'] ) : 0;
						if ( $img_width > 0 && $img_height > 0 ) {
							$pd_top = ( $img_height / $img_width ) * 100;
						}
					}
					$settings['ratio'] = $pd_top . '%';
				}

			}
			if ( isset( $settings['post_style'] ) && $settings['post_style'] == 'metro' ) {
				$ratio      = $settings['ratio'];
				$ratio_show = array(
					'--tf-portfolio-ratio: ' . $ratio . '%;',
					'--tf-portfolio-ratio-md:' . $ratio . '%;',
					'--tf-portfolio-ratio-sm:' . $ratio . '%'
				);
				$grid_class = array( 'tf-grid-item tfanimated' );
				if ( ! empty( $grid_items ) ) {
					$item_col    = 1;
					$item_row    = 1;
					$item_row_md = $item_row;
					$item_row_sm = $item_row_md;
					$item_col_md = $item_col;
					$item_col_sm = $item_col_md;
					if ( $grid_items ) {
						$grid_count = count( $grid_items );
						$grid_index = $settings['post_loop_layout'] !== 'yes' ? $i : $i % $grid_count;

						if ( $grid_index < $grid_count ) {
							if ( isset( $grid_items[ $grid_index ]['number_column_mobile'] ) && $grid_items[ $grid_index ]['number_column_mobile'] !== '' ) {
								$item_col_sm  = $grid_items[ $grid_index ]['number_column_mobile'];
								$grid_class[] = 'gc-sm-' . $item_col_sm;
							}
							if ( isset( $grid_items[ $grid_index ]['number_column_tablet'] ) && $grid_items[ $grid_index ]['number_column_tablet'] !== '' ) {
								$item_col_md  = $grid_items[ $grid_index ]['number_column_tablet'];
								$grid_class[] = 'gc-md-' . $item_col_md;
							}
							if ( isset( $grid_items[ $grid_index ]['number_column'] ) && $grid_items[ $grid_index ]['number_column'] !== '' ) {
								$item_col     = $grid_items[ $grid_index ]['number_column'];
								$grid_class[] = 'gc-' . $item_col;
							}
							if ( isset( $grid_items[ $grid_index ]['number_row_mobile'] ) && $grid_items[ $grid_index ]['number_row_mobile'] !== '' ) {
								$item_row_sm  = $grid_items[ $grid_index ]['number_row_mobile'];
								$grid_class[] = 'gr-sm-' . $item_row_sm;
							}
							if ( isset( $grid_items[ $grid_index ]['number_row_tablet'] ) && $grid_items[ $grid_index ]['number_row_tablet'] !== '' ) {
								$item_row_md  = $grid_items[ $grid_index ]['number_row_tablet'];
								$grid_class[] = 'gr-md-' . $item_row_md;
							}
							if ( isset( $grid_items[ $grid_index ]['number_row'] ) && $grid_items[ $grid_index ]['number_row'] !== '' ) {
								$item_row     = $grid_items[ $grid_index ]['number_row'];
								$grid_class[] = 'gr-' . $item_row;
							}
						}
					}
					$item_ratio    = $ratio * $item_row / $item_col;
					$item_ratio_md = $ratio * $item_row_md / $item_col_md;
					$item_ratio_sm = $ratio * $item_row_sm / $item_col_sm;
					$ratio_show    = array(
						' --tf-portfolio-ratio: ' . $item_ratio . '%;',
						'--tf-portfolio-ratio-md:' . $item_ratio_md . '%;',
						'--tf-portfolio-ratio-sm:' . $item_ratio_sm . '%'
					);

				}
				$settings['style']        = implode( ";", $ratio_show );
				$settings['column_class'] = implode( " ", $grid_class );
			}


			tf_get_template( 'portfolio/' . $settings['post_layout'] . '.php', array(
				'settings'        => $settings,
				'category_length' => $settings['category_length'] != '' ? intval( $settings['category_length'] ) : 10
			) );
			?>

			<?php
			$i ++;
		endwhile;
	else:
		?>
        <p class="no-posts-found"><?php esc_html_e( 'No posts found!', 'themesflat' ) ?></p>
	<?php endif;
	wp_reset_postdata();

	return ob_get_clean();
}

function tf_get_button_sizes() {
	return apply_filters( 'tf_button_sizes', [
		'xs' => esc_html__( 'Extra Small', 'themesflat' ),
		'sm' => esc_html__( 'Small', 'themesflat' ),
		'md' => esc_html__( 'Medium', 'themesflat' ),
		'lg' => esc_html__( 'Large', 'themesflat' ),
		'xl' => esc_html__( 'Extra Large', 'themesflat' ),
	] );
}

function tf_get_button_styles() {
	return apply_filters( 'tf_button_styles', [
		''        => esc_html__( 'Classic', 'themesflat' ),
		'outline' => esc_html__( 'Outline', 'themesflat' ),
		'link'    => esc_html__( 'Link', 'themesflat' ),
		'3d'      => esc_html__( '3D', 'themesflat' ),
	] );
}

function tf_get_button_shape() {
	return apply_filters( 'tf_button_shape', array(
		'rounded' => esc_html__( 'Rounded', 'themesflat' ),
		'square'  => esc_html__( 'Square', 'themesflat' ),
		'round'   => esc_html__( 'Round', 'themesflat' ),
	) );
}

add_action( 'wp_ajax_tf_load_more', 'tf_portfolio_load_more_callback' );
add_action( 'wp_ajax_nopriv_tf_load_more', 'tf_portfolio_load_more_callback' );
function tf_portfolio_load_more_callback() {
	if ( ! isset( $_REQUEST['nonceField'] )
	     || ! wp_verify_nonce( sanitize_text_field( $_REQUEST['nonceField'] ), 'tf_load_post' ) ) {
		return;
	}

	parse_str( tf_kses_post( $_REQUEST['args'] ), $args );
	parse_str( ( tf_kses_post( $_REQUEST['settings'] ) ), $settings );

	$page = sanitize_text_field( $_REQUEST['page'] );

	$args['offset'] = (int) $args['offset'] + ( ( (int) $page - 1 ) * (int) $args['posts_per_page'] );
	if ( isset( $_REQUEST['taxonomy'] ) ) {
		$taxonomy = tf_recursive_sanitize_text_field( $_REQUEST['taxonomy'] );

		if ( $taxonomy['taxonomy'] != 'all' ) {
			$args['tax_query'] = [
				$taxonomy,
			];
		}


	}
	$handler = tf_recursive_sanitize_text_field( $_REQUEST['handler'] );
	if ( $settings['orderby'] === 'rand' && ! empty( $args['post__not_in'] ) ) {
		$args['post__not_in'] = array_unique( tf_recursive_sanitize_text_field( $_REQUEST['post__not_in'] ) );
	}

	$html        = tf_render_template_post( $args, $settings );
	$pagination  = '';
	$total_page  = intval( sanitize_text_field( $_REQUEST['totalPage'] ) );
	$nonce_field = wp_create_nonce( 'tf_load_post' );
	$paging      = '';
	if ( isset( $settings['paging'] ) && $settings['paging'] != '' ) {
		$paging = $settings['paging'];
		if ( $total_page > intval( $page ) ) {
			ob_start();
			if ( 'load_more' == $settings['paging'] ) {
				tf_get_template( 'pagination/load-more.php', array(
					'args'                => $args,
					'settings_array'      => $settings,
					'total_page'          => $total_page,
					'show_load_more_text' => $settings['show_load_more_text'],
					'nonce_field'         => $nonce_field
				) );
			}
			$pagination = ob_get_clean();
		}
	}


	$data_arr = array(
		'content'      => $html,
		'paging'       => $paging,
		'current_page' => $page,
		'pagination'   => $pagination,
		'target'       => '#tf-portfolio-list-' . $settings['id'],
		'widget_id'    => $settings['id']
	);
	if ( $handler == 'category_filter' ) {
		$data_arr['filter_category'] = 'yes';
		$data_arr['paging']          = '';
	}

	wp_send_json_success( $data_arr );
	die();
}


