
<?php
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");

    // рандомный код капчи
    $random_alpha = md5(rand());

    $captcha_code = substr($random_alpha, 0, 6);

    // создание изображения капчи
    $image = imagecreatetruecolor(150, 38);

    $background_color = imagecolorallocate($image, 231, 100, 18);

    $text_color = imagecolorallocate($image, 255, 255, 255);

    imagefilledrectangle($image, 0, 0, 200, 38, $background_color);

    $font = dirname(__FILE__) . '/font/Arial-Bold.ttf';

    imagettftext($image, 20, 5, 30, 28, $text_color, $font, $captcha_code);

    imagepng($image, "img/captcha.png");

    imagedestroy($image);
    echo $captcha_code;
    
    // отдаем код капчи
    setcookie("captcha", strval($captcha_code), time() + 500); 
?>
