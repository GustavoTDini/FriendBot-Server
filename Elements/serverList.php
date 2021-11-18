<?php
function echoList($posts, $categorias)
{
    echo "<table class='table'>
                <thead>
                    <tr>
                        <th scope='col'>Código</th>
                        <th scope='col'>Título</th>
                        <th scope='col'>Categoria</th>
                        <th scope='col'>Alterar</th>
                        <th scope='col'>Apagar</th>
                    </tr>
                </thead>
                <tbody>";
    foreach ($posts as $post) {
        $codCategoria = $post[4];
        $categoria = $categorias[$codCategoria][0];
        echo "<tr>
                            <th scope='row'>$post[0]</th>
                            <td>$post[1]</td>
                            <td>$categoria</td>
                            <td><a href='alterar.php?cod=$post[0]' type='button' class='btn btn-primary'>Alterar</a></td>
                            <td><a href='excluir.php?cod=$post[0]' type='button' class='btn btn-danger'>Apagar</a></td>
                        </tr>";
    }
    echo "</tbody>
                </table>";
}

?>

