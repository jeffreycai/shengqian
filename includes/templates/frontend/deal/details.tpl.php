<?php 
global $conf;
$deal = $data->deal;
$category = $deal->getCategory();
$html = new HTML();
?>


<article>

  <div class="tn col-md-6">
    <img class="img-responsive" src="<?php echo $deal->getThumbnail($conf['deal']['thumbnail_size']); ?>" alt="<?php echo $deal->getTitle(); ?>" />
  </div>
  <div class="col-md-6">
    <header>
      <h1><?php echo $deal->getTitle(); ?></h1>
      <?php if ($deal->getSaving()): ?>
        <span class="label label-danger">省<?php echo $deal->getSaving(); ?></span>
      <?php endif; ?>
      <?php if ($deal->getDiscount()): ?>
        <span class="label label-warning"><?php echo $deal->getDiscount(); ?>折扣</span>
      <?php endif; ?>
      <span class="label label-primary"><?php echo $category; ?></span>
    </header>
    <?php echo $deal->getDetails(); ?>
    
    <div class="divider dotted"></div>
    
    <ul class="fine-print">
      <?php if ($hoster = $deal->getHoster()): ?>
        <li><span>服务提供商:</span><?php echo $hoster; ?></li>
      <?php endif; ?>
      <li><span>折扣有效日期：</span><?php echo $deal->getDueDate(); ?></li>
      <li><span>折扣创建日期：</span><?php echo $deal->getCreatedAtDate(); ?></li>
    </ul>
    <div class="tell-friend"><br />
      <p>分享给小伙伴们，一起省钱~！</p>
      <?php $html->renderOut('/components/sharebtns', array(
          'share_text' => "分享好东西：" . str_replace('"', '\"', $deal->getTitle(true, 60)) . " ". $conf['site_url'] . $deal->getPageUrl(),
          'share_img' => $deal->getImage()
      )); ?>
    </div>
    
    <div class="divider dotted"></div>
    
    <div class="row">
      <div class="col-xs-12">
        <a href="<?php echo $deal->getGoToLink(); ?>" class="btn btn-danger btn-sm goto">去看看！</a>
      </div>
    </div>
  </div>
  
  <div class="clearfix"></div>
  
</article>




