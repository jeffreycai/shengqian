<?php
require_once CLASS_DIR . DS . 'DBObject.class.php';

/**
 * DB fields for Staff:
 * - agency
 * - cn
 * - photo_uri
 * - isValidae
 * - token
 * - isAbused
 */
class Staff extends DBObject {
  /**
   * Implement parent abstract functions
   */
  protected function setPrimaryKeyName() {
    $this->primary_key = array(
      'email'
    );
  }
  protected function setTableName() {
    $this->table_name = 'staff';
  }
  
  /** ---------------------------------
   * Setters and getters for DB fields
    ----------------------------------*/
  public function setEmail($var) {
    $var = strtolower($var);
    $this->setDbFieldEmail($var);
  }
  public function getEmail() {
    return $this->getDbFieldEmail();
  }
//  public function setAgency($var) {
//    $var = strtolower($var);
//    $this->setDbFieldAgency($var);
//  }
//  public function getAgency() {
//    return $this->getDbFieldAgency();
//  }
//  public function setCN($var) {
//    $var = strtolower($var);
//    $this->setDbFieldCN($var);
//  }
//  public function getCN() {
//    return $this->getDbFieldCN();
//  }
  public function setPhotoURI($var) {
    $this->setDbFieldPhoto_uri($var);
  }
  public function getPhotoURI() {
    return $this->getDbFieldPhoto_uri();
  }
  public function setPhotoUpdatedAt($var) {
    $this->setDbFieldPhoto_updated_at($var);
  }
  public function getPhotoUpdatedAt() {
    return $this->getDbFieldPhoto_updated_at();
  }
  public function setIsValidated($var) {
    $this->setDbFieldIs_token_validated($var);
  }
  public function getIsValidated() {
    return $this->getDbFieldIs_token_validated();
  }
  public function setRequestToUpload($var) {
    $this->setDbFieldRequest_to_upload($var);
  }
  public function getRequestToUpload() {
    return $this->getDbFieldRequest_to_upload();
  }
  public function setToken($var) {
    $this->setDbFieldToken($var);
  }
  public function getToken() {
    return $this->getDbFieldToken();
  }
  public function setTokenValidatedAt($var) {
    $this->setDbFieldToken_validated_at($var);
  }
  public function getTokenValidatedAt() {
    return $this->getDbFieldToken_validated_at();
  }
  public function setIsAbusedReported($var) {
    $this->setDbFieldIs_abused_reported($var);
  }
  public function getIsAbusedReported() {
    return $this->getDbFieldIs_abused_reported();
  }
  public function setAbusedReportedAt($var) {
    $this->setDbFieldAbused_reported_at($var);
  }
  public function getAbusedReportedAt() {
    return $this->getDbFieldAbused_reported_at();
  }
  public function setCreatedAt($var) {
    $this->setDbFieldCreated_at($var);
  }
  public function getCreatedAt() {
    return $this->getDbFieldCreated_at();
  }
  public function setAbusedReportedBy($var) {
    $this->setDbFieldAbused_reported_by($var);
  }
  public function getAbusedReportedBy() {
    return $this->getDbFieldAbused_reported_by();
  }
  public function setTokenValidatedBy($var) {
    $this->setDbFieldToken_validated_by($var);
  }
  public function getTokenValidatedBy() {
    return $this->getDbFieldToken_validate_by();
  }
  public function setPhotoUpdatedBy($var) {
    $this->setDbFieldPhoto_updated_by($var);
  }
  public function getPhotoUpdatedBy() {
    return $this->getDbFieldPhoto_updated_by();
  }
  
  /**----------------
   * unique self functions
     ----------------*/
  
  /**
   * get an staff object by querying pks
   * if does not find a record, return empty Staff object
   * 
   * @global type $mysqli
   * @param type $agency
   * @param type $cn
   */
  static public function fetchByPK($var, $create_if_not_exist = false) {
    $staff = new Staff();
    
    global $mysqli;
    $query = "SELECT * FROM `" . $staff->getTableName() . "` WHERE LOWER(`email`)=" . self::prepare_val_for_sql(strtolower($var)) . ";";
    $result = $mysqli->query($query);

    // populate database result to the return object
    if ($record = $result->fetch_object()) {
      DBObject::importQueryResultToDbObject($record, $staff);
    } else if ($create_if_not_exist) {
      $staff->setEmail($var);
      $staff->setCreatedAt(timestamp());
      $staff->save();
    }
    
    return $staff;
  }
  
  /**
   * Override PHP isset() function
   * 
   * if there is one staff db field defined, then this object is "set", otherwise, we take it as "unset"
   * @return boolean
   */
  public function __isset($name) {
    foreach (get_object_vars($this) as $key => $val) {
      if (preg_match('/^db_field_/', $key)) {
        return true;
      }
    }
    return false;
  }
  
