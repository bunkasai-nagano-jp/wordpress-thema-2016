<!-- footer -->
<footer class="footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
        <p>&copy; <?php echo bloginfo('name'); ?> 2015</p>
      </div>
      <div class="col-md-8">
        <?php
        $defaults = array(
          'menu'            => 'footer',
          'container'       => false,
          'echo'            => true,
          'depth'           => 0,
          'walker'          => new navbar_link_list,
          'theme_location'  => 'footer',
          'items_wrap'      => '%3$s',
        );
        wp_nav_menu( $defaults );?>
      </div>
    </div>
  </div>
</footer>
<!-- /footer -->
</div>
<!-- /container -->
<?php wp_footer(); ?>
<script type="text/javascript" src="//www.google.com/cse/brand?form=cse-search-box&lang=ja"></script>
</body>
</html>
