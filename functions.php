<?php
// 0) CSS and JS on footer
// 1) Main menu
// 2) Widgets
// 3) Includes
// 4) Css dinamicos
// 5) Content width
// 6) Add theme support
// 7) Coment reply
// 8) Walker class
// 9) Wp link pages
// 10) Custom post type
// 11) WooCommerce custom
// 12) GitHub updates

// 0) JS on footer
	function scripts_footer() {
	    remove_action('wp_head', 'wp_print_scripts');
	    remove_action('wp_head', 'wp_print_head_scripts', 9);
	    remove_action('wp_head', 'wp_enqueue_scripts', 1);

	    add_action('wp_footer', 'wp_print_scripts', 5);
	    add_action('wp_footer', 'wp_enqueue_scripts', 5);
	    add_action('wp_footer', 'wp_print_head_scripts', 5);
	}
	add_action( 'wp_enqueue_scripts', 'scripts_footer' );

	function my_deregister_styles() {
	  wp_deregister_style('wp-block-library');
	  wp_deregister_style('wc-block-style');
		wp_deregister_style('woocommerce');
		wp_deregister_style('woocommerce-smallcreen');
	  wp_deregister_style('contact-form-7');
		wp_deregister_style('bootstrap-personalized');
	  wp_deregister_style('dnd-upload-cf7');
	}

	add_action('wp_print_styles', 'my_deregister_styles', 100);

// 1) Main menu
	if (function_exists('register_nav_menus')) {
		register_nav_menus (array('superior' => 'Menu Principal'));
	}

	// Class <a> main menu
		add_filter('nav_menu_link_attributes','clase_menu', 10,3);
		function clase_menu ($atts, $item, $args){
			$class = 'nav-link font-weight-bold mx-2';
			$atts ['class'] = $class;
			return $atts;
		}

// 2) Widgets
	add_action( 'widgets_init', 'ip_sidebar' );
	function ip_sidebar() {
		register_sidebar(
	        array(
	            'id'            => 'homepage',
	            'name'          => __( 'Sidebar homepage', 'informatica_pereyra' ),
	            'description'   => __( 'Se ubica únicamente en la homepage.', 'informatica_pereyra' ),
	            'before_widget' => '<div id="%1$s" class="widget %2$s my-3">',
	            'after_widget'  => '</div>',
	            'before_title'  => '<h3 class="widget-title-dark">',
	            'after_title'   => '</h3>'
	        )
	    );
	    register_sidebar(
	        array(
	            'id'            => 'footer',
	            'name'          => __( 'Sidebar del footer', 'informatica_pereyra' ),
	            'description'   => __( 'Se ubica debajo de las paginas y entradas.', 'informatica_pereyra' ),
	            'before_widget' => '<div id="%1$s" class="widget %2$s my-3">',
	            'after_widget'  => '</div>',
	            'before_title'  => '<h3 class="widget-title">',
	            'after_title'   => '</h3>'
	        )
	    );
	}

// 3) Includes
	get_template_part( 'Customizer/ip-customizer' );
	get_template_part( 'plugins/ip-shortcodes' );

