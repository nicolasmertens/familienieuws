<?php
namespace Common\View\Helper;

use Common\Service\BrandService;

use Zend\Http\Request,
    Zend\ServiceManager\ServiceManager,
    Zend\Mvc\Router\Http\TreeRouteStack,
    Zend\Session\SessionManager,
    Zend\View\Helper\AbstractHelper;

/**
 * Helper for loading css files
 */
class CssLoader extends AbstractHelper
{
    /** @var string */
    const brandingPath = "branding";

    /** @var \Zend\Http\Request */
    protected $request = null;

    /** @var \Zend\Mvc\Router\Http\TreeRouteStack */
    protected $router = null;

    /** @var string */
    protected $host = "";

    public function __construct(ServiceManager $sm)
    {
        $this->router  = $sm->get('router');
        $this->request = $sm->get('request');
        $this->host    = BrandService::getInstance()->getBrand()->getHostname();
    }

    public function __invoke()
    {
        $this->_loadDefaultCss();

        $this->_loadABCss();

        $this->_loadBrandingCss();

        $this->_loadIcon();

        return $this->view->headLink();
    }

    /**
     * loading the default css files
     */
    private function _loadDefaultCss()
    {
        $this->view->headLink()->appendStylesheet('/css/bootstrap.css');
        $this->view->headLink()->appendStylesheet('//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');
        $this->view->headLink()->appendStylesheet('/css/layout.css');
        $this->view->headLink()->appendStylesheet('/css/flexslider.css');
        $this->view->headLink()->appendStylesheet('/css/mosaic.css');

        $match = $this->router->match($this->request);
        if (!is_null($match) && in_array($match->getMatchedRouteName(), array('admin', 'admin/wildcard'))) {
            $this->view->headLink()->appendStylesheet('/css/admin.css');
        }
    }

    /**
     * loading branded css files based on host
     */
    private function _loadBrandingCss()
    {
        $fullPath = realpath("./public");

        $searchPath = $fullPath . DIRECTORY_SEPARATOR . self::brandingPath;
        $searchPath .= DIRECTORY_SEPARATOR . $this->host . DIRECTORY_SEPARATOR . "css" . DIRECTORY_SEPARATOR;

        if (!is_dir($searchPath)) { // set the default path when no branding available
            $this->host = "www.marketingappexchange.com";
            $searchPath = $fullPath . DIRECTORY_SEPARATOR . self::brandingPath;
            $searchPath .= DIRECTORY_SEPARATOR . $this->host . DIRECTORY_SEPARATOR . "css" . DIRECTORY_SEPARATOR;
        }

        foreach(new \GlobIterator($searchPath . "*") as $cssFile) {
            if ($cssFile->isReadable()) {
                if ($cssFile->isFile()) {
                    $this->view->headLink()->appendStylesheet('/' . self::brandingPath . '/'
                        . $this->host . '/css/' . $cssFile->getFilename());
                }
            }
        }
    }

    /**
     * loading ab testing css files
     */
    private function _loadABCss()
    {
        if ($this->view->abtest != null && is_array($this->view->abtest) && isset($this->view->abtest[1])) {
            if($this->view->abtest[1] == 'A') {
                // @todo agree on a fixed file format for css
                // load it conditionaly based on if file exists
                // and put it in a view helper
                //$this->view->headLink()->appendStylesheet('/css/mosaic' . $group . '-' . $number . '.css');
            }
        }
    }

    private function _loadIcon()
    {
        $fullPath = realpath("./public");

        $iconFile = $fullPath . DIRECTORY_SEPARATOR . self::brandingPath .
                    DIRECTORY_SEPARATOR . $this->host . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR;
        if (file_exists($iconFile)) {
            $this->view->headLink(array(
                'rel'  => 'shortcut icon',
                'type' => 'image/x-icon',
                'href' => '/' . self::brandingPath . '/' . $this->host . '/images/favicon.ico',
            ), 'PREPEND');
        }
    }
}