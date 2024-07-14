<?php
    session_start();

    ob_start();

    //Receber o Id do usuario
    $id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/index.css" />
    <title>Document</title>
</head>
<body>
        <div class="boxHeader">
            <h1>Agenda Telefônica</h1>
            <nav class="boxNav">
                <a href="list.php">Listar</a><br>
                <a href="index.php">Cadastrar</a><br>
            </nav>
        </div>
    
        <h2>Detalhes do usuários</h2>
    
    <?php
        if(isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION);
        }

        //Verificar se o Id existe
        if(!empty($id)) {
            require './Connection.php';
            require './User.php';

            $viewUser = new User();
            $viewUser->id = $id;
            $valueUser = $viewUser->view();

            extract($valueUser);

            echo "ID do usuario: $id<br>";
            echo "Nome do usuario: $name<br>";
            echo "Telefone do usuario: $telefhone<br>";
            echo "Cadastrado: " . date('d/m/Y H:i:s', strtotime($created)) ."<br>";

            echo "Editado: ";
            if(!empty($modified)) {
                echo date('d/m/Y H:i:s', strtotime($modified));
            }
            echo " <br>";

        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Erro: Usuário nao encontrado!</p>";
            header("Location: list.php");
        }

        
    ?>
</body>
</html>