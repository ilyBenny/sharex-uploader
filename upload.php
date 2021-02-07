<?php

  define('DIRECTORY', ""); # Directory of where this file and uploads folder is located.
  define('PASSWORD', ""); # Your password
  define('DOMAIN', ""); # Your domain NOT THE URL

  define('EMBED', true);
  define('EMBED_TITLE', ""); # The title of the embedded message or twitter card.

  $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off" ? "https" : "http" . "://";
  function human_filesize($bytes, $decimals) { # Thanks some dude on stack overflow :)
      $size = array('B','KB','MB','GB','TB','PB','EB','ZB','YB');
      $factor = floor((strlen($bytes) - 1) / 3);
      return sprintf("%.{$decimals}f ", $bytes / pow(1024, $factor)) . @$size[$factor];
  }
  date_default_timezone_set('Europe/London');
  $datetime = date('dS F Y');
  $hash = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
  if ( ! isset($_POST['password']) || $_POST['password'] !== PASSWORD) {
      die('Incorrect password.');
  }
  if(!empty($_FILES['file'])) {
    $type = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
    $fileurl = $protocol . DOMAIN . DIRECTORY . "uploads/$hash.$type";
    $filelocation = __DIR__ . "/uploads/$hash.$type";
    if(move_uploaded_file($_FILES['file']['tmp_name'], "uploads/$hash.$type")) {
      if (EMBED == true) {
        $filesize = human_filesize(filesize($filelocation), 2);
        $embedfile = fopen("uploads/$hash.html", "w") or die("Unable to open file!");
        fwrite($embedfile, "<title>$hash.$type</title>\n");
        if ($type == "png" || $type == "gif" || $type == "jpeg" || $type == "jpg"):
          fwrite($embedfile, "<head>\n<meta name='twitter:card' content='photo'>\n");
        elseif ($type == "mp4" || $type == "webm"):
          fwrite($embedfile, "<head>\n<meta name='twitter:card' content='player'>\n");
        else:
          fwrite($embedfile, "<head>\n<meta name='twitter:card' content='suummary_large_image'>\n");
        endif;
        fwrite($embedfile, "<meta name='twitter:title' content='". EMBED_TITLE . " (" . $filesize . ")'>\n");
        if ($type == "png" || $type == "gif" || $type == "jpeg" || $type == "jpg"):
          fwrite($embedfile, "<meta name='twitter:image' content='$fileurl'>\n");
        elseif ($type == "mp4" || $type == "webm"):
          fwrite($embedfile, "<meta name='twitter:player' content='$fileurl'>\n<meta name='twitter:player:width' content='1280'>\n<meta name='twitter:player:height' content='720'>\n");
        endif;
        fwrite($embedfile, "</head>\n<body>\n<h1>$hash.$type</h1>\n<p>" . $filesize . "</p>\n");
        if ($type == "png" || $type == "gif" || $type == "jpeg" || $type == "jpg"):
          fwrite($embedfile, "<img src='$fileurl'></img>\n");
        elseif ($type == "mp4" || $type == "webm"):
          fwrite($embedfile, "<video controls>\n<source src='$fileurl'>\n</video>\n");
        elseif ($type == "mp3" || $type == "ogg"):
          fwrite($embedfile, "<audio controls>\n<source src='$fileurl'>\n</audio>\n");
        else:
          fwrite($embedfile, "<button><a href='$fileurl' download>Download</a></button>");
        endif;
        fwrite($embedfile, "</body>");
        fclose($embedfile);
        echo $protocol . DOMAIN . "/uploads/$hash";
      } else {
        echo $protocol . DOMAIN . "/uploads/$hash.$type";
      }
    } else {
        echo "Failed to upload your file.";
    }
  }

?>
