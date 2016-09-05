<?php
if ( function_exists( 'pagination' ) ) {
	if ( $wp_query->max_num_pages !== 1 ) {
		echo "<!-- pagination -->\n";
		pagination( $wp_query->max_num_pages );
		echo "<!-- /pagination -->\n";
	}
}
