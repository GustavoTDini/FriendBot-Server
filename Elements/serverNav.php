<?php
$listPath = "..\Server\\listar.php";
$insertPath = "..\Server\\inserir.php";
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
$url .= $_SERVER['HTTP_HOST'];
$url .= $_SERVER['REQUEST_URI'];

$listActive = '';
$insertActive = '';

if (str_contains($url, "listar.php"))
    $listActive = " active ";

if (str_contains($url, "inserir.php"))
    $insertActive = " active ";

echo '<div class="col-3 justify-content-center">
        <h2><span class="badge bg-secondary container">Isaac Blog</span></h2>
        <div class="list-group">
            <a href="' . $listPath . '" class="list-group-item list-group-item-action' . $listActive . '">Listar Posts</a>
            <a href="' . $insertPath . '" class="list-group-item list-group-item-action' . $insertActive . '">Inserir Novo Post</a>
        </div>
     </div>';
?>
