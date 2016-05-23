<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>OrganiCity Accounts - PHP Demo</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css">
  </head>
  <body>
    <div class="container">
      <h1>OrganiCity Accounts</h1>
      <h2>PHP Demo</h2>
      <hr>
      <a href="/accounts-demo-php/" class="btn btn-default">Home</a>
      <?php if(isset($_SESSION['username'])) { ?>
        <a href="/accounts-demo-php?page=profile" class="btn btn-default">Profile</a>
        <a href="/accounts-demo-php?page=logout" class="btn btn-default">Logout</a>
      <?php } else { ?>
        <a href="/accounts-demo-php?page=login" class="btn btn-default">Login</a>
      <?php } ?>
      <hr>