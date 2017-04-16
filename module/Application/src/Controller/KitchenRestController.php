<?php
/**
 * User: Alice in wonderland
 * Date: 05.04.2017
 * Time: 16:04
 */

namespace Application\Controller;


use Application\Model\UserInterface;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Mvc\MvcEvent;

//RESTful service for kitchen
class KitchenRestController extends AbstractRestfulController
{
    private $data;
    public function __construct(UserInterface $data)
    {
        $this->data = $data;
    }
    public function get($id)
    {
        $data=$this->data->getUserByName($id);
        if(!$data){
            return new JsonModel(['error'=>'Error']);
        }
        return new JsonModel($data);
    }

    public function getList()
    {
        // $type = $this->params()->fromRoute('type','get');
        $data = $this->data->getJson();

        if(!$data){
            return new JsonModel(['error'=>'Error']);
        }
        return new JsonModel($data);
    }
}