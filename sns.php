<?php
    $url_encode=urlencode(get_permalink());
    $title_encode=urlencode(get_the_title() . " - " . get_bloginfo('name'));
?>

<div id="socialbox">
    <a href="http://www.facebook.com/sharer.php?src=bm&u=<?php echo $url_encode;?>&t=<?php echo $title_encode;?>" class="social-item social-facebook"><i class="ion-social-facebook"></i>&nbsp;FaceBookでシェア</a>
    <a href="http://twitter.com/intent/tweet?url=<?php echo $url_encode ?>&text=<?php echo $title_encode ?>&tw_p=tweetbutton" class="social-item social-twitter"><i class="ion-social-twitter"></i>&nbsp;Twitterでツイート</a>
</div>
<div class="clearfix"></div>
