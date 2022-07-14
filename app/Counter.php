<?php

namespace App;

class Counter
{
    private string $counterName;
    private array $result = [];

    public function __construct(string $name)
    {
        $this->counterName = $name;
        $this->result = [
            $this->counterName => []
        ];
    }

    public function add(string $data) : void
    {
        if (array_key_exists($data, $this->result[$this->counterName])) {
            $this->result[$this->counterName][$data]++;
        } else {
            $this->result[$this->counterName][$data] = 1;
        }
    }

    public function getResult() : array
    {
        return $this->result;
    }
}