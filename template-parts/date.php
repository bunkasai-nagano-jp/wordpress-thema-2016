<div class="card-subtitle text-muted">
	<h5 class="card-date"><i class="fa fa-fw fa-calendar"></i> 公開 <?php the_date(); ?></h5>
	<?php if ( get_the_date() !== get_the_modified_date() ) : ?>
		<h5 class="card-date"><i class="fa fa-fw fa-repeat"></i> 更新 <?php the_modified_date(); ?></h5>
	<?php endif; ?>
</div>
