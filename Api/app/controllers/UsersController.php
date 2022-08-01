<?php
include_once 'core/bootstrap.php';

class UsersController
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
        $data = $request->getBody();

        $db = new db();
        $db->openConnection();

        $users = new Users($db);

        $recordset = $users->select($data);

        if (!empty($data['email']) && !empty($data['password'])) {
            if ($recordset !== false) {
                http_response_code(201);
                echo json_encode($recordset);
            } else {
                http_response_code(404);
                echo json_encode(array("message" => "User not found"));
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

        $user = new Users($db);

        if (!empty($data['first_name']) || !empty($data['last_name']) || !empty($data['username']) || !empty($data['email']) || !empty($data['password'])) {
            if ($user->create($data)) {
                $recordset = $user->select($data);
                http_response_code(201);
                echo json_encode($recordset);
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Cannot add user"));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Missing data"));
        }
    }
}
