<?php

include_once '../model/entity/Board.php';
include_once '../model/dao/BoardDAO.php';


class BoardController
{

    public function insert($request, $response, $args)
    {
        $p = $request->getParsedBody();
        $produto = new Produto(0, $p['nome'], $p['preco']);

        $dao = new ProdutoDAO;
        $produto = $dao->inserir($produto);

        return $response->withJson($produto, 201);
    }

    public function update($request, $response, $args)
    {
        $id = $args['id'];
        $p = $request->getParsedBody();
        $produto = new Produto($id, $p['nome'], $p['preco']);

        $dao = new ProdutoDAO;
        $produto = $dao->atualizar($produto);

        return $response->withJson($produto);
    }

    public function delete($request, $response, $args)
    {
        $id = $args['id'];

        $dao = new ProdutoDAO;
        $produto = $dao->deletar($id);

        return $response->withJson($produto);
    }

    public function findAll($request, $response, $args)
    {
        $dao = new ProdutoDAO;
        $produtos = $dao->listar();

        return $response->withJson($produtos);
    }

    public function findById($request, $response, $args)
    {
        $id = $args['id'];

        $dao = new ProdutoDAO;
        $produto = $dao->buscarPorId($id);

        return $response->withJson($produto);
    }

}