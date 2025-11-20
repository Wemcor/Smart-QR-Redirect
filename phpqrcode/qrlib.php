<?php
/*
 * PHP QR Code encoder
 * Documentation and samples: https://sourceforge.net/projects/phpqrcode/
 */

define('QR_ECLEVEL_L', 0);

class QRcode {
    public static function png($text, $outfile = false, $level = QR_ECLEVEL_L, $size = 3, $margin = 4) {
        include_once(dirname(__FILE__).'/qrencoder.php');
        QRencoder::text($text, $outfile, $level, $size, $margin);
    }
}
?>
