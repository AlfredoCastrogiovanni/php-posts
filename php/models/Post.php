<?php

class Post {
    public $id;
    public $title;
    public $content;
    public $image;
    public $user_id;
    public $category_id;

    public function __construct(int $id, String $title, String $content, String $image, int $user_id, int $category_id) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->image = $image;
        $this->user_id = $user_id;
        $this->category_id = $category_id;
    }
}