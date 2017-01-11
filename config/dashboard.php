<?php
/**
 * Dashboard Config
 *
 * @package    config.dashboard;
 * @version    1.0.0
 * @author     Tor Miller
 * @copyright  (c) 2015-2017, Bizly.co
 */

return [

    'info' => [
        'company' => [
            'name' => env('COMPANY_NAME'),
            'logo' => [
                'src_url' => env('COMPANY_LOGO_SRC_URL'),
            ],
        ],
    ],

];
