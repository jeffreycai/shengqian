<?php global $conf; ?>

<div class="container body">
  <h2>省钱折扣</h2>
  <h3>今日精选</h3>
  <div class="row">
    <?php foreach (Deal::findAllPromoted(6) as $deal): ?>
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
        <li class="next"><a href="/deals/promoted">更多精选 &RightArrow;</a></li>
      </ul>
    </div>
  </div>
  <h3>美食折扣 - 吃货省钱</h3>
  <div class="row">
    <?php foreach (Deal::findAllByCategory('food', 12) as $deal): ?>
      <div class="col-sm-4 col-md-3">
        <div class="card">
          <div class="row">
            <div class="col-xs-5 col-xs-push-7 col-sm-12 col-sm-push-0">
              <div class="tn">
                <img class="img-responsive" src="<?php echo $deal->getThumbnail($conf['deal']['thumbnail_size']) ?>" alt="<?php echo html_entity_decode($deal->getTitle()); ?>" />
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
        <li class="next"><a href="/deals/food">更多美食折扣 &RightArrow;</a></li>
      </ul>
    </div>
  </div>
    
  <h3>商品折扣 - 购物狂省钱</h3>
  <div class="row">
    <?php foreach (Deal::findAllByCategory('goods', 12) as $deal): ?>
      <div class="col-sm-4 col-md-3">
        <div class="card">
          <div class="row">
            <div class="col-xs-5 col-xs-push-7 col-sm-12 col-sm-push-0">
              <div class="tn">
                <img class="img-responsive" src="<?php echo $deal->getThumbnail($conf['deal']['thumbnail_size']) ?>" alt="<?php echo html_entity_decode($deal->getTitle()); ?>" />
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
        <li class="next"><a href="/deals/goods">更多商品折扣 &RightArrow;</a></li>
      </ul>
    </div>
  </div>
  
  <h3>旅游折扣 - 驴友省钱</h3>
  <div class="row">
    <?php foreach (Deal::findAllByCategory('travel', 12) as $deal): ?>
      <div class="col-sm-4 col-md-3">
        <div class="card">
          <div class="row">
            <div class="col-xs-5 col-xs-push-7 col-sm-12 col-sm-push-0">
              <div class="tn">
                <img class="img-responsive" src="<?php echo $deal->getThumbnail($conf['deal']['thumbnail_size']) ?>" alt="<?php echo html_entity_decode($deal->getTitle()); ?>" />
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
        <li class="next"><a href="/deals/travel">更多旅游折扣 &RightArrow;</a></li>
      </ul>
    </div>
  </div>
  
  <h3>活动折扣 - 玩货省钱</h3>
  <div class="row">
    <?php foreach (Deal::findAllByCategory('event', 12) as $deal): ?>
      <div class="col-sm-4 col-md-3">
        <div class="card">
          <div class="row">
            <div class="col-xs-5 col-xs-push-7 col-sm-12 col-sm-push-0">
              <div class="tn">
                <img class="img-responsive" src="<?php echo $deal->getThumbnail($conf['deal']['thumbnail_size']) ?>" alt="<?php echo html_entity_decode($deal->getTitle()); ?>" />
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
        <li class="next"><a href="/deals/event">更多活动折扣 &RightArrow;</a></li>
      </ul>
    </div>
  </div>
  
</div>