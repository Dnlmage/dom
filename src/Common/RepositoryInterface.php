<?php
namespace engldom\Common;

interface RepositoryInterface
{
    public function getSource() : SourceInterface;

    public function setSource();
}
