<?php
$headPath = "..\Elements\\head.php";
$headerPath = "..\Elements\\header.php";
$navPath = "..\Elements\\serverNav.php";
$footerPath = "..\Elements\\footer.php";
include($headPath);
echo '<body class="d-flex flex-column h-100">';
include($headerPath);

$codigoToDelete = $_GET['cod'];

$servidor = "localhost"; //conexão local
$usuario  = "root";      //o usuário administrador
$senha    = "";			//a senha-padrão do XAMPP é vazio
$banco    = "isaac_diary"; //nome do banco de dados

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
mysqli_set_charset($conexao, 'utf8');
if(!$conexao) {
    die("PROBLEMA COM A CONEXÃO:" .mysqli_connect_error());
}
$consulta = "DELETE FROM `news` WHERE `codigo`='$codigoToDelete'";
$resultadoDelete =  mysqli_query($conexao,$consulta) or die("FALHA NA EXECUÇÃO DA CONSULTA:" .mysqli_connect_error());

?>
<main class="flex-shrink-0">
    <div class="container">
        <div class="row">
            <?php
            include($navPath);
            ?>
            <div class="col-9">
                <h2><span class="badge bg-secondary container">Exclusão de post</span></h2>
                <div class="alert alert-success" role="alert">
                    Post excluído com sucesso
                </div>
            </div>
        </div>
    </div>
</main>
<?php
require($footerPath);
footer(false);
echo '
    </body>
    </html>'
?>