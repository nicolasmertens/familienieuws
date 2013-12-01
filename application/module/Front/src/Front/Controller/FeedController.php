<?php

namespace Front\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class FeedController extends AbstractActionController {

    public function __construct()
    {
        
    }

    public function pageAction()
    {
        $config    = $this->getServiceLocator()->get('config');
        $config    = $config['connectors']['facebook'];

        require_once './lib/facebookwrapper.php';
        require_once './lib/fbphotofeed.php';

        $facebookWrapper = new \FacebookWrapper(array(
            'appId' => $config['app_id'],
            'secret' => $config['app_secret'],
            'cookie' => true,
            'fileUpload' => false, // optional
            'allowSignedRequest' => false // optional, but should be set to false for non-canvas apps
        ));
        $user = $facebookWrapper->getUserData();

        if($user)
        {
            $fbPhotoFeed = new \FbPhotoFeed();
            $fbPhotoFeed->addFeed($facebookWrapper->getUserUploadedPhotos(10));
            $fbPhotoFeed->addFeed($facebookWrapper->getUserPhotos(10));
        }
        else
        {
            header('Location: /');
        }
        return array(
            'config'      => $config,
            'fbPhotoFeed' => $fbPhotoFeed
        );
    }

    public function pdfAction()
    {
        $config    = $this->getServiceLocator()->get('config');
        $config    = $config['connectors']['facebook'];

        require_once './lib/facebookwrapper.php';
        require_once './lib/fbphotofeed.php';

        $facebookWrapper = new \FacebookWrapper(array(
            'appId' => $config['app_id'],
            'secret' => $config['app_secret'],
            'cookie' => true,
            'fileUpload' => false, // optional
            'allowSignedRequest' => false // optional, but should be set to false for non-canvas apps
        ));
        $user = $facebookWrapper->getUserData();

        if($user)
        {
            $fbPhotoFeed = new \FbPhotoFeed();
            $fbPhotoFeed->addFeed($facebookWrapper->getUserUploadedPhotos(10));
            $fbPhotoFeed->addFeed($facebookWrapper->getUserPhotos(10));
        }
        else
        {
            $fbPhotoFeed = null;
        }
        
        $view = new \Zend\View\Model\ViewModel(array(
            'config'      => $config,
            'fbPhotoFeed' => $fbPhotoFeed
        ));
        $view->setTemplate('front/feed/pdf.phtml');

        $viewRender = $this->getServiceLocator()->get('ViewRenderer');
        $html = $viewRender->render($view);

        $html2pdf = new \HTML2PDF('P', 'A4', 'nl');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($html, false);
        $html2pdf->Output('test.pdf', false);
    }
}