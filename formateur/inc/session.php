<?php
session_start();
if(!isset($_SESSION['formateur']))
{
header('Location:login.php');
}
?>