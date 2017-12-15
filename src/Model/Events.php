<?php

namespace engldom\Model;

use engldom\Lib\QueryBulderFactory;
use engldom\Config;

/**
 * Class Events
 * @package engldom\Model
 */
class Events extends BaseModel
{

    /**
     * @var string
     */
    public $tableName = 'events';


    /**
     * @return mixed
     */
    public function findAll()
    {
        $query = QueryBulderFactory::factory(Config::getSource())
            ->select()
            ->from($this->tableName)
            ->query();

        return $this->source->query($query);
    }
}
