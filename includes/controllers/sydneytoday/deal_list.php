<?php
global $conf;
global $mysqli;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// get records to display
$query = "SELECT * FROM `sydneytoday_deal` ORDER BY deleted ASC, last_published ASC LIMIT " . (($page-1) * $conf['record_each_page']) . ', ' . ($conf['record_each_page']);

$result = $mysqli->query($query);
$deals = array();
while ($record = $result->fetch_object()) {
  $deal = new SydneytodayDeal();
  DBObject::importQueryResultToDbObject($record, $deal);
  $deals[] = $deal;
}

// get total page number
$query = "SELECT * FROM `topic`";
$total_page = ceil($mysqli->query($query)->num_rows / $conf['record_each_page']);


$html = new HTML();

echo $html->render('html_header', array('title' => 'Dingtie task list'));
echo $html->render('header');

echo $html->render('sydneytoday/sidebar');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class='page-header'>今日悉尼</h1>
  <h2 class='sub-header'>折扣信息任务列表</h2>
  
  <?php echo $html->render('pagination', array(
      'total_page' => $total_page,
      'page' => $page
  )) ?>
  
  <table class="table table-striped">
    <tbody>
      <tr>
        <th>#</th>
        <th>标题</th>
        <th>最后发布时间</th>
        <th>操作</th>
      </tr>
      <?php foreach ($deals as $deal): ?>
      <tr id="sydneytoday_deal-<?php echo $deal->getId(); ?>">
        <td><?php echo $deal->getId(); ?></td>
        <td><?php echo $deal->getTitle(20); ?></td>
        <td><?php echo $deal->getLastPublished() ?></td>
        <td>
          <?php if ($deal->getDeleted()): ?>
          <button class="btn btn-xs btn-danger delete deleted" type="button" data-loading-text="Deleting...">Delete forever</button>
          <?php else: ?>
          <button class="btn btn-xs btn-danger delete" type="button" data-loading-text="Deleting...">Delete</button>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <?php echo $html->render('pagination', array(
      'total_page' => $total_page,
      'page' => $page
  )) ?>

<?php

echo $html->render('footer');
echo $html->render('html_footer');

