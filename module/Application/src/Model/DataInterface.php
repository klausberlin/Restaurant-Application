<?php
/**
 * User: Alice in wonderland
 * Date: 18.04.2017
 * Time: 23:37
 */

namespace Application\Model;


interface DataInterface
{
    public function getCategories();
    public function getjoins();
    public function getSingleItem($id);
    public function getItems();
    public function getTables();
    public function insertOrders($userId,$tableId,$totalPrice);
    public function getUsers($username);
    public function getMax();

}