<?php
namespace engldom\Source;

use engldom\Common\SourceInterface;

/**
 * Class SourceFactory
 * @package engldom\Source
 */
class SourceFactory
{
    /**
     * @param string $type
     * @return SourceInterface
     */
    public static function factory(string $type): SourceInterface
    {
        if ($type === 'mysql') {
            return MysqlSource::getInstance();
        }

        throw new \InvalidArgumentException('Unknown source');
    }
}
