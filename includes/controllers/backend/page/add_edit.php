<?php
//-- if this is a submit action, create the record
$page = null;
if (isset($_POST['submit'])) {
  $id = isset($_POST['id']) ? $_POST['id'] : null;
  $title = isset($_POST['title']) ? strip_tags($_POST['title']) : null;
  $slug = isset($_POST['slug']) ? strip_tags(trim($_POST['slug'])) : null;
  $content = isset($_POST['content']) ? $_POST['content'] : null;
  $summary = isset($_POST['summary']) ? $_POST['summary'] : null;
  $image = isset($_POST['image']) ? $_POST['image'] : null;
  $parent_id = isset($_POST['parent_id']) ? strip_tags($_POST['parent_id']) : null;
  $published = isset($_POST['published']) ? strip_tags($_POST['published']) : null;
  $order = isset($_POST['order']) ? strip_tags($_POST['order']) : 0;
  
  
  // TODO - validation
  if (!empty($slug) && preg_match('/[^a-z\-0-9]/', $slug)) {
    setMsg(MSG_ERROR, 'slug 只能是小写或者数字');
  } elseif(Page::findBySlug($slug, true, $id)) { 
    setMsg(MSG_ERROR, '同样的slug已经有了，换个吧');
  } else {
  
    // create / update page
    $page = new Page();
    if ($id) {
      $page->setId(intval($id));
    }
    if (!empty($title)) $page->setTitle($title);
    if (!empty($slug)) $page->setSlug($slug);
    if (!empty($content)) $page->setContent($content);
    if (!empty($summary)) $page->setSummary ($summary);
    if (!empty($image)) $page->setImage ($image);
    if (!empty($parent_id)) $page->setParentId ($parent_id);
    if (!empty($published)) $page->setPublished($published); else $page->setPublished (0);
    if (!empty($order)) $page->setOrder ($order);

    if ($page->isNew()) {
      $page->setCreatedAt(time());
    }
    $page->save();
    if ($id) {
      setMsg(MSG_SUCCESS, '网页更新成功！');
    } else {
      setMsg(MSG_SUCCESS, '网页创建成功！');
    }
    HTML::forwardBackToReferer();
    
    
  }

} else {
  $id = isset($vars[1]) ? $vars[1] : null;
  $html = new HTML();
  if ($id) {
    $page = Page::findById($id);
  }
}

//-- otherwise, show the create form
$html = new HTML();

echo $html->render('backend/html_header', array('title' => 'Create a Page'));
echo $html->render('backend/header');

?>

<div class="main">
  <?php $html->renderOut('backend/page/nav'); ?>
  <h2 class='sub-header'>
    <?php if ($page): ?>
    编辑网页信息："<?php echo $page->getTitle(20); ?>";
    <?php else: ?>
    创建一个新的网页信息
    <?php endif; ?>
  </h2>
  <?php echo $html->render('backend/page/form', array('page' => $page)); ?>
</div>

<?php

echo $html->render('backend/footer');
echo $html->render('backend/html_footer');

