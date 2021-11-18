<?php
$headPath = "..\Elements\\head.php";
$headerPath = "..\Elements\\header.php";
$navPath = "..\Elements\\serverNav.php";
$postsPath = "..\Elements\\serverList.php";
$footerPath = "..\Elements\\footer.php";

$servidor = "localhost"; //conexão local
$usuario = "root";      //o usuário administrador
$senha = "";            //a senha-padrão do XAMPP é vazio
$banco = "isaac_diary"; //nome do banco de dados

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
mysqli_set_charset($conexao, 'utf8');
if (!$conexao) {
    die("PROBLEMA COM A CONEXÃO:" . mysqli_connect_error());
}
$consultaPosts = "SELECT * FROM `news`";
$resultadoPosts = mysqli_query($conexao, $consultaPosts) or die("FALHA NA EXECUÇÃO DA CONSULTA:" . mysqli_connect_error());
$posts = mysqli_fetch_all($resultadoPosts);

$consultaCat = "SELECT categoria FROM `categorias`";
$resultadoCat = mysqli_query($conexao, $consultaCat) or die("FALHA NA EXECUÇÃO DA CONSULTA:" . mysqli_connect_error());
$categorias = mysqli_fetch_all($resultadoCat);

include_once($headPath);
echo '<body class="d-flex flex-column h-100">';
include_once($headerPath);
?>
    <main class="flex-shrink-0">
    <div class="container">
        <div class="row">
            <?php
            include_once($navPath);
            ?>
            <div class="col-9">
                <h2><span class='badge bg-secondary container'>Lista de Posts</span></h2>
                <?php
                require($postsPath);
                echoList($posts, $categorias);
                ?>
            </div>
        </div>
    </div>
</main>
<?php
require($footerPath);
footer(false);
echo '
    </div>
    </body>
    </html>'
?>