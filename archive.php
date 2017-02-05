<?php get_header(); ?>
<main>
	<?php get_template_part( 'template-parts/breadcrumb' ); ?>
	<h1><?php if ( is_tag() ) :
			single_tag_title();
		elseif ( is_tax() ) :
			single_term_title();
		endif; ?>の文化祭</h1>
	<?php get_template_part( 'itiran' ); ?>
</main>
<?php get_template_part( 'template-parts/pagination' ); ?>
<?php get_footer(); ?>
