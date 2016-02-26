<form method="get" action="<?php echo home_url(); ?>/">
  <div class="input-group">
    <label class="hidden" for="s"><?php _e('', 'kubrick'); ?></label>
    <input type="text" class="form-control" value="<?php the_search_query(); ?>"  name="s"/>
    <span class="input-group-btn">
      <button type="submit" class="btn btn-default form-control" alt="検索" value="<?php _e('Search', 'kubrick'); ?>">検索</button>
    </span>
  </div>
</form>