  /**
   * get uri of the avatar photo, if not uploaded, return the default photo uri
   * if the staff photo is not varified, return default photo uri as well
   * 
   * @global type $conf
   * @return type
   */
  public function getAvatarUri() {
    global $conf;
    
    // if this photo is reported inappropriate, return default avatar
    if ($this->getIsAbusedReported()) {
      return $conf['default_avatar'];
    }
    
    // otherwise, show the uploaded photo
    if ($this->photoUploaded()) {
      return $this->getPhotoURI();
    }
    
    return $conf['default_avatar'];
  }
  
  /**
   * check if the photo is uploaded
   * 
   * @return boolean
   */
  public function photoUploaded() {
    if ($this->getPhotoURI()) {
      return true;
    }
    return false;
  }
  
  /**
   * populate Staff object with extra details from table "phonelist"
   * 
   * @global type $mysqli
   */
  public function popDetails() {
    // do not pop if already popped
    if (@is_array($this->details)) {
      return;
    }
    
    global $mysqli;
    $query = "SELECT * FROM `" . get_records_table() . "` WHERE LOWER(`mail`)=" . self::prepare_val_for_sql($this->getEmail()) . ";";
    $result = $mysqli->query($query);

    while ($detail = $result->fetch_assoc()){
      $this->details[] = $detail;
    }
  }
  
  public function getDetails() {
    $this->popDetails();
    return isset($this->details) ? $this->details : null;
  }
  
  public function getPhotoPath() {
    global $conf;
    
    if ($this->photoUploaded()) {
      return $this->getPhotoDirPath() . DS . basename($this->getPhotoURI());
    }
    return null;
  }
  
  /**
   * return photo directory path
   */
  static function getPhotoDirPath() {
    global $conf;
    return WEBROOT . $conf['avatar_root'];
  }
  
  static function getPhotoCacheDirPath() {
    global $conf;
    return WEBROOT . $conf['avatar_cache'];
  }
  
  /**
   * get all staff whose photo used to be reported as abused
   */
  static function getAllAbused() {
    global $mysqli;
    
    $staffs = array();
    
    $query = "SELECT * FROM `staff` WHERE `abused_reported_at` IS NOT NULL ORDER BY `is_abused_reported` DESC, `abused_reported_at` DESC";
    $result = $mysqli->query($query);
    while ($record = $result->fetch_object()) {
      $staff = new Staff();
      self::importQueryResultToDbObject($record, $staff);
      $staff->popDetails();
      $staffs[] = $staff;
    }
    return $staffs;
  }
  
  /**
   * Send a verification email to staff
   */
  public function sendVerificationEmail() {
    global $conf;
    
    $html = new HTML();
    
    $subject = $conf['verification_email_subject'];
    $message = $html->render('email-verification', array(
      'staff' => $this
    ));
    $from = $conf['email_from'];
    $to = $this->details[0]['mail'];
    
// for debug purpose, if it is not production, set $to address to Jeffrey's mail address
if ($conf['env'] !== 'production') {
  $to = 'jeffrey.cai@rms.nsw.gov.au';
}

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Additional headers
    $headers .= 'From: ' . $from . "\r\n";

    // Mail it
    return mail($to, $subject, $message, $headers);
  }
  
  /**
   * Reset the staff to the status of not verified
   */
  public function resetToNotVerified() {
    $this->resetToken();
    $this->setIsValidated(0);
    $this->setTokenValidatedAt(null);
  }
  
  public function resetToken() {
    $this->setToken(md5(time()));
  }
  
  /**
   * Get this staff's full name
   */
  public function getFullName() {
    $this->popDetails();
    $givenName = ucfirst(strtolower($this->details[0]['givenName']));
    $sn = ucfirst(strtolower($this->details[0]['sn']));
    return $givenName . ' ' . $sn;
  }
  
  /**
   * Get the verification link uri
   */
  public function getVerificationUri() {
    return 'http://' . $_SERVER['SERVER_NAME'] . '/staff/verify/' . urlencode($this->getEmail()) . '?token=' . urlencode($this->getToken());
  }
  
  public function makePhotoName() {
    return $this->getEmail() . '.jpg';
  }
  
  /**
   * get Staff details page url
   * 
   * @return type
   */
  public function getStaffDetailsPageUrl() {
    $this->popDetails();
    $details = array_pop($this->getDetails());
    $url = '/staff/' . urlencode($details['Agency']) . '/' . urlencode($details['cn']);
    return strtolower($url);
  }
  
  /**
   * get staff photo upload page url
   * 
   * @return string
   */
  public function getPhotoUploadPageUrl() {
    $this->popDetails();
    $details = array_pop($this->getDetails());
    $url = '/staff/update/' . urlencode(strtolower($details['mail']));
    return $url;
  }
  
  /**
   * get cached avatar image uri
   * 
   * @return type
   */
  public function getCachedAvatarUri() {
    global $conf;
    return $conf['avatar_cache'] . '/' . $this->makePhotoName();
  }
  
  /**
   * delete the staff and it's photo
   */
  public function delete() {
    // delete the photo
    @unlink($this->getPhotoPath());
    // delete the db record
    parent::delete();
  }
}