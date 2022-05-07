<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_uri() ); ?>" type="text/css"/>
	<?php wp_head(); ?>
</head>
<body>
<h1><?php bloginfo( 'name' ); ?></h1>
<h2><?php bloginfo( 'description' ); ?></h2>

<div id="ajax-posts" class="wp-block-post-template">
	<?php
	$postsPerPage = 5;
	$args         = array(
		'post_type'      => 'franchise',
		'posts_per_page' => $postsPerPage,
	);

	$loop = new WP_Query( $args );

	while ( $loop->have_posts() ) : $loop->the_post();
		?>
        <a class="wp-block-post" href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
			<?php the_post_thumbnail(); ?>
            <h2><?php the_title(); ?></h2>
            <p><?php the_author(); ?></p>
        </a>
	<?php
	endwhile;
	wp_reset_postdata();
	?>
</div>
<div class="loader">
    <button id="more_posts" class="button-loader">Load More</button>
</div>

</body>
<?php wp_footer(); ?>
</html>
