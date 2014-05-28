<?php
$category = $data->category;
$cid = $data->cid;

$img = $category ? $category->getId() : $cid;
?>

<div class="branding">
  <img src="/images/<?php echo $img ?>.jpg" width="100%" />
</div>