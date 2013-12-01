<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params'      => array(
                    'host'     => '127.0.0.1',
                    'port'     => '3306',
                    'user'     => 'hackathon',
                    'password' => 'familienieuws',
                    'dbname'   => 'www.familienieuws.eu',
                ),
                'doctrineTypeMappings' => array('enum' => 'string'),
            )
        )
    ),
);