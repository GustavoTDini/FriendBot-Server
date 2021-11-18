<?php

$adList = array(
    0 => '../images/Ads/acer.png',
    1 => '../images/Ads/allstar.png',
    2 => '../images/Ads/bulgari.png',
    3 => '../images/Ads/galaxy.png',
    4 => '../images/Ads/gucci.png',
    5 => '../images/Ads/gucci2.png',
    6 => '../images/Ads/iphone.png',
    7 => '../images/Ads/pandora.png',
    8 => '../images/Ads/samsung.png',
    9 => '../images/Ads/swarovski.png',
);

$ad = $adList[rand(0,9)];

echo '<figure class="figure">
        <img src="'.$ad.'" class="figure-img img-fluid rounded" alt="..." height="300">
      </figure></div>';
?>
