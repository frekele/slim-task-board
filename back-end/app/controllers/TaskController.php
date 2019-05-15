<?php

include_once './app/model/entity/Task.php';
include_once './app/model/dao/TaskDAO.php';

class TaskController
{

    public function insert($request, $response, $args)
    {
        try {
            $p = $request->getParsedBody();
            $column = new Task(0, $p['columnId'], $p['name'], $p['weight'], $p['description'], $p['assignedUserId']);
            $dao = new TaskDAO;
            $toard = $dao->insert($column);
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($column, 201);
    }

    public function update($request, $response, $args)
    {
        try {
            $id = $args['id'];
            $p = $request->getParsedBody();
            $column = new Task($id, $p['columnId'], $p['name'], $p['weight'], $p['description'], $p['assignedUserId']);
            $dao = new TaskDAO;
            $column = $dao->update($column);
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($column);
    }

    public function delete($request, $response, $args)
    {
        try {
            $id = $args['id'];
            $dao = new TaskDAO;
            $dao->delete($id);
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withStatus(204);
    }

    public function findAll($request, $response, $args)
    {
        try {
            $dao = new TaskDAO;
            $columns = $dao->findAll();
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($columns);
    }

    public function findById($request, $response, $args)
    {
        try {
            $id = $args['id'];
            $dao = new TaskDAO;
            $column = $dao->findById($id);
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($column);
    }

    public function findByColumnId($request, $response, $args)
    {
        try {
            $columnId = $args['columnId'];
            $dao = new TaskDAO;
            $column = $dao->findByColumnId($columnId);
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($column);
    }

    public function findByAssignedUserId($request, $response, $args)
    {
        try {
            $assignedUserId = $args['assignedUserId'];
            $dao = new TaskDAO;
            $column = $dao->findByAssignedUserId($assignedUserId);
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($column);
    }

}