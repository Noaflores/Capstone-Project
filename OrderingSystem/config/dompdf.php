<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | Set some default values. It is possible to add all defines that can be set
    | in dompdf_config.inc.php. You can also override the entire config file.
    |
    */
    'show_warnings' => false,   // Throw an Exception on warnings from dompdf
    'public_path' => null,      // Override the public path if needed

    /*
     * Dejavu Sans font is missing glyphs for converted entities, turn it off if you need to show € and £.
     */
    'convert_entities' => true,

    'options' => [
        /**
         * The location of the DOMPDF font directory
         *
         * The location of the directory where DOMPDF will store fonts and font metrics
         * Note: This directory must exist and be writable by the webserver process.
         * *Please note the trailing slash.*
         *
         * Notes regarding fonts:
         * Additional .afm font metrics can be added by executing load_font.php from command line.
         *
         * Only the original "Base 14 fonts" are present on all pdf viewers. Additional fonts must
         * be embedded in the pdf file or the PDF may not display correctly. This can significantly
         * increase file size unless font subsetting is enabled. Before embedding a font please
         * review your rights under the font license.
         *
         * Any font specification in the source HTML is translated to the closest font available
         * in the font directory.
         *
         * The pdf standard "Base 14 fonts" are:
         * Courier, Courier-Bold, Courier-BoldOblique, Courier-Oblique,
         * Helvetica, Helvetica-Bold, Helvetica-BoldOblique, Helvetica-Oblique,
         * Times-Roman, Times-Bold, Times-BoldItalic, Times-Italic,
         * Symbol, ZapfDingbats.
         */
        'font_dir' => storage_path('fonts'), // advised by dompdf (https://github.com/dompdf/dompdf/pull/782)

        /**
         * The location of the DOMPDF font cache directory
         *
         * This directory contains the cached font metrics for the fonts used by DOMPDF.
         * This directory can be the same as DOMPDF_FONT_DIR
         *
         * Note: This directory must exist and be writable by the webserver process.
         */
        'font_cache' => storage_path('fonts'),

        /**
         * The location of a temporary directory.
         *
         * The directory specified must be writeable by the webserver process.
         * The temporary directory is required to download remote images and when
         * using the PDFLib back end.
         */
        'temp_dir' => sys_get_temp_dir(),

        /**
         * ==== IMPORTANT ====
         *
         * dompdf's "chroot": Prevents dompdf from accessing system files or other
         * files on the webserver.  All local files opened by dompdf must be in a
         * subdirectory of this directory.  DO NOT set it to '/' since this could
         * allow an attacker to use dompdf to read any files on the server. This
         * should be an absolute path.
         */
        'chroot' => realpath(base_path()),

        /**
         * Protocol whitelist
         */
        'allowed_protocols' => [
            'data://' => ['rules' => []],
            'file://' => ['rules' => []],
            'http://' => ['rules' => []],
            'https://' => ['rules' => []],
        ],

        /**
         * Operational artifact (log files, temporary files) path validation
         */
        'artifactPathValidation' => null,

        /**
         * Log file location
         */
        'log_output_file' => null,

        /**
         * Whether to enable font subsetting or not
         */
        'enable_font_subsetting' => false,

        /**
         * PDF rendering backend
         */
        'pdf_backend' => 'CPDF',

        /**
         * HTML target media type which should be rendered into pdf
         */
        'default_media_type' => 'screen',

        /**
         * Default paper size
         */
        'default_paper_size' => 'a4',

        /**
         * Default paper orientation
         */
        'default_paper_orientation' => 'portrait',

        /**
         * Default font family
         *
         * Used if no suitable fonts can be found. This must exist in the font folder.
         */
        'default_font' => 'nauman', // Set our Nauman Neue font as default

        /**
         * Image DPI setting
         */
        'dpi' => 96,

        /**
         * Enable embedded PHP
         */
        'enable_php' => false,

        /**
         * Enable inline JavaScript
         */
        'enable_javascript' => true,

        /**
         * Enable remote file access
         */
        'enable_remote' => false,

        /**
         * List of allowed remote hosts
         */
        'allowed_remote_hosts' => null,

        /**
         * A ratio applied to the fonts height to be more like browsers' line height
         */
        'font_height_ratio' => 1.1,

        /**
         * Use the HTML5 parser
         */
        'enable_html5_parser' => true,
    ],

    /**
     * Custom font mapping
     *
     * Key = font-family name used in CSS/HTML
     * Value = array of font variants with path to .ttf files
     */
    'fonts' => [
        'nauman' => [
            'R'  => storage_path('fonts/Nauman-Regular.ttf'),
            // Uncomment/add if you have bold/italic variants:
            // 'B' => storage_path('fonts/Nauman-Bold.ttf'),
            // 'I' => storage_path('fonts/Nauman-Italic.ttf'),
            // 'BI'=> storage_path('fonts/Nauman-BoldItalic.ttf'),
        ],
    ],

];
