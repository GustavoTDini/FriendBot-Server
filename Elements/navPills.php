<?php
function echoPills($cat)
{
    $servidor = "localhost"; //conexão local
    $usuario = "root";      //o usuário administrador
    $senha = "";            //a senha-padrão do XAMPP é vazio
    $banco = "isaac_diary"; //nome do banco de dados

    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
    mysqli_set_charset($conexao, 'utf8');
    if (!$conexao) {
        die("PROBLEMA COM A CONEXÃO:" . mysqli_connect_error());
    }
    $consulta = "SELECT * FROM `categorias`";
    $resultado = mysqli_query($conexao, $consulta) or die("FALHA NA EXECUÇÃO DA CONSULTA:" . mysqli_connect_error());
    $categorias = mysqli_fetch_all($resultado);
    $homeActive = 'active';

    if (isset($cat)) {
        $homeActive = '';
    }

    echo '<ul class="nav nav-pills nav-justified mb-5">
                    <li class="nav-item">
                        <a class="nav-link ' . $homeActive . '" aria-current="page" href="index.php">Home</a>
                    </li>';
    foreach ($categorias as $categoria) {
        $currCatCod = $categoria[0];
        $currCat = $categoria[1];
        $active = '';
        if ($currCatCod == $cat) {
            $active = 'active';
        }
        echo '<li class="nav-item">
                    <a class="nav-link ' . $active . '" href="index.php?cat=' . $currCatCod . '">' . $currCat . '</a>
                </li>';
    }
    echo ' </ul>';
}

