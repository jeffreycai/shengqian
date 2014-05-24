<?php global $conf; ?>

<div class="container body">
  <h2>折扣信息</h2>
  <h3>今日精选</h3>
  <div class="row">
    <?php foreach ($data->promoted_deals as $deal): ?>
      <div class="col-sm-6 col-md-4">
        <div class="card">
          <div class="row">
            <div class="col-xs-5 col-xs-push-7 col-sm-12 col-sm-push-0">
              <div class="tn">
                <img src="<?php echo $deal->getThumbnail($conf['deal']['thumbnail_size']) ?>" alt="<?php echo html_entity_decode($deal->getTitle()); ?>" />
              </div>
            </div>
            <div class="col-xs-7 col-xs-pull-5 col-sm-12 col-sm-pull-0">
              <h4><a href="<?php echo $deal->getPageUrl(false); ?>"><?php echo $deal->getTitle(); ?></a></h4>
            </div>
          </div>
          <div class="tags">
            <?php if ($deal->getSaving()): ?>
              <span class="label label-danger">省<?php echo $deal->getSaving(); ?></span>
            <?php endif; ?>
            <?php if ($deal->getDiscount()): ?>
              <span class="label label-warning"><?php echo $deal->getDiscount(); ?>折扣</span>
            <?php endif; ?>
            <span class="label label-primary"><?php echo $deal->getCategory(); ?></span>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <div class="col-xs-12">
      <ul class="pager">
        <li class="next"><a href="/deals/promoted">更多精选折扣 &RightArrow;</a></li>
      </ul>
    </div>
  </div>
  <h3>吃货省钱</h3>
  <div class="row">
    <?php foreach ($data->promoted_deals as $deal): ?>
      <div class="col-sm-6 col-md-4">
        <div class="card">
          <div class="row">
            <div class="col-xs-5 col-xs-push-7 col-sm-12 col-sm-push-0">
              <div class="tn">
                <img src="<?php echo $deal->getThumbnail($conf['deal']['thumbnail_size']) ?>" alt="<?php echo html_entity_decode($deal->getTitle()); ?>" />
              </div>
            </div>
            <div class="col-xs-7 col-xs-pull-5 col-sm-12 col-sm-pull-0">
              <h4><a href="<?php echo $deal->getPageUrl(false); ?>"><?php echo $deal->getTitle(); ?></a></h4>
            </div>
          </div>
          <div class="tags">
            <?php if ($deal->getSaving()): ?>
              <span class="label label-danger">省<?php echo $deal->getSaving(); ?></span>
            <?php endif; ?>
            <?php if ($deal->getDiscount()): ?>
              <span class="label label-warning"><?php echo $deal->getDiscount(); ?>折扣</span>
            <?php endif; ?>
            <span class="label label-primary"><?php echo $deal->getCategory(); ?></span>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <div class="col-xs-12">
      <ul class="pager">
        <li class="next"><a href="/deals/food">更多吃货折扣 &RightArrow;</a></li>
      </ul>
    </div>
  </div>
    
    
  
</div>