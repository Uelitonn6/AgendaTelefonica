<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style/index.css" />
    <title>Agenda Telefônica</title>
</head>
<body class="configRoot">
        <div class="boxHeader">
            <h1>Agenda Telefônica</h1>
            <nav class="boxNav">
                <a href="list.php">Listar</a><br>
                <a href="index.php">Cadastrar</a><br>
            </nav>
        </div>
    
        <h2>Listar usuários</h2>

        <div class="listBox">
            <?php
                if(isset($_SESSION['msg'])) {
                    echo $_SESSION['msg']; //Imprimir oque estiver em Session
                    unset($_SESSION['msg']); //Destruir oque estiver em Session
                }

                require './Connection.php';
                require './User.php';

                $listUsers = new User();
                $result_users = $listUsers->list(); //Recebendo o array com os dados

                //Listar todos Users
                foreach($result_users as $row_user) {
                    extract($row_user); //Extrair dados do Array 

                    echo "<div class='boxContent'>";
                    echo "Nome: $name<br>";
                    echo "Telefone: $telefhone<br>";
                    echo "<div class='linksBox'>";
                    echo "<a class='visualizar' href='view.php?id=$id'>Visualizar</a><br>";
                    echo "<a class='editar' href='edit.php?id=$id'>Editar</a><br>";
                    echo "<a class='apagar' href='delete.php?id=$id'>Apagar</a><br>";
                    echo "</div>";
                    echo "</div>";
                }
            ?>
    </div>
</body>
</html>