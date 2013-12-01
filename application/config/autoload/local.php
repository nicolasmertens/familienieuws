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
);