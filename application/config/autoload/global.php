<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'security'     => array(
        'key'  => 'MOJkRYNUPdta7TLySPO73Z6URns5d95D',
        'salt' => '6Ug0tDu6NioskKOO',
    ),

    'mail-service' => array(
        'from-default-email'     => '<info@wimkumpen.be>',
        'to-sales'               => ' "Wim Kumpen" <info@wimkumpen.be>',
        'from-appstore-no-reply' => ' "No Reply" <info@wimkumpen.be>'
    ),

    'connectors'    => array(
        'facebook' => array(
            'app_id'            => '249404298556640',
            'app_secret'        => 'f52086f4a132e0169f611e3351447dd4',
            'callback_url'      => '//familienieuws.eu/signup',
            'callback_url_invite_confirm' => 'http://familienieuws.eu/confirm',
            'scope'             => 'email,user_photos',
        ),
    )
);