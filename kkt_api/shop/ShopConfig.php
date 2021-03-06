<?php
// Configuration file for push.php
//CREATE USER 'uswaphubtest'@'localhost' IDENTIFIED BY '!@#456&*(';
//GRANT ALL PRIVILEGES ON vtc_swaphub_test. * TO 'uswaphub'@'localhost';    

$config = array(
    // These are the settings for development mode
    'development' => array(

        // The APNS server that we will use
        'server' => 'gateway.sandbox.push.apple.com:2195',

        // The SSL certificate that allows us to connect to the APNS servers
        'certificate' => '/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/kkt_api/shop/ck_shop.pem',
        'passphrase' => '123456',

        // Configuration of the MySQL database
        'db' => array(
            'host'     => '127.0.0.1',
            'dbname'   => 'vtc_swaphub',
            'username' => 'uswaphub',
            'password' => 'pswaphub&*(',
            ),

        // Name and path of our log file
        'logPushQueue' => '/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/kkt_api/shop/log/logPushQueue.log',
        'logSendIOS' => '/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/kkt_api/shop/log/logSendIOS.log',
        'logSendAndroid' => '/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/kkt_api/shop/log/logSendAndroid.log'
        ),

    // These are the settings for production mode
    'production' => array(

        // The APNS server that we will use
        'server' => 'gateway.push.apple.com:2195',

        // The SSL certificate that allows us to connect to the APNS servers
        'certificate' => '/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/kkt_api/shop/ck_shop.pem',
        'passphrase' => '123456',

        // Configuration of the MySQL database
        'db' => array(
            'host'     => 'localhost',
            'dbname'   => 'vtc_swaphub',
            'username' => 'uswaphub',
            'password' => 'pswaphub&*(',
            ),

         // Name and path of our log file
        'logPushQueue' => '/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/kkt_api/shop/log/logPushQueue.log',
        'logSendIOS' => '/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/kkt_api/shop/log/logSendIOS.log',
        'logSendAndroid' => '/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/kkt_api/shop/log/logSendAndroid.log'
        ),
    );

    
   
