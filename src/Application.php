<?php

namespace engldom;

use engldom\Common\RequestInterface;
use engldom\Controller\BaseController;

class Application
{

    protected $request;

    public function __construct(RequestInterface $request, array $userConfig = [])
    {
        $this->request = $request;
        Config::setConfig($userConfig);
    }

    public function run()
    {
        $this->init();
        $requestMethod = $this->request->getRequestMethod();
        $controller = BaseController::initial($requestMethod);
        $controller->execute();
    }

    protected function init()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->initEvents();
    }
}
