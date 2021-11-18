<?php

function echoCardDetails($title, $text, $imagePath, $date, $category)
{

    if (!isset($imagePath)) {
        $imagePath = '..\images\\placeHolder 300x300.png';
    }

    echo '<div class="card mb-3">
            <img src="' . $imagePath . '" class="card-img-top" alt="...">
            <div class="card-body">
                <h2 class="card-title">' . $title . '</h2>
                <h5 class="card-subtitle">' . $category . '</h5>
                <p class="card-text">' . $text . '</p>
                <p class="card-text"><small class="text-muted">' . $date . '</small></p>
            </div>
          </div>';
}

?>
