<?php

namespace App;

class Config
{
    private array $configList;

    public function __construct()
    {
        $this->configList = require './config.php';
        $this->setFields();

    }

    private function setFields() : void
    {
        foreach ($this->configList as $name => $value) {
            $this->{$name} = $value;
        }
    }
}