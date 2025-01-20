<?php

//Main Controller class

class Controller {
  public function view($view,$data = []){

     extract($data);
    $filename = '../app/views/'.$view.'.view.php';
    if(file_exists($filename)){
        require $filename;
   }else{
        echo "Cannot find the view file".$filename;
   }
}
}