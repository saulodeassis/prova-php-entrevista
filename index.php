<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link href="assets/css/style.css" rel="stylesheet" />
    <link rel="shortcut icon" href="assets/img/prova.png" />
    <title>PROVA-PHP-DISP</title>
</head>
<br><br>
<body>
<div class="col-lg-12 mx-auto p-4 py-md-5"> 
    <div class="card border-dark" style="text-align: center;">
    <div class="card-header text-white bg-dark">
    PROVA-PHP-ENTREVISTA-DESENVOLVEDOR IMPLANTADOR DE SISTEMAS PLENO
    </div>
        <div class="card-body">
            <h5 class="card-title">PROVA-PHP</h5>
            <p class="card-text">CRUD SIMPLES por: <a href="https://www.linkedin.com/in/saulodeassis/" target="_blank">saulo De Assis Ruas Fernandes</a></p>

            <button type='button' class='btn btn-primary'data-bs-toggle='modal' data-bs-target='#id'>Criar Usuário</button>  <a href="views/listUsers.php" class="btn btn-primary">Listar Usuários</a>

        </div>

    <div class="card-header  text-white bg-dark">
        PROVA-PHP-DISP
    </div>
    </div>
</div>    
<?php

require 'connection.php';
$connection = new Connection();
$colors = $connection->query("SELECT * from colors");

?>
<!--MODAL QUE CRIA USUÁRIOS-->
<div class="modal fade" id="id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cadastrar Usuário</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="controllers/insertUsers.php">
                    <div class="form-group form-row">

                    <div class="col">
                        <label>Nome</label>
                        <input type="text" class="form-control" name="name" value="" required>
                        <br>
                    </div>
                    <div class="col">
                        <label>E-mail</label>
                        <input type="text" class="form-control" name="email" value="" required>
                        <br>
                    </div>

                    <label>Escolha a Cor da Linha</label>
                    <select class="form-select" aria-label="Default select example" name="color">
                        <option value="" selected>Selecione...</option>
                        
                        <?php foreach ($colors as $color) { 
                          echo ' <option value="'.$color->value.'">'.$color->name.'</option>' ; 
                        } ?>

                        <br>
                    </select>

                    <div class="col">
                    <br>

                    <label for="">Cores Disponíveis:</label>
                    <table class="table">
                    <tr>
                        <td class="table-primary">Azul</td>
                        <td class="table-secondary">Cinza</td>
                        <td class="table-success">Verde</td>
                        <td class="table-danger">Vermelho</td><br>
                    </tr>
                    <tr> 
                        <td class="table-warning">Amarelo</td>
                        <td class="table-info">Verde Limão</td>
                        <td class="table-light">Branco</td>
                        <td class="table-dark">Preto</td>
                    </tr>
                    </table>

                    </div>
            </div>
            <div class="col 7">
               <label for="name">Escolha a cor da formatação desejada dos texto da  lista, conforme abaixo: </label><br>
               <label for="name">ID:
                <input 
                      type="color" 
                      value="#000000" 
                      name="color_a"
                > 
                </label>
                <label for="name">Nome:
                <input 
                      type="color" 
                      value="#000000" 
                      name="color_b"
                >
                </label>
                <label for="name">Email:
                <input 
                      type="color" 
                      value="#000000" 
                      name="color_c"
                > 
                <label for="name">Color:
                <input 
                      type="color" 
                      value="#000000" 
                      name="color_d"
                > 
                <br>
          </div>
          <br>
        <div class="modal-footer">
          <input type="hidden" id="schedule_id" name="schedule_id" value="">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-success">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>