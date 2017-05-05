<?php
if ( function_exists( 'pagination' ) ) {
	if ( 1 !== $wp_query->max_num_pages ) {
		echo "<!-- pagination -->\n";
		pagination( $wp_query->max_num_pages );
		echo "<!-- /pagination -->\n";
	}
}
