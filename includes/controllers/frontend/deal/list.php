<?php
global $conf;
global $mysqli;

// get category if it is not "all"
$cid = isset($vars[2]) ? $vars[2] : 'all';
$category = null; // set null if category is "all"
if ($cid != 'all' && $cid != 'promoted') {
  $category = Category::findById($cid);
  if (!$category) {
    HTML::forward('/404');
  }
}


$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$record_per_page = 24;

// get records to display
$query = "SELECT * FROM `deal` WHERE valid=1 ";
if ($category) {
  $query .= " AND cid=" . DBObject::prepare_val_for_sql($cid);
} else if ($cid == 'promoted') {
  $query .= " AND promoted=1";
}
$query .= " ORDER BY created_at DESC LIMIT " . (($page-1) * $record_per_page) . ', ' . ($record_per_page);
$result = $mysqli->query($query);
$deals = array();
while ($record = $result->fetch_object()) {
  $deal = new Deal();
  DBObject::importQueryResultToDbObject($record, $deal);
  $deals[] = $deal;
}

// get total page number
$query = "SELECT * FROM `deal` WHERE valid=1 ";
if ($category) {
  $query .= " AND cid=" . DBObject::prepare_val_for_sql($cid);
} else if ($cid == 'promoted') {
  $query .= " AND promoted=1";
}
$total = $mysqli->query($query)->num_rows;
$total_page = ceil($total / $record_per_page);





$html = new HTML();
$html->renderOut('frontend/html_header', array(
    'title' => ($category ? $category->getName() : ($cid == 'promoted' ? '精选' : '全部')) . '折扣消息',
    'body_class' => 'deals'
));

$html->renderOut('frontend/nav/main', array(
    'current_url' => get_cur_page_url(true),
    'site_name_html' => $conf['site_name_html'],
    'categories' => $conf['category']
));
$html->renderOut('frontend/sidemenu');

?>

<div class="container body">
  <div class="row">
    <div class="col-sm-8 col-md-9">
      <ol class="breadcrumb">
        <li><a href="/">首页</a></li>
        <li><a href="/deals">省钱折扣</a></li>
        <?php if($cid == 'promoted'): ?>
          <li class="active">精选</li>
        <?php elseif ($cid != 'all'): ?>
          <li class="active"><?php echo $category; ?></li>
        <?php else: ?>
          <li class="active">全部</li>
        <?php endif; ?>
      </ol>
      
      <?php $html->renderOut('frontend/jumbotron/deal', array('category' => $category, 'cid' => $cid)); ?>
      
      <h1><?php echo $category ? $category : ($cid == 'all' ? '全部' : '精选') ?>折扣</h1>
        
      <p><span class="label label-default">共找到<?php echo $total ?>条记录</span></p>

      <?php $html->renderOut('components/pagination', array(
        'total_page' => $total_page,
        'page' => $page
      )) ?>

      <?php $html->renderOut('components/deal_list_bottom', array('deals' => $deals)); ?>

      <?php $html->renderOut('components/pagination', array(
        'total_page' => $total_page,
        'page' => $page
      )) ?>

      <ul class="pager">
        <li class="next"><a href="#" class="gototop">看看其他分类折扣 &RightArrow;</a></li>
      </ul>
      
    </div>
    <div class="col-sm-4 col-md-3 sidebar">
      <?php $html->renderOut('frontend/deal/sidebar_left'); ?>
    </div>
  </div>
</div>


<?php

$html->renderOut('frontend/footer');

$html->renderOut('frontend/html_footer');