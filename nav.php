<!-- nav -->
<header class="navbar navbar-light bg-faded">
	<div class="container">
		<nav>
			<div class="clearfix">
				<button class="navbar-toggler pull-xs-right hidden-sm-up" type="button" data-toggle="collapse" data-target="#navbar-header" aria-controls="navbar-header" aria-expanded="false">
					<i class="fa fa-bars" aria-hidden="true"></i>
				</button>
				<a class="navbar-brand hidden-sm-up" href="<?php echo esc_url( home_url() ); ?>/"><?php bloginfo( 'name' ); ?></a>
			</div>
			<div class="navbar-toggleable-xs collapse " id="navbar-header" aria-expanded="false">
				<div class="nav navbar-nav">
					<a class="nav-item nav-link" href="<?php echo esc_url( home_url() ); ?>/"><?php bloginfo( 'name' ); ?></a>
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
				<form action="https://www.google.com/cse" class="form-inline pull-sm-right" id="cse-search-box">
					<input type="hidden" name="cx" value="000907066374336213658:lnnce0mnjry"/>
					<input type="hidden" name="ie" value="UTF-8"/>
					<input class="form-control" type="text" name="q" size="31"/>
					<input class="btn btn-outline-success" type="submit" name="sa" value="Search"/>
				</form>
			</div>
		</nav>
	</div>
</header>
<!-- /nav -->
