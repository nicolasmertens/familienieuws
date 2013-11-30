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
        'from-default'           => '"Marketing App Exchange support" <info@wimkumpen.be>',
        'to-sales'               => 'info@wimkumpen.be;info@wimkumpen.be',
        'from-appstore-no-reply' => '"No Reply" <info@wimkumpen.be>',		
    ),
    
    'connectors'    => array(
        'twitter'   => array(
            'consumer_key'      => 'QAYHIPKYNXWeI3kFjt0KCw',
            'consumer_secret'   => 'HLoy5vAsd6cwSQFS8jnwM9vLl8E1hIBhtVr52gCD5Hw',
            'callback_url'      => 'http://www.social.com/connector/twitter',
        ),
        'foursquare'=> array(
            'client_id'         => 'XWQZZ3W2EOSIO3CAUINIWRU1UI4T0R15GY3XXF00GFQSV4WR',
            'client_secret'     => 'RWQRD0BTVRM1CVNO30EEBFPI4UYWRZR01D4UEE0XZFUJ1XVH',
            'callback_url'      => 'http://www.social.com/connector/foursquare',
        ),
        'facebook' => array(
            'app_id'            => '231826030312834',
            'app_secret'        => 'f2680a2d8ff1fbe0812b5f3190f6cafa',
            'callback_url'      => 'http://www.social.com/connector/facebook',
        ),
        'instagram'=> array(
            'client_id'         => '28780dce58fe408a9d1b579435262eac',
            'client_secret'     => 'b58d3dc499f64dfcbb351e074c368ca4',
            'callback_url'      => 'http://www.social.com/connector/instagram',
        )
    )
);