<img src="<?php echo get_gmap_sv_url(); ?>" class="img-thumbnail center-block" />
<h2 class="header">名称</h2>
<p class="bg-success"><?php echo get_field('name'); ?></p>
<h2 class="header">開催期間</h2>
<p class="bg-info"><?php echo get_field('startDate'); ?>&nbsp;~&nbsp;<?php echo get_field('endDate'); ?>
<?php
$public_end_date = get_field('publicEndDate');
$public_start_date = get_field('publicStartDate');
if ( empty($public_end_date) )
{
	if ( empty($public_start_date) )
	{
		echo '<h2 class="header">一般公開</h2>';
		echo '<p class="bg-warning">なし</p>';
	}
	else
	{
		echo '<h2 class="header">一般公開日</h2>';
		echo '<p class="bg-info">'.get_field('publicStartDate').'</p>';
	}
}
else
{
	echo '<h2 class="header">一般公開期間</h2>';
	echo '<p class="bg-info">'.get_field('publicStartDate').'&nbsp;~&nbsp;'.get_field('publicEndDate').'</p>';
}
?>
<h2 class="header">地図</h2>
<?php echo get_gmap_url(); ?>
<h3 class="header">学校情報</h3>
<table class="table table-striped table-bordered">
	<tbody>
		<tr>
			<td>学校名</td>
			<td><?php echo get_field('schoolName'); ?></td>
		</tr>
		<tr>
			<td>住所</td>
			<td><?php echo get_field('address'); ?></td>
		</tr>
		<tr>
			<td>公式サイト</td>
			<td><a href="<?php echo get_field('url'); ?>"><?php echo get_field('url'); ?></a></td>
		</tr>
		<tr>
			<td>電話番号</td>
			<td><?php echo get_field('tel'); ?></td>
		</tr>
	</tbody>
</table>
