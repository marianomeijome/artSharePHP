<?php
/**
 * Author: Group 10
 * Date: June 14, 2016
 * File: logout.php
 */
session_start();
session_destroy();
header( "Location: index.php" );
?>