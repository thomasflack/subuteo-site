<?php

class DB_Test{
    private function create()
    {
        return new DB('localhost', 'root', '', 'test2');
    }
