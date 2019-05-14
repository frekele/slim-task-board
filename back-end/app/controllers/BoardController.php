<?php

include_once '../model/entity/Board.php';
include_once '../model/dao/BoardDAO.php';


class BoardController
{

    public function insert($request, $response, $args)
    {
        $p = $request->getParsedBody();
        $toard = new Board(0, $p['name'], $p['description']);
        $dao = new BoardDAO;
        $toard = $dao->inserir($toard);
        return $response->withJson($toard, 201);
    }

    public function update($request, $response, $args)
    {
        $id = $args['id'];
        $p = $request->getParsedBody();
        $toard = new Board($id, $p['name'], $p['description']);
        $dao = new BoardDAO;
        $toard = $dao->atualizar($toard);
        return $response->withJson($toard);
    }

    public function delete($request, $response, $args)
    {
        $id = $args['id'];
        $dao = new BoardDAO;
        $toard = $dao->deletar($id);
        return $response->withJson($toard);
    }

    public function findAll($request, $response, $args)
    {
        $dao = new BoardDAO;
        $toards = $dao->listar();
        return $response->withJson($toards);
    }

    public function findById($request, $response, $args)
    {
        $id = $args['id'];
        $dao = new BoardDAO;
        $toard = $dao->buscarPorId($id);
        return $response->withJson($toard);
    }

}