<?php
session_start();
if(!isset($_SESSION['stagiaire']))
{
header('Location:../');
}
?>