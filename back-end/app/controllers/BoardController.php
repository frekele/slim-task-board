<?php

include_once '../model/entity/Board.php';
include_once '../model/dao/BoardDAO.php';


class BoardController
{

    public function insert($request, $response, $args)
    {
        try {
            $p = $request->getParsedBody();
            $toard = new Board(0, $p['name'], $p['description']);
            $dao = new BoardDAO;
            $toard = $dao->insert($toard);
        } catch (Exception $error) {
            return $response->withStatus(500);
        }
        return $response->withJson($toard, 201);
    }

    public function update($request, $response, $args)
    {
        try {
            $id = $args['id'];
            $p = $request->getParsedBody();
            $toard = new Board($id, $p['name'], $p['description']);
            $dao = new BoardDAO;
            $toard = $dao->update($toard);
        } catch (Exception $error) {
            return $response->withStatus(500);
        }
        return $response->withJson($toard);
    }

    public function delete($request, $response, $args)
    {
        try {
            $id = $args['id'];
            $dao = new BoardDAO;
            $toard = $dao->delete($id);
        } catch (Exception $error) {
            return $response->withStatus(500);
        }
        return $response->withJson($toard);
    }

    public function findAll($request, $response, $args)
    {
        try {
            $dao = new BoardDAO;
            $toards = $dao->findAll();
        } catch (Exception $error) {
            return $response->withStatus(500);
        }
        return $response->withJson($toards);
    }

    public function findById($request, $response, $args)
    {
        try {
            $id = $args['id'];
            $dao = new BoardDAO;
            $toard = $dao->findById($id);
        } catch (Exception $error) {
            return $response->withStatus(500);
        }
        return $response->withJson($toard);
    }

}