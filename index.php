<!DOCTYPE html>
<html>
	<head>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class();?>>
		<div id="app">
			<header id="header">
				<button id="toggle-menu" class="genericon genericon-menu">Toggle Menu</button>
				<h1 id="site-title">
					<a href="<?php echo esc_url( site_url() ); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
			</header><!-- header#header -->
			<div id="content">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-meta">
							<div class="entry-avatar">
								<?php echo get_avatar( get_the_author_meta( 'user_email' ), 40 ); ?>
							</div>
							<h3 class="entry-author"><?php the_author(); ?></h3>
							<p class="entry-time"><?php the_date(); ?></p>
						</div>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>	
					</article>

				<?php endwhile; ?>

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #app -->
		<?php wp_footer(); ?>
	</body>
</html>