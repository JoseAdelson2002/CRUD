<html>
<head>
    <title>ADM</title>
    <meta charset="utf-8">
</head>
<body>
 <h1> ADM </h1>

<hr>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
ID_ADM: <input type="number" name="id_adm"><br>
CPF: <input type="number" name="cpf"><br>
<button type="submit" name="btn-create"> Inserir </button>
<button type="submit" name="btn-read"> Consultar </button>
<button type="submit" name="btn-update"> Atualizar </button>
<button type="submit" name="btn-delete"> Deletar </button>

<h3>Manual: Para inserir e atualizar precisa preencher todos os dados, para consultar e deletar apenas o id_adm </h3>

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
    
    $id_adm = $_POST["id_adm"];
    $cpf = $_POST["cpf"];    

    if(empty($id_adm) or empty($cpf)):
        $erros[] = "<li> O campo id_adm/cpf precisa ser preenchido </li>";
    else:
        $sql = "INSERT INTO ADM (id_adm, cpf) VALUES ('$id_adm', '$cpf')";
          
        if ($connect->query($sql) === TRUE) {
        echo "Registro inserido com sucesso!";
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_connect_error();
            echo "Chave estrangeira não encontrada<br>";
        } endif;
endif;

//READ
if(isset($_POST['btn-read'])):

    $id_adm = $_POST["id_adm"];

    if(empty($id_adm)):
        $erros[] = "<li> O campo id_adm precisa ser preenchido </li>";
    else:
        $sql = "SELECT * FROM ADM WHERE id_adm='$id_adm'";
        $result = $connect->query($sql);

        if ($result !== false && $result->num_rows == 1) {
            $registro = $result->fetch_assoc();
            echo "ID_ADM: " . $registro["id_adm"] ."<br>". "CPF: " . $registro["CPF"];
        } else {
            echo "Registro não encontrado ou erro na consulta.";
        }endif;
endif;

//UPDATE
if(isset($_POST['btn-update'])):

    $id_adm = $_POST["id_adm"];
    $cpf = $_POST["cpf"];

    if(empty($id_adm) or empty($cpf)):
        $erros[] = "<li> O campo id_adm/cpf precisa ser preenchido </li>";
    else:     
        $sql = "UPDATE ADM SET cpf='$cpf' WHERE id_adm='$id_adm'";

        if ($connect->query($sql) === TRUE) {
            echo "Registro atualizado com sucesso!";
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_connect_error();
            echo "Chave estrangeira não encontrada<br>";
        }endif;
endif;

//DELETE
if(isset($_POST['btn-delete'])):
    $id_adm = $_POST["id_adm"];
    
    if(empty($id_adm)):
        $erros[] = "<li> O campo id_adm precisa ser preenchido </li>";
    else:
        $sql = "DELETE FROM ADM WHERE id_adm='$id_adm'";
        
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