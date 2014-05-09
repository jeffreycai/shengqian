<?php
require_once CLASS_DIR . DS . 'DBObject.class.php';

/**
 * DB fields for Deal:
 * - id
 * - cid
 * - title
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
    if ($t = $result->fetch_object()) {
      $deal = new Deal();
      DBObject::importQueryResultToDbObject($t, $deal);
      return $deal;
    }
  }
  
  public function setCategory(Category $category) {
    $this->category = $category;
    $this->setCid($category->getId());
  }
  
  public function getCategory() {
    return $this->category;
  }
}

?>
