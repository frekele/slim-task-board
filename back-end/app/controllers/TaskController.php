<?php

include_once '../model/entity/Task.php';
include_once '../model/dao/TaskDAO.php';


class TaskController
{

    public function insert($request, $response, $args)
    {
        try {
            $p = $request->getParsedBody();
            $toard = new Task(0, $p['name'], $p['description']);
            $dao = new TaskDAO;
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
            $toard = new Task($id, $p['name'], $p['description']);
            $dao = new TaskDAO;
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
            $dao = new TaskDAO;
            $toard = $dao->delete($id);
        } catch (Exception $error) {
            return $response->withStatus(500);
        }
        return $response->withJson($toard);
    }

    public function findAll($request, $response, $args)
    {
        try {
            $dao = new TaskDAO;
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
            $dao = new TaskDAO;
            $toard = $dao->findById($id);
        } catch (Exception $error) {
            return $response->withStatus(500);
        }
        return $response->withJson($toard);
    }

}