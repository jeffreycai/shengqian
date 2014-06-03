<?php
require_once CLASS_DIR . DS . 'DBObject.class.php';

/**
 * DB fields for Deal:
 * - id
 * - name
 */
class Category extends DBObject {
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
    $this->table_name = 'category';
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
  public function setName($name) {
    $this->setDbFieldName($name);
  }
  public function getName() {
    return $this->getDbFieldName();
  }
  
  /** ---------------------
   * Self defined functions
   ------------------------*/
  const COLOUR_ALL = '#A1DEF8';
  const COLOUR_FOOD = '#3FBF79';
  const COLOUR_GOODS = '#DB6AC5';
  const COLOUR_TRAVEL = '#FEE664';
  const COLOUR_EVENT = '#CAD3D0';
  
  static function findById($id) {
    global $mysqli;
    $result = $mysqli->query('SELECT * FROM `category` WHERE id=' . DBObject::prepare_val_for_sql($id));
    if ($t = $result->fetch_object()) {
      $category = new Category();
      DBObject::importQueryResultToDbObject($t, $category);
      return $category;
    }
  }
  
  static function findByName($name) {
    global $mysqli;
    $result = $mysqli->query('SELECT * FROM `category` WHERE name=' . DBObject::prepare_val_for_sql($name));
    if ($record = $result->fetch_object()) {
      $category = new Category();
      DBObject::importQueryResultToDbObject($record, $category);
      return $category;
    } else {
      return null;
    }
  }
  
  /**
   * create category db record if does not exist
   * 
   * @global type $conf
   * @global type $mysqli
   */
  static function populateDB() {
    global $conf;
    global $mysqli;
    
    $categories = $conf['category'];
    foreach ($categories as $cat => $name) {
      // if is an array, loop
      if (is_array($cat)) {
        foreach ($cat as $c => $name) {
          if ($instance = self::findById($c)) {
            // do nothing
          } else {
            // create
            $new = new Category();
            $new->setId($c);
            $new->setName($name);
            $new->save();
          }
        }
      // otherwise
      } else {
          if ($instance = self::findById($cat)) {
            // do nothing
          } else {
            // create
            $new = new Category();
            $new->setid($cat);
            $new->setName($name);
            $new->save();
          }
      }
    }
  }
  
  public function __toString() {
    return $this->getName();
  }
  
  public function getRecentDeals($amount, $exclude_deal_id = null) {
    global $mysqli;
    $query = "SELECT * FROM deal WHERE cid=" . DBObject::prepare_val_for_sql($this->getId()) . " AND published=1 AND valid=1";
    if ($exclude_deal_id) {
      $query .= " AND id!=" . $exclude_deal_id;
    }
    $query.= " ORDER BY created_at DESC LIMIT " . $amount;
    $result = $mysqli->query($query);
    $rtn = array();
    while ($result && $record = $result->fetch_object()) {
      $deal = new Deal();
      Deal::importQueryResultToDbObject($record, $deal);
      $rtn[] = $deal;
    }
    return $rtn;
  }
  
}

?>
