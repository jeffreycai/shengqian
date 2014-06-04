<?php
global $conf;
global $mysqli;

$deals = array();

$keyword = trim(strip_tags(isset($_GET['keyword']) ? $_GET['keyword'] : ''));
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$total_page;
$total;
$record_per_page = 12;

// validation
if ($keyword == '') {
  setMsg(MSG_ERROR, '请输入搜索关键字');
} else {
  // get records to display
  $query = "SELECT * FROM `deal` WHERE title LIKE '%" . addslashes($keyword) . "%' OR details LIKE '%" . addslashes($keyword) . "%' ORDER BY created_at DESC LIMIT " . (($page-1) * $record_per_page) . ', ' . ($record_per_page);
  $result = $mysqli->query($query);
  while ($record = $result->fetch_object()) {
    $deal = new Deal();
    DBObject::importQueryResultToDbObject($record, $deal);
    $deals[] = $deal;
  }


  // get total page number
  $query = "SELECT * FROM `deal` WHERE title LIKE '%" . addslashes($keyword) . "%' ORDER BY created_at DESC";
  $total = $mysqli->query($query)->num_rows;
  $total_page = ceil($total / $record_per_page);
}





$html = new HTML();
$html->renderOut('frontend/html_header', array(
    'title' => '搜索关键字： ' . $keyword,
    'body_class' => 'search'
));

$html->renderOut('frontend/nav/main', array(
    'current_url' => get_cur_page_url(),
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
        <li><a href="/search/deal">搜索</a></li>
        <li class="active"><small>关键字：</small> <?php echo $keyword ? $keyword : 'N/A' ?></li>
      </ol>
        
        <h1>搜索关键字： <?php echo $keyword ?></h1>
        
        <?php $html->renderOut('frontend/deal/search'); ?>
        
        <p><br /><span class="label label-default">共找到<?php echo $total ? $total : 0 ?>条记录</span></p>
        
        <?php $html->renderOut('components/pagination', array(
          'total_page' => $total_page,
          'page' => $page
        )) ?>
        
        <?php $html->renderOut('components/deal_list_bottom', array('deals' => $deals)); ?>
        
        <?php $html->renderOut('components/pagination', array(
          'total_page' => $total_page,
          'page' => $page
        )) ?>
      <!--
      <section>
        <h2>类似省钱折扣</h2>
        <?php // $html->renderOut('components/deal_list_bottom', array('deals' => $similar_deals)); ?>
      </section>
      -->
    </div>
    <div class="col-sm-4 col-md-3 sidebar">
      <?php $html->renderOut('frontend/deal/sidebar_left_search'); ?>
    </div>
  </div>
</div>


<?php

$html->renderOut('frontend/footer');

$html->renderOut('frontend/html_footer');
