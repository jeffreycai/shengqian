<?php 
global $conf;
$deal = $data->deal;
$category = $deal->getCategory();
$html = new HTML();
?>


<article>

  <div class="tn col-md-6">
    <img class="img-responsive" src="<?php echo $deal->getThumbnail($conf['deal']['thumbnail_size']); ?>" alt="<?php echo $deal->getTitle(); ?>" />
    <br />
    <?php if (!$deal->getValid()): ?>
      <div class="alert alert-warning fade in" style="text-align: center;">
        <strong>折扣信息已过期。</strong> <a href="#" class="jump-to-similar">&raquo; 看看其他消息</a>
      </div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <header>
      <h1><?php echo $deal->getTitle(); ?></h1>
      <span class="label label-primary"><?php echo $category; ?></span>
      <?php if ($deal->getSaving()): ?>
        <span class="label label-danger">省<?php echo $deal->getSaving(); ?></span>
      <?php endif; ?>
      <?php if ($deal->getDiscount()): ?>
        <span class="label label-warning"><?php echo $deal->getDiscount(); ?>折扣</span>
      <?php endif; ?>
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
    
    <?php if ($deal->getValid()): ?>
      <div class="tell-friend"><br />
        <p>分享给小伙伴们，一起省钱~！</p>
        <?php $html->renderOut('/components/sharebtns', array(
            'share_text' => "发现一个好东西：" . str_replace('"', '\"', $deal->getTitle(true, 60)),
            'share_img' => $deal->getImage()
        )); ?>
      </div>
    <?php endif; ?>
    
    <div class="divider dotted"></div>
    
    <div class="row">
      <div class="col-xs-12">
        <?php if ($deal->getValid()): ?>
          <a href="<?php echo $deal->getGoToLink(); ?>" class="btn btn-danger btn-sm goto">去看看！</a>
        <?php else: ?>
          <a href="<?php echo $deal->getGoToLink(); ?>" class="btn btn-default btn-sm goto" disabled="disabled">亲，这条折扣信息过期了哦</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
  
  <div class="clearfix"></div>
  
</article>




