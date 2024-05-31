<?php 

session_start();

if(isset($_POST["name"])  && !empty($_POST["name"]) && 
   isset($_POST["email"]) && !empty($_POST["email"])){

   require '../connection.php';
   $connection = new Connection();

   $name = addslashes($_POST["name"]);
   $email = addslashes($_POST["email"]);
   $color = addslashes($_POST["color"]);


   $color_a = addslashes($_POST["color_a"]);
   $color_b = addslashes($_POST["color_b"]);
   $color_c = addslashes($_POST["color_c"]);
   $color_d = addslashes($_POST["color_d"]);

   //verifica o value da cor inputada e trata para inserir na base
   switch ($color) {
      case $color == "table-primary": $color = 1; break; 
      case $color == "table-secondary": $color = 2; break; 
      case $color == "table-success": $color = 3; break; 
      case $color == "table-danger": $color = 4; break; 
      case $color == "table-warning": $color = 5; break; 
      case $color == "table-info": $color = 6; break; 
      case $color == "table-light": $color = 7; break; 
      case $color == "table-dark": $color = 8; break; 
      default: $color = 7; break; 
   }

   $connection = new Connection();
   $getIdUserCount = $connection->query("SELECT count(*) as user_count FROM users WHERE users.name='$name'");   
   $userCount = '';
   foreach ($getIdUserCount  as $idUserCount) {

      $userCount =  $idUserCount->user_count;

   }   
 
   if($userCount > 0){
      $userCount = '';
      $_SESSION["insere"] = "$name já cadastrado(a) com sucesso! :D";
      header ("Location: ../views/listUsers.php");
      exit();
   }
   

   $insert = $connection->query("INSERT INTO users(name, 
                                                   email
                                                   ) VALUES('$name', 
                                                            '$email' 
                                                            )
                                                            ");
   $connection = new Connection();
   $getIdUser = $connection->query("SELECT users.id FROM users WHERE users.name='$name'");    
   foreach ($getIdUser  as $idUser) {
      $insert = $connection->query("INSERT INTO user_colors(user_id, 
                                                            color_id,
                                                            color_a,
                                                            color_b,
                                                            color_c,
                                                            color_d) VALUES('$idUser->id', 
                                                                           '$color',
                                                                           '$color_a',
                                                                           '$color_b',
                                                                           '$color_c',
                                                                           '$color_d')");  
  }

   $_SESSION["insere"] = "$name cadastrado(a) com sucesso!";
   header ("Location: ../views/listUsers.php");
}