<?php
require_once CLASS_DIR . DS . 'DBObject.class.php';

/**
 * DB fields:
 * - id
 * - title
 * - contact
 * - hoster
 * - type
 * - groupon_link
 * - details
 * - image
 * - deleted
 * - last_published
 */
class SydneytodayDeal extends DBObject {
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
    $this->table_name = 'sydneytoday_deal';
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
  public function setTitle($t) {
    $this->setDbFieldTitle($t);
  }
  public function getTitle($limit = null) {
    $title = $this->getDbFieldTitle();
    if ($limit != null && mb_strlen($title) > $limit) {
      $title = mb_substr($title, 0, $limit, "utf-8") . ' ...';
    }
    return $title;
  }
  public function setContact($c) {
    $this->setDbFieldContact($c);
  }
  public function getContact() {
    return $this->getDbFieldContact();
  }
  public function setHoster($h) {
    $this->setDbFieldHoster($h);
  }
  public function getHoster() {
    return $this->getDbFieldHoster();
  }
  public function setType($t) {
    $this->setDbFieldType($t);
  }
  public function getType() {
    return $this->getDbFieldType();
  }
  public function setGrouponLink($l) {
    $this->setDbFieldGroupon_link($l);
  }
  public function getGrouponLink() {
    return $this->getDbFieldGroupon_link();
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
  public function setDeleted($d) {
    $this->setDbFieldDeleted($d);
  }
  public function getDeleted() {
    return $this->getDbFieldDeleted();
  }
  public function setLastPublished($lp) {
    $this->setDbFieldLast_published($lp);
  }
  public function getLastPublished() {
    $lp = $this->getDbFieldLast_published();
    return is_null($lp) ? 'N/A' : date('Y-m-d H:i:s', $lp);
  }
  
  /** ---------------------
   * Self defined functions
   ------------------------*/
  const TYPE_FREE = 1;
  const TYPE_FASHION = 2;
  const TYPE_FOOD = 3;
  const TYPE_TECH = 4;
  const TYPE_OTHER = 5;
  
  static function findById($id) {
    global $mysqli;
    $result = $mysqli->query('SELECT * FROM `sydneytoday_deal` WHERE id=' . $id);
    if ($t = $result->fetch_object()) {
      $deal = new SydneytodayDeal();
      DBObject::importQueryResultToDbObject($t, $deal);
      return $deal;
    }
  }
}

?>
