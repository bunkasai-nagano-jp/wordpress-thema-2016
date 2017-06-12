</div>
<!-- /container -->
<!-- footer -->
		<nav class="navbar navbar-inverse bg-inverse">
			<div class="container">
				<nav class="nav">
					<a class="nav-link active" href="<?php echo esc_url( home_url() ); ?>/">&copy;&nbsp;<?php bloginfo( 'name' ); ?>&nbsp;2015</a>
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
				</nav>
			</div>
		</nav>
<!-- /footer -->
<?php wp_footer(); ?>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-3116606223638769",
        enable_page_level_ads: true
    });
</script>
</body>
</html>
