<?php global $conf; ?>

<div class="container">
  <div class="card-title">
    <h2>折扣信息</h2>
    <h3>今日精选折扣</h3>
    <div class="row">
      <?php foreach ($data->promoted_deals as $deal): ?>
      <div class="col-sm-6 col-md-4">
        <img width="120px" src="<?php echo $deal->getThumbnail($conf['deal']['thumbnail_size']) ?>" alt="<?php echo html_entity_decode($deal->getTitle()); ?>" />
        <h4><?php echo $deal->getTitle(); ?></h4>
        <?php echo $deal->getDetails(); ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  
</div>