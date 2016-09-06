<?php get_header(); ?>
<div class="col-md-12">
	<div>
		<div class="card">
			<div class="card-block">
				<h1 class="card-title"><?php the_title(); ?></h1>
				<?php
					$args            = [
						'meta_query' => [
							'start_date' => [
								'key'     => 'startDate',
								'value'   => [ '2016/01/01', '2016/12/31' ],
								'compare' => 'BETWEEN',
								'type'    => 'DATE',
							],
							'address'    => [
								'key'  => 'address',
								'type' => 'CHAR',
							],
						],
						'post_type'  => 'post',
						'order'      => 'ASC',
						'orderby'    => 'address',
						'nopaging'   => true,
					];
					$posts           = query_posts( $args );
					$school_name_tmp = [];
				?>
				<?php foreach ( $posts as $post ) :
					if ( in_array( get_field( 'schoolName' ), $school_name_tmp ) ) :
						continue;
					endif; ?>
					<div class="card-block">
						<h2 class="card-text">
							<a href="<?php the_permalink(); ?>"><?php the_field( 'name' ) ?></a>
						</h2>
						<h4 class="card-subtitle text-muted"><?php the_field( 'schoolName' ) ?></h4>
						<div class="card-block">
							<p class="card-text">
								<span><i class="fa fa-fw fa-calendar"></i> 開催期間</span>
								<?php if ( get_field( 'startDate' ) and get_field( 'endDate' ) ) : ?>
									<span><?php the_field( 'startDate' ); ?>&nbsp;~&nbsp;<?php the_field( 'endDate' ); ?></span>
									<?php
								elseif ( get_field( 'startDate' ) and ! get_field( 'endDate' ) ) : ?>
									<span><?php the_field( 'startDate' ); ?></span>
								<?php else : ?>
									<span>不明</span>
									<?php
								endif;
								?>
							</p>
							<p class="card-text">
								<span><i class="fa fa-fw fa-info" aria-hidden="true"></i> 一般公開</span>
								<?php if ( get_field( 'public_unknown' ) ) : ?>
									<span>不明</span>
								<?php else : ?>
								<?php if ( have_rows( 'public_open' ) ) : ?>
									<?php while ( have_rows( 'public_open' ) ) : the_row(); ?>
										<?php if ( get_sub_field( 'public_open_day' ) and get_sub_field( 'public_open_start_time' ) and get_sub_field( 'public_open_end_time' ) ) : ?>
											<span class="list-card-date">
									<?php the_sub_field( 'public_open_day' ); ?>&nbsp;<?php the_sub_field( 'public_open_start_time' ); ?>&nbsp;~&nbsp;<?php the_sub_field( 'public_open_end_time' ); ?>
									</span>
										<?php elseif ( get_sub_field( 'public_open_day' ) ) : ?>
											<span><?php the_sub_field( 'public_open_day' ); ?></span>
										<?php endif; ?>
									<?php endwhile; ?>
								<?php elseif ( get_field( 'publicStartDate' ) and get_field( 'publicEndDate' ) ) : ?>
									<span><?php the_field( 'publicStartDate' ); ?>&nbsp;~&nbsp;<?php the_field( 'publicEndDate' ); ?></span>
								<?php elseif ( get_field( 'publicStartDate' ) and ! get_field( 'publicEndDate' ) ) : ?>
									<span><?php the_field( 'publicStartDate' ); ?></span>
								<?php elseif ( ! have_rows( 'public_open' ) and ! get_field( 'publicStartDate' ) and ! get_field( 'publicEndDate' ) ) : ?>
									<span>なし</span>
								<?php endif; ?>
							</p>
							<?php endif;
								$tmp[] = get_field( 'schoolName' );
							?>
						</div>
					</div>
				<?php endforeach;
					wp_reset_query(); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
