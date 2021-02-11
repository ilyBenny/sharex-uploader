<html>
  <?php

    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off" ? "https" : "http" . "://";
    $fileurl = $protocol . DOMAIN . DIRECTORY . "uploads/$hash.$type";

    require_once __DIR__ . '/protected/config.php';

    function human_filesize($bytes, $decimals) {
        $size = array('B','KB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f ", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    $files = scandir('uploads/');

    if (isset($_GET["f"])) {

      $string = $_GET["f"];
      $type = strrchr($string, '.');
      $type = str_replace(".","",$type);

      foreach ($files as $file) {
        if ($file == $_GET["f"]) {

          $filesize = human_filesize(filesize("uploads/" . $_GET["f"]), 2);
          ?>

            <head>
              <title><?php echo $_GET["f"]; ?></title>
              <meta name='og:site_name' content='<?php echo $_GET["f"]; ?>'>
              <?php if ($type == "png" || $type == "gif" || $type == "jpeg" || $type == "jpg"): ?>
                <meta name='twitter:card' content='photo'>
                <meta name='twitter:title' content='<?php echo EMBED_TITLE; ?> (<?php echo $filesize; ?>)'>
                <meta name='twitter:image' content='<?php echo $protocol . DOMAIN . "/uploads/" . $_GET["f"]; ?>'>
              <?php elseif ($type == "mp4" || $type == "webm"): ?>
                <meta name='twitter:card' content='player'>
                <meta name='twitter:title' content='<?php echo EMBED_TITLE; ?> (<?php echo $filesize; ?>)'>
                <meta name='twitter:player' content='<?php echo $protocol . DOMAIN . "/uploads/" . $_GET["f"]; ?>'>
                <meta name='twitter:player:width' content='1280'>
                <meta name='twitter:player:height' content='720'>
              <?php else: ?>
                <meta name='twitter:card' content='suummary_large_image'>
                <meta name='twitter:title' content='<?php echo EMBED_TITLE; ?> (<?php echo $filesize; ?>)'>
              <?php endif; ?>
            </head>
            <body>
              <h1><?php echo $_GET["f"]; ?></h1>
              <p>File size: <?php echo $filesize; ?></p>
              <?php if ($type == "png" || $type == "gif" || $type == "jpeg" || $type == "jpg"): ?>
                <img src='<?php echo $protocol . DOMAIN . "/uploads/" . $_GET["f"]; ?>'></img>
              <?php elseif ($type == "mp4" || $type == "webm"): ?>
                <video controls>
                  <source src='<?php echo $protocol . DOMAIN . "/uploads/" . $_GET["f"]; ?>'>
                </video>
              <?php elseif ($type == "mp3" || $type == "ogg"): ?>
                <audio controls>
                  <source src='<?php echo $protocol . DOMAIN . "/uploads/" . $_GET["f"]; ?>'>
                </audio>
              <?php else: ?>
                <button><a href='<?php echo $protocol . DOMAIN . "/uploads/" . $_GET["f"]; ?>' download>Download</a></button>
              <?php endif; ?>
            </body>

          <?php
        }
      }
    } else {
      header('Location: ' . $protocol . DOMAIN);
    }

  ?>
</html>
