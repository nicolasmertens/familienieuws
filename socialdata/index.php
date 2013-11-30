<?php
header('P3P: CP="NON DSP TAIa PSAa PSDa OUR IND UNI", policyref="/w3c/p3p.xml"');

require_once 'config.php';
require_once 'lib/facebookwrapper.php';
require_once 'lib/fbphotofeed.php';

/*
 * Init facebook
 */
session_start();
$facebookWrapper = new FacebookWrapper(array(
    'appId' => FB_APP_ID,
    'secret' => FB_APP_SECRET,
    'cookie' => true,
    'fileUpload' => false, // optional
    'allowSignedRequest' => false // optional, but should be set to false for non-canvas apps
));


$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$page .= '.php';
if(file_exists(ROOT_PATH . 'controller' . DIRECTORY_SEPARATOR . $page)) require_once ROOT_PATH . 'controller' . DIRECTORY_SEPARATOR . $page;



//render page
require_once 'view/_header.php';


if(file_exists(ROOT_PATH . 'view' . DIRECTORY_SEPARATOR . $page)) {
    require_once ROOT_PATH . 'view' . DIRECTORY_SEPARATOR . $page;
} else {
    echo '404 - Page not found!';
}


require_once 'view/_footer.php';
?>
