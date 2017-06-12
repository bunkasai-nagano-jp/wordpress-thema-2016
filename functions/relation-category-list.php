<?php
/**
 * 関連する記事を取得する関数
 *
 * @param string $post_id 投稿ID.
 */
function relation_category_list() {
$category       = get_the_category();   // 現在のカテゴリー(オブジェクト).
$category_id    = $category[0]->cat_ID; // 先頭のカテゴリーID.
$post_id        = get_the_ID();
$args           = [
	'meta_query'     => [
		'meta' => [
			'key'  => 'startDate',
			'type' => 'DATE',
		],
	],
	'cat'            => $category_id,
	'orderby'        => 'meta',
	'order'          => 'DESC', // 開催日が新しい順.
	'posts_per_page' => 5,      // 最大記事数.
];
$relation_posts = new WP_Query( $args );
if ( $relation_posts->have_posts() ) : ?>
<h4>同じ市町村の文化祭情報</h4>
<nav class="nav flex-column">
	<?php while ( $relation_posts->have_posts() ) : $relation_posts->the_post();
		if ( $post_id === $relation_posts->post->ID ) : ?>
			<a href="<?php echo get_permalink( $relation_posts->post->ID ); ?>"
			   class="nav-item active"><?php echo $relation_posts->post->post_title; ?></a>
		<?php else : ?>
			<a href="<?php the_permalink( $relation_posts->post->ID ); ?>"
			   class="nav-item"><?php echo $relation_posts->post->post_title; ?></a>
		<?php endif; ?>
	<?php endwhile; ?>
</nav>
<?php wp_reset_postdata();
endif;
}
