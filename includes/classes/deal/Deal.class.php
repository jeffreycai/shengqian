<?php
require_once CLASS_DIR . DS . 'DBObject.class.php';

/**
 * DB fields for Deal:
 * - id
 * - cid
 * - title
 * - slug
 * - url
 * - coupon_code
 * - details
 * - image
 * - saving
 * - discount
 * - published
 * - created_at
 * - deleted
 * - promoted
 * - hoster
 * - due
 */
class Deal extends DBObject {
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
    $this->table_name = 'deal';
  }
  
  /** ---------------------------------
   * Setters and getters for DB fields
    ----------------------------------*/
  public function setId($id) {
    $this->setDbFieldId($id);
  }
  public function getId() {
    return $this->getDbFieldId();
  }
  public function setCid($cid) {
    $this->setDbFieldCid($cid);
  }
  public function getCid() {
    return $this->getDbFieldCid();
  }
  public function setTitle($title) {
    $this->setDbFieldTitle($title);
  }
  public function getTitle($short = false, $length = 20) {
    $title = $this->getDbFieldTitle();
    if ($short && mb_strlen($title) > $length) {
      $title = mb_substr($title, 0, $length, "utf-8") . ' ...';
    }
    return $title;
  }
  public function setSlug($s) {
    $this->setDbFieldSlug($s);
  }
  public function getSlug() {
    return $this->getDbFieldSlug();
  }
  public function setUrl($url) {
    $this->setDbFieldUrl($url);
  }
  public function getUrl() {
    return $this->getDbFieldUrl();
  }
  public function setCouponCode($cc) {
    $this->setDbFieldCoupon_code($cc);
  }
  public function getCouponCode() {
    return $this->getDbFieldCoupon_code();
  }
  public function setDetails($d) {
    $this->setDbFieldDetails($d);
  }
  public function getDetails() {
    return $this->getDbFieldDetails();
  }
  public function setImage($i) {
    $this->setDbFieldImage($i);
  }
  public function getImage() {
    return $this->getDbFieldImage();
  }
  public function setSaving($s) {
    $this->setDbFieldSaving($s);
  }
  public function getSaving() {
    return $this->getDbFieldSaving();
  }
  public function setDiscount($d) {
    $this->setDbFieldDiscount($d);
  }
  public function getDiscount() {
    return $this->getDbFieldDiscount();
  }
  public function setHoster($h) {
    $this->setDbFieldHoster($h);
  }
  public function getHoster() {
    return $this->getDbFieldHoster();
  }
  public function setDue($d) {
    $this->setDbFieldDue($d);
  }
  public function getDue() {
    return $this->getDbFieldDue();
  }
  public function setPublished($pa) {
    $this->setDbFieldPublished($pa);
  }
  public function getPublished() {
    return $this->getDbFieldPublished();
  }
  public function setCreatedAt($ca) {
    $this->setDbFieldCreated_at($ca);
  }
  public function getCreatedAt() {
    return $this->getDbFieldCreated_at();
  }
  public function setDeleted($d) {
    $this->setDbFieldDeleted($d);
  }
  public function getDeleted() {
    return $this->getDbFieldDeleted();
  }
  public function setPromoted($p) {
    $this->setDbFieldPromoted($p);
  }
  public function getPromoted() {
    return $this->getDbFieldPromoted();
  }
  
  /** ---------------------
   * Self defined functions
   ------------------------*/
  private $category;
  
  static function findById($id) {
    global $mysqli;
    $result = $mysqli->query('SELECT * FROM `deal` WHERE id=' . $id);
    if ($result && $t = $result->fetch_object()) {
      $deal = new Deal();
      DBObject::importQueryResultToDbObject($t, $deal);
      return $deal;
    }
  }
  
  static function findAllPromoted($limit = 0) {
    global $mysqli;
    $rtn = array();
    $query = "SELECT * FROM deal WHERE promoted=1 AND published=1";
    if ($limit) {
      $query .= " LIMIT $limit";
    }
    $result = $mysqli->query($query);
    while ($d = $result->fetch_object()) {
      $deal = new Deal();
      Deal::importQueryResultToDbObject($d, $deal);
      $rtn[] = $deal;
    }
    return $rtn;
  }
  
  static function findAllByCategory($cat, $limit = 0) {
    global $mysqli;
    $rtn = array();
    
    $query = "SELECT * FROM deal WHERE cid=" . DBObject::prepare_val_for_sql($cat) ." AND published=1";
    if ($limit) {
      $query .= " LIMIT $limit";
    }
    $result = $mysqli->query($query);
    
    while ($d = $result->fetch_object()) {
      $deal = new Deal();
      Deal::importQueryResultToDbObject($d, $deal);
      $rtn[] = $deal;
    }
    return $rtn;
  }
  
  static function findBySlug($slug, $cid, $id) {
    global $mysqli;
    $query = "SELECT * FROM deal WHERE slug=" . DBObject::prepare_val_for_sql($slug);
    if ($cid) {
      $query .= " AND cid=" . DBObject::prepare_val_for_sql($cid);
    }
    if ($id) {
      $query .= " AND id!=" . DBObject::prepare_val_for_sql($id);
    }
    $result = $mysqli->query($query);
    $rtn = null;
    if ($result && $record = $result->fetch_object()) {
      $deal = new Deal();
      Deal::importQueryResultToDbObject($record, $deal);
      $rtn = $deal;
    }
    return $rtn;
  }
  
  public function setCategory(Category $category) {
    $this->category = $category;
    $this->setCid($category->getId());
  }
  
  public function getCategory() {
    if (!isset($this->category)) {
      $this->setCategory(Category::findById($this->getCid()));
    }
    return $this->category;
  }
  
  public function getDueDate($format = 'Y-m-d') {
    if ($this->getDue()) {
      return date($format, $this->getDue());
    }
    return 'N/A';
  }
  
  public function getCreatedAtDate($format = 'Y-m-d') {
    return date($format, $this->getCreatedAt());
  }
  
  public function isNew() {
    if ($this->getDbFieldId()) {
      return false;
    }
    return true;
  }
  
  private function getThumbnailFolder() {
    return CACHE_DIR . DS . 'deal';
  }
  
  private function makeThumbnailFilename() {
    return 'deal_' . $this->getId() . '.jpg';
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
    $deal_dir = $this->getThumbnailFolder();
    if (!is_dir($deal_dir)) {
      mkdir($deal_dir);
    }
    // create thumbnail file if not existed
    $thumbnail = $deal_dir . DS . $this->makeThumbnailFilename();
    if (!is_file($thumbnail)) {
      loadLibraryWideImage();
      $image = WideImage::load($this->getImage());
      $image = $image->resize($width, $height);
      if ($refill) {
        $w = $image->getWidth();
        $h = $image->getHeight();
        $bg_color = $image->allocateColor(0, 0, 0);
        if ($w == $width) {
          $delta = ($height - $h) / 2;
          $image = $image->resizeCanvas($width, $height, 0, $delta, $bg_color);

        } else {
          $delta = ($width - $w) / 2;
          $image = $image->resizeCanvas($width, $height, $delta, 0, $bg_color);
        }
      }
      $image->saveToFile($thumbnail);
    }
    return str_replace(WEBROOT, '', $thumbnail);
  }
  
  public function getPageUrl() {
    global $conf;
    $cats = array_flip($conf['category']);
    return "/deal/" . $cats[$this->getCategory()->getName()] . "/" . $this->getId();
  }
  
  public function getGrouponLinkNaked() {
    if (preg_match('/^https:\/\/t\.groupon\.com\.au/', $this->getUrl())) {
      $url = $this->getUrl();
      $matches = array();
      preg_match('/url=([^&]+)/', $url, $matches);
      if (isset($matches[1])) {
        $tokens = explode('?', urldecode($matches[1]));
        return $tokens[0];
      }
    }
  }
}

?>
