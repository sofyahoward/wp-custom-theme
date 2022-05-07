<?php

add_theme_support( 'post-thumbnails' );

add_post_type_support( 'franchise', 'thumbnail' );

function register_franchise_post_type() {
	$args = array(
		'public'       => true,
		'label'        => 'Franchise',
		'show_in_rest' => true,
		'template'     => array(
			array(
				'core/image',
				array(
					'align' => 'left',
				)
			),
			array(
				'core/heading',
				array(
					'placeholder' => 'Add AuthorR...',
				)
			),
			array(
				'core/paragraph',
				array(
					'placeholder' => 'Add Description...',
				)
			),
		),
	);
	register_post_type( 'franchise', $args );
}

add_action( 'init', 'register_franchise_post_type' );

function scripts() {
	wp_enqueue_script( 'jquery' );

	if ( get_post_type( get_the_ID() ) == "franchise" ) {
		wp_register_style( 'style', get_template_directory_uri() . '/dist/app.css', [], 1, 'all' );
		wp_enqueue_style( 'style' );

		// wp_register_script('app', get_template_directory_uri() . '/dist/app.js', ['jquery'], 1, true);
		// wp_enqueue_script('app');
	}

	wp_register_style( 'style', get_template_directory_uri() . '/dist/home.css', [], 1, 'all' );
	wp_enqueue_style( 'style' );


	wp_register_script( 'app', get_template_directory_uri() . '/dist/app.js', [ 'jquery' ], 1, true );

	wp_localize_script( 'app', 'ajax_posts', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'noposts' => __( 'No older posts found', 'sofya-theme' ),
	) );
	wp_enqueue_script( 'app' );
}

add_action( 'wp_enqueue_scripts', 'scripts' );


function more_post_ajax() {

	$ppp  = ( isset( $_POST["ppp"] ) ) ? $_POST["ppp"] : 5;
	$page = ( isset( $_POST['pageNumber'] ) ) ? $_POST['pageNumber'] : 0;

	header( "Content-Type: text/html" );

	$args = array(
		'suppress_filters' => true,
		'post_type'        => 'franchise',
		'posts_per_page'   => $ppp,
		'paged'            => $page,
	);

	$loop = new WP_Query( $args );

	$out = '';

	if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
		$out .=
			'<a class="wp-block-post" href="' . get_the_permalink() . '" alt="' . get_the_title() . '">
            ' . get_the_post_thumbnail() . '
            <h2>' . get_the_title() . '</h2>
            <p>' . get_the_author() . '</p>
        </a>';


	endwhile;
	endif;
	wp_reset_postdata();
	die( $out );
}

add_action( 'wp_ajax_nopriv_more_post_ajax', 'more_post_ajax' );
add_action( 'wp_ajax_more_post_ajax', 'more_post_ajax' );
