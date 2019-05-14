<?php

use \Firebase\JWT\JWT;

include_once '../model/entity/User.php';
include_once '../model/dao/UserDAO.php';

class UserController
{
    private $secretKey = "taskboard123456";

    public function insert($request, $response, $args)
    {
        $var = $request->getParsedBody();
        $user = new User(0, $var['name'], $var['login'], $var['password']);

        $dao = new UserDAO;
        $user = $dao->inserir($user);

        return $response->withJson($user, 201);
    }

    public function authenticate($request, $response, $args)
    {
        $user = $request->getParsedBody();

        $dao = new UserDAO;
        $user = $dao->findByLogin($user['login']);
        if ($user->password == $user['password']) {
            $token = array(
                'user' => strval($user->id),
                'name' => $user->name
            );
            $jwt = JWT::encode($token, $this->secretKey);
            return $response->withJson(["token" => $jwt], 201)
                ->withHeader('Content-type', 'application/json');
        } else
            return $response->withStatus(401);
    }

    public function tokenValidate($request, $response, $next)
    {
        $token = $request->getHeader('Authorization')[0];

        if ($token) {
            try {
                $decoded = JWT::decode($token, $this->secretKey, array('HS256'));
                if ($decoded)
                    return ($next($request, $response));
            } catch (Exception $error) {

                return $response->withStatus(401);
            }
        }

        return $response->withStatus(401);
    }
}