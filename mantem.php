<html>
<head>
    <title>Mantem</title>
    <meta charset="utf-8">
</head>
<body>
 <h1> Mantem </h1>

<hr>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
ID_alteração: <input type="number" name="id_alteracao"><br>
Email: <input type="text" name="email"><br>
ID_ADM: <input type="number" name="id_adm"><br>
Tipo_Alteração: <input type="text" name="tipo_alteracao"><br>
Data_Alteração: <input type="text" name="data_alteracao"><br>
<button type="submit" name="btn-create"> Inserir </button>
<button type="submit" name="btn-read"> Consultar </button>
<button type="submit" name="btn-update"> Atualizar </button>
<button type="submit" name="btn-delete"> Deletar </button>

<h3>Manual: Para inserir precisa preencher todos os dados</h3>
<h3>Manual: Para atualizar precisa preencher o id_alteração e/ou tipo_alteração/data_alteração</h3>
<h3>Manual: Para consultar ou deletar precisa apenas do id_alteração</h3>


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
    
    $id_alteracao = $_POST["id_alteracao"];
    $email = $_POST["email"];
    $id_adm = $_POST["id_adm"];
    $tipo_alteracao = $_POST["tipo_alteracao"]; 
    $data_alteracao = $_POST["data_alteracao"];   

    if(empty($id_adm) or empty($email) or empty($id_alteracao) or empty($tipo_alteracao) or empty($data_alteracao)):
        $erros[] = "<li> Todos os campos precisam ser preenchidos </li>";
    else:
        $sql = "INSERT INTO Mantem (id_alteracao, email, id_adm, tipo_alteracao, data_alteracao) VALUES ('$id_alteracao', '$email', '$id_adm', '$tipo_alteracao', '$data_alteracao')";
          
        if ($connect->query($sql) === TRUE) {
        echo "Registro inserido com sucesso!";
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_connect_error();
        } endif;
endif;

//READ
if(isset($_POST['btn-read'])):

    $id_alteracao = $_POST["id_alteracao"];

    if(empty($id_alteracao)):
        $erros[] = "<li> O campo id_alteracao precisa ser preenchido </li>";
    else:
        $sql = "SELECT * FROM Mantem WHERE id_alteracao='$id_alteracao'";
        $result = $connect->query($sql);

        if ($result !== false && $result->num_rows == 1) {
            $registro = $result->fetch_assoc();
            echo "ID_alteracao: " . $registro["id_alteracao"] ."<br>". "Email: " . $registro["email"] ."<br>". "ID_ADM: " . $registro["id_adm"] ."<br>". "Tipo_Alteração: " . $registro["tipo_alteracao"] ."<br>". "Data_Alteração: " . $registro["data_alteracao"];
        } else {
            echo "Registro não encontrado ou erro na consulta.";
        }endif;
endif;

//UPDATE
if(isset($_POST['btn-update'])):

    $id_alteracao = $_POST["id_alteracao"];
    $tipo_alteracao = $_POST["tipo_alteracao"];
    $data_alteracao = $_POST["data_alteracao"];

    if(empty($id_alteracao)):
        $erros[] = "<li> O campo id_alteracao precisa ser preenchido </li>";
    else: 
        if(!empty($tipo_alteracao) && empty($data_alteracao)):    
            $sql = "UPDATE Mantem SET tipo_alteracao='$tipo_alteracao' WHERE id_alteracao='$id_alteracao'";
        elseif(empty($tipo_alteracao) && !empty($data_alteracao)):
            $sql = "UPDATE Mantem SET data_alteracao='$data_alteracao' WHERE id_alteracao='$id_alteracao'";
        elseif(!empty($tipo_alteracao) && !empty($data_alteracao)):
            $sql = "UPDATE Mantem SET tipo_alteracao='$tipo_alteracao' ,data_alteracao='$data_alteracao' WHERE id_alteracao='$id_alteracao'";
        else: 
          echo "<li> O campo tipo_alteração ou data_alteração precisa ser preenchido </li>";
          $sql = "^";
        endif;
        if ($connect->query($sql) === TRUE) {
            echo "Registro atualizado com sucesso!";
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_connect_error();
        }endif;
endif;

//DELETE
if(isset($_POST['btn-delete'])):
    $id_alteracao = $_POST["id_alteracao"];
    
    if(empty($id_alteracao)):
        $erros[] = "<li> O campo id_alteracao precisa ser preenchido </li>";
    else:
        $sql = "DELETE FROM Mantem WHERE id_alteracao='$id_alteracao'";
        
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