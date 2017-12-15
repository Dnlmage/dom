<?php

namespace engldom\Model;

use engldom\Model\BaseModel;
use engldom\Lib\QueryBulderFactory;
use engldom\Config;

/**
 * Class Message
 * @package engldom\Model
 */
class Message extends BaseModel
{

    /**
     * @var string
     */
    public $tableName = 'message';

    /**
     * @return mixed
     */
    public function findById()
    {
        $query = QueryBulderFactory::factory(Config::getSource())
            ->select()
            ->from($this->tableName)
            ->where('id = :id')
            ->query();

        return $this->source->query($query, array("id" => $this->getAttribute('id')));
    }

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


    /**
     * @return mixed
     */
    public function save()
    {
        $query = QueryBulderFactory::factory(Config::getSource())
            ->insert($this->tableName, ['body'], [':body']);
        return $this->source->query($query, array("body" => $this->getAttribute('body')));
    }
}
