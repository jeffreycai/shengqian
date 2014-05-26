<?php
global $conf;
global $mysqli;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// get records to display
$query = "SELECT * FROM `sydneytoday_deal` ORDER BY deleted ASC, valid ASC, deleted ASC, last_published ASC LIMIT " . (($page-1) * $conf['record_each_page']) . ', ' . ($conf['record_each_page']);
$result = $mysqli->query($query);
$deals = array();
while ($record = $result->fetch_object()) {
  $deal = new SydneytodayDeal();
  DBObject::importQueryResultToDbObject($record, $deal);
  $deals[] = $deal;
}


// get total page number
$query = "SELECT * FROM `sydneytoday_deal`";
$total_page = ceil($mysqli->query($query)->num_rows / $conf['record_each_page']);


$html = new HTML();

echo $html->render('backend/html_header', array('title' => 'Sydneytoday Deal task list'));
echo $html->render('backend/header');

//echo $html->render('backend/sydneytoday/sidebar');
?>
<div class="main">
  <?php $html->renderOut('backend/sydneytoday/deal/nav'); ?>
  <h2 class='sub-header'>折扣频道帖子列表</h2>
  
  <?php echo $html->render('components/pagination', array(
      'total_page' => $total_page,
      'page' => $page
  )) ?>
  
  <table class="table table-striped">
    <tbody>
      <tr>
        <th>#</th>
        <th>标题</th>
        <th>Valid?</th>
        <th>Target</th>
        <th>Due</th>
        <th>最后发帖时间</th>
        <th>操作</th>
      </tr>
      <?php foreach ($deals as $deal): ?>
      <tr id="sydneytoday_deal-<?php echo $deal->getId(); ?>">
        <td><?php echo $deal->getId(); ?></td>
        <td><?php echo $deal->getTitle(true); ?></td>
        <td class="valid"><span class="glyphicon glyphicon-<?php echo $deal->getValid() ? 'ok' : 'remove' ?>"></span></td>
        <td><a href="<?php echo $deal->getGrouponLinkNaked(); ?>">link</a></td>
        <td><?php echo $deal->getDueDate(); ?></td>
        <td class="last_published"><?php echo $deal->getLastPublished(true); ?></td>
        <td>
          <!-- edit -->
          <button class="btn btn-xs btn-primary edit" onclick="window.location = '/admin/sydneytoday/deal/edit/<?php echo $deal->getId();?>';">Edit</button>
          <!-- create instance -->
          <div class="btn-group">
            <button type="button" class="btn btn-xs btn-success publish-deal" data-loading-text="Publishing...">Publish</button>
            <button type="button" class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu publish" role="menu">
              <?php $instances = $deal->getInstances(); ?>
              <?php foreach ($instances as $instance): ?>
              <li class="disabled"><a href="#"><?php echo $instance->getCreatedAt(true); ?></a></li>
              <?php endforeach; ?>
              <li class="divider"></li>
              <li  class="disabled"><a href="#"><small><strong><?php echo sizeof($instances); ?> records in total.</strong></small></a></li>
            </ul>
          </div>
          <!-- delete -->
          <?php if ($deal->getDeleted()): ?>
          <button class="btn btn-xs btn-danger delete deleted" type="button" data-loading-text="Deleting...">Delete forever</button>
          <?php else: ?>
          <button class="btn btn-xs btn-danger delete" type="button" data-loading-text="Deleting...">Delete</button>
          <?php endif; ?>
          <!-- valid -->
          <button class="btn btn-xs btn-warning validate" type="button" data-loading-text="Valitating...">Validate</button>
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

