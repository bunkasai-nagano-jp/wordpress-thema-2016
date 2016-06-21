<?php
    $url_encode=urlencode(get_permalink());
    $title_encode=urlencode(get_the_title() . " - " . get_bloginfo('name'));
?>
<div class="sns">
  <a href="http://www.facebook.com/sharer.php?src=bm&u=<?php echo $url_encode;?>&t=<?php echo $title_encode;?>" class="btn btn-default btn-facebook btn-lg btn-block" role="button"><i class="fa fa-facebook"></i>&nbsp;FaceBookでシェア</a>
  <a href="http://twitter.com/intent/tweet?url=<?php echo $url_encode ?>&text=<?php echo $title_encode ?>&tw_p=tweetbutton" class="btn btn-default btn-twitter btn-lg btn-block" role="button"><i class="fa fa-twitter"></i>&nbsp;Twitterでツイート</a>
</div>
