<?php

require_once 'config.php';
require_once 'libs/CarClient.php';

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: *');

if (isset($_POST['action'])) 
{
    header('Content-Type: application/json');
    $client = new CarClient();
    $action = $_POST['action'];

    if ($action == 'getCarList')
    {
        echo $client->getCarList();
    }else if($action == 'searchCars')
    {
        $filter = $_POST['filter'];
        echo $client->CarFilter($filter);
    }else if($action == 'getById')
    {
        $id = $_POST['id'];
        echo $client->getById($id);
    }else if($action == 'getOrderForm')
    {
        require_once TEMPLATE_ORDER;
    }else if($action == 'order')
    {
        $orderData = $_POST['orderData'];
        echo $client->Order($orderData);
    }

}else if (isset($_GET['action'])) 
{
    $action = $_GET['action'];
    if($action == 'getOrderForm')
    {
        require_once TEMPLATE_ORDER;
    }

}else
{
    header('Content-Type: text/html');
    require_once TEMPLATE;
}

?>
