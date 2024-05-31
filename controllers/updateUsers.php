<?php 

session_start();

require '../connection.php';
$connection = new Connection();
header ("Location: ../views/listUsers.php");
$id = addslashes($_POST["id"]);
$name = addslashes($_POST["name"]);
$email = addslashes($_POST["email"]);
$color = $_POST["color"];

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


$insert = $connection->query("UPDATE users SET name = '$name', email = '$email' WHERE id = $id ");

$connection = new Connection();
$getIdUserUpdateCount = $connection->query("SELECT count(user_colors.user_id) as teste FROM user_colors WHERE user_colors.user_id=$id");

$countUp= '';
foreach ($getIdUserUpdateCount  as $countUpdate) {

   var_dump($countUpdate->teste);
   $countUp= $countUpdate->teste;

}
if($countUp > 0){
    var_dump('caiu aqui no update');
    $connection = new Connection();
    $getIdUserUpdate = $connection->query("SELECT user_colors.user_id as teste FROM user_colors WHERE user_colors.user_id=$id");

    foreach ($getIdUserUpdate  as $idUserUpdate) {       

        $insert = $connection->query("UPDATE user_colors 
                                      SET color_id = '$color', 
                                          color_a = '$color_a',
                                          color_b = '$color_b',
                                          color_c = '$color_c',
                                          color_d = '$color_d'
                                      WHERE user_id  = $id ");
    }
    $countUp= '';
}    

if($countUp == 0){
    var_dump('caiu aqui no insert');
    $connection = new Connection();
    $getIdUser = $connection->query("SELECT users.id FROM users WHERE users.id= $id");

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
    $countUp= '';
}

$_SESSION["update"] = "$name alterado(a) com sucesso!";
header ("Location: ../views/listUsers.php");