<?php

return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params'      => array(
                    'password' => '',
                )
            )
        )
    ),
	
    'mail-service'       => array(
        'from-default'           => '"Wim Kumpen" <info@wimkumpen.be>',
        'to-sales'               => 'info@wimkumpen.be;info@wimkumpen.be',
        'from-appstore-no-reply' => '"No Reply" <info@wimkumpen.be>',		
    ),
    
    'connectors'    => array(
        'facebook' => array(
            'app_id'            => '249404298556640',
            'app_secret'        => 'f52086f4a132e0169f611e3351447dd4',
            'callback_url'      => '//www.krantje.be/signup',
            'callback_url_invite_confirm' => 'http://www.krantje.be/confirm',
            'scope'             => 'email,user_photos',
        ),
    )
);