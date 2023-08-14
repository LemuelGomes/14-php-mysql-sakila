<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <title>:: Pesquisa de Filmes - SAKILA ::</title>
</head>
<body>

    <form action="index.php" method="POST">
        <div class="mb-3">
            <label for="" class="form-label">Filme a procurar...</label>
            <input type="text" name="campo_pesquisar" class="form-control" id="" aria-describedby="">
        </div>
        <button type="submit" class="btn btn-primary">Pesquisar</button>
    </form>

    <?php
    if (isset($_POST['campo_pesquisar'])) {

    $servidor = 'localhost';
    $usuario = 'root';
    $senha = '';
    $base = 'sakila';

    $conexao = new mysqli($servidor, $usuario, $senha, $base);
    $sql = 'SELECT filme.filme_id, filme.titulo, filme.ano_de_lancamento, categoria.nome FROM filme INNER JOIN filme_categoria ON (filme_categoria.filme_id = filme.filme_id) INNER JOIN categoria ON (filme_categoria.categoria_id = categoria.categoria_id) WHERE titulo LIKE "%' . $_POST['campo_pesquisar'] . '%";';
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {

        echo '<table class="table">';
        echo '<thead>';
        echo '    <tr>';
        echo '        <th scope="col">ID do Filme</th>';
        echo '        <th scope="col">Título</th>';
        echo '        <th scope="col">Ano de Lançamento</th>';
        echo '        <th scope="col">Categoria</th>';
        echo '    </tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($linhas = $resultado->fetch_assoc()) {
            echo '<tr>';
            echo '    <th scope="row">' . $linhas['filme_id'] . '</th>';
            echo '    <td>' . $linhas['titulo'] . '</td>';
            echo '    <td>' . $linhas['ano_de_lancamento'] . '</td>';
            echo '    <td>' . $linhas['nome'] . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } 

    $conexao->close();  
}      
    ?>
</body>
</html>