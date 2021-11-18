<?php

function echoCard($title, $date, $description, $imagePath, $codigo)
{

    if (!isset($imagePath)) {
        $imagePath = '\images\\placeHolder 300x300.png';
    }

    echo '<div class="card mb-5 m-2">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="' . $imagePath . '" class="rounded-start cardImage" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <h5 class="card-title">' . $title . '</h5>
                                <p class="card-text">' . $description . '</p>
                                <p class="card-text"><small class="text-muted">' . $date . '</small></p>
                                <a href="item.php?cod=' . $codigo . '" class="btn btn-primary">Saiba Mais</a>
                            </div>
                        </div>
                    </div>
                </div>';
}

?>