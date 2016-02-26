<ol class="breadcrumb">
	<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo home_url(); ?>" itemprop="url"><span itemprop="title">ホーム</span></a></li>
<?php $postcat = get_the_category();
$catid = $postcat[0]->cat_ID;
$allcats = array($catid);
while( ! $catid == 0 )
{
$mycat = get_category($catid);
$catid = $mycat->parent;
array_push($allcats, $catid);
}
array_pop($allcats);
$allcats = array_reverse($allcats);
$tmp = count($allcats);
?>
<?php foreach( $allcats as $catid )
{
if( ($tmp == 1) )
{
echo '<li class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">'.'<span itemprop="title">'.get_cat_name($catid).'</span></li>';
break;
}
echo '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">'.'<a href="'.get_category_link($catid).'" itemprop="url">'.'<span itemprop="title">'.get_cat_name($catid).'</span></a></li>';
$tmp--;
}
?>
</ol>
