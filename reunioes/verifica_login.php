<?php

$link = mysqli_connect("localhost", "root", "", "calendario")or die
 ("Sem conexão com o servidor");

$email = $_POST['email'];
$senha = $_POST['senha'];
$sql = "SELECT email,senha,id_user FROM `user` WHERE `email` = '$email' AND `senha`= '$senha'";
$result = mysqli_query($link, $sql);
$num_rows = mysqli_num_rows($result);
    if($num_rows > 0){
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        

        header('location:index.php');
    }
    else{
        echo "teste2";
        unset ($_SESSION['email']);
        unset ($_SESSION['senha']); 
        header('location:login.php');
    }
?>