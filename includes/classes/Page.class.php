<?php
require_once CLASS_DIR . DS . 'DBObject.class.php';

/**
 * DB fields for Page:
 * - id
 * - title
 * - slug
 * - content
 * - summary
 * - parent_id
 * - created_at
 * - published
 * - order
 */
class Page extends DBObject {
  /**
   * Implement parent abstract functions
   */
  protected function setPrimaryKeyName() {
    $this->primary_key = array(
      'id'
    );
  }
  protected function setPrimaryKeyAutoIncreased() {
    $this->pk_auto_increased = true;
  }
  protected function setTableName() {
    $this->table_name = 'page';
  }
  
  /** ---------------------------------
   * Setters and getters for DB fields
    ----------------------------------*/
  public function setId($id) {
    $this->setDBFieldId($id);
  }
  public function getId() {
    return $this->getDbFieldId();
  }
  public function setTitle($t) {
    $this->setDBFieldTitle($t);
  }
  public function getTitle() {
    return $this->getDbFieldTitle();
  }
  public function setSlug($s) {
    $this->setDBFieldSlug($s);
  }
  public function getSlug() {
    return $this->getDbFieldSlug();
  }
  public function setContent($c) {
    $this->setDBFieldContent($c);
  }
  public function getContent() {
    return $this->getDbFieldContent();
  }
  public function setSummary($s) {
    $this->setDBFieldSummary($s);
  }
  public function getSummary() {
    return $this->getDbFieldSummary();
  }
  public function setImage($i) {
    $this->setDBFieldImage($i);
  }
  public function getImage() {
    return $this->getDbFieldImage();
  }
  public function setParentId($id) {
    $this->setDBFieldParent_id($id);
  }
  public function getParentId() {
    return $this->getDbFieldParent_id();
  }
  public function setCreatedAt($time) {
    $this->setDBFieldCreated_at($time);
  }
  public function getCreatedAt() {
    return $this->getDbFieldCreated_at();
  }
  public function setPublished($pa) {
    $this->setDbFieldPublished($pa);
  }
  public function getPublished() {
    return $this->getDbFieldPublished();
  }
  public function setOrder($o) {
    $this->setDBField($o);
  }
  public function getOrder() {
    return $this->getDbFieldOrder();
  }
  
  /** ---------------------
   * Self defined functions
   ------------------------*/
  static function findById($id) {
    global $mysqli;
    $result = $mysqli->query('SELECT * FROM `page` WHERE id=' . $id);
    if ($result && $t = $result->fetch_object()) {
      $page = new Page();
      DBObject::importQueryResultToDbObject($t, $page);
      return $page;
    }
    return null;
  }
  
  static function findBySlug($slug, $publshed = true, $exclude_id=null) {
    global $mysqli;
    $query = "SELECT * FROM page WHERE slug=" . DBObject::prepare_val_for_sql($slug);
    if ($exclude_id) {
      $query .= " AND id!=" . $exclude_id;
    }
    if ($publshed) {
      $query .= " AND published=1";
    }
    $result = $mysqli->query($query);
    if ($result && $record = $result->fetch_object()) {
      $page = new Page();
      Page::importQueryResultToDbObject($record, $page);
      return $page;
    }
    return null;
  }
  
  public function getParent() {
    return self::findById($this->getParentId());
  }
  
  public function getParents() {
    $parents = array();
    while ($parent = $this->getParent()) {
      $parents[] = $parent;
    }
    return $parents;
  }

  public function getChildrenPages() {
    global $mysqli;
    $result = $mysqli->query('SELECT * FROM `page` WHERE parent_id=' . $this->getId() . ' AND published=1 ORDER BY order ASC');
    $children = array();
    if ($result && $t = $result->fetch_object()) {
      $page = new Page();
      DBObject::importQueryResultToDbObject($t, $page);
      $children[] = $page;
    }
    return $children;
  }
  
  public function getPageUrl($absolute = false) {
    global $conf;
    
    $url = "";
    $page = $this;
    while ($parent = $page->getParent()) {
      $url = $parent->getSlug() . "/" . $url;
      $page = $parent;
    }
    $url = "/" . $url . $this->getSlug();
    if ($absolute) {
      $url = $conf['site_url'] . $url;
    }
    return $url;
  }
  
  public function isNew() {
    if ($this->getDbFieldId()) {
      return false;
    }
    return true;
  }
  
  public function getThumbnailFolder() {
    return CACHE_DIR . DS . 'page';
  }
  
  private function makeThumbnailFilename() {
    return 'page_' . $this->getId() . '.jpg';
  }
  
  public function getThumbnail($size, $refill=true) {
    // get thumbnail width and height
    $matches = array();
    if (!preg_match('/^(\d+)x(\d+)$/i', $size, $matches)) {
      throw new Exception('Thumbnail file size provided not correct.');
      return null;
    }
    $width = intval($matches[1]);
    $height = intval($matches[2]);
    
    global $conf;
    // create cache folder if not existed
    $page_dir = $this->getThumbnailFolder();
    if (!is_dir($page_dir)) {
      mkdir($page_dir);
    }
    // create thumbnail file if not existed
    $thumbnail = $page_dir . DS . $this->makeThumbnailFilename();
    if (!is_file($thumbnail)) {
      loadLibraryWideImage();
      $image = WideImage::load($this->getImage());
      $image = $image->resize($width, $height);
      if ($refill) {
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
      }
//      if (!$this->getValid()) {
//        $image = $image->applyFilter(IMG_FILTER_GRAYSCALE);
//      }
      $image->saveToFile($thumbnail);
    }
    return str_replace(WEBROOT, '', $thumbnail);
  }
}