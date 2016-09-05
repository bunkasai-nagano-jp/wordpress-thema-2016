<?php if ( have_rows( 'twitter_user_timeline' ) or have_rows( 'twitter_search_timeline' ) ) :  ?>
	<h2>Twitter</h2>
	<?php while ( have_rows( 'twitter_user_timeline' ) ) : the_row(); ?>
		<a class="twitter-timeline" data-width="<?php the_sub_field( 'twitter_user_timeline_width' ); ?>" data-height="<?php the_sub_field( 'twitter_user_timeline_height' ); ?>" href="https://twitter.com/<?php the_sub_field( 'twitter_user_timeline_screen_name' ); ?>"> Tweets by <?php the_sub_field( 'twitter_user_timeline_screen_name' ); ?></a>
	<?php endwhile; ?>
	<?php while ( have_rows( 'twitter_search_timeline' ) ) : the_row(); ?>
		<a class="twitter-timeline" href="<?php the_sub_field( 'twitter_search_timeline_url' ); ?>" data-widget-id="<?php the_sub_field( 'twitter_search_timeline_widget_id' ); ?>" width="<?php the_sub_field( 'twitter_search_timeline_width' ); ?>"><?php the_sub_field( 'twitter_search_timeline_name' ); ?></a>
	<?php endwhile; ?>
<?php endif; ?>
