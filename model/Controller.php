<?php


class Controller
{
    protected $pdo;


    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=' . DB_CONNECTION_DB, DB_CONNECTION_USER, DB_CONNECTION_PASS);
    }
}