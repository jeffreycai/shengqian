<?php
$table = strip_tags(isset($vars[1]) ? $vars[1] : null);
$id = strip_tags(isset($vars[2]) ? $vars[2] : null);
if (is_null($table) || is_null($id)) {
  dispatch('404');
  exit;
}


global $mysqli;

$class = DBObject::tableNameToClassName($table);

$instance = $class::findById($id);

// delete completely if this record is marked as "deleted"
$instance->delete();
echo "delete completely";
exit;