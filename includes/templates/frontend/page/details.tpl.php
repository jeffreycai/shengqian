<?php 
global $conf;
$page = $data->page;
$html = new HTML();
?>


<article>
  <header class="col-xs-12">
    <h1><?php echo $page->getTitle(); ?></h1>
  </header>

  <div class="tn col-md-7 col-sm-12">
    <img class="img-responsive" src="<?php echo $page->getThumbnail($conf['deal']['thumbnail_size']); ?>" alt="<?php echo $page->getTitle(); ?>" />
    <br />
  </div>
  <div class="col-md-5 col-sm-12">
    <?php if ($summary = $page->getSummary()): ?>
      <?php echo $summary; ?>
    <?php endif; ?>
  </div>
  <div class="col-xs-12">

    <?php echo $page->getContent(); ?>
    
    <div class="divider dotted"></div>
    
    <?php if (!comeFromWechat()): ?>
      <div class="tell-friend"><br />
        <p>分享给小伙伴们！</p>
        <?php $html->renderOut('/components/sharebtns', array(
            'share_text' => "发现一个好东西：" . str_replace('"', '\"', $page->getTitle(true, 60)),
            'share_img' => $page->getImage()
        )); ?>
      </div>
    <?php endif; ?>

  </div>
  
  <div class="clearfix"></div>
  
</article>




