<?php
require_once 'models/Model.php';
class User extends Model
{
    public function __construct()
    {
        parent::__construct('users');
    }
}