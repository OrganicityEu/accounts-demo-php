<?php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  session_start();

  require __DIR__ . '/vendor/autoload.php';

  include("header.php");

  if(empty($_GET['page'])) {
    include("inc/home.php");
  } else if(file_exists("inc/" . $_GET['page'] . ".php")) {
    include("inc/" . $_GET['page'] . ".php");
  }

  include("footer.php");
?>
