<img src="<?php echo get_gmap_sv_url(); ?>" class="img-thumbnail center-block" />
<h2 class="header">名称</h2>
<p class="bg-success"><?php echo get_field('name'); ?></p>
<h2 class="header">開催期間</h2>
<p class="bg-info"><?php echo get_field('startDate'); ?>&nbsp;~&nbsp;<?php echo get_field('endDate'); ?></p>
<?php

$public_start_date =    get_field('publicStartDate');  //一般公開公開日
$public_end_date   =    get_field('publicEndDate');    //一般公開終了日
$public_unknown    =    get_field('public_unknown');   //一般公開情報が不明かどうか真偽値

if ( $public_unknown === true ) {
	// 一般公開情報が不明
	echo "<h2 class=\"header\">一般公開</h2>\n";
	echo "<p class=\"bg-warning\">不明</p>\n";
}
elseif ( empty($public_start_date) ) {
	// 一般公開なし
	echo "<h2 class=\"header\">一般公開</h2>\n";
	echo "<p class=\"bg-warning\">なし</p>\n";
}
elseif ( empty($public_end_date) ) {
	// 一般公開終了日が空
	// 一般公開が1日
	echo "<h2 class=\"header\">一般公開日</h2>\n";
	echo '<p class="bg-info">'. $public_start_date ."</p>\n";
}
else {
	echo "<h2 class=\"header\">一般公開期間</h2>\n";
	echo '<p class="bg-info">'. $public_start_date .'&nbsp;~&nbsp;'. $public_end_date ."</p>\n";
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
