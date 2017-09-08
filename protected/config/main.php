<?php
    return array(
        'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'name'=>'Kênh kiếm tiền hiệu quả tiện lợi - kenhkiemtien.com',
        'language'=>'vi',

        'preload'=>array('log'),

        'import'=>array(
            'application.models.*',        
            'application.components.*',
            'application.extensions.*', 
            'application.extensions.url.*',     
            'application.utilities.*',
            'zii.widgets.CPortlet',
        ),

        'defaultController'=>'apps',
        'modules' => array(
            'kktpanel',
        ),
        'components'=>array(
            'user'=>array(			
                'allowAutoLogin'=>true,
            ),  

            'yexcel' => array(
                'class' => 'ext.yexcel.Yexcel'
            ),

            'facebook'=>array(
                'class' => 'ext.yii-facebook-opengraph.SFacebook',
                'appId'=>'264501217006830', // needed for JS SDK, Social Plugins and PHP SDK
                'secret'=>'9789f7ef545619bc2b87faf04399ca49', // needed for the PHP SDK
                'locale'=>'en_US',
            ),

            'db'=>array(
                'connectionString' => 'mysql:host=127.0.0.1;dbname=vtc_kenhkiemtien',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
                'class'=>'CDbConnection'            
            ),

            'db_forum'=>array(
                'connectionString' => 'mysql:host=210.245.90.243;dbname=vtc_diendan_kkt',
                'emulatePrepare' => true,
                'username' => 'uvtc_mtop',
                'password' => 'pvtc_mtop!@#456',
                'charset' => 'utf8',
                'class'=>'CDbConnection'            
            ),

            'db_gamestore'=>array(
            'connectionString' => 'mysql:host=210.245.90.243;dbname=vtc_game_store',
            'emulatePrepare' => true,
            'username' => 'uvtc_mtop',
            'password' => 'pvtc_mtop!@#456',
            'charset' => 'utf8',
            'class'=>'CDbConnection'            
            ),

         

            'db_facebook'=>array(
            'connectionString' => 'mysql:host=210.245.90.243;dbname=vtc_adv_facebook',
            'emulatePrepare' => true,
            'username' => 'uvtc_mtop',
            'password' => 'pvtc_mtop!@#456',
            'charset' => 'utf8',
            'class'=>'CDbConnection'            
            ),

            'db_bongda'=>array(
            'connectionString' => 'mysql:host=210.245.90.243;dbname=vtc_bongda',
            'emulatePrepare' => true,
            'username' => 'uvtc_mtop',
            'password' => 'pvtc_mtop!@#456',
            'charset' => 'utf8',
            'class'=>'CDbConnection'            
            ),

            'db_openfire'=>array(
                'connectionString' => 'mysql:host=210.245.90.243;dbname=openfire',
                'emulatePrepare' => true,
                'username' => 'uvtc_mtop',
                'password' => 'pvtc_mtop!@#456',
                'charset' => 'utf8',
                'class'=>'CDbConnection'            
            ),

            'errorHandler'=>array(            
                'errorAction'=>'apps/error',
            ),

            'urlManager'=>array(
                'urlFormat'=>'path',
                'showScriptName'=>false,            
                'caseSensitive' => true,
                'rules'=>array(
                    '/gioi-thieu'=>'kktGeneral/intro',                         
                    '/cac-cau-hoi-thuong-gap'=>'kktGeneral/qa',                         
                    '/quy-dinh-su-dung'=>'kktGeneral/privacy',
                    '/quy-dinh-thanh-toan'=>'kktGeneral/paymentRule',
                    '/tro-giup-cong-tac-vien'=>'kktGeneral/help',
                    '/chinh-sach-hop-tac'=>'kktGeneral/policy',
                    '/ca-nhan/tro-ten-mien'=>'kktUser/domain',
                    '/ca-nhan/san-pham/danh-sach-<alias>-<typeCat:\d+>'=>'kktUser/listData',
                    '/ca-nhan/san-pham/danh-sach-<alias>-<typeCat:\d+>/<page>'=>'kktUser/listData',
                    '/ca-nhan/<alias>-d<id:\d+>t<typeCat:\d+>'=>'kktUser/dataDetail',
                    '/kich-hoat'=>'kktUser/active',
                    '/dang-ky-cung-<userId:\d+>'=>'kktUser/register',  
                    '/dang-ky'=>'kktUser/register',

                    '/<id:\d+>/<alias>'=>'kktDownload/app',
                    '/tai-ngay-<alias>-<id:\d+>'=>'kktDownload/downloadMyAdv',
                    '/tai-ngay-<alias>-t<type:\d+>'=>'kktDownload/hotHome',
                    '/<alias>-d<id:\d+>u<userId:\d+>'=>'kktDownload/downloadGame',
                    '/tai-ngay-bo-anh-hot-<id>-<dataId>'=>'kktAlbumDetail/index',
                    '/tai-ngay-video-<id>-<dataId>'=>'kktDownload/video',
                    '/tai-ngay-anh-hot-<id>-<dataId>'=>'kktDownload/image',
                    '/tai-ngay-game-<id>-<dataId>'=>'kktDownload/game',
                    'ca-nhan'=>'kktUser/index',
                    '/ca-nhan/seo'=>'kktUser/seoPage',
                    '/ca-nhan/ga'=>'kktUser/gaPage',
                    '/ca-nhan/tien-ich'=>'kktUser/work',
                    '/ca-nhan/gioi-thieu-dang-ky'=>'kktUser/invite',  
                    '/ca-nhan/phan-phoi'=>'kktUser/gameOnline',
                    '/ca-nhan/rut-gon-link'=>'kktUser/shortLink',
                    '/ca-nhan/ung-dung-ban-le'=>'kktUser/listApp',
                    '/ca-nhan/tao-box-quang-cao-rieng'=>'kktUser/myAdv',
                    '/ca-nhan/quang-cao-d<id:\d+>'=>'kktUser/myAdvDetail',
                    '/<title>-<id:\d+>'=>'kktUser/sellNow',
                    '/ban-ngay<id:\d+>'=>'kktUser/sellNow',
                    '/ca-nhan/xoa-quang-cao'=>'kktUser/deleteMyAdv',
                    '/ca-nhan/nhung-box-quang-cao'=>'kktUser/boxAdv',
                    '/ca-nhan/doi-mat-khau'=>'kktUser/changePassword',
                    '/ca-nhan/sua-thong-tin'=>'kktUser/editProfile',
                    '/ca-nhan/ho-so'=>'kktUser/profile',
                    '/ca-nhan/lay-lai-mat-khau'=>'kktUser/activeForgotPassword',
                    '/ca-nhan/quen-mat-khau'=>'kktUser/forgotPassword',
                    '/ca-nhan/doi-mat-khau-thanh-cong'=>'kktUser/msgChangeForgotPassword',
                    '/ca-nhan/thong-bao-quen-mat-khau'=>'kktUser/msgForgotPassword',
                    /*'/'=>'kktHome/index',*/    
                    //'/danh-sach-app'=>'kktHome/index',    

                    '/danh-sach-app'=>'apps/index',
                    '/danh-sach-app/<page:\d+>'=>'apps/index',
                    '/danh-sach-app/page/<page:\d+>'=>'apps/index',

                    '/danh-sach-game'=>'game/index',
                    '/danh-sach-game/<page:\d+>'=>'game/index',
                    '/danh-sach-game/page/<page:\d+>'=>'game/index',

                    'kktpanel/<controller:\w+>/<action:\w+>'=>'kktpanel/<controller>/<action>',
                    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                ),
            ),
            'cache' => array (
                'class'=>'system.caching.CFileCache',
                /*
                'class' => 'CMemCache',
                'servers'=>array(
                array(
                'host'=>'127.0.0.1',
                'port'=>11211,
                'weight'=>60,
                ),
                ),
                */
            ),
            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'error, warning',
                    ),
                ),
            ),
        ),

        'params'=>require(dirname(__FILE__).'/params.php'),
    );
