<?php
include ('testDb.php');

class testDbFactory{
    public function create()
    {
        return new mysqli('localhost', 'root', '', 'test');
    }
}
