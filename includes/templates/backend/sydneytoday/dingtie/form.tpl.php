<?php $topic = $data->topic; ?>

<form class="form-horizontal" role="form" action="" method="post">
  <?php echo renderMsgs(); ?>
  <div class="form-group">
    <label for="url" class="col-sm-3 control-label">帖子地址</label>
    <div class="col-sm-9">
      <input id="url" type="url" class="form-control" placeholder="帖子地址" name="url" 
        <?php if (isset($_POST['url'])): ?>
           value="<?php echo $_POST['url'] ?>"
        <?php elseif ($topic): ?>
           value="http://www.sydneytoday.com/bencandy.php?fid=<?php echo $topic->getFid(); ?>&id=<?php echo $topic->getTid(); ?>"
        <?php endif; ?>
      required="" />
    </div>
  </div>
  <div class="form-group">
    <label for="title" class="col-sm-3 control-label">标题</label>
    <div class="col-sm-9">
      <input id="title" type="text" class="form-control" placeholder="帖子标题" name="title" 
        <?php if (isset($_POST['title'])): ?>
             value="<?php echo $_POST['title'] ?>"
        <?php elseif ($topic): ?>
             value="<?php echo $topic->getTitle(); ?>"
        <?php endif; ?> required="" />
    </div>
  </div>
  <?php if ($topic): ?>
  <input type="hidden" name="id" value="<?php echo $topic->getId(); ?>" />
  <?php endif; ?>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-default" value="submit" name="submit">
        <?php if ($topic): ?>Update<?php else: ?>Create<?php endif; ?>
      </button>
    </div>
  </div>
</form>