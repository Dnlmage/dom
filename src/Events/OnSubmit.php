<?php

namespace engldom\Events;

use engldom\Common\EventsInterface;

/**
 * Class onSubmit
 * @package engldom\Events
 */
class OnSubmit implements EventsInterface
{
    /**
     * @param array $params
     */
    public static function execute(array $params = [])
    {
        $img = '/src/img/img.jpg';

        if (!empty($params['messageModel']->getAttribute('body'))) {
            $replacedBody = str_replace(':)',
                '<img src="' . $img . '">',
                $params['messageModel']->getAttribute('body'));
            $params['messageModel']->setAttribute('body', $replacedBody);
        }
    }
}
