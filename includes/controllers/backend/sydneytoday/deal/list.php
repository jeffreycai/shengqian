<?php
global $conf;
global $mysqli;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// get records to display
$query = "SELECT d.id, s.created_at FROM deal as d LEFT JOIN sydneytoday_deal_instance as s ON d.id=s.did WHERE d.valid=1 GROUP BY d.id ORDER BY s.created_at ASC LIMIT " . (($page-1) * $conf['record_each_page']) . ', ' . ($conf['record_each_page']);
$result = $mysqli->query($query);
$deals = array();
while ($result && $record = $result->fetch_object()) {
  $deal = Deal::findById($record->id);
  DBObject::importQueryResultToDbObject($record, $deal);
  $deal->last_updated = $record->created_at;
  $deals[] = $deal;
}
//_debug($deals);

// get total page number
$query = "SELECT d.id, s.created_at FROM deal as d LEFT JOIN sydneytoday_deal_instance as s ON d.id=s.did WHERE d.valid=1 GROUP BY d.id";
$total_page = ceil($mysqli->query($query)->num_rows / $conf['record_each_page']);


$html = new HTML();

echo $html->render('backend/html_header', array('title' => 'Deal list'));
echo $html->render('backend/header');

//echo $html->render('backend/deal/sidebar');
?>
<div class="main">
  <?php $html->renderOut('backend/sydneytoday/nav'); ?>
  <h2 class='sub-header'>折扣发帖列表</h2>
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
        <th>Thumbnail</th>
        <th>Last Ding</th>
        <th>Valid?</th>
        <th>操作</th>
      </tr>
      <?php foreach ($deals as $deal): ?>
      <tr id="deal-<?php echo $deal->getId(); ?>">
        <td><?php echo $deal->getId(); ?></td>
        <td><a href="<?php echo $deal->getPageUrl() ?>" target="_blank"><?php echo $deal->getTitle(true); ?></a></td>
        <td><img src="<?php echo $deal->getThumbnail($conf['deal']['thumbnail_size']); ?>" width="100px;" /></td>
        <td class="last_published"><?php echo time_ago($deal->last_updated); ?></td>
        <td class="valid"><span class="glyphicon glyphicon-<?php echo $deal->getValid() ? 'ok' : 'remove' ?>"></span></td>
        <td>
          <!-- edit -->
          <a class="btn btn-xs btn-primary edit" href='/admin/deal/edit/<?php echo $deal->getId();?>'>Edit</a>
          <!-- publish -->
          <button type="button" class="btn btn-xs btn-success publish-sydneytoday-deal" data-loading-text="Posting...">Post</button>
          <!-- validate -->
          <?php if ($deal->isGroupon()): ?>
            <button class="btn btn-xs btn-warning validate" data-loading-text="Validating">Validate</button>
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

