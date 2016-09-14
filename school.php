<?php
	if ( get_gmap_sv_url( 600, 350 ) ) : ?>
		<img class="card-img-top img-fluid" src="<?php echo esc_url( get_gmap_sv_url( 600, 350 ) ); ?>" alt="streetview">
	<?php endif; ?>
<div class="card-block">
	<?php if ( is_ended() ) : ?>
		<p class="card-text text-muted">この文化祭は終了しました</p>
	<?php endif; ?>
	<h2 class="card-title">名称</h2>
	<p><?php the_field( 'name' ); ?></p>
	<h2 class="card-title">開催期間</h2>
	<p><?php
	if ( ! get_field( 'endDate' ) ) :
		the_field( 'startDate' );
	else :
		echo get_field( 'startDate' ) . '&nbsp;~&nbsp;' . get_field( 'endDate' );
	endif;
	?>
	</p>
	<h2 class="card-title">一般公開</h2>
	<?php if ( get_field( 'public_unknown' ) ) : ?>
		<p>不明</p>
	<?php else : ?>
		<?php if ( have_rows( 'public_open' ) ) :
			while ( have_rows( 'public_open' ) ) : the_row();
				if ( get_sub_field( 'public_open_day' ) and get_sub_field( 'public_open_start_time' ) and get_sub_field( 'public_open_end_time' ) ) : ?>
					<p><?php the_sub_field( 'public_open_day' ); ?>&nbsp;<?php the_sub_field( 'public_open_start_time' ); ?>&nbsp;~&nbsp;<?php the_sub_field( 'public_open_end_time' ); ?></p>
				<?php elseif ( get_sub_field( 'public_open_day' ) ) : ?>
					<p><?php the_sub_field( 'public_open_day' ); ?></p>
				<?php endif;
			endwhile;
		elseif ( get_field( 'publicStartDate' ) and get_field( 'publicEndDate' ) ) : ?>
			<p><?php the_field( 'publicStartDate' ); ?>&nbsp;~&nbsp;<?php the_field( 'publicEndDate' ); ?></p>
		<?php elseif ( get_field( 'publicStartDate' ) ) : ?>
			<p><?php the_field( 'publicStartDate' ); ?></p>
		<?php else : ?>
			<p>なし</p>
		<?php endif;
	endif; ?>
	<?php if ( have_rows( 'bunkasai_site' ) ) : ?>
		<h2 class="card-title">関連サイト</h2>
		<div class="card-block">
			<?php while ( have_rows( 'bunkasai_site' ) ) :the_row(); ?>
				<?php if ( get_sub_field( 'bunkasai_site_name' ) and get_sub_field( 'bunkasai_site_url' ) ) : ?>
					<h3><?php the_sub_field( 'bunkasai_site_name' ); ?></h3>
					<a href="<?php the_sub_field( 'bunkasai_site_url' ) ?>"><?php the_sub_field( 'bunkasai_site_url' ); ?></a>
				<?php endif;
			endwhile; ?>
		</div>
	<?php endif; ?>
	<?php get_template_part( 'template/twitter-embed' ); ?>
	<h2 class="card-title">地図</h2>
	<?php echo get_gmap_url(); ?>
	<h3 class="card-title">学校情報</h3>
	<table class="table table-striped table-bordered">
		<tbody>
		<tr>
			<td>学校名</td>
			<td><?php the_field( 'schoolName' ); ?></td>
		</tr>
		<tr>
			<td>住所</td>
			<td><?php the_field( 'address' ); ?></td>
		</tr>
		<tr>
			<td>学校公式サイト</td>
			<td><a href="<?php the_field( 'url' ); ?>"><?php the_field( 'url' ); ?></a></td>
		</tr>
		<tr>
			<td>電話番号</td>
			<td><?php the_field( 'tel' ); ?></td>
		</tr>
		</tbody>
	</table>
</div>
