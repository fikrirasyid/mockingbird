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