// 4) Dinamics Css
	function ip_theme_customize_css()
	{
	?>
	    <style type="text/css">
	        .dashboard-section-overview .copy-to-clipboard-trigger, .checkout-button, #place_order {
	            background-color: <?php echo get_theme_mod('ip_btn_bg'); ?>!important;
	            color: <?php echo get_theme_mod('ip_btn_color'); ?> !important;
	        }
	        .bg-personalized, th,span.onsale, .reset_variations, #bg-menu-mobile, #first-content-home, .bg-title-color, .bg-title-content-color{
	        	background-color: <?php echo get_theme_mod('ip_primary_color'); ?> !important;
	        }
	        strong,h2, h3, h4, h5, h6, .widget-title-dark, .color-personalized, .product_title{
	        	color: <?php echo get_theme_mod('ip_primary_color'); ?> !important;
	        }
	        .ip_img_slide1{
	        	background: url(<?php echo wp_get_attachment_url(get_theme_mod('ip_head_slide1')); ?>) no-repeat 50% 50%;
	        }
	        .btn, .wpcf7-submit, #submit.submit, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button{
	        	background-color: <?php echo get_theme_mod('ip_btn_bg'); ?>;
	        	color: <?php echo get_theme_mod('ip_btn_color'); ?>;
	        }
	        .btn:hover, .btn:focus, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:focus{
	        	color: <?php echo get_theme_mod('ip_btn_color'); ?>!important;
	        	background-color: <?php echo get_theme_mod('ip_btn_bg'); ?>;
	        }
	        a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart, button.single_add_to_cart_button.button.alt{
	        	background-color: <?php echo get_theme_mod('ip_btn_bg'); ?>!important;
	        	color: <?php echo get_theme_mod('ip_btn_color'); ?>!important;
	        }
	        .the_post_thumbnail{
	        	background: url(<?php echo get_the_post_thumbnail_url(); ?> ) no-repeat 50% 50%;
	        }
	    </style>
	<?php
	}
	add_action( 'wp_head', 'ip_theme_customize_css');

// 5) content width
	if ( ! isset( $content_width ) ) {
		$content_width = 660;
	}

// 6) add theme support
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support('post-formats', array('video', 'image', 'aside'));


// 7) comment reply
	function wpse218049_enqueue_comments_reply() {

	    if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
	        // Load comment-reply.js (into footer)
	        wp_enqueue_script( 'comment-reply', 'wp-includes/js/comment-reply', array(), false, true );
	    }
	}
	add_action(  'wp_enqueue_scripts', 'wpse218049_enqueue_comments_reply' );

// 8) Walker class
	class Walker_Nav_Primary extends Walker_Nav_menu {

		function start_lvl( &$output, $depth = 0, $args = array()){ //ul
			$indent = str_repeat("\t",$depth);
			$submenu = ($depth > 0) ? ' sub-menu' : '';
			$output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
		}

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){ //li a span

			$indent = ( $depth ) ? str_repeat("\t",$depth) : '';

			$li_attributes = '';
			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			$classes[] = ($args->walker->has_children) ? 'dropdown' : '';
			$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
			$classes[] = 'menu-item-' . $item->ID;
			if( $depth && $args->walker->has_children ){
				$classes[] = 'dropdown-submenu';
			}

			$class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = ' class="' . esc_attr($class_names) . '"';

			$id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
			$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

			$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
			$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
			$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
			$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';

			$attributes .= ( $args->walker->has_children ) ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

			$item_output = $args->before;
			$item_output .= '<a' . $attributes . '>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ( $depth == 0 && $args->walker->has_children ) ? ' <b class="caret"></b></a>' : '</a>';
			$item_output .= $args->after;

			$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		}
	}

// 9) Wp link pages
 	$defaults = array(
		'before'           => '<p>' . __( 'Páginas:', 'informatica_pereyra' ),
		'after'            => '</p>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'Número',
		'separator'        => ' ',
		'nextpagelink'     => __( 'Proxima página', 'informatica_pereyra'),
		'previouspagelink' => __( 'Página anterior', 'informatica_pereyra' ),
		'pagelink'         => '%',
		'echo'             => 1
	);

