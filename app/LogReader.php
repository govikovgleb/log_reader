<?php

namespace App;

class LogReader
{
    private string $logPath;

    public function __construct(string $path)
    {
        $this->logPath = $path;
    }

    /**
     * @return iterable
     */
    public function read() : iterable
    {
        $handle = fopen($this->logPath, "r");

        while(!feof($handle)) {
            yield trim(fgets($handle));
        }

        fclose($handle);
    }
}