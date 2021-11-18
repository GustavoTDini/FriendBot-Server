<?php
$headPath = "..\Elements\\head.php";
$headerPath = "..\Elements\\header.php";
$navPath = "..\Elements\\searchNav.php";
$navPillsPath = "..\Elements\\navPills.php";
$searchCardPath = "..\Elements\\searchCard.php";
$footerPath = "..\Elements\\footer.php";
$adPath = "..\Elements\\ad.php";
include($headPath);
echo '<body class="d-flex flex-column h-100">';
include($headerPath);
$search = $_GET['search'];

if (isset($_GET['search']) && $search != ''){
    $servidor = "localhost"; //conexão local
    $usuario  = "root";      //o usuário administrador
    $senha    = "";			//a senha-padrão do XAMPP é vazio
    $banco    = "isaac_diary"; //nome do banco de dados

    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
    mysqli_set_charset($conexao, 'utf8');
    if(!$conexao) {
        die("PROBLEMA COM A CONEXÃO:" .mysqli_connect_error());
    }

    $search = '%'.$search.'%';
    $consulta = "SELECT * FROM `news` WHERE `texto` LIKE '$search' OR `titulo` LIKE '$search' OR `resumo` LIKE '$search'";
    $resultadoSearch=  mysqli_query($conexao,$consulta) or die("FALHA NA EXECUÇÃO DA CONSULTA:" .mysqli_connect_error());
    $searchList = mysqli_fetch_all($resultadoSearch);
} else{
    $search = null;
}


?>
<main class="py-3">
    <div class="m-auto flex-column container flex-wrap">
        <?php
        include($navPath);
        ?>
        <div class="row gx-4 mt-4">
            <div class="col-10">
                <?php
                if ($search == null){
                    echo'<div class="alert alert-danger" role="alert">
                            Busca Vazia, por favor inclua alguma letra!
                         </div>';
                } else{
                    $path = $_SERVER['DOCUMENT_ROOT'];
                    require($searchCardPath);
                    if (!isset($searchList) || count($searchList) == 0){
                        echo'<div class="alert alert-danger" role="alert">
                                Sua Busca Não retornou nenhum resultado
                             </div>';
                    }else {
                        foreach ($searchList as $searchItem){
                            echoSearchCard($searchItem[1], $searchItem[6], $searchItem[2],$searchItem[0]);
                        }
                    }

                }

                ?>
            </div>
            <div class="col-2 h-100">
            <?php
            include($adPath);
            ?>
            </div>
    </div>
</main>
<?php
require($footerPath);
footer(true);
?>
</body>
</html>