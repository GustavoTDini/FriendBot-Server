<?php
$headPath = "..\Elements\\head.php";
$headerPath = "..\Elements\\header.php";
$navPath = "..\Elements\\serverNav.php";
$formPath = "..\Elements\\form.php";
$footerPath = "..\Elements\\footer.php";
include($headPath);
echo '<body class="d-flex flex-column h-100">';
include($headerPath);
?>
<main class="flex-shrink-0">
    <div class="container">
        <div class="row">
            <?php
            include($navPath);
            ?>
            <div class="col-9">
                <h2><span class="badge bg-secondary container">Inserir</span></h2>
                <?php
                include($formPath);
                ?>
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