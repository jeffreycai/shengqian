<?php
global $conf;
global $mysqli;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// get records to display
$query = "SELECT * FROM `deal` ORDER BY deleted ASC, created_at DESC LIMIT " . (($page-1) * $conf['record_each_page']) . ', ' . ($conf['record_each_page']);
$result = $mysqli->query($query);
$deals = array();
while ($record = $result->fetch_object()) {
  $deal = new Deal();
  DBObject::importQueryResultToDbObject($record, $deal);
  $deals[] = $deal;
}


// get total page number
$query = "SELECT * FROM `deal`";
$total_page = ceil($mysqli->query($query)->num_rows / $conf['record_each_page']);


$html = new HTML();

echo $html->render('backend/html_header', array('title' => 'Deal list'));
echo $html->render('backend/header');

echo $html->render('backend/deal/sidebar');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <?php $html->renderOut('backend/deal/nav'); ?>
  <h2 class='sub-header'>折扣信息列表</h2>
  
  <?php echo $html->render('components/pagination', array(
      'total_page' => $total_page,
      'page' => $page
  )) ?>
  
  <table class="table table-striped">
    <tbody>
      <tr>
        <th>#</th>
        <th>标题</th>
        <th>Due</th>
        <th>发帖时间</th>
        <th>Published?</th>
        <th>Promoted?</th>
        <th>操作</th>
      </tr>
      <?php foreach ($deals as $deal): ?>
      <tr id="deal-<?php echo $deal->getId(); ?>">
        <td><?php echo $deal->getId(); ?></td>
        <td><?php echo $deal->getTitle(true); ?></td>
        <td><?php echo $deal->getDue(); ?></td>
        <td><?php echo $deal->getCreatedAt(); ?></td>
        <td><span class="glyphicon glyphicon-<?php echo $deal->getPublished() ? 'ok' : 'remove' ?>"></span></td>
        <td><span class="glyphicon glyphicon-<?php echo $deal->getPromoted() ? 'ok' : 'remove' ?>"></span></td>
        <td>
          <!-- edit -->
          <button class="btn btn-xs btn-primary edit" onclick="window.location = '/admin/deal/edit/<?php echo $deal->getId();?>';">Edit</button>
          <!-- delete -->
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

  <?php echo $html->render('components/pagination', array(
      'total_page' => $total_page,
      'page' => $page
  )) ?>

<?php

echo $html->render('backend/footer');
echo $html->render('backend/html_footer');
