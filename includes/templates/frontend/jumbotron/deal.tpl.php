<?php
global $conf;

$category = $data->category;
$cid = $data->cid;
$current_url = get_cur_page_url();

$img = $category ? $category->getId() : $cid;
?>

<div class="branding row">
  <div style='margin-top: 15px;' class="visible-xs col-xs-12">
    <ul class="nav nav-tabs">
      <li<?php echo_link_active_class('/deals', $current_url); ?>><a href="/deals">全部折扣</a></li>
      <li<?php echo_link_active_class('/deals/promoted', $current_url); ?>><a href="/deals/promoted">精选折扣</a></li>
      <?php foreach ($conf['category'] as $cid => $name): $cat = Category::findById($cid); ?>
      <li<?php echo_link_active_class('/deals/' . $cat->getId(), $current_url) ?>><a href='/deals/<?php echo $cat->getId(); ?>'><?php echo $cat->getName(); ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
  
  <div class="col-xs-12 col-sm-9">
    <div style="padding: 4px; background-color: #FFF;">
    <img class="img-responsive" src="/images/<?php echo $img ?>.jpg" />
    </div>
  </div>
  
  <div class="col-xs-12 col-sm-3">
    
    <div>
      <ul class="nav nav-pills nav-stacked visible-sm visible-md visible-lg">
        <li<?php echo_link_active_class('/deals', $current_url); ?>><a href="/deals">全部折扣</a></li>
        <li<?php echo_link_active_class('/deals/promoted', $current_url); ?>><a href="/deals/promoted">精选折扣</a></li>
        <?php foreach ($conf['category'] as $cid => $name): $cat = Category::findById($cid); ?>
        <li<?php echo_link_active_class('/deals/' . $cat->getId(), $current_url) ?>><a href='/deals/<?php echo $cat->getId(); ?>'><?php echo $cat->getName(); ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    
  </div>
  
<!--  <div class="col-xs-12 col-sm-3">
    <div class="row">
      <div class="col-xs-6 col-sm-12"><a class="btn btn-info" href="/deals">All</a></div>
      <div class="col-xs-6 col-sm-12"><a class="btn btn-info" href="/deals/promoted">Promoted</a></div>
      <?php foreach ($conf['category'] as $cid => $name): $cat = Category::findById($cid); ?>
        <div class="col-xs-3 col-sm-12">
          <a class="btn btn-info" href="/deals/<?php echo $cat->getId(); ?>"><?php echo $cat->getName(); ?></a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>-->
</div>
<div class="clearfix"></div>