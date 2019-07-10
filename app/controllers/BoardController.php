<?php

include_once './app/model/entity/Board.php';
include_once './app/model/dao/BoardDAO.php';
include_once './app/model/dao/ColumnDAO.php';
include_once './app/model/dao/TaskDAO.php';

class BoardController
{

    private function validate(Board $board)
    {
        if (empty($board)) {
            throw new Exception("'Board' is required!");
        }
        if (!$board->name || !trim($board->name)) {
            throw new Exception("nameField 'nome' is required!");
        }
    }

    public function insert($request, $response, $args)
    {
        try {
            $p = $request->getParsedBody();
            $board = new Board(0, $p['name'], $p['description']);
            $this->validate($board);
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
            $this->validate($board);
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
            $eager = $request->getQueryParam('eager');
            $dao = new BoardDAO;
            $board = $dao->findById($id);

            if ($eager == 'true') {
                $columnDAO = new ColumnDAO;
                $board->columns = $columnDAO->findByBoardId($id);
                if (!empty($board->columns)) {
                    foreach ($board->columns as &$column) {
                        $taskDAO = new TaskDAO;
                        $column->tasks = $taskDAO->findByColumnId($column->id);
                    }
                }
            }
        } catch (Exception $error) {
            var_dump($error->getMessage());
            return $response->withStatus(500);
        }
        return $response->withJson($board);
    }
}