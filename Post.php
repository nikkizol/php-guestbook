<?php

declare(strict_types=1);

class Post
{
    private $title;
    private $date;
    private $authorName;
    private $content;
    private $jsonList = [];


    public function __construct(string $title, $date, string $authorName, string $content)
    {

        $this->title = $title;
        $this->date = $date;
        $this->authorName = $authorName;
        $this->content = $content;
    }


    public function fetchPosts()
    {
        $this->jsonList = json_decode(file_get_contents('guestbook.json'), true);

        return $this->jsonList;
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        if (!isset($this->title)) {
            $this->title = "";
        } else {
            $this->title = (string)$this->title;
        }
        return $this->title;
    }


    /**
     * @return string
     */
    public function getContent(): string
    {
        if (!isset($this->content)) {
            $this->content = "";
        } else {
            $this->content = (string)$this->content;
        }
        return $this->content;
    }

    /**
     * @return string
     */
    public function getAuthorName(): string
    {
        if (!isset($this->authorName)) {
            $this->authorName = "";
        } else {
            $this->authorName = (string)$this->authorName;
        }
        return $this->authorName;
    }
}