<form class="form-horizontal" role="form" action="" method="post">
  <?php echo renderMsgs(); ?>
  <div class="form-group">
    <label for="url" class="col-sm-3 control-label">帖子地址</label>
    <div class="col-sm-9">
      <input id="url" type="url" class="form-control" placeholder="帖子地址" name="url" <?php if (isset($_POST['url'])): ?>value="<?php echo $_POST['url'] ?>"<?php endif; ?> required="" />
    </div>
  </div>
  <div class="form-group">
    <label for="title" class="col-sm-3 control-label">标题</label>
    <div class="col-sm-9">
      <input id="title" type="text" class="form-control" placeholder="帖子标题" name="title" <?php if (isset($_POST['title'])): ?>value="<?php echo $_POST['title'] ?>"<?php endif; ?> required="" />
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-default" value="submit" name="submit">Create</button>
    </div>
  </div>
</form>