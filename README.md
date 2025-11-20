# 📦 Wemcor Smart QR (Simple)

Minimalist WordPress plugin to generate QR codes.\
This plugin creates QR codes for any URL on your site and stores them as
PNG files inside a dedicated folder using the built‑in **phpqrcode**
library.

## 🚀 Features

-   Generate QR codes for any URL.
-   Automatically saves PNG files in `/qrcodes/`.
-   Automatic filename based on domain + URL path.
-   Zero configuration required.
-   No external dependencies (library included).

## 📁 Plugin Structure

    wemcor-smart-qr-simple/
    │
    ├── wemcor-smart-qr.php        # Main plugin file
    │
    └── phpqrcode/
        ├── qrlib.php              # Core QR generation library
        └── qrencoder.php          # Internal encoder

## 🛠 Installation

1.  Download or clone the repository:

        git clone https://github.com/your-user/wemcor-smart-qr-simple.git

2.  Upload the folder to:

        /wp-content/plugins/

3.  Activate the plugin from the WordPress admin panel: **Plugins → Add
    New → Activate**

## 🔧 Usage

Currently, the plugin works programmatically.\
You can generate a QR code from any hook, shortcode, or template:

``` php
if (function_exists('wemcor_generate_qr')) {
    $file = wemcor_generate_qr('https://example.com/contact');
    echo '<img src="' . esc_url($file) . '" alt="QR Code">';
}
```

The QR code file will be stored in:

    /wp-content/uploads/wemcor-smart-qr/

## 📜 License

GPL‑2.0 or later.
