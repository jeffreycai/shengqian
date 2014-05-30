<?php
global $conf;

$category = $data->category;
$cid = $data->cid;
$current_url = get_cur_page_url();

$img = $category ? $category->getId() : $cid;
?>

<div class="row jumbotron">
  
  <div class="visible-xs col-xs-12">
    <ul class="nav nav-tabs">
      <li<?php echo_link_active_class('/deals', $current_url); ?>><a href="/deals">全部</a></li>
      <li<?php echo_link_active_class('/deals/promoted', $current_url); ?>><a href="/deals/promoted">精选</a></li>
      <?php foreach ($conf['category'] as $cid => $name): $cat = Category::findById($cid); ?>
      <li<?php echo_link_active_class('/deals/' . $cat->getId(), $current_url) ?>><a href='/deals/<?php echo $cat->getId(); ?>'><?php echo $cat->getName(); ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
  
  <div class="col-xs-12 col-sm-9">
    <div class="img-wrapper">
      <img class="img-responsive" src="/images/<?php echo $img ?>.jpg" />
    </div>
  </div>
  
  <div class="col-xs-12 col-sm-3">
    <ul class="nav nav-pills nav-stacked visible-sm visible-md visible-lg">
      <li<?php echo_link_active_class('/deals', $current_url); ?>><a href="/deals">全部折扣</a></li>
      <li<?php echo_link_active_class('/deals/promoted', $current_url); ?>><a href="/deals/promoted">精选折扣</a></li>
      <?php foreach ($conf['category'] as $cid => $name): $cat = Category::findById($cid); ?>
      <li<?php echo_link_active_class('/deals/' . $cat->getId(), $current_url) ?>><a href='/deals/<?php echo $cat->getId(); ?>'><?php echo $cat->getName(); ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
  
</div>
<div class="clearfix"></div>