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
 * - discount
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
  public function getLastPublished($time_ago = false) {
    $lp = $this->getDbFieldLast_published();
    if (is_null($lp)) {
      return 'N/A';
    } elseif ($time_ago) {
      return time_ago($lp);
    } else {
      return date('Y-m-d H:i:s', $lp);
    }
  }
  public function setDiscount($d) {
    $this->setDbFieldDiscount($d);
  }
  public function getDiscount() {
    return $this->getDbFieldDiscount();
  }
  public function setDueDate($dd) {
    $this->setDbFieldDue_date($dd);
  }
  public function getDueDate() {
    return $this->getDbFieldDue_date();
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
  
  /**
   * get all instances
   * 
   * @global type $mysqli
   * @return type
   */
  public function getInstances($order_by = 'created_at', $sort = 'DESC') {
    global $mysqli;

    $instances = array();
    $query = 'SELECT * FROM sydneytoday_deal_instance WHERE did=' . $this->getId() . ' ORDER BY ' . $order_by . ' ' . $sort;
    $result = $mysqli->query($query);
    while ($record = $result->fetch_object()) {
      $instance = new SydneytodayDealInstance();
      SydneytodayDealInstance::importQueryResultToDbObject($record, $instance);
      $instances[] = $instance;
    }
    return $instances;
  }
  
  public function getTrackingPageLink() {
    global $conf;
    return $conf['tracking_site_url'] . '/deal/' . $this->getId() . '/tracking';
  }
  
  public function getGrouponLinkNaked() {
    $url = $this->getGrouponLink();
    $matches = array();
    preg_match('/url=([^&]+)/', $url, $matches);
    if (isset($matches[1])) {
      $tokens = explode('?', urldecode($matches[1]));
      return $tokens[0];
    } else {
      return $url;
    }
  }
}

?>
