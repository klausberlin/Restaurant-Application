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
    public function removeSingleItem($itemId);
    public function insertItems($categoryId, $articleName, $articlePrice);
    public function getLatestItem();
    public function createCategory($categoryName);
    public function removeCategory($id);
    public function getLatestFromCategory();
    public function removeSingleFoodorderWithItemId($itemId);
    public function getAllOrdersFromUser($userId,$dateTime);

}