<?php
global $conf;

$id = $vars[1];
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
  <div class="col-xs-12 col-sm-8 content">
    <?php $html->renderOut('frontend/deal/details', array('deal' => $deal)); ?>
  </div>
  <div class="col-xs-12 col-sm-4 sidebar">
    <?php $html->renderOut('frontend/deal/sidebar_left'); ?>
  </div>
</div>


<?php
$html->renderOut('frontend/footer');

$html->renderOut('frontend/html_footer');
