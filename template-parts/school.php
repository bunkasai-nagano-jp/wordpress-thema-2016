<?php
$school = new School(get_field('schoolName'));
$year = $school->get_year();
$img_url = $school->get_streetview_url(600, 350, get_the_ID());
if (!empty($img_url)) : ?>
    <img class="img-fluid img-thumbnail mb-3" src="<?php echo $img_url; ?>" alt="streetview">
<?php endif; ?>
<div class="">
    <?php if (is_ended()) : ?>
        <p class="card-text text-muted">この文化祭は終了しました</p>
    <?php endif; ?>
    <h2 class="card-title">名称</h2>
    <p><?php the_field('name'); ?></p>
    <h2 class="card-title">開催期間</h2>
    <p><?php echo esc_html($school->the_event_date($year)); ?></p>
    <h2 class="card-title">一般公開</h2>
    <?php $event_public_open_date = $school->get_event_public_open_date($year); ?>
    <?php foreach ($event_public_open_date as $text) : ?>
        <p><?php echo esc_html($text); ?></p>
    <?php endforeach; ?>
    <?php if (have_rows('bunkasai_site')) : ?>
        <h2 class="card-title">関連サイト</h2>
        <div class="card-block">
            <?php while (have_rows('bunkasai_site')) :the_row(); ?>
                <?php if (get_sub_field('bunkasai_site_name') and get_sub_field('bunkasai_site_url')) : ?>
                    <h3><?php the_sub_field('bunkasai_site_name'); ?></h3>
                    <a href="<?php the_sub_field('bunkasai_site_url') ?>"><?php the_sub_field('bunkasai_site_url'); ?></a>
                <?php endif;
            endwhile; ?>
        </div>
    <?php endif; ?>
    <?php get_template_part('template-parts/twitter-embed'); ?>
    <h2 class="card-title">地図</h2>
    <?php the_gmap(); ?>
	<ins class="adsbygoogle"
	     style="display:block; text-align:center;"
	     data-ad-format="fluid"
	     data-ad-layout="in-article"
	     data-ad-client="ca-pub-3116606223638769"
	     data-ad-slot="9748204935"></ins>
	<script>
        (adsbygoogle = window.adsbygoogle || []).push({});
	</script>
    <h3>学校情報</h3>
    <table class="table table-striped table-bordered pb-0">
        <tbody>
        <tr>
            <td>学校名</td>
            <td><?php the_field('schoolName'); ?></td>
        </tr>
        <tr>
            <td>住所</td>
            <td><?php the_field('address'); ?></td>
        </tr>
        <tr>
            <td>学校公式サイト</td>
            <td><a href="<?php the_field('url'); ?>"><?php the_field('url'); ?></a></td>
        </tr>
        <tr>
            <td>電話番号</td>
            <td><?php the_field('tel'); ?></td>
        </tr>
        </tbody>
    </table>
</div>
