<?php
require_once CLASS_DIR . DS . 'DBObject.class.php';

/**
 * DB fields:
 * - id
 * - created_at
 * - did
 */
class SydneytodayDealInstance extends DBObject {
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
    $this->table_name = 'sydneytoday_deal_instance';
  }
  
  /** ---------------------------------
   * Setters and getters for DB fields
    ----------------------------------*/
  static function sendInvalidReport(Array $deals) {
    if (sizeof($deals) == 0) {
      return;
    }
    
    global $conf;
    $to = $conf['site_admin_email'];
    $subject = 'Invalid deals detected.';
    $message = '';
    foreach ($deals as $deal) {
      $message .= $deal->getId() . ' - ' . $deal->getTitle() . "\r\n";
    }
    $headers = 'From: jeffreycai-sydney@hotmail.com' . "\r\n" .
    'Reply-To: jeffreycai-sydney@hotmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    mail($to, $subject, $message, $headers);
  }
  
  public function setId($id) {
    $this->setDbFieldId($id);
  }
  public function getId() {
    return $this->getDbFieldId();
  }
  public function setCreatedAt($timestamp) {
    $this->setDbFieldCreated_at($timestamp);
  }
  public function getCreatedAt($time_ago = false) {
    $ca = $this->getDbFieldCreated_at();
    if (is_null($ca)) {
      return 'N/A';
    } elseif ($time_ago) {
      return time_ago($ca);
    } else {
      return date('Y-m-d H:i:s', $ca);
    }
  }
  public function setDid($id) {
    $this->setDbFieldDid($id);
  }
  public function getDid() {
    return $this->getDbFieldDid();
  }
  public function setDeal($deal) {
    $this->deal = $deal;
    $this->setDid($deal->getId());
  }
  public function getDeal() {
    return $this->deal;
  }
}