<?php
$table = strip_tags(isset($vars[1]) ? $vars[1] : null);
$id = strip_tags(isset($vars[2]) ? $vars[2] : null);
if (is_null($table) || is_null($id)) {
  dispatch('404');
  exit;
}


global $mysqli;

$class = ucfirst($table);

$instance = $class::findById($id);

// delete completely if this record is marked as "deleted"
if ($instance->getDeleted()) {
  $query = 'DELETE FROM '.$table.' WHERE id=' . $id;
  $mysqli->query($query);
  echo "delete completely";
} else {
  $query = 'UPDATE '.$table.' SET deleted = 1 WHERE id=' . strip_tags($id);
  $mysqli->query($query);
  echo "marked as deleted";
}
exit;