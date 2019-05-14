<?php

include_once '../model/entity/Column.php';
include_once '../model/dao/ColumnDAO.php';


class ColumnController
{

    public function insert($request, $response, $args)
    {
        try {
            $p = $request->getParsedBody();
            $toard = new Column(0, $p['name'], $p['description']);
            $dao = new ColumnDAO;
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
            $toard = new Column($id, $p['name'], $p['description']);
            $dao = new ColumnDAO;
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
            $dao = new ColumnDAO;
            $toard = $dao->delete($id);
        } catch (Exception $error) {
            return $response->withStatus(500);
        }
        return $response->withJson($toard);
    }

    public function findAll($request, $response, $args)
    {
        try {
            $dao = new ColumnDAO;
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
            $dao = new ColumnDAO;
            $toard = $dao->findById($id);
        } catch (Exception $error) {
            return $response->withStatus(500);
        }
        return $response->withJson($toard);
    }

}