<?php
if ( have_rows( 'twitter_timeline' ) ):
  while ( have_rows( 'twitter_timeline' ) ) : the_row();
    $twitter_timeline_screen_name = get_sub_field( 'twitter_timeline_screen_name' );
    $twitter_timeline_width       = get_sub_field( 'twitter_timeline_width' );
    $twitter_timeline_height      = get_sub_field( 'twitter_timeline_height' );
    ?>
    <a class="twitter-timeline" data-width="<?php echo $twitter_timeline_width; ?>" data-height="<?php echo $twitter_timeline_height; ?>" href="https://twitter.com/<?php echo $twitter_timeline_screen_name; ?>"> Tweets by <?php echo $twitter_timeline_screen_name; ?></a>
    <?php
  endwhile;
endif;
?>
