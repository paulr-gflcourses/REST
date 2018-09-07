<?php
class CarClient
{
    private $client;

    public function __construct()
    {
        $this->client = new SoapClient(SERVER_URL . '?wsdl', ['exceptions' => true, 'trace' => 1, 'cache_wsdl' => WSDL_CACHE_NONE]);
    }

    public function getCarList()
    {
        try 
        {
            $result = $this->client->getCarList();
        } catch (Exception $e) 
        {
            return json_encode(['errors' => $e->getMessage()]);
        }
        return json_encode($result);
    }

    public function CarFilter($data)
    {
        try 
        {
            if (isset($data['year'])) 
            {
                $result = $this->client->CarFilter($data);
            } else 
            {
                throw new Exception(ERR_NO_YEAR_SELECTED);
            }
        } catch (Exception $e) 
        {
            return json_encode(['errors' => $e->getMessage()]);
        }

        return json_encode($result);
    }

    public function getById($id)
    {
        try 
        {
            $result = $this->client->getById(['id' => $id]);
        } catch (Exception $e) 
        {
            return json_encode(['errors' => $e->getMessage()]);
        }
        return json_encode($result);
    }

    public function Order($order)
    {
        try
        {
            if (isset($order['firstname'])
                &&isset($order['lastname'])
                &&isset($order['payment'])
                &&isset($order['idcar'])) 
            {
                $result = $this->client->Order($order);
            } else {
                throw new Exception(ERR_ORDER_PARAMS);
            }
        } catch (Exception $e) {
            return json_encode(['errors' => $e->getMessage()]);
        }
        return json_encode($result);
    }

}

