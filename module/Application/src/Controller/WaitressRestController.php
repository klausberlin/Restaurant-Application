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
    private $databaseInterface;

    /**
     * WaitressRestController constructor.
     * @param DataInterface $data
     */
    public function __construct(DataInterface $data)
    {
        $this->databaseInterface = $data;
    }

    /**
     * @param mixed $id
     * @return JsonModel
     */
    public function get($id)
    {
        $data = $this->databaseInterface->getSingleItem($id);

        if(!$data){
            return new JsonModel(['error'=>'Error']);
        }
        return new JsonModel($data);
    }

    /**
     * @return JsonModel
     */
    public function getList()
    {
        // $type = $this->params()->fromRoute('type','get');
        $data = $this->databaseInterface->getItems();

        if(!$data){
            return new JsonModel(['error'=>'Error']);
        }
        return new JsonModel($data);
    }

    /**
     * @param mixed $orderInformation
     * @return JsonModel
     */
    public function create($orderInformation)
    {
        print_r($orderInformation);

        $tableId =  $orderInformation['TableId'];
        $username = $orderInformation['UserName'];
        $orderPrice = $orderInformation['OrderPrice'];

        $usernameId = $this->databaseInterface->getUsers($username);

        $userId = 0;
        foreach($usernameId as $userIdValue) {
            $userId = $userIdValue['id'];
        }
        $this->databaseInterface->insertOrders($userId, $tableId, $orderPrice);

        //get the latest order to insert into foodorders
        $latest = $this->databaseInterface->getMax();
        $latestOrderId = 0;
        foreach($latest as $latestOrder) {
            $latestOrderId = $latestOrder['MaxId'];
        }

        foreach( $orderInformation['SelectedArticles'] as $value ) {
            $this->databaseInterface->insertFoodorders(substr($value,19), $tableId, $latestOrderId);
        }

        return new JsonModel();
    }
}