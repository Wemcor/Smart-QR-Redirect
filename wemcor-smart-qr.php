<?php
/**
 * Plugin Name: Wemcor Smart QR Redirect
 * Description: Redirecciona /qr i genera un codi QR local amb la llibreria PHP QR Code.
 * Version: 1.2
 * Author: wemcor.com
 */

// Incloure la llibreria PHP QR Code
require_once plugin_dir_path(__FILE__) . 'phpqrcode/qrlib.php';

// Variables dinàmiques per al fitxer QR
$domain = str_replace('.', '-', parse_url(home_url(), PHP_URL_HOST));
$qr_filename = "qr_{$domain}.png";
$qr_path = plugin_dir_path(__FILE__) . $qr_filename;
$qr_url = plugin_dir_url(__FILE__) . $qr_filename;

// Afegim la pàgina al menú d'administració
add_action('admin_menu', function() use ($qr_filename, $qr_url, $qr_path) {
    add_menu_page('Configuració QR', 'QR redirect', 'manage_options', 'qr-redirect', function() use ($qr_filename, $qr_url, $qr_path) {
        $url = esc_url(get_option('qr_redirect_url', home_url()));

        if (isset($_POST['regenerate_qr'])) {
            QRcode::png($url, $qr_path, QR_ECLEVEL_L, 4);
            echo '<div class="updated"><p>QR regenerat!</p></div>';
        }
        ?>
        <div class="wrap">
            <h1>Configuració de redirecció QR</h1>
            <form method="post" action="options.php">
                <?php
                    settings_fields('qr_redirect_options');
                    do_settings_sections('qr_redirect');
                    submit_button();
                ?>
            </form>

            <h2>Codi QR actual</h2>
            <img src="<?php echo $qr_url; ?>" alt="QR" />
            <br><br>
            <form method="post">
                <button type="submit" name="regenerate_qr" class="button button-primary">Regenerar QR</button>
            </form>
            <br>
            <a href="<?php echo $qr_url; ?>" download="<?php echo $qr_filename; ?>" class="button">Descarregar QR</a>
        </div>
        <?php
    });
});

// Ajust per guardar la URL de destinació
add_action('admin_init', function() {
    register_setting('qr_redirect_options', 'qr_redirect_url');
    add_settings_section('qr_redirect_section', '', null, 'qr_redirect');
    add_settings_field('qr_redirect_url', 'URL de destinació', function() {
        $value = esc_url(get_option('qr_redirect_url', home_url()));
        echo "<input type='url' name='qr_redirect_url' value='$value' class='regular-text' />";
    }, 'qr_redirect', 'qr_redirect_section');
});

// Redirecció de /qr cap a la URL definida
add_action('template_redirect', function() {
    if (trim($_SERVER['REQUEST_URI'], '/') === 'qr') {
        $target = esc_url(get_option('qr_redirect_url', home_url()));
        wp_redirect($target, 302);
        exit;
    }
});
?>
