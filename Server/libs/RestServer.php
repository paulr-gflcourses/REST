<?php

class RestServer
{
    private $service;

    public function __construct($service)
    {
        $this->service = $service;
        $url = $_SERVER['REQUEST_URI'];
        //list($b, $c, $s, $a, $d, $db, $table, $path) = explode('/', $url, 8);
        //$params = explode('/', $url, 8);

        list( $c, $s, $a, $d, $db, $table, $path) = explode('/', $url, 7);
        $params = explode('/', $url, 7);
        # use setMethod to map to a specific function
        # # GET /api/db/web/applist/test.com = getApplist(test.com)
        echo "<pre>";
        echo "parameters: s=$s, a=$a, d=$d, db=$db, table=$table, path=$path";
        //call_user_func('f');
        $method = $_SERVER['REQUEST_METHOD'];
        echo " method: $method,";
        //echo " params:";
        print_r($params);


        $funcName = ucfirst($table);
        $funcParams = explode('/', $path);
        switch ($method) 
        {
        case 'GET':
            //echo ", func params: ";
            //print_r($funcParams);
            $viewType = array_pop($funcParams);
            $viewType = explode('?', $viewType)[0];
            //echo ", viewType: $viewType";
            $result = $this->setMethod('get' . $funcName, $funcParams);
            $this->show_results($result, $viewType);
            break;
        case 'POST':
            $this->setMethod('post' . $funcName, $funcParams);
            break;
        case 'PUT':
            $this->setMethod('put' . $funcName, $funcParams);
            break;
        case 'DELETE':
            $this->setMethod('delete' . $funcName, $funcParams);
            break;
        default:
            return false;
        }
        echo "</pre>";
    }
    private function setMethod($funcName, $param = false)
    {
        //echo "Method: $funcName, params:";
        //print_r($param);
        $ret=false;
        //call_user_func($method, $param);
        if (method_exists($this->service, $funcName)) {
            $ret = call_user_func([$this->service, $funcName], $param);
            // echo "result: ";
            // print_r($ret);
        }
        return $ret;
    }

    private function show_results($result, $viewType)
    {
        //echo "viewType: $viewType";
        echo "\n Result: \n";
        switch ($viewType) 
        {
        case '.json':
            echo json_encode($result);
            break;
        case '.txt':
            echo $this->objectToText($result);
            break;
        default:
            echo 'No such type!';
        }
    }

    private function objectToText($obj)
    {
        $res = "";
        if (is_array($obj))
        {
            $first = $obj[0];
            foreach ($first as $key=> $val) 
            {
                $res .= $key." \t"; 
            }
            foreach ($obj as $item) 
            {
                $res .= "\n";
                foreach ($item as $field) 
                {
                    $res .= $field." \t";

                }
            }
        }
        return $res;

    }



}
