<?php
include '../database/bd.php';

$objBD = new bd();

if (!empty($_POST['valor'])) {
    $result = $objBD->search($_POST);
} else {
    $result = $objBD->select();
}
    if (!empty ($_GET['id'])) {
        $objBD -> remove($_GET['id']);
        header ("location: UsuarioList.php");
    }

?>

<?php
include "./head.php";
?>



<h4> Listagem de usuários </h4>
<form action="UsuarioList.php" method="post">
        <input type="text" name="valor" id="">

        <select name="tipo" id="">
            <option value="nome">Nome</option>
            <option value="cpf">CPF</option>
            <option value="telefone">Telefone</option>
        </select>
        <input type="submit" value="Buscar">
    </form>
<a href="../index.php">Voltar</a>
<a href="./UsuarioForm.php">Cadastrar</a>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col"> ID </th>
            <th scope="col"> Nome </th>
            <th scope="col"> Telefone </th>
            <th scope="col"> CPF </th>
            <th scope="col"> Ação </th>
            <th scope="col"> Ação </th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($result as $item) {
            $item = (object) $item;
            echo "
        <tr>
            <td  scope='row'>" . $item->id . "</td>
            <td>" . $item->nome . "</td>
            <td>" . $item->telefone . "</td>
            <td>" . $item->cpf . "</td>
            <td> <a href= 'UsuarioForm.php?id= " . $item->id . "'> Editar </a></td>
            <td> <a href= 'UsuarioList.php?id= " . $item->id . "'onclick=\" return confirm ('Deseja realmente remover o registro?'); \" > Remover </a></td>
        </tr>
        ";
        }
        ?>
    </tbody>
</table>
<?php
include "./footer.php";
?>
