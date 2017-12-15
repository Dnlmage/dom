<?php
namespace engldom\Controller;

use engldom\Common\ExecutableInterface;
use engldom\Model\Message;

/**
 * Class GetController
 * @package engldom\Controller
 */
class GetController extends BaseController implements ExecutableInterface
{
    /**
     * @return mixed
     */
    public function execute()
    {
        $messageModel = new Message();
        return static::getResponce()->execute($messageModel->findAll());
    }
}
