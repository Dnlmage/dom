<?php
namespace engldom\Responce;

use engldom\Common\ResponceInterface;

/**
 * Class JsonResponce
 * @package engldom\Responce
 */
class JsonResponce implements ResponceInterface
{
    /**
     * @param array $responceData
     */
    public function execute(array $responceData)
    {
        echo json_encode($responceData);
    }
}