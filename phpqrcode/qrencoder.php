<?php
class QRencoder {
    public static function text($text, $outfile = false, $level = 0, $size = 3, $margin = 4) {
        $url = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($text);
        $data = file_get_contents($url);
        if ($outfile) {
            file_put_contents($outfile, $data);
        } else {
            header('Content-Type: image/png');
            echo $data;
        }
    }
}
?>
