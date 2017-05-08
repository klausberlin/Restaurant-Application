<?php
/**
 * User: Alice in wonderland
 * Date: 05.04.2017
 * Time: 16:04
 */

namespace Application\Controller;


use Application\Model\DataInterface;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

//RESTful service for kitchen
class WaitressRestController extends AbstractRestfulController
{
    private $database_interface;
    public function __construct(DataInterface $data)
    {
        $this->database_interface = $data;
    }
    public function get($id)
    {
        $data = $this->database_interface->getSingleItem($id);

        if(!$data){
            return new JsonModel(['error'=>'Error']);
        }
        return new JsonModel($data);
    }

    public function getList()
    {
        // $type = $this->params()->fromRoute('type','get');
        $data = $this->database_interface->getItems();

        if(!$data){
            return new JsonModel(['error'=>'Error']);
        }
        return new JsonModel($data);
    }
    public function create($data)
    {
        $i=0;
        $j=0;
        $totalPrice = 0;

        print_r($data);

        //get username
        //get current table from view/[order], to save in table order
        foreach($data as $key => $value)
        {
            $name[$i] = $key;
            $table_name[$i] = $value;
            $i++;

        }
        $orders = json_decode($table_name[1]);

        //get the ID from orders
        foreach ($orders as $order)
        {
            //clean the string and only save the id
            $order_value[$j]=substr($order,19);
            $j++;
        }

        //get the ID from the orders and calculate the current order
        foreach($order_value as $itemId)
        {
            $item_data = $this->database_interface->getSingleItem($itemId);
            foreach($item_data as $itemValue)
            {
                //add the total price
                print_r($itemValue);
                $totalPrice += $itemValue['price'];
            }
        }

        //get user information
        $userInfoArray = $this->database_interface->getUsers($name[0]);
        foreach($userInfoArray as $newna)
        {
            //get user ID to save in orders table
            $userId = $newna['id'];
        }
        /*
         * TODO
         * 1. Insert VALUES (users_id, tables_id, totalprice) into Table orders
         * 2. Get the last ID form orders to insert it to table foodorders to build a conncetion between foodorders and orders
         * 3. Loop over orders we get from the view and insert it to food orders with the the last id from orders
         * */



        $tableId = substr($table_name[0],5);

       /* print_r($userId);
        print_r($totalPrice);*/

        $this->database_interface->insertOrders($userId,$tableId,$totalPrice);;

        //get the latest order to insert into foodorders
        $latest = $this->database_interface->getMax();
        foreach($latest as $latest_order)
        {
            $latestOrderId=$latest_order['MaxId'];
        }


        foreach($order_value as $itemId)
        {

            print_r("Artikel::::: ".$itemId."  ");
            print_r("Tisch::::: ".$tableId."  ");
            print_r("Bestellnummer::::: ".$latestOrderId."  ");


           /* $item_data = $this->database_interface->getSingleItem($itemId);
            foreach($item_data as $itemValue)
            {
                //add the total price
                print_r($itemValue);
                $totalPrice += $itemValue['price'];
            }*/
        }

        exit;
        foreach($data as $orders){
            $new=json_decode($orders);
            foreach($new as $key => $value){
                $order_value[$i]=substr($value,19);
                $i++;
            }
        }
      /*  $this->database_interface->postOrders($order_value);*/
        foreach($order_value as $itemData => $itemId)
        {
            $item_data = $this->database_interface->getSingleItem($itemId);

            foreach($item_data as $itemValue)
            {
                print_r($itemValue);

                $totalPrice += $itemValue['price'];

            }
        }

        exit;

        return new JsonModel(array('data' => array('id'=> 3, 'name' => 'New Album', 'band' => 'New Band')));

    }
}