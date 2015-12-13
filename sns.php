 <?php
    $url_encode=urlencode(get_permalink());
    $title_encode=urlencode(get_the_title());
?>

<div id="socialbox">
    <a href="http://www.facebook.com/sharer.php?src=bm&u=<?php echo $url_encode;?>&t=<?php echo $title_encode;?>" class="social_item mm-facebook mm-ripple" title=""><i class="ion-social-facebook"></i>&nbsp;FaceBookでシェア
    </a>
    <a href="http://twitter.com/intent/tweet?url=<?php echo $url_encode ?>&text=<?php echo $title_encode ?>&tw_p=tweetbutton" class="social_item ion-social-twitter mm-twitter mm-ripple">&nbsp;Twitterでシェア</a>
</div>
<div class="clearfix"></div>
