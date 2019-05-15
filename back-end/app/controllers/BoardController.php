<?php

include_once './app/model/entity/Board.php';
include_once './app/model/dao/BoardDAO.php';


class BoardController
{

    public function insert($request, $response, $args)
    {
        try {
            $p = $request->getParsedBody();
            $board = new Board(0, $p['name'], $p['description']);
            $dao = new BoardDAO;
            $board = $dao->insert($board);
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($board, 201);
    }

    public function update($request, $response, $args)
    {
        try {
            $id = $args['id'];
            $p = $request->getParsedBody();
            $board = new Board($id, $p['name'], $p['description']);
            $dao = new BoardDAO;
            $board = $dao->update($board);
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($board);
    }

    public function delete($request, $response, $args)
    {
        try {
            $id = $args['id'];
            $dao = new BoardDAO;
            $board = $dao->delete($id);
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($board);
    }

    public function findAll($request, $response, $args)
    {
        try {
            $dao = new BoardDAO;
            $boards = $dao->findAll();
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($boards);
    }

    public function findById($request, $response, $args)
    {
        try {
            $id = $args['id'];
            $dao = new BoardDAO;
            $board = $dao->findById($id);
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($board);
    }

}