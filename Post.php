<?php

declare(strict_types=1);

class Post
{
    private $title;
    private $date;
    private $authorName;
    private $content;


    public function __construct(string $title, $date, string $authorName, string $content)
    {

        $this->title = $title;
        $this->date = $date;
        $this->authorName = $authorName;
        $this->content = $content;
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {

        return $this->title;
    }


    /**
     * @return string
     */
    public function getContent(): string
    {

        return $this->content;
    }

    /**
     * @return string
     */
    public function getAuthorName(): string
    {

        return $this->authorName;
    }
}