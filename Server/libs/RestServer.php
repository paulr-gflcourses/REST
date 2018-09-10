<?php

class RestServer
{
    public function __construct()
    {
        $url = $_SERVER['REQUEST_URI'];
        list($a2, $b, $c, $s, $a, $d, $db, $table, $path) = explode('/', $url, 6);
        $params = explode('/', $url, 6);
        # use setMethod to map to a specific function
        # # GET /api/db/web/applist/test.com = getApplist(test.com)
        echo "<pre>";
        echo "parameters: s=$s, a=$a, d=$d, db=$db, table=$table, path=$path";
        //call_user_func('f');
        $method = $_SERVER['REQUEST_METHOD'];
        echo "method: $method";
        echo "params:";
        print_r($params);
        echo "</pre>";

        switch($method)
        {
        case 'GET':
        $this->setMethod('get'.ucfirst($table), explode('/', $path));
        break;
        case 'DELETE':
        $this->setMethod('delete'.ucfirst($table), explode('/', $path));
        break;
        case 'POST':
        $this->setMethod('post'.ucfirst($table), explode('/', $path));
        break;
        case 'PUT':
        $this->setMethod('put'.ucfirst($table), explode('/', $path));
        break;
        default:
        return false;
        }

    }
    public function setMethod($method, $param = false)
    {
        echo "Method: $method, params:";
            print_r($param);
        if (method_exists($this, $method)) {
            call_user_func($method, $param);
            
        }
    }

}
