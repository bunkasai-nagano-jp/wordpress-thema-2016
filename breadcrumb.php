<!-- breadcrumb -->
<ol class="breadcrumb">
<?php if ( is_home() ) { ?>
  <li class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
    <span itemprop="title">ホーム</span>
  </li>
<?php } else { ?>
  <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
    <a href="<?php echo home_url(); ?>" itemprop="url">
      <span itemprop="title">ホーム</span>
    </a>
  </li>
<?php } ?>
<?php $categories = get_the_category();
if ( $categories ) {
	$current_category_id  =  $categories[0]->cat_ID;
	$all_category_id      =  array($current_category_id);
	while( $current_category_id ) {
		$current_category     =  get_category($current_category_id);
		$current_category_id  =  $current_category->parent;
		array_push($all_category_id, $current_category_id);
	}
	array_pop($all_category_id);
	$all_category_id = array_reverse($all_category_id);
	$tmp = count($all_category_id);
	?>
<?php foreach( $all_category_id as $current_category_id ) {
		if ( is_home() ) {
			break;
		}
		if( ($tmp == 1) ) {
			if ( is_single() ) { ?>
  <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
    <a href="<?php echo get_category_link($current_category_id); ?>" itemprop="url">
      <span itemprop="title"><?php echo get_cat_name($current_category_id); ?></span>
    </a>
  </li>
<?php
				break;
			}
?>
  <li class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
    <span itemprop="title"><?php echo get_cat_name($current_category_id); ?></span>
  </li>
<?php
			break;
		} ?>
  <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
    <a href="<?php echo get_category_link($current_category_id); ?>" itemprop="url">
      <span itemprop="title"><?php echo get_cat_name($current_category_id); ?></span>
    </a>
  </li>
<?php
	$tmp--;
	}
} ?></ol>
<!-- /breadcrumb -->
