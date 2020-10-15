<?php

declare(strict_types=1);

class PostLoader
{
    private $msgArray = [];

    public function pushToArray($data)
    {
        array_push($this->msgArray, $data);

    }

    public function getAllpost()
    {
        return $this->msgArray;
    }

    public function encodeAllpost()
    {
        return json_encode($this->msgArray, JSON_PRETTY_PRINT);
    }

    public function saveInJson($filename, $encodedArray)
    {
        return file_put_contents($filename, $encodedArray);
    }
}