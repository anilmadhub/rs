<?php
require('inc/session.php');
require('../functions/misc.php');
require("../core/db.class.php");
define('PAGE','HOME');

//export to excel
$datefrom='08/01/2011';
$dateto='10/21/2011';
$rdv_excel = new db();
//$rdv_list = $rdv_excel -> retrieve('rdv','*','WHERE date >='.formateDate2($datefrom).' AND date <='.formateDate2($datefrom));
$rdv_list = $rdv_excel -> retrieve('rdv','*','WHERE date >='.formateDate2($datefrom).' AND date <='.formateDate2($dateto));
print_r($rdv_list);
?>