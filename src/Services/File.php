<?php

namespace Services;

class File
{
    /**
     * @param $filename
     * @return bool|string
     */
    public function readFile($filename)
    {
        return file_get_contents($filename);
    }

    /**
     * @param $row
     * @return array
     */
    public function parseStr($row)
    {
        return json_decode($row);
    }
}