<?php

class Shortener
{
  protected $db;

  public function __construct(){
    $this->db = new mysqli('localhost','root','','Mother');

  }
   protected function generateCode($num){
return base_convert($num,10,36);
   }
   public function makeCode($url){
   $url =trim($url);   //remove white spaces

if(!(filter_var($url,FILTER_VALIDATE_URL))){  //is it valid
     return '';
   }

   $url=$this->db->escape_string($url);    //(needed)escape special characters in string for sql

    //cheeking if existing url
     $exists=$this->db->query("SELECT code FROM sister WHERE url='{$url}'");//(this refers to method in class.Search the database for this url)
   if($exists->num_rows){    //if its a good url in the num_rows return the codoe
    return $exists->fetch_object()->code; //return the code
   }else{
      //  generalte and store url code
        $this->db->query("INSERT INTO sister(url,created)VALUES ('{$url}',NOW())");
        //Generate code based on inserted ID
        $code= $this->generateCode($this->db->insert_id);

        //update the record with generated  code
        $this->db->query("UPDATE sister SET code='{$code}' WHERE url= '{$url}'");

          return $code;
   }
   }
  public function getURL($code){
     $code=$this->db->escape_string($code);
     $code=$this->db->query("SELECT url FROM sister WHERE code = '$code' ");
   if($code->num_rows){

     return $code->fetch_object()->url;
   }
      return '';
}
}
