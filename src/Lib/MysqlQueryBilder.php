<?php

namespace engldom\Lib;

use engldom\Common\QueryBilderInterface;

/**
 * Class MysqlQueryBilder
 * @package engldom\Lib
 */
class MysqlQueryBilder implements QueryBilderInterface
{

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var string
     */
    protected $query = '';

    /**
     * @var array
     */
    private $whereConditions = [];

    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * MysqlQueryBilder constructor.
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    /**
     * @param array $params
     * @return QueryBilderInterface
     */
    public function select(array $params = []): QueryBilderInterface
    {
        if (empty($params)) {
            $this->query .= 'SELECT * ';
        } else {
            $this->query .= 'SELECT ' . implode(',', $params);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function query(): string
    {
        return $this->query;
    }

    /**
     * @param $tableName
     * @return QueryBilderInterface
     */
    public function from(string $tableName): QueryBilderInterface
    {
        $this->query .= ' FROM ' . $tableName . ' ';
        return $this;
    }

    /**
     * @param $condition
     * @return QueryBilderInterface
     */
    public function where(string $condition): QueryBilderInterface
    {
        if (empty($this->whereConditions)) {
            $this->query .= ' WHERE ' . $condition . ' ';
            $this->whereConditions[] = $condition;
        } else {
            $this->query .= ' and ' . $condition . ' ';
            $this->whereConditions[] = $condition;
        }

        return $this;
    }

    /**
     * @param $tableName
     * @param $fields
     * @param $params
     * @return string
     */
    public function insert(string $tableName, array $fields, array $params): string
    {
        return "INSERT INTO " . $tableName . " (" . implode(',', $fields) . ") VALUES (" . implode(',', $params) . ")";
    }

    /**
     *
     */
    public function delete()
    {
        // TODO: Implement delete() method.
    }

    /**
     *
     */
    public function update()
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $condition
     */
    public function orWhere($condition)
    {
    }

    /**
     * @param $condition
     */
    public function order($condition)
    {
    }
}
