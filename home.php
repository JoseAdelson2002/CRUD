<?php

if(isset($_POST['btn-usuario'])):
    header('Location: usuario.php');
endif;

if(isset($_POST['btn-adm'])):
    header('Location: adm.php');
endif;

if(isset($_POST['btn-mantem'])):
    header('Location: mantem.php');
endif;

?>

<html>
<head>
    <title>CRUD</title>
    <meta charset="utf-8">
</head>
<body>
 <h1> CRUD </h1>

<hr>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<button type="submit" name="btn-usuario"> CRUD Usuario </button>
<button type="submit" name="btn-adm"> CRUD ADM </button>
<button type="submit" name="btn-mantem"> CRUD Mantem </button>

</form>   

</body>
</html>