// 10) Custom post type
 	add_action( 'init', 'codex_landing_pages_init' );
	function codex_landing_pages_init() {
		$labels = array(
			'name'               => _x( 'Landing Pages', 'Nombre general del tipo de post', 'informatica_pereyra' ),
			'singular_name'      => _x( 'Landing Page', 'Nombre singular', 'informatica_pereyra' ),
			'menu_name'          => _x( 'Landing Pages', 'admin menu', 'informatica_pereyra' ),
			'name_admin_bar'     => _x( 'Landing Pages', 'añadir nueva en admin bar', 'informatica_pereyra' ),
			'add_new'            => _x( 'Añadir nueva', 'Landing Page', 'informatica_pereyra' ),
			'add_new_item'       => __( 'Añadir nueva Landing Page', 'informatica_pereyra' ),
			'new_item'           => __( 'Nueva Landing Page', 'informatica_pereyra' ),
			'edit_item'          => __( 'Editar Landing Page', 'informatica_pereyra' ),
			'view_item'          => __( 'Ver Landing Page', 'informatica_pereyra' ),
			'all_items'          => __( 'Landing Pages', 'informatica_pereyra' ),
			'search_items'       => __( 'Buscar Landing Pages', 'informatica_pereyra' ),
			'parent_item_colon'  => __( 'Landing Page:', 'informatica_pereyra' ),
			'not_found'          => __( 'No encontrado.', 'informatica_pereyra' ),
			'not_found_in_trash' => __( 'No se en contraron en la papelera.', 'informatica_pereyra' )
		);

		$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Descripcion.', 'informatica_pereyra' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'landing-pages' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt')
		);

		register_post_type( 'landing_pages', $args );
	}

// 11) Woocomerce Custom
if (class_exists('WooCommerce')){
	function mytheme_add_woocommerce_support() {
	    add_theme_support( 'woocommerce', array(
	        'thumbnail_image_width' => 600,
	        'single_image_width'    => 600,

	        'product_grid'          => array(
	            'default_rows'    => 3,
	            'min_rows'        => 1,
	            'max_rows'        => 3,
	            'default_columns' => 3,
	            'min_columns'     => 3,
	            'max_columns'     => 5,
	        ),
	    ) );
	    add_theme_support( 'wc-product-gallery-slider' );
	}

	add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

// mini woocommerce cart

function custom_mini_cart() {
    echo '<div class="widget woocommerce widget_shopping_cart my-3 asd"><ul class="">';
        echo '<li> <div class="widget_shopping_cart_content fadeIn">';
                  woocommerce_mini_cart();
            echo '</div></li></ul></div>';

      }
add_shortcode( 'custom-techno-mini-cart', 'custom_mini_cart' );


function wc_refresh_mini_cart_count($fragments){
    ob_start();
    ?>
    <div id="mini-cart-count">
        <?php echo WC()->cart->get_cart_contents_count(); ?>
    </div>
    <?php
        $fragments['#mini-cart-count'] = ob_get_clean();
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_count');

}
//  12) GitHub Updates
    // set_site_transient('update_themes', null);
	function ip_check_update( $transient ) {
	    if ( empty( $transient->checked ) ) {
	        return $transient;
	    }
	    $theme_data = wp_get_theme(wp_get_theme()->template);
	    $theme_slug = $theme_data->get_template();
	    //Delete '-master' from the end of slug
	    $theme_uri_slug = preg_replace('/-master$/', '', $theme_slug);

	    $remote_version = '0.0.0';
	    $style_css = wp_remote_get("https://raw.githubusercontent.com/alanpereyra57/".$theme_uri_slug."/master/style.css")['body'];
	    if ( preg_match( '/^[ \t\/*#@]*' . preg_quote( 'Version', '/' ) . ':(.*)$/mi', $style_css, $match ) && $match[1] )
	        $remote_version = _cleanup_header_comment( $match[1] );

	    if (version_compare($theme_data->version, $remote_version, '<')) {
	        $transient->response[$theme_slug] = array(
	            'theme'       => $theme_slug,
	            'new_version' => $remote_version,
	            'url'         => 'https://github.com/alanpereyra57/'.$theme_uri_slug,
	            'package'     => 'https://github.com/alanpereyra57/'.$theme_uri_slug.'/archive/master.zip',
	        );
	    }

	    return $transient;
	}

	$ip_password = get_theme_mod('$ip_password');

	if($ip_password == 'iiKNN33797'){
		add_filter( 'pre_set_site_transient_update_themes', 'ip_check_update' );
	}
?>
