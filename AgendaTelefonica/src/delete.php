<?php 
   session_start();
   ob_start();

  $id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT); //Obter id

  //Verificando se o id tem valor
  if(!empty($id)) {
        require './Connection.php';
        require './User.php';

        $delete_user = new User();

        $delete_user->id = $id; //Atribuindo id para User

        $value = $delete_user->delete();

        if($value) {
            $_SESSION['msg'] = "<p style='color: green;'>Usuário apagado com sucesso!</p>";
             header("Location: list.php");
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Erro: Usuário nao apagado!</p>";
            header("Location: list.php");
        }


  } else {
    $_SESSION['msg'] = "<p style='color: red;'>Erro: Usuário nao encontrado!</p>";
    header("Location: list.php");
  }