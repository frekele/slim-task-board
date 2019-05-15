<?php

use \Firebase\JWT\JWT;

include_once './app/model/entity/User.php';
include_once './app/model/dao/UserDAO.php';

class UserController
{
    private $secretKey = "taskboard123456";

    private function validate(User $user)
    {
        if (empty($user)) {
            throw new Exception("'User' is required!");
        }
        if (!$user->name || !trim($user->name)) {
            throw new Exception("nameField 'nome' is required!");
        }
        if (!$user->login || !trim($user->login)) {
            throw new Exception("nameField 'login' is required!");
        }
        if (!$user->password || !trim($user->password)) {
            throw new Exception("nameField 'password' is required!");
        }
    }

    public function insert($request, $response, $args)
    {
        try {
            $var = $request->getParsedBody();
            $user = new User(0, $var['name'], $var['login'], $var['password']);
            $this->validate($user);
            $dao = new UserDAO;

            $userExist = $dao->findByLogin($var['login']);
            if ($userExist) {
                throw new Exception("This login already exists!");
            } else {
                $user = $dao->insert($user);
            }
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($user, 201);
    }

    public function authenticate($request, $response, $args)
    {
        $user = $request->getParsedBody();
        $dao = new UserDAO;
        $userReturn = $dao->findByLogin($user['login']);
        if ($userReturn->password == $user['password']) {
            $token = array(
                'user' => strval($userReturn->id),
                'name' => $userReturn->name
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
                var_dump($error->getMessage());
                return $response->withStatus(401);
            }
        }
        return $response->withStatus(401);
    }
}