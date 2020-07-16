<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<?php echo template('header.html'); ?><div class="container-fluid clearfix view-html">
<?php echo template('system/random_jpg.html'); ?>
<div class="list-title list-title2">
<div class="container">
<p class="column-htmldir">
<?php echo $category[$catid]['htmldir'];?>
</p>
<h4 class="column-title">
<?php echo $category[$catid]['catname'];?>
</h4>
<ul class="column-subcolumn">
<?php if(is_array(categories($topid)))
foreach(categories($topid) as $t1) { ?>
<li class="column-subcolumn-title">
<a href="<?php echo $t1['url'];?>" title="<?php echo $t1['catname'];?>"><?php echo $t1['catname'];?></a>
</li> <?php } ?>
</ul>
</div>
</div>
<div class="container clearfix">
<div class="row column">
<div class="column-list-text-pic">
<?php if(is_array($archives))
foreach($archives as $i => $archive) { ?>
<div class="column-list-text-pic-item">
<div class="column-list-text-pic-img">
 <a target="_blank" href="<?php echo $archive['url'];?>"><img src="<?php echo $archive['thumb'];?>" alt="<?php echo $archive['stitle'];?>" /></a> <span><?php echo sdate($archive['adddate'],'Y.m.d');?></span>
</div>
<div class="column-list-text-pic-text">
<h4>
<a title="<?php echo $archive['stitle'];?>" href="<?php echo $archive['url'];?>" target="_blank"><?php echo $archive['title'];?></a>
</h4>
<p>
<?php echo cut(strip_tags($archive['introduce']),160);?>
</p>
</div>
</div> <?php } ?>
</div>
<div class="column-pagination">
<?php if(isset($pages)) { ?> <?php echo category_pagination($catid);?> <?php } ?>
</div>
</div>
</div>
</div><?php echo template('footer.html'); ?>