<?php
require_once __DIR__ . "/../../functions.inc.php";

echo json_encode(array(
    'spam_key' => getSpamKey(),
    'spam_val' => getSpamVal()
));
exit;