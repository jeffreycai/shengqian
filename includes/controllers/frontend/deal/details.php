<?php
global $conf;

$id = $vars[2];
$deal = Deal::findById($id);
$category = $deal->getCategory();
$similar_deals = $category->getRecentDeals(20, $id);
shuffle($similar_deals);
$similar_deals = array_slice($similar_deals, 0, 6);

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
    <div class="col-sm-8 col-md-9">
      <ol class="breadcrumb">
        <li><a href="/">首页</a></li>
        <li><a href="/deals">省钱折扣</a></li>
        <li><a href="/deals/<?php echo $category->getId() ?>"><?php echo $category; ?></a></li>
        <li class="active"><?php echo $deal->getTitle(TRUE, 15) ?></li>
      </ol>
      <div class="content">
        <?php $html->renderOut('frontend/deal/details', array('deal' => $deal)); ?>
      </div>
      <section class="similar">
        <h2>类似省钱折扣</h2>
        <?php $html->renderOut('components/deal_list_bottom', array('deals' => $similar_deals)); ?>
        <ul class="pager">
          <li class="next"><a href="/deals/<?php echo $category->getId() ?>">更多<?php echo $category; ?>折扣 &RightArrow;</a></li>
        </ul>
      </section>
    </div>
    <div class="col-sm-4 col-md-3 sidebar">
      <?php $html->renderOut('frontend/deal/sidebar_left'); ?>
    </div>
  </div>
</div>


<?php

$html->renderOut('frontend/footer');

$html->renderOut('frontend/html_footer');
