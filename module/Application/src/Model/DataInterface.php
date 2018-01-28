<?php

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
    public function insertFoodorders($itemId, $tableID, $orderId);
    public function getAllFoodorders();
    public function updateFoodordersStatus($itemId, $statusId);

}