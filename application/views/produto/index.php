<?php
$base = __DIR__;
include $base . '\..\layout\menu.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">

   

    <title>Lista de Produtos</title>
</head>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    h1 {
        color: #333;
        text-align: center;
    }

    .alert {
        margin: 20px 0;
        padding: 15px;
        border-radius: 4px;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #007bff;
        color: #fff;
    }

    .acao-botao-azul {
        background-color: #007bff;
        color: #fff;
        padding: 5px 10px;
        text-decoration: none;
        display: inline-block;
        border: none;
        cursor: pointer;
        font-weight: bold;
        margin-right: 10px;
        transition: background-color 0.3s;
    }

    .acao-botao-azul:hover {
        background-color: #0056b3;
    }
</style>

<body>
    <h1>Lista de Produtos</h1>
    <?php if (isset($data['msg-deletar'])) { ?>
        <div class="alert alert-danger" role="alert">Produto deletado com sucesso</div>
    <?php } ?>
    <p><a href="/produto/cadastrar" class="acao-botao-azul">Adicionar Produto</a></p>
    <table>
        <thead>
            <th>Código</th>
            <th>Nome</th>
            <th>Marca</th>
            <th>Preço</th>
            <th>Imagem</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php foreach ($data['produtos'] as $produto) { ?>
                <tr>
                    <td><?= $produto->getCodigo() ?></td>
                    <td><?= $produto->getNome() ?></td>
                    <td><?= $produto->getMarca() ?></td>
                    <td><?= $produto->getPreco() ?></td>
                    <td><img src="<?= $produto->getImagem() ?>" alt="Sem imagem" style="width: 150px;  height: auto"></td>
                    <td>

                        <a href="/produto/iniciarEditar/<?= $produto->getCodigo() ?>" class="acao-botao-azul">Editar</a>

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmationModal<?= $produto->getCodigo() ?>">
                            Excluir
                        </button>


                        <div class="modal fade" id="confirmationModal<?= $produto->getCodigo() ?>" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel<?= $produto->getCodigo() ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmationModalLabel<?= $produto->getCodigo() ?>">Confirmação</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Tem certeza de que deseja excluir o produto?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteForm<?= $produto->getCodigo() ?>').submit()">Excluir</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Formulário de exclusão -->
                        <form id="deleteForm<?= $produto->getCodigo() ?>" action="/produto/deletar" method="POST">
                            <input type="hidden" value="<?= $produto->getCodigo() ?>" name="codigo" />
                        </form>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>