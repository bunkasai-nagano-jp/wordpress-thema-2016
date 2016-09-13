<?php get_header(); ?>
<div class="col-md-12">
	<div class="card">
		<div class="card-block">
			<h1 class="card-title"><?php the_title(); ?></h1>
		</div>
		<div class="card-block">
			<div class="table-responsive">
				<table class="table table-sm table-hover table-striped table-fixed">
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
						$year        = '2016';
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
		</div>
	</div>
</div>
<?php get_footer(); ?>
