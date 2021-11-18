<?php

function echoSearchCard($title, $date, $description, $codigo)
{
    echo '  <div class="card mb-5 m-2">
                    <div class="row g-0">
                        <div class="col-md-10">
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
