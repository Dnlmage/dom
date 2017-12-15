<?php

namespace engldom\Controller;

use engldom\Common\ExecutableInterface;
use engldom\Request\Request;
use engldom\Model\Message;
use engldom\EventManager;

/**
 * Class PostController
 * @package engldom\Controller
 */
class PostController extends BaseController implements ExecutableInterface
{
    public function execute()
    {
        $resultSave = false;
        $message = Request::post('message');
        if (!empty($message)) {
            $messageModel = new Message();
            $messageModel->setAttribute('body', $message);
            EventManager::getInstance()->emit('OnSubmit', ['messageModel' => $messageModel]);
            $resultSave = $messageModel->save();
        }

        return static::getResponce()->execute(['resultSave' => $resultSave]);
    }
}
