<?php
//Conexão
require_once 'db_connect.php';

//Sessão
session_start();

//Botão enviar
if(isset($_POST['btn-entrar'])):
    $erros = array();
    $email = mysqli_escape_string($connect, $_POST['email']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);

    if(empty($email) or empty($senha)):
        $erros[] = "<li> O campo email/senha precisa ser preenchido </li>";
    else:
        $sql = "SELECT email FROM Usuario WHERE email = '$email'";
        $resultado = mysqli_query($connect, $sql);

        if(mysqli_num_rows($resultado) > 0):

            $sql = "SELECT * FROM Usuario WHERE email = '$email' AND senha = '$senha'";
            $resultado = mysqli_query($connect,$sql);

            if(mysqli_num_rows($resultado) == 1):
                $dados = mysqli_fetch_array($resultado);
                mysqli_close($connect);
                $_SESSION['logado'] = true;
                $_SESSION['id_usuario'] = $dados['id'];
                header('Location: home.php');
            else:
                $erros[] = "<li> Usuário e senha inválidos";
            endif;

        else:
            $erros[] = "<li> Usuário inexistente </li>";
        endif;

    endif;

endif;

?>


<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
</head>
<body>
 <h1> Login </h1>

<?php
if(!empty($erros)):
    foreach($erros as $erro):
        echo $erro;
    endforeach;
endif;
?>

<hr>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
Login: <input type="text" name="email"><br>
Senha: <input type="password" name="senha"><br>
<button type="submit" name="btn-entrar"> Entrar </button>

</form>   

</body>
</html>