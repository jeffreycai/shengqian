<?php
global $conf;
global $mysqli;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// get records to display
$query = "SELECT * FROM `page` ORDER BY created_at DESC LIMIT " . (($page-1) * $conf['record_each_page']) . ', ' . ($conf['record_each_page']);
$result = $mysqli->query($query);
$pages = array();
while ($result && $record = $result->fetch_object()) {
  $p = new Page();
  DBObject::importQueryResultToDbObject($record, $p);
  $pages[] = $p;
}


// get total page number
$query = "SELECT * FROM `page`";
$total_page = ceil($mysqli->query($query)->num_rows / $conf['record_each_page']);


$html = new HTML();

echo $html->render('backend/html_header', array('title' => 'Page list'));
echo $html->render('backend/header');

?>
<div class="main">
  <?php $html->renderOut('backend/page/nav'); ?>
  <h2 class='sub-header'>澳洲省钱网网页列表</h2>
  <?php echo renderMsgs(); ?>
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
        <th>创建时间</th>
        <th>Pub?</th>
        <th>操作</th>
      </tr>
      <?php foreach ($pages as $p): ?>
      <tr id="page-<?php echo $p->getId(); ?>">
        <td><?php echo $p->getId(); ?></td>
        <td><a href="<?php echo $p->getPageUrl() ?>" target="_blank"><?php echo $p->getTitle(true); ?></a></td>
        <td><?php echo $p->getCreatedAtDate(); ?></td>
        <td><span class="glyphicon glyphicon-<?php echo $p->getPublished() ? 'ok' : 'remove' ?>"></span></td>
        <td>
          <!-- edit -->
          <a class="btn btn-xs btn-primary edit" href='/admin/page/edit/<?php echo $p->getId();?>'>Edit</a>
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

