<?php
include_once "../../libs/RestServer.php";

function f()
{

    echo "--------- F --------------";

}

function getCars($server, $params)
{
    echo "GETTING CARS!";

}

$server = new RestServer();
echo "hello server/api/cars";




?>
