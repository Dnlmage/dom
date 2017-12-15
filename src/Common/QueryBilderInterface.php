<?php

namespace engldom\Common;

interface QueryBilderInterface
{
    public function select(array $params);

    public function insert(string $tableName, array $fields, array $params);

    public function update();

    public function delete();
}
