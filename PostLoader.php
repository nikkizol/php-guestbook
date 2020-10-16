<?php

declare(strict_types=1);

class PostLoader
{
    private array $msgArray = [];

    function __construct($name, $title, $date, $message)
    {
        $this->msgArray = ['name' => $name, 'title' => $title, 'date' => $date, 'message' => $message];
    }

    public function saveData()
    {
        $myData = $this->getAllpost();
        if (empty($myData)) {
            $myData = [];
        }
        array_push($myData, $this->msgArray);
        file_put_contents("guestbook.json", json_encode($myData, JSON_PRETTY_PRINT));
        return $myData;
    }

    public function getAllpost()
    {

        if (!empty(file_get_contents("guestbook.json"))) {
            $data = file_get_contents("guestbook.json");
            $data1 = json_decode($data);
            return $data1;
        }

    }

}