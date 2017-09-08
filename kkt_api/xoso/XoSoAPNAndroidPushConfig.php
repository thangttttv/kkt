<?php

// Configuration file for push.php

$config = array(
    // These are the settings for development mode
    'development' => array(

        // The APNS server that we will use
        'server' => 'gateway.sandbox.push.apple.com:2195',

        // The SSL certificate that allows us to connect to the APNS servers
        'certificate' => '/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/kkt_api/gamestore/ck_gamestore.pem',
        'passphrase' => 'nopass',

        // Configuration of the MySQL database
         'db' => array(
            'host'     => '127.0.0.1',
            'dbname'   => 'vtc_10h_xs',
            'username' => 'uxoso10h',
            'password' => 'pxoso10h!@#456',
            ),
       

        // Name and path of our log file
        'logfile' => '/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/kkt_api/xoso/log/push_xoso_android_development.log',
        ),

    // These are the settings for production mode
    'production' => array(

        // The APNS server that we will use
        'server' => 'gateway.push.apple.com:2195',

        // The SSL certificate that allows us to connect to the APNS servers
        'certificate' => '/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/kkt_api/xoso/ck_gamestore.pem',
        'passphrase' => 'nopass123',

        // Configuration of the MySQL database
         'db' => array(
            'host'     => '127.0.0.1',
            'dbname'   => 'vtc_10h_xs',
            'username' => 'uxoso10h',
            'password' => 'pxoso10h!@#456',
            ),
       

        // Name and path of our log file
        'logfile' => '/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/kkt_api/xoso/log/push_xoso_android_production.log',
        ),
        
        
    );
