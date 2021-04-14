<?php
include '../database/bd.php';

$objBD = new bd();

if (!empty($_POST['nome'])) {
    $dados = [
        "id" => $_POST['id'],
        "nome" => $_POST['nome'], "telefone" => $_POST['telefone'],
        "cpf" => $_POST['cpf']
    ];
    if (!empty($_POST['id'])) {
        $objBD->update($dados);
    } else {
        $objBD->insert($dados);
    }

    header("location:UsuarioList.php");
} elseif (!empty($_GET['id'])) {
    $result = $objBD->find($_GET['id']);
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina</title>
</head>
<body>
        <form action="UsuarioForm.php" method="post">
        <h3>Formulario usuario</h3>

        <input type="hidden" name="id" value="<?php echo !empty($result->id) ? $result->id : "" ?>" required><br><br>

            <label for="">Nome</label>
            <input type="text" name="nome" id="" value="<?php echo !empty($result->nome) ? $result->nome : "" ?>" required><br>

            <label for="">Telefone</label>
            <input type="text" name="telefone" id="" value="<?php echo !empty($result->telefone) ? $result->telefone : "" ?>" required><br><br>

            <label for="">CPF</label>
            <input type="text" name="cpf" id="" value="<?php echo !empty($result->cpf) ? $result->cpf : "" ?>" required><br><br>
            <input type="submit" value="Salvar">
            <a href="./UsuarioList.php">Voltar</a>
            </form>
</body>
</html>