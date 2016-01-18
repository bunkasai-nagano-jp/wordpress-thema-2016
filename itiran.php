<div id="topnews">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<dl class="clearfix">
			<dd>
				<h1>
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h1>
				<div class="blog-info">
					<p>
						<span class="pcone"><i class="fa fa-tags"></i>&nbsp;
							<?php the_category(', ') ?>
						</span>
					</p>
				</div>
				<div class="info">
					<img class="info-img" src="<?php echo get_gmap_sv_url(); ?>" alt="" />
					<p class="info-name">
						<span class="info-desc">文化祭名</span>
						<span><?php echo get_custom_field('name') ?></span>
					</p>
					<p class="info-school-name">
						<span class="info-desc">学校名</span>
						<span class="info-class"><?php echo get_custom_field('class') ?></span>
						<span class="info-school-name"><?php echo get_custom_field('schoolName') ?></span>
					</p>
					<?php
						$startDate = get_custom_field('startDate');
						$endDate = get_custom_field('endDate');
						if(!empty($startDate)) {
							echo '<p class="info-date">' . "\n" .
											'<span class="info-desc">開催期間</span>' . "\n" .
											'<span class="info-date-content">'. $startDate .' 〜 '. $endDate .'</span>' . "\n" .
										'</p>';
						}
					?>
					<?php
						$publicStartDate = get_custom_field('publicStartDate');
						$publicEndDate = get_custom_field('publicEndDate');
						if (empty($publicStartDate)) {

						} elseif (empty($publicEndDate)) {
							echo '<p class="info-date">' . "\n" .
											'<span class="info-desc">一般公開日</span>' . "\n" .
											'<span class="info-date-content">'. $publicStartDate .'</span>' . "\n" .
										'</p>';
						} else {
							echo '<p class="info-date">' . "\n" .
											'<span class="info-desc">一般公開期間</span>' . "\n" .
											'<span class="info-date-content">'. $publicStartDate .' 〜 '. $publicEndDate .'</span>' . "\n" .
										'</p>';
						}
					?>
				</div>
				<a class="permalink" href="<?php the_permalink(); ?>">詳細を見る</a>
			</dd>
		</dl>
	<?php endwhile; else: ?>
		<p>記事がありません</p>
	<?php endif; ?>
</div>
