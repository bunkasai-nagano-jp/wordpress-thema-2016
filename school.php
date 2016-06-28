<img src="<?php echo get_gmap_sv_url(600,350); ?>" class="img-fluid" style="width:100%;">
<div class="card-block">
	<?php
	if ( is_ended() ) {
		echo "<p class=\"card-text text-muted\">この文化祭は終了しました</p>";
	}
	?>
	<h2 class="card-title">名称</h2>
	<p class="bg-success"><?php echo get_field('name'); ?></p>
	<h2 class="card-title"><?php
	$start_date        =    get_field('startDate');        //開始日
	$end_date          =    get_field('endDate');          //終了日
	$public_start_date =    get_field('publicStartDate');  //一般公開公開日
	$public_end_date   =    get_field('publicEndDate');    //一般公開終了日
	$public_unknown    =    get_field('public_unknown');   //一般公開情報が不明かどうか真偽値
	if (!$end_date) {
		echo '開催日';
	}
	else {
		echo '開催期間';
	}
	 ?></h2>
	<p class="bg-info"><?php
	if (!$end_date) {
		echo $start_date;
	}
	else {
		echo $start_date. ' ~ '.$end_date;
	}
	?></p>
	<h2 class="card-title"><?php
	if ($public_unknown === true) {
		// 一般公開情報が不明
		echo "一般公開";
	}
	elseif (!$public_start_date) {
		// 一般公開なし
		echo "一般公開";
	}
	elseif ( empty($public_end_date) ) {
		// 一般公開終了日が空
		// 一般公開が1日
		echo "一般公開日";
	}
	else {
		echo "一般公開期間";
	}
	  ?></h2>
		<?php
		if ( $public_unknown === true ) {
			// 一般公開情報が不明
			echo "<p class=\"bg-warning\">不明</p>";
		}
		elseif (!$public_start_date) {
			// 一般公開なし
			echo "<p class=\"bg-warning\">なし</p>";
		}
		elseif (!$public_end_date) {
			// 一般公開終了日が空
			// 一般公開が1日
			echo '<p class="bg-info">'.$public_start_date."</p>";
		}
		else {
			echo '<p class="bg-info">'.$public_start_date.' ~ '.$public_end_date."</p>";
		}
?>
	<h2 class="card-title">地図</h2>
	<?php echo get_gmap_url(); ?>
	<h3 class="card-title">学校情報</h3>
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
</div>
