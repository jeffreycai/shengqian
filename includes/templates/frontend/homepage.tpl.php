<?php global $conf; ?>

<div class="container body">
  <h2>折扣信息</h2>
  <h3>今日折扣精选</h3>
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
              <h4><?php echo $deal->getTitle(); ?></h4>
            </div>
          </div>
        </div>
        <?php echo $deal->getDketails(); ?>
      </div>
    <?php endforeach; ?>
  </div>
  <h3>美食折扣</h3>

    
    
    
  
</div>