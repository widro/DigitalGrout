<!-- Primary navbar -->
<nav id="access" role="navigation">
	<h3 class="assistive-text">Main menu</h3>
	<div class="skip-link"><a title="Skip to primary content" href="#content" class="assistive-text">Skip to primary content</a></div>
	<div class="skip-link"><a title="Skip to secondary content" href="#secondary" class="assistive-text">Skip to secondary content</a></div>
	
	<div <?php ya_navbar_class(); ?>>
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<div class="nav-collapse collapse">
					<?php wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'show_home' => true)); ?>
				</div>
			</div>
		</div>
	</div>
</nav>
<!-- /Primary navbar -->