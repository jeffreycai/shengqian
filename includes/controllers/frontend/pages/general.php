<?php
global $conf;

$slug = $vars[1];

$page = Page::findBySlug($slug);

// forward 404 if page does not exist
if (!$page) {
  HTML::forward('/404');
}

$html = new HTML();
$html->renderOut('frontend/html_header', array(
    'title' => $page->getTitle(),
    'body_class' => 'page'
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
        <?php foreach ($page->getParents() as $parent): ?>
        <li><a href="<?php echo $parent->getPageUrl() ?>"><?php echo $page->getTitle(); ?></a></li>
        <?php endforeach; ?>
        <li class="active"><?php echo $page->getTitle(TRUE, 15) ?></li>
      </ol>
      <div class="content">
        <?php $html->renderOut('frontend/page/details', array('page' => $page)); ?>
      </div>
    </div>
    <div class="col-sm-4 col-md-3 sidebar">
      <?php $html->renderOut('frontend/deal/sidebar_left'); ?>
    </div>
  </div>
</div>


<?php

$html->renderOut('frontend/footer');

$html->renderOut('frontend/html_footer');
