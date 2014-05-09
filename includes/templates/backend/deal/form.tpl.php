<?php $deal = $data->deal; global $conf; ?>

<form class="form-horizontal" role="form" action="" method="post">
  <?php echo renderMsgs(); ?>
  <div class="form-group">
    <label for="title" class="col-sm-3 control-label">标题 <span>*</span></label>
    <div class="col-sm-9">
      <input id="title" type="text" class="form-control" placeholder="帖子标题" name="title" 
        <?php if (isset($_POST['title'])): ?>
             value="<?php echo $_POST['title'] ?>"
        <?php elseif ($deal): ?>
             value="<?php echo $deal->getTitle(); ?>"
        <?php endif; ?> required="" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label">类别</label>
    
    <?php foreach ($conf['category'] as $cat => $name): ?>
    <div class="radio col-sm-9 col-sm-offset-3">
      <label>
        <input type="radio" name="cid" value="<?php echo $cat; ?>" 
          <?php if (isset($_POST['cid']) && $_POST['cid'] == $cat): ?>
               checked
          <?php elseif ($deal && $deal->getCategory() == $cat): ?>
               checked
          <?php endif; ?> />
        <?php echo $name; ?>
      </label>
    </div>
    <?php endforeach; ?>
  </div>
  <div class="form-group">
    <label for="url" class="col-sm-3 control-label">源URL <span>*</span></label>
    <div class="col-sm-9">
      <input id="url" type="url" class="form-control" placeholder="折扣来源的URL" name="url" 
        <?php if (isset($_POST['url'])): ?>
             value="<?php echo $_POST['url'] ?>"
        <?php elseif ($deal): ?>
             value="<?php echo $deal->getUrl(); ?>"
        <?php endif; ?> required="" />
    </div>
  </div>
  <div class="form-group">
    <label for="coupon_code" class="col-sm-3 control-label">Coupon code</label>
    <div class="col-sm-9">
      <input id="coupon_code" type="text" class="form-control" placeholder="折扣码 Coupon code" name="coupon_code" 
        <?php if (isset($_POST['coupon_code'])): ?>
             value="<?php echo $_POST['coupon_code'] ?>"
        <?php elseif ($deal): ?>
             value="<?php echo $deal->getCouponCode(); ?>"
        <?php endif; ?> />
    </div>
  </div>
  <div class="form-group">
    <label for="details" class="col-sm-3 control-label">说明 <span>*</span></label>
    <div class="col-sm-9">
      <textarea id="details" class="form-control" placeholder="折扣的中文说明" name="details" required="" rows="15"><?php if (isset($_POST['details'])) { 
          echo $_POST['details'];
        } elseif ($deal) {
          echo $deal->getDetails();
        }?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="image" class="col-sm-3 control-label">图片 <span>*</span></label>
    <div class="col-sm-9">
      <input id="image" type="url" class="form-control" placeholder="图片" name="image" 
        <?php if (isset($_POST['image'])): ?>
             value="<?php echo $_POST['image'] ?>"
        <?php elseif ($deal): ?>
             value="<?php echo $deal->getImage(); ?>"
        <?php endif; ?> required="" />
    </div>
  </div>
  <div class="form-group">
    <label for="saving" class="col-sm-3 control-label">省</label>
    <div class="col-sm-9">
      <input id="saving" type="text" class="form-control" placeholder="省了多少？" name="saving" 
        <?php if (isset($_POST['saving'])): ?>
             value="<?php echo $_POST['saving'] ?>"
        <?php elseif ($deal): ?>
             value="<?php echo $deal->getSaving(); ?>"
        <?php endif; ?> />
    </div>
  </div>
  <div class="form-group">
    <label for="discount" class="col-sm-3 control-label">折扣</label>
    <div class="col-sm-9">
      <input id="discount" type="text" class="form-control" placeholder="折扣" name="discount" 
        <?php if (isset($_POST['discount'])): ?>
             value="<?php echo $_POST['discount'] ?>"
        <?php elseif ($deal): ?>
             value="<?php echo $deal->getDiscount(); ?>"
        <?php endif; ?> />
    </div>
  </div>
  <div class="form-group">
    <label for="due" class="col-sm-3 control-label">活动截止日期</label>
    <div class="col-sm-9">
      <input id="due" type="text" class="form-control datepicker" placeholder="活动截止日期(optional)" name="due" 
        <?php if (isset($_POST['due'])): ?>
             value="<?php echo $_POST['due'] ?>"
        <?php elseif ($deal): ?>
             value="<?php echo $deal->getDue(); ?>"
        <?php endif; ?> />
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-9 col-sm-offset-3">
      <div class="checkbox">
        <label for="published">
          <input type="checkbox" name="published" /> Publish ?
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-9 col-sm-offset-3">
      <div class="checkbox">
        <label for="promoted">
          <input type="checkbox" name="promoted" /> Promoted ?
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-9 col-sm-offset-3">
      <div class="checkbox">
        <label for="deleted">
          <input type="checkbox" name="promoted" /> Deleted ?
        </label>
      </div>
    </div>
  </div>
  
  <?php if ($deal): ?>
  <input name="id" type="hidden" value="<?php echo $deal->getId(); ?>" />
  <?php endif; ?>
  

  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-default" value="submit" name="submit">
        <?php if ($deal): ?>Update<?php else: ?>Create<?php endif; ?>
      </button>
    </div>
  </div>
</form>