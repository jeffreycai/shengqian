<?php
global $conf;

$id = $vars[2];
$deal = Deal::findById($id);

if (!$deal) {
  HTML::forward('/404');
}

$html = new HTML();
$html->renderOut('frontend/html_header', array(
    'title' => $deal->getTitle(),
    'body_class' => 'deal details'
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
    <div class="col-sm-8">
      <ol class="breadcrumb">
        <li><a href="/">首页</a></li>
        <li><a href="/deals">折扣信息</a></li>
        <li class="active"><?php echo $deal->getTitle(TRUE, 15) ?></li>
      </ol>
      <div class="content">
        <?php $html->renderOut('frontend/deal/details', array('deal' => $deal)); ?>
      </div>
    </div>
    <div class="col-sm-4 sidebar">
      <?php $html->renderOut('frontend/deal/sidebar_left'); ?>
    </div>
  </div>
</div>


<?php
$html->renderOut('frontend/footer');

$html->renderOut('frontend/html_footer');
