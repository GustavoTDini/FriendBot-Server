<?php
$headPath = "..\Elements\\head.php";
$headerPath = "..\Elements\\header.php";
$navPath = "..\Elements\\searchNav.php";
$navPillsPath = "..\Elements\\navPills.php";
$listCardPath = "..\Elements\\listCard.php";
$footerPath = "..\Elements\\footer.php";
$adPath = "..\Elements\\ad.php";
include($headPath);
echo '<body class="d-flex flex-column h-100">';
include($headerPath);
$cat = null;
if (isset($_GET['cat'])){
    $cat = $_GET['cat'];
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
                require($navPillsPath);
                echoPills($cat);
                $servidor = "localhost"; //conexão local
                $usuario  = "root";      //o usuário administrador
                $senha    = "";			//a senha-padrão do XAMPP é vazio
                $banco    = "isaac_diary"; //nome do banco de dados

                $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
                mysqli_set_charset($conexao, 'utf8');
                if(!$conexao) {
                    die("PROBLEMA COM A CONEXÃO:" .mysqli_connect_error());
                }
                if (!isset($cat)){
                    $consultaPosts = "SELECT * FROM `news` ORDER BY data_hora";
                } else {
                    $consultaPosts = "SELECT * FROM `news` WHERE categoria = '$cat' ORDER BY data_hora";
                }

                $resultadoPosts =  mysqli_query($conexao,$consultaPosts) or die("FALHA NA EXECUÇÃO DA CONSULTA:" .mysqli_connect_error());
                $posts = mysqli_fetch_all($resultadoPosts);

                require($listCardPath);
                $size = 10;
                if (count($posts) < 10){
                    $size = count($posts);
                }
                for($i = 0; $i < $size; $i++){
                    $post = $posts[$i];
                    echoCard($post[1],$post[6],$post[2],$post[5], $post[0]);
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
