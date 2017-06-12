<!-- nav -->
<header class="navbar navbar-inverse bg-inverse navbar-toggleable-md">
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
		        data-target="#navbar-header" aria-controls="navbar-header" aria-expanded="false">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>/"><?php bloginfo( 'name' ); ?></a>
	<div class="collapse navbar-collapse" id="navbar-header" aria-expanded="false">
		<div class="navbar-nav mr-auto">
			<?php
			$defaults = [
				'menu'           => 'navbar',
				'container'      => false,
				'echo'           => true,
				'depth'          => 0,
				'walker'         => new NavbarLinkList,
				'theme_location' => 'navbar',
				'items_wrap'     => '%3$s',
			];
			wp_nav_menu( $defaults ); ?>
		</div>
		<form action="https://www.google.com/cse" class="form-inline my-2 my-md-0" id="cse-search-box">
			<input type="hidden" name="cx" value="000907066374336213658:lnnce0mnjry"/>
			<input type="hidden" name="ie" value="UTF-8"/>
			<input class="form-control mr-sm-2" type="text" name="q" size="31"/>
			<input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="sa" value="Search"/>
		</form>
	</div>
</header>

<!-- /nav -->
