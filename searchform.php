<form role="search" method="get" class="search-form" action="<?php echo home_url(); ?>/">
  <div class="input-group">
    <label for="s">検索</label>
    <div class="input-group">
      <input type="search" class="form-control" value="<?php the_search_query(); ?>" id="s" name="s"/>
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default form-control" alt="検索" value="<?php _e('Search', 'kubrick'); ?>">検索</button>
      </span>
    </div>
  </div>
</form>
