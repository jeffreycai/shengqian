<?php 
global $conf;
$deal = $data->deal;
$category = $deal->getCategory();
?>


<article>

  <div class="tn col-md-6">
    <img src="<?php echo $deal->getThumbnail($conf['deal']['thumbnail_size']); ?>" alt="<?php echo $deal->getTitle(); ?>" />
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
  </div>
  
  <div class="clearfix"></div>
  
</article>




