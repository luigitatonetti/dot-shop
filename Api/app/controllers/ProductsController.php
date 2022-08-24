<?php
include_once 'core/bootstrap.php';
class ProductsController
{
    public function read()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        $request = new APIRequest;
        $request->decodeHttpRequest();

        $db = new db();
        $db->openConnection();

        $products = new Products($db);

        $recordset = $products->selectAll();

        if ($recordset !== false) {
            http_response_code(201);
            echo json_encode($recordset);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "No products found"));
        }
    }

    public function update()
    {

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: PUT");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        $request = new APIRequest;
        $request->decodeHttpRequest();
        $data = $request->getBody();

        $db = new db();
        $db->openConnection();

        $product = new Products($db);

        if ( !empty($data['products'])) {
            if ($product->update($data)) {
                http_response_code(201);
                echo json_encode(array("message" => "Product updated"));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Cannot update product"));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Missing data"));
        }
    }
}
