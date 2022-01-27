<?php
session_start();
if (!isset($_SESSION["actualUserID"]))
{
    header("location: index.php");
}