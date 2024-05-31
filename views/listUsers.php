<?php 
/*LISTAR OS USUÁRIOS, MAIS AS MODALS: UPDATE, DELETE, INSERT*/
session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../assets/img/prova.png" />
    <title>PROVA-PHP-DISP</title>
</head>
<br><br>
<body>
<div class="col-lg-12 mx-auto p-4 py-md-5">      
    <div class="card border-dark" style="text-align: center;">
        <div class="card-header  text-white bg-dark">
          PROVA-PHP-ENTREVISTA-DESENVOLVEDOR IMPLANTADOR DE SISTEMAS PLENO
        </div>
        <div class="card-body">
            <h5 class="card-title">PROVA-PHP</h5>
            <p class="card-text">CRUD SIMPLES por: <a href="https://www.linkedin.com/in/saulodeassis/" target="_blank">saulo De Assis Ruas Fernandes</a></p>
            <button type='button' class='btn btn-primary'data-bs-toggle='modal' data-bs-target='#cria'>Criar Usuário</button>  <a href="../index.php" class="btn btn-primary">Home</a>   
        </div>
        <div class="card-header  text-white bg-dark">
          PROVA-PHP-DISP
        </div>
    </div>

    <br>
    <h3 class="lista_de_usuarios">Lista de Usuários</h3>
    <br>
    <?php

    require '../connection.php';
    $connection = new Connection();
    $users = $connection->query("SELECT users.id, 
                                    users.name, 
                                    users.email, 
                                    colors.value, 
                                    colors.name as cor,
                                    user_colors.color_a as color_a,
                                    user_colors.color_b as color_b,
                                    user_colors.color_c as color_c,
                                    user_colors.color_d as color_d 
                                FROM users
                                LEFT JOIN user_colors ON user_colors.user_id = users.id 
                                LEFT JOIN colors ON colors.id = user_colors.color_id");
    ?>

    <!-- LISTA USUÁRIOS -->
    <div class='table-responsive'>
     <table class='table table-striped table-hover'>
            <tr class="table-dark">
                <th>ID</th>    
                <th>Nome</th>    
                <th>Email</th>
                <th>Color</th>
                <th colspan="2">Ação</th>    
            </tr>

            <?php
            foreach($users as $user) {

            echo "
            <tr>
                    <td class='$user->value'><font color='$user->color_a'>$user->id</font></td>
                    <td class='$user->value'><font color='$user->color_b'>$user->name</font></td>
                    <td class='$user->value'><font color='$user->color_c'>$user->email</font></td>
                    <td class='$user->value'><font color='$user->color_d'>$user->cor</font></td>
                    <td class='$user->value'>
                    <button type='button' class='btn btn-primary btn-sm'data-bs-toggle='modal' data-bs-target='#id_$user->id'>Editar</button>
                    </td>
                    <td class='$user->value'>
                    <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#delete_$user->id'>Excluir</button>
                    </td>
            </tr>"; }
     echo "</table>";
    echo "</div>";

    //QUERY PDA MODAL QUE EDITA O USUÁRIO
    $users = $connection->query("SELECT users.id, 
                                    users.name, 
                                    users.email, 
                                    colors.value as value_color, 
                                    colors.name as name_color,
                                    user_colors.color_a as color_a,
                                    user_colors.color_b as color_b,
                                    user_colors.color_c as color_c,
                                    user_colors.color_d as color_d 
                                FROM users
                                LEFT JOIN user_colors ON user_colors.user_id = users.id 
                                LEFT JOIN colors ON colors.id = user_colors.color_id");

    foreach($users as $user) { 

      //MODAL EDITAR OS DADOS DO USUÁRIO
      echo '<div class="modal fade" id="id_'.$user->id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dados do Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
            <!-- CORPO DO MODAL -->

                <form method="POST" action="../controllers/updateUsers.php">
                <input type="hidden" id="id" name="id" value="'.$user->id.'">

                    <div class="form-group form-row">

                    <div class="col">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="name" id="name" value="'.$user->name.'">
                        <br>
                    </div>

                    <div class="col">
                        <label for="email">E-mail</label>
                        <input type="text" class="form-control" name="email" id="email" value="'.$user->email.'">
                        <br>
                    </div>

                    <label for="">Escolha a Cor da Linha</label>
                    <select name="color" class="form-select" aria-label="Default select example">';

                    echo '<option value="'.$user->value_color.'" selected>'.$user->name_color.'</option>';                        
          
                    $colors = $connection->query("SELECT * FROM colors");

                    foreach ($colors as $color) {
                        
                        echo ' <option value="'.$color->value.'">'.$color->name.'</option>' ; 
                    } 

                    echo '
                        <br>
                    </select>

                    <div class="col">
                    <br>
                    <label for="">Cores das Linhas Disponíveis: </label>
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
                <!-- FIM DO CORPO DO MODAL -->
                </div>

                <div class="col 7">
                <label for="name">Escolha a cor da formatação desejada dos texto da  lista, conforme abaixo: </label><br>
                <label for="name">ID:
                 <input 
                       type="color" 
                       name="color_a"
                       value="'.$user->color_a.'"
                 > 
                 </label>
                 <label for="name">Nome:
                 <input 
                       type="color" 
                       name="color_b"
                       value="'.$user->color_b.'"
                 >
                 </label>
                 <label for="name">Email:
                 <input 
                       type="color" 
                       name="color_c"
                       value="'.$user->color_c.'"
                 > 
                 <label for="name">Color:
                 <input 
                       type="color" 
                       name="color_d"
                       value="'.$user->color_d.'"
                 > 
                 <br>
                </div>
                <br>                

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>

                </form>

            </div>
            </div>
        </div>';
    } 


    //MODAL DELETANDO USUÁRIO
    $users = $connection->query("SELECT id, name FROM users");

    foreach($users as $user) {
        echo sprintf('
        <div class="modal fade" id="delete_%s" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dados do Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <!-- CORPO DO MODAL -->

                    <form method="POST" action="../controllers/deleteUsers.php">
                    <input type="hidden" id="id" name="id" value="%s">

                        <div class="form-group form-row">

                        <div class="col">
                            <label for="name">Você tem certeza que deseja excluir o usuário</label>
                            %s?
                            <br>
                        </div>
                        </div>
                    <!-- FIM DO CORPO DO MODAL -->
                </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                    </div>
                </form>
            </div>
            </div>
        </div>', $user->id, $user->id, $user->name);}

    $colors = $connection->query("SELECT * from colors"); 
    ?>
    <!--MODAL CRIAR USUÁRIO-->

    <div class="modal fade" id="cria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Cadastrar Usuário</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="../controllers/insertUsers.php">
                        <div class="form-group form-row">

                        <div class="col">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="name" value="" required>
                            <br>
                        </div>

                        <div class="col">
                            <label for="email">E-mail</label>
                            <input type="text" class="form-control" name="email" value="" required>
                            <br>
                        </div>

                        <label for="">Escolha a Cor da Linha</label>
                        <select class="form-select" aria-label="Default select example" name="color">
                            <option value="" selected>Selecione...</option>
                            <?php foreach ($colors as $color) { 
                            echo ' <option value="'.$color->value.'">'.$color->name.'</option>' ; } ?>                
                            <br>
                        </select>

                        <div class="col">
                        <br>
                        <label for="">Cores das Linhas Disponíveis: </label>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                  </form>
              </div>
          </div>
        </div>
   </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

<script>
	<?php if(isset($_SESSION['insere'])){?>
            alert('<?php 
							echo $_SESSION["insere"]; 
							unset( $_SESSION["insere"]);
				  }?>');
</script>
<script>
	<?php if(isset($_SESSION['update'])){?>
            alert('<?php 
							echo $_SESSION["update"]; 
							unset( $_SESSION["update"]);
				  }?>');
</script>
<script>
	<?php if(isset($_SESSION['delete'])){?>
            alert('<?php 
							echo $_SESSION["delete"]; 
							unset( $_SESSION["delete"]);
				  }?>');
</script>
<script>
	<?php if(isset($_SESSION['!delete'])){?>
            alert('<?php 
							echo $_SESSION["!delete"]; 
							unset( $_SESSION["!delete"]);
				  }?>');
</script>

</body>
</html>