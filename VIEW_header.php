<!DOCTYPE html>
<html>
  <head>
    <title><?= $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="w3.css">
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">-->
  </head>
  
  <body>

    <header class="w3-container w3-teal">
      
      <h3 class="w3-col s12 m8 l6"><?= $title; ?><?= ($subtitle ? ' - '.$subtitle : ''); ?></h3>
      <div style="vertical-align: middle;" class="w3-right-align">
        <a href="index.php?modul=controlPanel"><span style="margin: auto 10px;"><?=$session['name'];?></span></a>
        <a href="?logout=1" class="w3-btn w3-theme" style="margin: auto 10px;">Logout</a>
      </div>
      
    </header>
