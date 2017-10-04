<?php
session_start();
require_once 'Shortener.php';

$s = new Shortener;

if(isset($_POST['url'])) {
    $url = $_POST['url'];

    if($code = $s->makeCode($url)) {
        $_SESSION['feedback'] ="Generated! Your short URL is:<a href=\"http://localhost/{$code}\">http://localhost/{$code}\</a>";}

          else {
     $_SESSION['feedback']= "There was a problem.Invalid";

    }

 }
  header('Location:UrlShortner.php');//send data to client
