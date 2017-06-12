<!-- breadcrumb -->
<ol class="breadcrumb mb-3">
    <li class="breadcrumb-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
        <a href="<?php echo esc_url( home_url() ); ?>" itemprop="url"><span itemprop="title">ホーム</span></a>
	</li>
	<?php $categories = get_the_category();
	if ( $categories ) :
		$current_category_id = $categories[0]->cat_ID;
		$all_category_id = [ $current_category_id ];
		while ( $current_category_id ) :
			$current_category = get_category( $current_category_id );
			$current_category_id = $current_category->parent;
			array_push( $all_category_id, $current_category_id );
		endwhile;
		array_pop( $all_category_id );
		$all_category_id = array_reverse( $all_category_id );
		$tmp = count( $all_category_id );
		foreach ( $all_category_id as $current_category_id ) :
			if ( (1 === $tmp) ) :
				if ( is_single() ) : ?>
					<li class="breadcrumb-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
						<a href="<?php echo esc_url( get_term_link( $current_category_id ) ); ?>" itemprop="url">
							<span itemprop="title"><?php echo esc_html( get_cat_name( $current_category_id ) ); ?></span>
						</a>
					</li>
				<?php else : ?>
					<li class="breadcrumb-item active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
						<span itemprop="title"><?php echo esc_html( get_cat_name( $current_category_id ) ); ?></span>
					</li>
				<?php endif; ?>
			<?php else : ?>
				<li class="breadcrumb-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="<?php echo esc_url( get_term_link( $current_category_id ) ); ?>" itemprop="url"><span itemprop="title"><?php echo esc_html( get_cat_name( $current_category_id ) ); ?></span></a>
				</li>
			<?php endif;
			$tmp--;
		endforeach;
	endif; ?>
</ol>
<!-- /breadcrumb -->
