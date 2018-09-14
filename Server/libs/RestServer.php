<?php

class RestServer
{
    private $service;

    public function __construct($service)
    {
        $this->parseMethod($service);
    }

    private function parseMethod($service)
    {
        $this->service = $service;
        $url = $_SERVER['REQUEST_URI'];
        //list($b, $c, $s, $a, $d, $db, $table, $path) = explode('/', $url, 8);
        //$params = explode('/', $url, 8);
         list( $c, $s, $a, $d, $db, $table, $path) = explode('/', $url, 7);
         $params = explode('/', $url, 7);

        $method = $_SERVER['REQUEST_METHOD'];
        $funcName = ucfirst($table);
        $funcParams = explode('/', $path);
        switch ($method) {
            case 'GET':
                $viewType = array_pop($funcParams);
                $viewType = explode('?', $viewType)[0];
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
    }

    private function setMethod($funcName, $param = false)
    {
        $ret = false;
        if (method_exists($this->service, $funcName)) {
            $ret = call_user_func([$this->service, $funcName], $param);
        }
        return $ret;
    }

    private function show_results($result, $viewType)
    {
        header('Access-Control-Allow-Origin: *');
        switch ($viewType) 
        {
            case '.json':
                header('Content-Type: application/json');
                echo json_encode($result);
                break;
            case '.txt':
                header('Content-type: text/plain');
                echo $this->toText($result);
                break;
            case '.xhtml':
                header('Content-type: text/html');
                echo $this->toHtml($result);
                break;
            case '.xml':
                header('Content-type: application/xml');
                echo $this->toXml($result);
                break;
            default:
                echo 'No such type!';
                break;
        }
    }

    private function toText($obj)
    {
        return print_r($obj);
    }

    private function toHtml($obj)
    {
        $res = "<table>";
        if (is_array($obj)) {
            $first = $obj[0];
            $res .= "<tr>";
            foreach ($first as $key => $val) {
                $res .= "<th>" . $key . "</th>";
            }
            $res .= "</tr>";
            foreach ($obj as $item) {
                $res .= "<tr>";
                foreach ($item as $field) {
                    $res .= "<td>" . $field . "</td>";

                }
            }
            $res .= "</tr>";
        } elseif (is_object($obj)) {
            $first = $obj;
            $res .= "<tr>";
            foreach ($first as $key => $val) {
                $res .= "<th>" . $key . "</th>";
            }
            $res .= "</tr>";
            $res .= "<tr>";
            foreach ($obj as $field) {
                $res .= "<td>" . $field . "</td>";
            }
            $res .= "</tr>";
        }
        $res .= "</table>";
        return $res;
    }

    private function toXml($obj)
    {
        $xml = new SimpleXMLElement('<cars/>');
        $arrToParse = $obj;
        if (is_object($obj)) {
            $arrToParse = [$obj];
        }
        foreach ($arrToParse as $item) {
            $car = $xml->addChild('car');
            foreach ($item as $key => $val) {
                $car->addChild($key, $val);
            }
        }

        return $xml->asXML();
    }

}
