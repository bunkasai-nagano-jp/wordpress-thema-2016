<footer id="footer">
    <?php
    if ( ! is_active_sidebar( 'sidebar-2' ) ){
      return;
    }
    else {
      echo '<div class="">';
        dynamic_sidebar( 'sidebar-2' );
      echo '</div>';
    }
    ?>
    <p class="copy">Copyright&copy;<?php echo bloginfo('name'); ?>&nbsp;,&nbsp;<?php the_date('Y');?>&nbsp;All Rights Reserved.</p>
</footer>
</div>

<script type="text/javascript">
	  window._pt_lt = new Date().getTime();
	  window._pt_sp_2 = [];
	  _pt_sp_2.push('setAccount,7bc15af7');
	  var _protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
	  (function() {
		var atag = document.createElement('script'); atag.type = 'text/javascript'; atag.async = true;
		atag.src = _protocol + 'js.ptengine.jp/pta.js';
		var stag = document.createElement('script'); stag.type = 'text/javascript'; stag.async = true;
		stag.src = _protocol + 'js.ptengine.jp/pts.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(atag, s);s.parentNode.insertBefore(stag, s);
	  })();
</script>

<?php wp_footer(); ?>
    </body>
</html>
