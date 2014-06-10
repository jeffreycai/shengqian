<form class="form-horizontal" role="form" action="" method="post">
  <?php echo renderMsgs(); ?>
  <div class="form-group">
    <label for="ids" class="col-sm-3 control-label">折扣ID <span>*</span></label>
    <div class="col-sm-9">
      <input id="ids" type="text" class="form-control" placeholder="Deal IDs" name="ids" 
        <?php if (isset($_POST['ids'])): ?>
             value="<?php echo $_POST['ids'] ?>"
        <?php endif; ?> required="" />
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-default" value="submit" name="submit">
        发布
      </button>
    </div>
  </div>
</form>

<ul>
<?php foreach (Deal::findAllValid(20) as $deal): ?>
  <li><strong><?php echo $deal->getId(); ?></strong> - <?php echo $deal->getTitle(); ?></li>
<?php endforeach; ?>
</ul>
