<?php
$headPath = "..\Elements\\head.php";
$headerPath = "..\Elements\\header.php";
$navPath = "..\Elements\\searchNav.php";
$navPillsPath = "..\Elements\\navPills.php";
$cardPath = "..\Elements\\itemCard.php";
$footerPath = "..\Elements\\footer.php";
$adPath = "..\Elements\\ad.php";
include($headPath);
echo '<body class="d-flex flex-column h-100">';
include($headerPath);

$codigoToShow = $_GET['cod'];

$servidor = "localhost"; //conexão local
$usuario  = "root";      //o usuário administrador
$senha    = "";			//a senha-padrão do XAMPP é vazio
$banco    = "isaac_diary"; //nome do banco de dados

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
mysqli_set_charset($conexao, 'utf8');
if(!$conexao) {
    die("PROBLEMA COM A CONEXÃO:" .mysqli_connect_error());
}

$consulta = "SELECT * FROM `news` WHERE `codigo`='$codigoToShow'";
$resultadoShow =  mysqli_query($conexao,$consulta) or die("FALHA NA EXECUÇÃO DA CONSULTA:" .mysqli_connect_error());
$item = mysqli_fetch_all($resultadoShow)[0];

$consultaCat = "SELECT categoria FROM `categorias`";
$resultadoCat =  mysqli_query($conexao,$consultaCat) or die("FALHA NA EXECUÇÃO DA CONSULTA:" .mysqli_connect_error());
$categorias = mysqli_fetch_all($resultadoCat);
$codCategoria = $item[4];
$categoria = $categorias[$codCategoria][0];

?>
<main class="py-3">
    <div class="m-auto flex-column container flex-wrap">
        <?php
        include($navPath);
        ?>
        <div class="row gx-4 mt-4">
            <div class="col-10">
                <?php
                require($navPillsPath);
                echoPills(null);
                require($cardPath);
                echoCardDetails($item[1], $item[3], $item[5], $item[6], $categoria);
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
