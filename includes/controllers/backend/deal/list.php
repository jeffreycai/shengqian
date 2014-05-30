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

//echo $html->render('backend/deal/sidebar');
?>
<div class="main">
  <?php $html->renderOut('backend/deal/nav'); ?>
  <h2 class='sub-header'>折扣信息列表</h2>
  
  <?php echo $html->render('components/pagination', array(
      'total_page' => $total_page,
      'page' => $page
  )) ?>
  
  <div class="table-responsive">
  <table class="table table-striped table-hover">
    <tbody>
      <tr>
        <th>#</th>
        <th>标题</th>
        <th>Vendor</th>
        <th>分类</th>
        <th>Due</th>
        <th>创建时间</th>
        <th>Last Ding</th>
        <th>Pub?</th>
        <th>Pro?</th>
        <th>Vad?</th>
        <th>操作</th>
      </tr>
      <?php foreach ($deals as $deal): ?>
      <tr id="deal-<?php echo $deal->getId(); ?>">
        <td><?php echo $deal->getId(); ?></td>
        <td><?php echo $deal->getTitle(true); ?></td>
        <td><?php echo $deal->getVendor(); ?></td>
        <td><?php echo $deal->getCategory(); ?></td>
        <td><?php echo $deal->getDueDate(); ?></td>
        <td><?php echo $deal->getCreatedAtDate(); ?></td>
        <td class="last_published"><?php echo $deal->getLastPublished(true); ?></td>
        <td><span class="glyphicon glyphicon-<?php echo $deal->getPublished() ? 'ok' : 'remove' ?>"></span></td>
        <td><span class="glyphicon glyphicon-<?php echo $deal->getPromoted() ? 'ok' : 'remove' ?>"></span></td>
        <td class="valid"><span class="glyphicon glyphicon-<?php echo $deal->getValid() ? 'ok' : 'remove' ?>"></span></td>
        <td>
          <!-- edit -->
          <a class="btn btn-xs btn-primary edit" href='/admin/deal/edit/<?php echo $deal->getId();?>'>Edit</a>
          <!-- validate -->
          <?php if ($deal->isGroupon()): ?>
            <button class="btn btn-xs btn-warning validate">Validate</button>
          <?php endif; ?>
          <!-- publish -->
          <button type="button" class="btn btn-xs btn-success publish-sydneytoday-deal" data-loading-text="Publishing...">Publish</button>
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
  </div>

  <?php echo $html->render('components/pagination', array(
      'total_page' => $total_page,
      'page' => $page
  )) ?>

<?php

echo $html->render('backend/footer');
echo $html->render('backend/html_footer');

