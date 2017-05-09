</div>
<!-- /container -->
<!-- footer -->
<?php if ( !wp_is_mobile() ) : ?>
	<ins class="adsbygoogle"
	     style="display:inline-block;width:970px;height:90px"
	     data-ad-client="ca-pub-3116606223638769"
	     data-ad-slot="3918021732"></ins>
<?php endif; ?>

<footer class="navbar navbar-light bg-faded">
	<div class="container">
		<nav>
			<div class="nav navbar-nav">
				<a class="nav-item nav-link active" href="<?php echo esc_url( home_url() ); ?>/">&copy;&nbsp;<?php bloginfo( 'name' ); ?>&nbsp;2015</a>
				<?php
					$defaults = [
						'menu'           => 'footer',
						'container'      => false,
						'echo'           => true,
						'depth'          => 0,
						'walker'         => new NavbarLinkList,
						'theme_location' => 'footer',
						'items_wrap'     => '%3$s',
					];
					wp_nav_menu( $defaults ); ?>
			</div>
		</nav>
	</div>
</footer>
<!-- /footer -->
<?php wp_footer(); ?>
</body>
</html>
