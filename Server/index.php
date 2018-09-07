<?php

$url = $_SERVER[REQUEST_URI];
list($s, $a, $d, $db, $table, $path) = explode('/', $url, 6); 

# use setMethod to map to a specific function 
# # GET /api/db/web/applist/test.com = getApplist(test.com) 
echo "parameters: $s, $a, $d, $db, $table, $path";

//switch($this->method) 
//{ 
    //case 'GET': 
        //$this->setMethod('get'.ucfirst($table), explode('/', $path)); 
        //break; 
    //case 'DELETE': 
        //$this->setMethod('delete'.ucfirst($table), explode('/', $path)); 
        //break; 
    //case 'POST': 
        //$this->setMethod('post'.ucfirst($table), explode('/', $path)); 
        //break; 
    //case 'PUT': 
        //$this->setMethod('put'.ucfirst($table), explode('/', $path)); 
        //break; 
    //default: 
        //return false; 
//} 


function setMethod($method, $param=false) 
{ 
    if ( method_exists($this, $method)  ) 
    { 
        //call_user_func(......); 
    } 
}
?>
