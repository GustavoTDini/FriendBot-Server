<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$datetime = utf8_encode(strftime('%A, %d de %B de %Y, %R', strtotime('now')));
$imagePath = "..\images\\turingLogoServer.png";
echo '<header class="py-3">
        <div class="container d-flex flex-wrap justify-content-evenly">
            <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none h-auto col-4">
                <a href="../Front_End/index.php">
                    <img width="120px" height="120px" class="img-fluid" src="' . $imagePath . '"  alt="logo">
                </a>
                <H1 class="m-4">Isaac Diary</H1>
            </div>
            <span class="fs-6 col-4">' . $datetime . '</span>
        </div>
      </header>';
?>
