<?php
  if ( have_rows( 'twitter_user_timeline' ) or have_rows( 'twitter_search_timeline' ) ): ?>
    <h2>Twitter</h2>
    <?php
    while ( have_rows( 'twitter_user_timeline' ) ) : the_row();
      $twitter_user_timeline_screen_name = get_sub_field( 'twitter_user_timeline_screen_name' );
      $twitter_user_timeline_width       = get_sub_field( 'twitter_user_timeline_width' );
      $twitter_user_timeline_height      = get_sub_field( 'twitter_user_timeline_height' );
      ?>
      <a class="twitter-timeline" data-width="<?php echo $twitter_user_timeline_width; ?>" data-height="<?php echo $twitter_user_timeline_height; ?>" href="https://twitter.com/<?php echo $twitter_user_timeline_screen_name; ?>"> Tweets by <?php echo $twitter_user_timeline_screen_name; ?></a>
      <?php
    endwhile;
    while ( have_rows( 'twitter_search_timeline' ) ) : the_row();
      $twitter_search_timeline_name      = get_sub_field( 'twitter_search_timeline_name' );
      $twitter_search_timeline_url       = get_sub_field( 'twitter_search_timeline_url' );
      $twitter_search_timeline_widget_id = get_sub_field( 'twitter_search_timeline_widget_id' );
      $twitter_search_timeline_width     = get_sub_field( 'twitter_search_timeline_width' );
      ?>
      <a class="twitter-timeline" href="<?php echo $twitter_search_timeline_url; ?>" data-widget-id="<?php echo $twitter_search_timeline_widget_id; ?>" width="<?php echo $twitter_search_timeline_width; ?>"><?php echo $twitter_search_timeline_name ?></a>
      <?php
    endwhile;
  endif;
?>
