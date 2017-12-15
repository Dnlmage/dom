<?php
namespace engldom\Lib;

use engldom\Common\QueryBilderInterface;

/**
 * Class QueryBulderFactory
 * @package engldom\Lib
 */
class QueryBulderFactory
{
    /**
     * @param string $type
     * @return QueryBilderInterface
     */
    public static function factory(string $type = '') : QueryBilderInterface
    {
        if ($type === 'mysql') {
            return new MysqlQueryBilder();
        }

        throw new \InvalidArgumentException('Unknown source');
    }
}
