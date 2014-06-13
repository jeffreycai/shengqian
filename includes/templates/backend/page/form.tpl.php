<?php $page = $data->page; global $conf; ?>

<form class="form-horizontal" role="form" action="" method="post">
  <?php echo renderMsgs(); ?>
  <div class="form-group">
    <label for="title" class="col-sm-3 control-label">标题 <span>*</span></label>
    <div class="col-sm-9">
      <input id="title" type="text" class="form-control" placeholder="帖子标题" name="title" 
        <?php if (isset($_POST['title'])): ?>
             value="<?php echo $_POST['title'] ?>"
        <?php elseif ($page): ?>
             value="<?php echo $page->getTitle(); ?>"
        <?php endif; ?> required="" />
      
      <?php if ($page && $link = $page->getPageUrl()): ?>
      <a href="<?php echo $link; ?>" target="_blank">前端页面</a>
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group">
    <label for="slug" class="col-sm-3 control-label">Url slug <span>*</span></label>
    <div class="col-sm-9">
      <input id="title" type="text" class="form-control" placeholder="url字段，小写字母和中横线 -" name="slug" 
        <?php if (isset($_POST['slug'])): ?>
             value="<?php echo $_POST['slug'] ?>"
        <?php elseif ($page): ?>
             value="<?php echo $page->getSlug(); ?>"
        <?php endif; ?> required="" />
    </div>
  </div>
  <div class="form-group">
    <label for="content" class="col-sm-3 control-label">内容 <span>*</span></label>
    <div class="col-sm-9">
      <textarea id="content" class="form-control ckeditor" placeholder="页面的内容" name="content" required="" rows="15"><?php if (isset($_POST['content'])) { 
          echo $_POST['content'];
        } elseif ($page) {
          echo $page->getContent();
        }?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="order" class="col-sm-3 control-label">Order <span>*</span></label>
    <div class="col-sm-9">
      <input id="order" type="number" class="form-control" placeholder="页面的位置" name="order" 
        <?php if (isset($_POST['order'])): ?>
             value="<?php echo $_POST['order'] ?>"
        <?php elseif ($page): ?>
             value="<?php echo $page->getOrder(); ?>"
        <?php endif; ?> required="" />
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-9 col-sm-offset-3">
      <div class="checkbox">
        <label for="published">
          <input type="checkbox" name="published" value="1" id="published"
            <?php if (isset($_POST['published'])): ?>
              checked
            <?php elseif ($page && $page->getPublished()): ?>
              checked
            <?php endif; ?>
          /> Publish ?
        </label>
      </div>
    </div>
  </div>

  
  <?php if ($page): ?>
  <input name="id" type="hidden" value="<?php echo $page->getId(); ?>" />
  <input name="parent_id" type="hidden" value="<?php echo $page->getParentId(); ?>" />
  <?php endif; ?>
  

  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-default" value="submit" name="submit">
        <?php if ($page): ?>Update<?php else: ?>Create<?php endif; ?>
      </button>
    </div>
  </div>
</form>