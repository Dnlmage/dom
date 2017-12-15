<?php

namespace engldom\Model;

use yii\db\Exception;
use engldom\Common\SourceInterface;
use engldom\Config;
use engldom\Source\SourceFactory;

/**
 * Class BaseModel
 * @package engldom\Model
 */
class BaseModel
{

    /**
     * @var SourceInterface
     */
    protected $source;

    /**
     * @var
     */
    public $tableName;
    /**
     * @var array
     */
    public $attributes = [];

    /**
     * MessageRepository constructor.
     */
    public function __construct()
    {
        $this->source = SourceFactory::factory(Config::getSource());
    }

    /**
     * @param string $name
     * @param $value
     */
    public function setAttribute(string $name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getAttribute(string $name)
    {
        try {
            return $this->attributes[$name];
        } catch (Exception $e) {
            throw new \InvalidArgumentException('Unknown attribute');
        }
    }

    /**
     * @return SourceInterface
     */
    public function getSource(): SourceInterface
    {
        return $this->source;
    }
}
