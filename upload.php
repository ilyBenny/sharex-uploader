<?php

  require_once __DIR__ . '/protected/config.php';

  $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off" ? "https" : "http" . "://";
  $hash = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 8);

  if ( ! isset($_POST['password']) || $_POST['password'] !== PASSWORD) {
      die('Incorrect password.');
  }

  if(!empty($_FILES['file'])) {
    $type = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
    $fileurl = $protocol . DOMAIN . DIRECTORY . "uploads/$hash.$type";
    $filelocation = __DIR__ . "/uploads/$hash.$type";
    if(move_uploaded_file($_FILES['file']['tmp_name'], "uploads/$hash.$type")) {
      if (EMBED == true) {
        echo $protocol . DOMAIN . DIRECTORY . "/?f=$hash.$type";
      } else {
        echo $protocol . DOMAIN . DIRECTORY . "/uploads/$hash.$type";
      }
    } else {
        echo "Failed to upload your file.";
    }
  }

?>
