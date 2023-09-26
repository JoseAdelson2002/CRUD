<html>
<head>
    <title>Usuario</title>
    <meta charset="utf-8">
</head>
<body>
 <h1> Usuario </h1>

<hr>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
Email: <input type="text" name="email"><br>
Senha: <input type="password" name="senha"><br>
<button type="submit" name="btn-create"> Inserir </button>
<button type="submit" name="btn-read"> Consultar </button>
<button type="submit" name="btn-update"> Atualizar </button>
<button type="submit" name="btn-delete"> Deletar </button>

<h3> Manual: Para inserir e atualizar tem que preencher email e senha, porém para as demais funções apenas o email(chave primária) </h3>

</form>   

</body>
</html>

<?php
//Conexão
require_once 'db_connect.php';

//Sessão
session_start();

//Verificação
if(!isset($_SESSION['logado'])):
    header('Location: index.php');
endif;

//------------------------------------------------CRUD------------------------------------------------------

//CREATE
if(isset($_POST['btn-create'])):
    
    $email = $_POST["email"];
    $senha = $_POST["senha"];    

    if(empty($email) or empty($senha)):
        $erros[] = "<li> O campo email/senha precisa ser preenchido </li>";
    else:
        $sql = "INSERT INTO Usuario (email, senha) VALUES ('$email', '$senha')";
            
        if ($connect->query($sql) === TRUE) {
        echo "Registro inserido com sucesso!";
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_connect_error();
        } endif;
endif;

//READ
if(isset($_POST['btn-read'])):

    $email = $_POST["email"];

    if(empty($email)):
        $erros[] = "<li> O campo email precisa ser preenchido </li>";
    else:
        $sql = "SELECT * FROM Usuario WHERE email='$email'";
        $result = $connect->query($sql);

        if ($result !== false && $result->num_rows == 1) {
            $registro = $result->fetch_assoc();
            echo "Email: " . $registro["email"] ."<br>". "Senha: " . $registro["senha"];
        } else {
            echo "Registro não encontrado ou erro na consulta.";
        }endif;
endif;

//UPDATE
if(isset($_POST['btn-update'])):

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if(empty($email) or empty($senha)):
        $erros[] = "<li> O campo email/senha precisa ser preenchido </li>";
    else:     
        $sql = "UPDATE Usuario SET senha='$senha' WHERE email='$email'";

        if ($connect->query($sql) === TRUE) {
            echo "Registro atualizado com sucesso!";
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_connect_error();
        }endif;
endif;

//DELETE
if(isset($_POST['btn-delete'])):
    $email = $_POST["email"];
    
    if(empty($email)):
        $erros[] = "<li> O campo email precisa ser preenchido </li>";
    else:
        $sql = "DELETE FROM Usuario WHERE email='$email'";
        
        if ($connect->query($sql) === TRUE) {
            echo "Registro deletado com sucesso!";
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_connect_error();
        }endif;
endif;

?>

<?php
if(!empty($erros)):
    foreach($erros as $erro):
        echo $erro;
    endforeach;
endif;
?>
