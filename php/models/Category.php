<?php

class Category {
    public $id;
    public $name;

    public function __construct(int $id, String $name) {
        $this->id = $id;
        $this->name = $name;
    }
}