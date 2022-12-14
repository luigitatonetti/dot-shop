<?php
include_once('core/bootstrap.php');

class OrdersController
{

    public function read()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        $request = new APIRequest;
        $request->decodeHttpRequest();
        $param = $_SERVER['REQUEST_URI'];
        $param = explode('/', $param);
        $id = $param[2];
        $db = new db();
        $db->openConnection();

        $order = new Orders($db);

        if (!is_null($id)) {
            $recordset = $order->select($id);
            if ($recordset !== false) {
                http_response_code(201);
                echo json_encode($recordset);
            } else {
                http_response_code(404);
                echo json_encode(array("message" => "Order not found"));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Missing data"));
        }
    }

    public function create()
    {

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        $request = new APIRequest;
        $request->decodeHttpRequest();
        $data = $request->getBody();

        $db = new db();
        $db->openConnection();

        $order = new Orders($db);

        if ( !empty($data['products']) || !empty($data['id_user'])) {
            if ($order->create($data)) {
                http_response_code(201);
                echo json_encode(array("message" => "Order added"));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Cannot add order"));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Missing data"));
        }
    }

    public function delete()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: DELETE");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        $request = new APIRequest;
        $request->decodeHttpRequest();

        $param = $_SERVER['REQUEST_URI'];
        $param = explode('/', $param);
        $id = $param[2];
        
        $db = new db();
        $db->openConnection();

        $order = new Orders($db);

        if (!is_null($id)) {
            if ($order->delete($id)) {
                http_response_code(200);
                echo json_encode(array("message" => "Order deleted"));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Cannot delete the order"));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Missing data"));
        }
    }
}
