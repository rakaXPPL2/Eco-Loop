<?php

/**
 * Vercel Server Configuration
 *
 * This file is used by Vercel to configure the PHP runtime.
 */

return [
    'php' => '8.3',
    'ext' => [
        'apcu',
        'bcmath',
        'ctype',
        'curl',
        'dom',
        'exif',
        'fileinfo',
        'gd',
        'iconv',
        'intl',
        'json',
        'mbstring',
        'openssl',
        'pdo',
        'pdo_pgsql',
        'pgsql',
        'random',
        'session',
        'tokenizer',
        'xml',
        'zip',
    ],
];
