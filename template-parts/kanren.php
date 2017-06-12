<?php
$category       = get_the_category();
$category_id    = $category[0]->cat_ID;
$year           = School::get_year();
$relation_posts = new WP_Query( [
	'meta_query'     => [
		[
			'key'     => 'startDate',
			'value'   => $year,
			'compare' => 'LIKE',
		],
	],
	'cat'            => $category_id,
	'posts_per_page' => 2,
	'post__not_in'   => [ $post->ID ],
] ); ?>
<h2><i class="fa fa-th-list"></i>&nbsp;関連記事</h2>
<div class="d-flex flex-wrap justify-content-around align-items-stretch p-2">
	<?php if ( $relation_posts->have_posts() ) :
		$relation_posts->the_post(); ?>
		<!-- card -->
		<div class="card mb-3">
			<?php
			$school  = new School( get_field( 'schoolName', $relation_posts->post->ID ) );
			$year    = $school->get_year();
			$img_url = $school->get_streetview_url( 385, 200, $relation_posts->post->ID );
			if ( $img_url ) : ?>
				<div class="card-img-top">
					<img src="<?php echo esc_html( $img_url ); ?>" alt="streetview" class="img-fluid">
				</div>
			<?php endif; ?>
			<div class="card-block">
				<a href="<?php the_permalink(); ?>">
					<h4 class="card-title"><?php the_field( 'name', $relation_posts->post->ID ); ?></h4>
				</a>
				<h6 class="card-subtitle text-muted"><?php the_field( 'class' ); ?><?php the_field( 'schoolName', $relation_posts->post->ID ); ?></h6>
				<div class="card-block">
					<?php if ( is_bunkasai_during_open() ) : ?>
						<p class="card-text text-info"><i class="fa fa-fw fa-flag" aria-hidden="true"></i>&nbsp;開催中</p>
					<?php elseif ( is_bunkasai_during_open() === false ) : ?>
						<p class="card-text text-muted"><i class="fa fa-fw fa-clock-o" aria-hidden="true"></i>&nbsp;終了
						</p>
					<?php elseif ( is_bunkasai_during_open() === null ) : ?>
						<p class="card-text text-primary">
							<i class="fa fa-fw fa-clock-o"
							   aria-hidden="true"></i>&nbsp;開催まで<?php echo esc_html( get_remaining_days() ); ?>日
						</p>
					<?php endif; ?>
					<p class="card-text"><i class="fa fa-fw fa-calendar"></i>&nbsp;開催期間</p>
					<p class="card-text"><?php echo esc_html( $school->the_event_date( $year ) ); ?></p>
					<p class="card-text"><i class="fa fa-fw fa-info" aria-hidden="true"></i>&nbsp;一般公開</p>
					<?php $event_public_open_date = $school->get_event_public_open_date( $year ); ?>
					<?php foreach ( $event_public_open_date as $text ) : ?>
						<p class="card-text"><?php echo esc_html( $text ); ?></p>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="card-block text-xs-right">
				<a href="<?php the_permalink( $relation_posts->post->ID ); ?>" class="btn btn-primary">詳細</a>
			</div>
			<div class="card-footer">
				<i class="fa fa-fw fa-tags"></i> <span><?php the_category( ', ' ); ?></span>
			</div>
		</div>

		<!-- /card -->
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<?php get_template_part( 'template-parts/no-articles' ); ?>
	<?php endif; ?>
</div>
