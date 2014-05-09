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
  static function findById($id) {
    global $mysqli;
    $result = $mysqli->query('SELECT * FROM `category` WHERE id=' . $id);
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
          if ($instance = self::findByName($c)) {
            // do nothing
          } else {
            // create
            $new = new Category();
            $new->setName($c);
            $new->save();
          }
        }
      // otherwise
      } else {
          if ($instance = self::findByName($cat)) {
            // do nothing
          } else {
            // create
            $new = new Category();
            $new->setName($cat);
            $new->save();
          }
      }
    }
  }
  
}

?>
