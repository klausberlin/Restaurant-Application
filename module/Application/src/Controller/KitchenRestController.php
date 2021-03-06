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
use Zend\Mvc\MvcEvent;

//RESTful service for kitchen
class KitchenRestController extends AbstractRestfulController
{
    private $data;

    /**
     * KitchenRestController constructor.
     * @param DataInterface $data
     */
    public function __construct(DataInterface $data)
    {

        $this->data = $data;
    }

    /**
     * @param mixed $id
     */
    public function get($id)
    {
//        $data=$this->data->getUserByName($id);
//        if(!$data){
//            return new JsonModel(['error'=>'Error']);
//        }
//        return new JsonModel($data);
    }


    /**
     * @return JsonModel
     */
    public function getList()
    {
        $data = $this->data->getAllFoodorders();

        $i = 1;
        $order=[];

        //create the correct array object to show in *kitchen for the newest orders
        foreach($data as $separateData){
            $items = $this->data->getSingleItem($separateData['item_id']);

            foreach($items as $itemData) {

                $itemName = $itemData['name'];
                $itemPrice = $itemData['price'];
            }
            $order[] = [
                'orderId' => $separateData['order_id'],
                'tableId' => $separateData['table_id'],
                'itemId' => $separateData['id'],
                'statusId' => $separateData['status_id'],
                'item' => [
                        'name' => $itemName,
                        'price' => $itemPrice
                ]
            ];

            $orderId = $separateData['order_id'];

            $i++;
        }

        if(!$data){
            return new JsonModel(['error'=>'Error']);
        }
        return new JsonModel($order);
    }

    /**
     * @param mixed $orderInformation
     * @return mixed
     * ToDo Erldigen von korrekter Datenübermittlung von Küche und Datenbank. Es sollen drei Schritte erfolgen
     * ToDo ..
     */
    public function create($orderInformation)
    {

        if ($this->getRequest()->isPost()){
            if(!empty($this->getRequest())){

                switch($orderInformation['status_id']){

                    case '0':

                        $this->data->updateFoodordersStatus($orderInformation['id'],1);

                        break;

                    case '1':

                        $this->data->updateFoodordersStatus($orderInformation['id'],2);

                        break;


                    case '2':


                        break;






                }
            }


        }


//        return parent::create($orderInformation); // TODO: Change the autogenerated stub
        //return new JsonModel();
    }
}