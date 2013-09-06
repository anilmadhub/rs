<?php
session_start();
require_once("../core/db.class.php");
$credit = new db();
$result = $credit->retrieve("stagiaire","credit","WHERE id=".$_SESSION['stagiaire']['id']);
$data = $credit ->structure($result);
print $data['credit'];
?>