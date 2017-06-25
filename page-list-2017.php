<?php get_header(); ?>
<div class="col-md-12">
	<h1><?php the_title(); ?></h1>
	<div class="row">
		<ins class="adsbygoogle"
		     style="display:block"
		     data-ad-client="ca-pub-3116606223638769"
		     data-ad-slot="2149923735"
		     data-ad-format="auto"></ins>
		<script>
            (adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
	<div class="table-responsive">
		<table class="table table-sm table-hover table-striped">
			<thead class="thead-default">
			<tr>
				<th>所在地</th>
				<th>学校名</th>
				<th>文化祭名</th>
				<th>開催期間</th>
				<th>一般公開</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$school_list = get_all_school_information();
			$year        = '2017';
			?>
			<?php foreach ( $school_list as $value ) :
				$school = new School( $value['school_name'] );
				if ( false !== array_search( $year, array_column( $school->event, 'year' ), true ) ) : ?>
					<tr>
						<td>
							<a href="<?php echo esc_url( $school->category['category_link'] ); ?>"><?php echo esc_html( $school->category['category_name'] ); ?></a>
						</td>
						<td>
							<a href="<?php echo esc_url( $school->the_permalink( $year ) ); ?>"><?php echo esc_html( $school->school_name ); ?></a>
						</td>
						<td><?php echo esc_html( $school->name ); ?></td>
						<td><?php echo esc_html( $school->the_event_date( $year ) ); ?></td>
						<td>
							<?php $event_public_open_date = $school->get_event_public_open_date( $year ); ?>
							<?php foreach ( $event_public_open_date as $text ) : ?>
								<p><?php echo esc_html( $text ); ?></p>
							<?php endforeach; ?>
						</td>
					</tr>
				<?php endif; ?>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="row">
		<ins class="adsbygoogle"
		     style="display:block"
		     data-ad-client="ca-pub-3116606223638769"
		     data-ad-slot="2149923735"
		     data-ad-format="auto"></ins>
		<script>
            (adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
</div>
<?php get_footer(); ?>
