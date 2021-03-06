<?php
global $conf;

$id = $vars[2];
$deal = Deal::findById($id);
$refill = isset($vars[3]);

    // get thumbnail width and height

    $width = 300;
    $height = 300;
    
    // create cache folder if not existed
    $deal_dir = $deal->getThumbnailFolder();
    if (!is_dir($deal_dir)) {_debug($deal->getThumbnailFolder());
      mkdir($deal_dir);
    }
    // create thumbnail file if not existed
    $thumbnail = $deal_dir . DS . 'deal_' . $deal->getId() . '_square.jpg';
    if (is_file($thumbnail)) {
      unlink($thumbnail);
    }

      loadLibraryWideImage();
      $image = WideImage::load($deal->getImage());
      if ($refill) {
        $image = $image->resize($width, $height, 'inside');
          $w = $image->getWidth();
          $h = $image->getHeight();
          $bg_color = $image->allocateColor(255, 255, 255);
          if ($w == $width) {
            $delta = ($height - $h) / 2;
            $image = $image->resizeCanvas($width, $height, 0, $delta, $bg_color);

          } else {
            $delta = ($width - $w) / 2;
            $image = $image->resizeCanvas($width, $height, $delta, 0, $bg_color);
          }
      } else {
        $image = $image->resize($width, $height, 'outside');
        if ($width == $image->getWidth()) {
          $delta = ($image->getHeight() - $height) / 2;
          $image = $image->crop(0, $delta, $width, $height);
        } else {
          $delta = ($image->getWidth() - $width) / 2;
          $image = $image->crop(0, 0, $width, $height);
        }
      }
      if (!$deal->getValid()) {
        $image = $image->applyFilter(IMG_FILTER_GRAYSCALE);
      }
      $image->saveToFile($thumbnail);

    HTML::forward(str_replace(WEBROOT, '', $thumbnail), true);