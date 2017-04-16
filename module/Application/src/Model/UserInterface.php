<?php

/**
 * User: Alice in wonderland
 * Date: 31.03.2017
 * Time: 23:16
 */
namespace Application\Model;

Interface UserInterface
{
    public function getUserByName($username);
    public function getJson();
    public function getAllUsers();


}