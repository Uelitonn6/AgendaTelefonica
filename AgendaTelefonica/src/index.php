<?php
   session_start(); //Iniciar Sessao
   ob_start(); //Limpar buffer de saida 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style/index.css" />
    <title>Agenda Telefônica</title>
</head>
<body>
    
    <div class="boxHeader">
        <h1>Agenda Telefônica</h1>
        <nav class="boxNav">
            <a href="list.php">Listar</a><br>
            <a href="index.php">Cadastrar</a><br>
        </nav>
    </div>
    
    <?php
        require './Connection.php';
        require './User.php';
        
        //Obter dados do Input
        $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if(!empty($formData['sendAddUser'])) {

            $createUser = new User();
            $createUser->formData = $formData;
            $isCreatedUser = $createUser->create();

            if($isCreatedUser) {
                $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
                header("Location: list.php");
            } else {
                echo "<p style='color: red;'>Erro: Usuário não cadastrado!</p>";
            }
        }
    ?>
    <h2>Cadastrar usuários</h2>
    <form class="formBox" name="CreateUser" method="POST" action="">
        <label>Nome: </label>
        <input type="text" name="name" placeholder="Nome completo" required />
        <br><br>

        <label>Telefone: </label>
        <input type="text" name="telefhone" placeholder="Telefone" required />
        <br><br>

        <input class="buttonCadastrar" type="submit" value="Cadastrar" name="sendAddUser" />
    </form>
</body>
</html>