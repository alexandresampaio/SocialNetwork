<?php
    session_start();
    
    header('Content-type: image/jpeg');
    
    $image = imagecreate(350, 70);
    $fonte= 'spell.ttf';

    $corFundo = imagecolorallocate($image, 255,255, 255);
    $corLetra = imagecolorallocate($image,155, 48, 255);

    $tFonte = '50';
    $qtLetras= 5;

    $letras= substr(str_shuffle('AaBbCcDdEFefGghHiIJjKlMmnNOpPQqRrsStTUuVvWwXxYyzZ0123456789'),0, $qtLetras );
    
    $_SESSION['captchacadastro'] = $letras;

    for($i=1;$i < $qtLetras; $i++)
    {
     imagettftext($image, $tFonte, rand(-30,25), ( ($tFonte*$i)/1.5 ), $tFonte+5, $corLetra, $fonte, substr($letras, ($i-1), 1) );
    }
    
    imagejpeg($image);
    imagedestroy($image);
?>
