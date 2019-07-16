<?php

include_once './app/model/entity/Task.php';
include_once './app/model/dao/TaskDAO.php';

class TaskController
{

    private function validate(Task $task)
    {
        if (empty($task)) {
            throw new Exception("'Task' is required!");
        }
        if (!$task->columnId) {
            throw new Exception("nameField 'columnId' is required!");
        }
        if (!$task->name || !trim($task->name)) {
            throw new Exception("nameField 'nome' is required!");
        }
        if (!$task->weight) {
            throw new Exception("nameField 'weight' is required!");
        }
    }

    public function insert($request, $response, $args)
    {
        try {
            $p = $request->getParsedBody();
            $task = new Task(0, $p['columnId'], $p['name'], $p['weight'], $p['description'], $p['assignedUserId']);
            $this->validate($task);
            $dao = new TaskDAO;
            $task = $dao->insert($task);
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($task, 201);
    }

    public function update($request, $response, $args)
    {
        try {
            $id = $args['id'];
            $p = $request->getParsedBody();
            $task = new Task($id, $p['columnId'], $p['name'], $p['weight'], $p['description'], $p['assignedUserId']);
            $this->validate($task);
            $dao = new TaskDAO;
            $task = $dao->update($task);
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($task);
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
            $tasks = $dao->findAll();
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($tasks);
    }

    public function findById($request, $response, $args)
    {
        try {
            $id = $args['id'];
            $dao = new TaskDAO;
            $task = $dao->findById($id);
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($task);
    }

    public function findByColumnId($request, $response, $args)
    {
        try {
            $columnId = $args['columnId'];
            $dao = new TaskDAO;
            $task = $dao->findByColumnId($columnId);
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($task);
    }

    public function findByAssignedUserId($request, $response, $args)
    {
        try {
            $assignedUserId = $args['assignedUserId'];
            $dao = new TaskDAO;
            $task = $dao->findByAssignedUserId($assignedUserId);
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($task);
    }

}