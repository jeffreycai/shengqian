<?php
$id = isset($vars[1]) ? $vars[1] : null;
if (is_null($id)) {
  dispatch('404');
  exit;
}


global $mysqli;

$topic = Topic::findById($id);
// delete completely if this record is marked as "deleted"
if ($topic->getDeleted()) {
  $query = 'DELETE FROM topic WHERE id=' . strip_tags($id);
  $mysqli->query($query);
  echo "delete completely";
} else {
  $query = 'UPDATE topic SET deleted = 1 WHERE id=' . strip_tags($id);
  $mysqli->query($query);
  echo "marked as deleted";
}
exit;