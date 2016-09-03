<?php get_header(); ?>
<div class="col-md-12">
	<div class="card">
	<div class="card-block">
	  <h1 class="card-title"><?php the_title(); ?></h1>
	</div>
	<div class="table-responsive">
	  <table class="table table-hover table-striped">
		<thead>
		<tr>
		  <th>市町村</th>
		  <th>学校名</th>
		  <th>文化祭名</th>
		  <th>詳細ページ</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$args  = array(
		  'meta_query' => array(
			'meta' => array(
			  'key'  => 'address',
			  'type' => 'CHAR',
			),
		  ),
		  'post_type'  => 'post',
		  'order'      => 'ASC',
		  'orderby'    => 'meta',
		  'nopaging'   => true,
		);
		$posts = query_posts( $args );
		$tmp   = array();
		foreach ( $posts as $post ) :
			$current_processing_school_name = get_field( 'schoolName' );
			if ( in_array( $current_processing_school_name, $tmp, true ) ) {
				continue;
			}
			?>
		  <tr>
			<td>
				<?php
				$category      = get_the_category( $post->ID );
				$cayrgory_name = $category[0]->name; ?>
			  <a href="<?php echo get_category_link( $category[0]->cat_ID ); ?>"><?php echo $cayrgory_name; ?></a>
			</td>
			<td><?php the_field( 'schoolName' ); ?></td>
			<td><?php the_field( 'name' ); ?></td>
			<td class="year">
				<?php
				if ( is_other_year_post( get_field( 'schoolName' ) ) ) :
					$args = array(
					'meta_value' => get_field( 'schoolName' ),
					);
					$result = get_posts( $args );

					foreach ( $result as $post ) :
						  $start_date = date_create( get_field( 'startDate' ) );
							?>
						  <a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo date_format( $start_date, 'Y' ); ?>
					  年</a>
						<?php
					endforeach;

			  else :
					$start_date = date_create( get_field( 'startDate' ) );
				?>
				<a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo date_format( $start_date, 'Y' ); ?>年</a>
				<?php
			  endif;
				?>
			</td>
		  </tr>
			<?php
			$tmp[] = get_field( 'schoolName' );
		endforeach;
		?>
		</tbody>
	  </table>
	</div>
	</div>
</div>
<?php get_footer(); ?>
