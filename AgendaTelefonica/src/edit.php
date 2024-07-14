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
    
        <h2>Editar usuários</h2>
   
    <?php
        if(isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION);
        }

        require './Connection.php';
        require './User.php';

        //Obter dados do Form
        $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        //Verificar se o user clicou no botao
        if(!empty($formData['sendEditUser'])) {
            $editUser = new User();
            $editUser->formData = $formData;
            $value = $editUser->edit();

            //Foi editado?
            if($value) {
                $_SESSION['msg'] = "<p style='color: green;'>Usuário editado com sucesso</p>";
                header("Location: list.php");
            } else {
                echo "<p style='color: red;'>Erro: Usuário nao editado!</p>";
            }
        }

        //Verificar se o Id existe
        if(!empty($id)) {
            $viewUser = new User();
            $viewUser->id = $id;
            $valueUser = $viewUser->view();

            extract($valueUser);

       ?>
            <form class="formBox" name="EditUser" method="POST" action="">
                <input type="hidden" type="number" name="id" value="<?php echo $id; ?>" />
                <label>Nome: </label>
                <input type="text" name="name" placeholder="Nome completo" value="<?php echo $name; ?>" required />
                <br><br>

                <label>Telefone: </label>
                <input type="text" name="telefhone" placeholder="Telefone" value="<?php echo $telefhone; ?>" required />
                <br><br>

                <input class="buttonCadastrar"  type="submit" value="Editar" name="sendEditUser" />
            </form>
       <?php

        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Erro: Usuário nao encontrado!</p>";
            header("Location: list.php");
        }

        
    ?>
</body>
</html>