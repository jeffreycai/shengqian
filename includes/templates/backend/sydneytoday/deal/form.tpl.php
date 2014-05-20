<?php $deal = $data->deal; ?>

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
    <label for="groupon_link" class="col-sm-3 control-label">Groupon活动页面 <span>*</span></label>
    <div class="col-sm-9">
      <input id="groupon_link" type="url" class="form-control" placeholder="Groupon活动页面" name="groupon_link" 
        <?php if (isset($_POST['groupon_link'])): ?>
             value="<?php echo $_POST['groupon_link'] ?>"
        <?php elseif($deal): ?>
             value="<?php echo $deal->getGrouponLink(); ?>"
        <?php endif; ?> required="" />
    </div>
  </div>
  <div class="form-group">
    <label for="contact" class="col-sm-3 control-label">联系人 <span>*</span></label>
    <div class="col-sm-9">
      <input id="contact" type="text" class="form-control" placeholder="联系人姓名(optional)" name="contact" 
        <?php if (isset($_POST['contact'])): ?>
             value="<?php echo $_POST['contact'] ?>"
        <?php elseif ($deal): ?>
             value="<?php echo $deal->getContact(); ?>"
        <?php endif; ?> required="" />
    </div>
  </div>
  <div class="form-group">
    <label for="contact" class="col-sm-3 control-label">活动截止日期</label>
    <div class="col-sm-9">
      <input id="due_date" type="text" class="form-control datepicker" placeholder="活动截止日期(optional)" name="due_date" 
        <?php if (isset($_POST['due_date'])): ?>
             value="<?php echo $_POST['due_date'] ?>"
        <?php elseif ($deal): ?>
             value="<?php echo $deal->getDueDate(); ?>"
        <?php endif; ?> />
    </div>
  </div>
  <div class="form-group">
    <label for="image" class="col-sm-3 control-label">折扣</label>
    <div class="col-sm-9">
      <input id="image" type="text" class="form-control" placeholder="帖子标题" name="discount" 
        <?php if (isset($_POST['discount'])): ?>
             value="<?php echo $_POST['discount'] ?>"
        <?php elseif ($deal): ?>
             value="<?php echo $deal->getDiscount(); ?>"
        <?php endif; ?> />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label">类别</label>
    <div class="radio col-sm-9">
      <label>
        <input type="radio" name="type" value="<?php echo SydneytodayDeal::TYPE_FREE ?>" 
          <?php if (isset($_POST['type']) && $_POST['type'] == SydneytodayDeal::TYPE_FREE): ?>
               checked
          <?php elseif ($deal && $deal->getType() == SydneytodayDeal::TYPE_FREE): ?>
               checked
          <?php endif; ?> />
        免费 / Sample
      </label>
    </div>
    <div class="radio col-sm-9 col-sm-offset-3">
      <label>
        <input type="radio" name="type" value="<?php echo SydneytodayDeal::TYPE_FASHION ?>" 
          <?php if (isset($_POST['type']) && $_POST['type'] == SydneytodayDeal::TYPE_FASHION): ?>
               checked
          <?php elseif ($deal && $deal->getType() == SydneytodayDeal::TYPE_FASHION): ?>
               checked
          <?php endif; ?> />
        时尚 / 美妆
      </label>
    </div>
    <div class="radio col-sm-9 col-sm-offset-3">
      <label>
        <input type="radio" name="type" value="<?php echo SydneytodayDeal::TYPE_FOOD ?>" 
          <?php if (isset($_POST['type']) && $_POST['type'] == SydneytodayDeal::TYPE_FOOD): ?>
               checked
          <?php elseif ($deal && $deal->getType() == SydneytodayDeal::TYPE_FOOD): ?>
               checked
          <?php endif; ?> />
        美食 / 旅游
      </label>
    </div>
    <div class="radio col-sm-9 col-sm-offset-3">
      <label>
        <input type="radio" name="type" value="<?php echo SydneytodayDeal::TYPE_TECH ?>" 
          <?php if (isset($_POST['type']) && $_POST['type'] == SydneytodayDeal::TYPE_TECH): ?>
               checked
          <?php elseif ($deal && $deal->getType() == SydneytodayDeal::TYPE_TECH): ?>
               checked
          <?php endif; ?> />
        电子 / 科技
      </label>
    </div>
    <div class="radio col-sm-9 col-sm-offset-3">
      <label>
        <input type="radio" name="type" value="<?php echo SydneytodayDeal::TYPE_OTHER ?>" 
          <?php if (  (isset($_POST['type']) && $_POST['type'] == SydneytodayDeal::TYPE_OTHER)): ?>
               checked
          <?php elseif ($deal && $deal->getType() == SydneytodayDeal::TYPE_OTHER): ?>
               checked
          <?php elseif (!$deal && !isset($_POST['type'])): ?>
               checked
          <?php endif; ?> />
        其他
      </label>
    </div>
  </div>
  <div class="form-group">
    <label for="hoster" class="col-sm-3 control-label">主办方</label>
    <div class="col-sm-9">
      <input id="hoster" type="text" class="form-control" placeholder="活动主办方(optional)" name="hoster" 
        <?php if (isset($_POST['hoster'])): ?>
             value="<?php echo $_POST['hoster']; ?>"
        <?php elseif ($deal): ?>
             value="<?php echo $deal->getHoster(); ?>"
        <?php endif; ?> />
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-9 col-sm-offset-3">
      <div class="checkbox">
        <label for="valid">
          <input type="checkbox" name="valid" value="1" id="valid"
            <?php if (isset($_POST['valid'])): ?>
              checked
            <?php elseif ($deal && $deal->getValid()): ?>
              checked
            <?php endif; ?>
          /> Valid ?
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-9 col-sm-offset-3">
      <div class="checkbox">
        <label for="deleted">
          <input type="checkbox" name="deleted" value="1" id="deleted"
            <?php if (isset($_POST['deleted'])): ?>
              checked
            <?php elseif ($deal && $deal->getDeleted()): ?>
              checked
            <?php endif; ?>
          /> Deleted ?
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