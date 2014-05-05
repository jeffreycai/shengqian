<?php
require_once CLASS_DIR . DS . 'DBObject.class.php';

/**
 * DB fields for Topic:
 * - fid
 * - tid
 * - title
 * - last_replied
 * - deleted
 */
class Topic extends DBObject {
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
    $this->table_name = 'topic';
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
  public function setFid($fid) {
    $this->setDbFieldFid($fid);
  }
  public function getFid() {
    return $this->getDbFieldFid();
  }
  public function setTid($tid) {
    $this->setDbFieldTid($tid);
  }
  public function getTid() {
    return $this->getDbFieldTid();
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
  public function setLastReplied($lr) {
    $this->setDbFieldLast_replied($lr);
  }
  public function getLastReplied() {
    $lr = $this->getDbFieldLast_replied();
    return is_null($lr) ? 'N/A' : date('Y-m-d H:i:s', $lr);
  }
  public function setDeleted($d) {
    $this->setDbFieldDeleted($d);
  }
  public function getDeleted() {
    return $this->getDbFieldDeleted();
  }
  
  /** ---------------------
   * Self defined functions
   ------------------------*/
  static function findById($id) {
    global $mysqli;
    $result = $mysqli->query('SELECT * FROM `topic` WHERE id=' . $id);
    if ($t = $result->fetch_object()) {
      $topic = new Topic();
      DBObject::importQueryResultToDbObject($t, $topic);
      return $topic;
    }
  }
}

?>
