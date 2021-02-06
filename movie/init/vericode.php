<?php
$img_w = 70;  //验证码宽
$img_h = 22;  //验证码高
$char_len = 4; //验证码字符长度
$font = 5;  //验证码字体大小

$char = array_merge(range('A', 'Z'), range('a', 'z'), range(1, 9));

$rand_keys = array_rand($char, $char_len);

if ($char_len == 1) {
    $rand_keys = array($rand_keys);
}

shuffle($rand_keys);

$code = '';
foreach ($rand_keys as $key) {
    $code .= $char[$key];
}

session_start();
$_SESSION['verifyCode'] = $code;

$img = imagecreatetruecolor($img_w, $img_h);

$bg_color = imagecolorallocate($img, 0xcc, 0xcc, 0xcc);
imageFill($img, 0, 0, $bg_color);

for ($i = 0; $i < 300; $i++) {
    $color = imagecolorallocate($img, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0,
        255));
    imagesetpixel($img, mt_rand(0, $img_w), mt_rand(0, $img_h), $color);
}

$rect_color = imagecolorallocate($img, 0x90, 0x90, 0x90);
imagerectangle($img, 0, 0, $img_w - 1, $img_h - 1, $rect_color);

$str_color = imagecolorallocate($img, mt_rand(0, 100), mt_rand(0, 100),mt_rand(0,
    100));

$font_w = imagefontwidth($font);
$font_h = imagefontheight($font);
$str_w = $font_w * $char_len;
imagestring($img, $font, ($img_w-$str_w)/2, ($img_h-$font_h)/2, $code,
    $str_color);

header('Content-Type: image/png');
imagepng($img);

imagedestroy($img);