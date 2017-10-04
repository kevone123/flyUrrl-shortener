<<?php
 require_once 'Shortener.php';

 if(isset($_GET['code'])){ //  redicrecting to google
     $s= new Shortener;
     $code=$_GET['code'];


     if($url =$s->getURL($code)){
       header("Location:{$url}");
        die();
     }
     header('Locaton:UrlShortner.php');
}
