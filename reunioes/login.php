<?php
include_once 'conexao.php';
?>

<body style="background-image:  url('img/sala.png'); height: 100px;background-size: 100% 650px;background-repeat: no-repeat;
  background-attachment: fixed">
    <?php
    include 'menu.php';
    ?>
    <div class="row" style="width: 100%;">
        <div class="col-4"></div>
        <div class="col-4" style="margin-bottom: 25px; margin-top: 5px;width: 100%;">
            <div class="col-sm text-center">
                <form method="POST" action="verifica_login.php" class="form-signin">
                    <img class="mb-4" src="img/logo.png" style=" width:250px;">
                    <b>
                        <h1 style="text-shadow: 0.1em 0.1em 0.2em black" class="h1 text-white mb-3 font-weight-normal">Agendamento de Salas</h1>
                    </b>
                    <label for="inputEmail" class="sr-only">E-mail:</label>
                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
                    <label for="inputPassword" class="mt-3 sr-only">Senha:</label>
                    <input type="password" name="senha" id="inputPassword" class="form-control mt-2" placeholder="Senha" required>
                    <button class="btn btn-dark mt-3 text-white btn-lg btn-block" type="submit">LOGIN</button>
                    <p class="mt-5  text-white ">&copy;2020 Mantiqueira Distribuidora - Tecnologia da Informação</p>
                </form>
            </div>
        </div>
        <div class="col-4"></div>
    </div>
</body>