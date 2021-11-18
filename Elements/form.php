<?php
$servidor = "localhost"; //conexão local
$usuario = "root";      //o usuário administrador
$senha = "";            //a senha-padrão do XAMPP é vazio
$banco = "isaac_diary"; //nome do banco de dados

function FieldComplete($titulo, $descricao, $texto, $categoria, $data)
{
    if (!isset($titulo) || $titulo == "" || $titulo == " " || !isset($descricao) || $descricao == "" || $descricao == " " ||
        !isset($texto) || $texto == "" || $texto == " " || !isset($categoria) || $categoria == "" || $categoria == " " || !isset($data) || $data == "" || $data == " ") {
        return false;
    } else {
        return true;
    }
}

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
mysqli_set_charset($conexao, 'utf8');
if (!$conexao) {
    die("PROBLEMA COM A CONEXÃO:" . mysqli_connect_error());
}
$consultaCategoria = "SELECT * FROM `categorias`";
$resultadoCat = mysqli_query($conexao, $consultaCategoria) or die("FALHA NA EXECUÇÃO DA CONSULTA:" . mysqli_connect_error());
$categorias = mysqli_fetch_all($resultadoCat);

if (isset($_POST['submit'])) {
    $codigo = $_GET['cod'] ?? uniqid();
    $titulo = $_POST['title'];
    $descricao = $_POST['description'];
    $texto = $_POST['text'];
    $categoria = $_POST['categoryList'];
    $data = $_POST['date'];

    $target_dir = "../images/postsImages/";
    $ext = pathinfo(basename($_FILES["fileImg"]["name"]), PATHINFO_EXTENSION);
    $target_file = $target_dir . $codigo . "." . $ext;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $emptyImage = empty($_FILES["fileImg"]["name"]);
    $checkImage = false;

    if (!$emptyImage) {
        $checkImage = getimagesize($_FILES["fileImg"]["tmp_name"]);
    }
    $isComplete = FieldComplete($titulo, $descricao, $texto, $categoria, $data);
    if (!$isComplete) {
        echo '<div class="col-12">
                <h2><span class="badge bg-secondary container">Alerta</span></h2>
                <div class="alert alert-danger" role="alert">Faltou completar os dados</div>
                <button class="btn btn-info col-12" onclick="history.go(-1)">Retornar</button>
            </div>';
    } else if (!$emptyImage && !$checkImage) {
        echo '<div class="col-12">
                <h2><span class="badge bg-secondary container">Alerta</span></h2>
                <div class="alert alert-danger" role="alert">É Necessário um arquivo de imagem!</div>
                <button class="btn btn-info col-12" onclick="history.go(-1)">Retornar</button>
            </div>';
    } else {
        if (!$emptyImage) {
            // Check file size
            if ($_FILES["fileImg"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if ($ext != "jpg" && $ext != "png" && $ext != "jpeg"
                && $ext != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileImg"]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["fileImg"]["name"])) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }

        $consultaCategoria = "SELECT codigo FROM `categorias` WHERE categoria = '$categoria';";
        $categoriaQuery = mysqli_query($conexao, $consultaCategoria) or die("FALHA NA EXECUÇÃO DA CONSULTA:" . mysqli_connect_error());
        $codCategoria = mysqli_fetch_array($categoriaQuery);
        $codCategoriaToInsert = $codCategoria[0];

        if (isset($_GET['cod'])) {
            $codigo = $_GET['cod'];
            $consulta = "UPDATE `news` SET `codigo`='$codigo', `titulo`='$titulo',`resumo`='$descricao',`texto`='$texto',`categoria`='$codCategoriaToInsert',`imagem`='$target_file',`data_hora`='$data' WHERE codigo = '$codigo';";
            $resultado = mysqli_query($conexao, $consulta) or die("FALHA NA EXECUÇÃO DA CONSULTA UPDATE:" . mysqli_connect_error());
            echo "<h2>OS DADOS FORAM ALTERADOS COM SUCESSO!</h2>";
        } else {
            $consulta = "INSERT INTO `news`(`codigo`, `titulo`, `resumo`, `texto`, `categoria`, `imagem`, `data_hora`) VALUES ('$codigo','$titulo','$descricao','$texto','$codCategoriaToInsert','$target_file','$data');";
            $resultado = mysqli_query($conexao, $consulta) or die("FALHA NA EXECUÇÃO DA CONSULTA:" . mysqli_connect_error());
            echo "<h2>OS DADOS FORAM INSERIDOS COM SUCESSO!</h2>";
        }

        header("location: listar.php");

    }
} else {

    $title = '';
    $description = '';
    $text = '';
    $category = '';
    $imagePath = '';
    $date = '';
    $botao = 'Inserir';

    if (isset($_GET['cod'])) {
        $codigo = $_GET['cod'];
        $consulta = "SELECT * FROM `news` WHERE `codigo`='$codigo'";
        $resultadoShow = mysqli_query($conexao, $consulta) or die("FALHA NA EXECUÇÃO DA CONSULTA:" . mysqli_connect_error());
        $item = mysqli_fetch_all($resultadoShow)[0];
        $consultaCategoria = "SELECT categoria FROM `categorias` WHERE codigo = '$item[4]';";
        $categoriaQuery = mysqli_query($conexao, $consultaCategoria) or die("FALHA NA EXECUÇÃO DA CONSULTA:" . mysqli_connect_error());
        $categoria = mysqli_fetch_array($categoriaQuery);
        $catToShow = $categoria[0];

        $title = $item[1];
        $description = $item[2];
        $text = $item[3];
        $category = $catToShow;
        $imagePath = $item[5];
        $date = $item[6];
        $botao = 'Alterar';
    }

    echo "<form name='formulario' action='" . $_SERVER["PHP_SELF"] . "?" . $_SERVER["QUERY_STRING"] . "' method='POST' enctype='multipart/form-data'>
            <div class='mb-3'>
                <label for='title' class='form-label'>Título do Post</label>
                <input type='text' class='form-control' name='title' value='" . $title . "'>
            </div>
            <div class='mb-3'>
                <label for='description' class='form-label'>Descrição</label>
                <input type='text' class='form-control' name='description' value='" . $description . "'>
            </div>
            <div class='mb-3'>
                <label for='text' class='form-label'>Texto</label>
                <textarea class='form-control' name='text' rows='5'>$text</textarea>
            </div>
            <div class='mb-3'>
                <label for='categoryList' class='form-label'>Categoria</label>
                <input class='form-control' list='categorias' name='categoryList' value='" . $category . "'>
            <datalist id='categorias'>";
                foreach ($categorias as $categoria) {
                    echo "<option value='$categoria[1]'>";
                }
            echo "</datalist>
                    </div>
                    <div class='mb-3'>
                        <label for='text' class='form-label'>Data</label>
                        <input type='date' class='form-control' name='date' value='" . $date . "'>
                    </div>
                    <div class='mb-3'>
                        <label for='fileImg' class='form-label'>Selecione Imagem</label>
                        <input class='form-control' type='file'  accept='.jpg,.gif,.png, .jpeg' name='fileImg' value='" . $imagePath . "'>
                    </div>
                    <div class='mt-5 mb-auto'>
                        <button type='submit' name='submit' class='col-6 btn-lg btn-success h2'>" . $botao . "</button>
                    </div>
                </form>";
    }
?>