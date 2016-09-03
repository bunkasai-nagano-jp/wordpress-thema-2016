<?php

// 関連する記事を取得する関数
function relation_category_list( $post_id ) {
	$category       = get_the_category();   // 現在のカテゴリー(オブジェクト)
	$category_id    = $category[0]->cat_ID; // 先頭のカテゴリーID
	$args           = array(
	'meta_query'     => array(
	  'meta' => array(
		'key'  => 'startDate',
		'type' => 'DATE',
	  ),
	),
	'cat'            => $category_id,
	'orderby'        => 'meta',
	'order'          => 'DESC', // 開催日が新しい順
	'posts_per_page' => 5,      // 最大記事数
	);
	$relation_posts = query_posts( $args );
	if ( ! $relation_posts ) :
		return false;
	else : ?>
	<h3>同じ市町村の文化祭情報</h3>
	<div class="list-group">
		<?php
		foreach ( $relation_posts as $relation_post ) {
			if ( $post_id == $relation_post->ID ) :
				?>
				<a href="<?php echo get_permalink( $relation_post->ID ); ?>"
			   class="list-group-item active"><?php echo $relation_post->post_title; ?></a>
				<?php
			else :
				?>
			  <a href="<?php echo get_permalink( $relation_post->ID ); ?>"
			 class="list-group-item"><?php echo $relation_post->post_title; ?></a>
			<?php
			endif;
		}
		?>
	</div>
	<?php
	endif;
}
