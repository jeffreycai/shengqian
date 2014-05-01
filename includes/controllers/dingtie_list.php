<?php
global $conf;
global $mysqli;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// get records to display
$query = "SELECT * FROM `topic` ORDER BY deleted ASC, last_replied ASC LIMIT " . (($page-1) * $conf['record_each_page']) . ', ' . ($conf['record_each_page']);
$result = $mysqli->query($query);
$topics = array();
while ($record = $result->fetch_object()) {
  $topic = new Topic();
  DBObject::importQueryResultToDbObject($record, $topic);
  $topics[] = $topic;
}

// get total page number
$query = "SELECT * FROM `topic`";
$total_page = ceil($mysqli->query($query)->num_rows / $conf['record_each_page']);


$html = new HTML();

echo $html->render('html_header', array('title' => 'Dingtie task list'));
echo $html->render('header');

echo $html->render('sidebar');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class='page-header'>顶贴</h1>
  <h2 class='sub-header'>顶贴任务列表</h2>
  
  <?php echo $html->render('pagination', array(
      'total_page' => $total_page,
      'page' => $page
  )) ?>
  
  <table class="table table-striped">
    <tbody>
      <tr>
        <th>#</th>
        <th>标题</th>
        <th>最后顶贴时间</th>
        <th>操作</th>
      </tr>
      <?php foreach ($topics as $topic): ?>
      <tr id="<?php echo $topic->getId(); ?>">
        <td><?php echo $topic->getId(); ?></td>
        <td><?php echo $topic->getTitle(true); ?></td>
        <td><?php echo $topic->getLastReplied() ?></td>
        <td>
          <?php if ($topic->getDeleted()): ?>
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

