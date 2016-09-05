<div class="card">
	<?php
		$img_url = get_gmap_sv_url( 385, 200 );
	if ( $img_url ) : ?>
			<div class="card-img-top">
				<img src="<?php echo esc_html( $img_url ); ?>" alt="streetview" class="img-fluid">
			</div>
		<?php endif; ?>
	<div class="card-block">
		<a href="<?php the_permalink(); ?>">
			<h2 class="card-title"><?php the_field( 'name' ); ?></h2>
		</a>
		<h6 class="card-subtitle text-muted"><?php the_field( 'class' ); ?>&nbsp;<?php the_field( 'schoolName' ); ?></h6>
		<div class="card-block">
			<?php if ( is_bunkasai_during_open() ) : ?>
				<p class="card-text text-info"><i class="fa fa-fw fa-flag" aria-hidden="true"></i>&nbsp;開催中</p>
			<?php elseif ( is_bunkasai_during_open() === false ) : ?>
				<p class="card-text text-muted"><i class="fa fa-fw fa-clock-o" aria-hidden="true"></i>&nbsp;終了</p>
			<?php elseif ( is_bunkasai_during_open() === null ) : ?>
				<p class="card-text text-primary"><i class="fa fa-fw fa-clock-o" aria-hidden="true"></i>&nbsp;開催まで<?php echo esc_html( get_remaining_days() ); ?>日</p>
			<?php endif; ?>
			<p class="card-text">
				<span><i class="fa fa-fw fa-calendar"></i> 開催期間</span>
				<?php if ( get_field( 'startDate' ) and get_field( 'endDate' ) ) : ?>
					<span><?php the_field( 'startDate' ); ?>&nbsp;~&nbsp;<?php the_field( 'endDate' ); ?></span>
				<?php elseif ( get_field( 'startDate' ) and ! get_field( 'endDate' ) ) : ?>
					<span><?php the_field( 'startDate' ); ?></span>
				<?php else : ?>
					<span>不明</span>
				<?php endif; ?>
			</p>
			<p class="card-text"><i class="fa fa-fw fa-info" aria-hidden="true"></i> 一般公開</p>
			<?php if ( get_field( 'public_unknown' ) ) : ?>
				<p class="card-text">不明</p>
			<?php else : ?>
				<?php if ( have_rows( 'public_open' ) ) : ?>
					<?php while ( have_rows( 'public_open' ) ) : the_row(); ?>
						<?php if ( get_sub_field( 'public_open_day' ) and get_sub_field( 'public_open_start_time' ) and get_sub_field( 'public_open_end_time' ) ) : ?>
							<p class="card-text">
								<?php the_sub_field( 'public_open_day' ); ?>&nbsp;<?php the_sub_field( 'public_open_start_time' ); ?>&nbsp;~&nbsp;<?php the_sub_field( 'public_open_end_time' ); ?>
							</p>
						<?php elseif ( get_sub_field( 'public_open_day' ) ) : ?>
							<p class="card-text"><?php the_sub_field( 'public_open_day' ); ?></p>
						<?php endif; ?>
					<?php endwhile; ?>

				<?php elseif ( get_field( 'publicStartDate' ) and get_field( 'publicEndDate' ) ) : ?>
					<p class="card-text">
						<?php the_field( 'publicStartDate' ); ?>&nbsp;~&nbsp;<?php the_field( 'publicEndDate' ); ?>
					</p>
				<?php elseif ( get_field( 'publicStartDate' ) and ! get_field( 'publicEndDate' ) ) : ?>
					<p class="card-text">
						<?php the_field( 'publicStartDate' ); ?>
					</p>
				<?php elseif ( ! have_rows( 'public_open' ) and ! get_field( 'publicStartDate' ) and ! get_field( 'publicEndDate' ) ) : ?>
					<p class="card-text">なし</p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="card-block text-xs-right">
		<a href="<?php the_permalink(); ?>" class="btn btn-primary">詳細</a>
	</div>
	<div class="card-footer">
		<i class="fa fa-fw fa-tags"></i> <span><?php the_category( ', ' ); ?></span>
	</div>
</div>
