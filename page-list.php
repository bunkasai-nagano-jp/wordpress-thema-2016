<?php get_header(); ?>
<div class="col-md-12">
	<h1><?php the_title(); ?></h1>
	<div class="row">
		<div class="col-md-12">
			<div class="m-3">
				<!-- list header -->
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
	</div>
	<div class="table-responsive">
		<table class="table table-sm table-hover table-striped">
			<thead class="thead-default">
			<tr>
				<th>所在地</th>
				<th>学校名</th>
				<th>文化祭名</th>
				<th>詳細ページ</th>
			</tr>
			</thead>
			<tbody>
			<?php $school_list = get_all_school_information();
			foreach ( $school_list as $value ) :
				$school = new School( $value['school_name'] ); ?>
				<tr>
				<td>
					<a href="<?php echo esc_url( $school->category['category_link'] ) ?>"><?php echo esc_html( $school->category['category_name'] ); ?></a>
				</td>
				<td><?php echo esc_html( $school->school_name ); ?></td>
				<td><?php echo esc_html( $school->name ); ?></td>
				<td class="year">
					<?php foreach ( $school->event as $event ) : ?>
						<a href="<?php echo esc_html( $event['permalink'] ); ?>"><?php echo esc_html( $event['year'] ); ?>
							年</a>
					<?php endforeach; ?>
				</td>
				</tr><?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="m-3">
				<!-- list footer -->
				<ins class="adsbygoogle"
				     style="display:block"
				     data-ad-client="ca-pub-3116606223638769"
				     data-ad-slot="5586337333"
				     data-ad-format="auto"></ins>
				<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
