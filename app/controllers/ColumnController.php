<?php

include_once './app/model/entity/Column.php';
include_once './app/model/dao/ColumnDAO.php';
include_once './app/model/dao/TaskDAO.php';

class ColumnController
{

    private function validate(Column $column)
    {
        if (empty($column)) {
            throw new Exception("'Column' is required!");
        }
        if (!$column->boardId) {
            throw new Exception("nameField 'boardId' is required!");
        }
        if (!$column->name || !trim($column->name)) {
            throw new Exception("nameField 'nome' is required!");
        }
        if (!$column->weight) {
            throw new Exception("nameField 'weight' is required!");
        }
    }

    public function insert($request, $response, $args)
    {
        try {
            $p = $request->getParsedBody();
            $column = new Column(0, $p['boardId'], $p['name'], $p['weight']);
            $this->validate($column);
            $dao = new ColumnDAO;
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
            $column = new Column($id, $p['boardId'], $p['name'], $p['weight']);
            $this->validate($column);
            $dao = new ColumnDAO;
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
            $dao = new ColumnDAO;
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
            $dao = new ColumnDAO;
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
            $eager = $request->getQueryParam('eager');
            $dao = new ColumnDAO;
            $column = $dao->findById($id);
            if ($eager == 'true') {
                $taskDAO = new TaskDAO;
                $column->tasks = $taskDAO->findByColumnId($column->id);
            }
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($column);
    }

    public function findByBoardId($request, $response, $args)
    {
        try {
            $boardId = $args['boardId'];
            $eager = $request->getQueryParam('eager');
            $dao = new ColumnDAO;
            $columns = $dao->findByBoardId($boardId);
            if ($eager == 'true' && !empty($columns)) {
                foreach ($columns as &$column) {
                    $taskDAO = new TaskDAO;
                    $column->tasks = $taskDAO->findByColumnId($column->id);
                }
            }
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($columns);
    }

}