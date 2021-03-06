<?php

namespace Application\Controller;


use Application\Model\DataInterface;
use Application\Model\UserInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;



class DashboardController extends AbstractActionController
{
    private $authService;
    private $_username;
    private $_userInterface;
    private $_user;
    private $dataInterface;

    //DI Database
    public function __construct(UserInterface $user_interface, DataInterface $dataInterface)
    {
        $this->authService = new AuthenticationService;
        $this->_username = $this->authService->getIdentity();
        $this->_userInterface = $user_interface;

        $user = $this->_userInterface->getUserByName($this->_username);
        $this->dataInterface = $dataInterface;

        foreach($user as $userRole){
            $this->_user = $userRole['role'];
        }
    }

    public function onDispatch(MvcEvent $e)
    {
        $this->_username = $this->authService->getIdentity();
        if ($this->authService->getIdentity() != true){
            $this->redirect()->toRoute('home');
        }
        $username = $this->_userInterface->getUserByName($this->_username);
        //check role of identity to verify the existing user to the dashboard
        foreach($username as $userRole){
            $role = $userRole['role'];
            if($role === 'Waitress'){
                $this->redirect()->toRoute('waitress');
            }
            elseif($role==='Kitchen'){
                $this->redirect()->toRoute('kitchen');
            }
        }
        return parent::onDispatch($e);
    }

    public function indexAction()
    {
        $getUsers = $this->_userInterface->getAllUsers();

        return new ViewModel([
            'allUsers'=>$getUsers,
        ]);
    }

    /**
     * @return ViewModel
     */
    public function userAction()
    {
        //Handle data from datepicker
        $orders = [];
        $waitress = $this->_userInterface->getAllUsers();
        $request = $this->getRequest();
        if($request->getMethod() == 'GET')
        {
            if(!empty($this->params()->fromQuery('datepicker')))
            {
                $userDateTime = date('Y-m-d',strtotime($this->params()->fromQuery('datepicker')));
                $userId = $this->params()->fromQuery('waitress-id');
                $ordersFromWaitress = $this->dataInterface->getAllOrdersFromUser($userId,$userDateTime);

                foreach ($ordersFromWaitress as $waitressOrders){
                    $orders[] = $waitressOrders;
                }

            }else{
                echo "keine Daten für diesen Zeitraum vorhanden";
            }
        }

        return new ViewModel([
            'waitress' => $waitress,
            'orders' => $orders
        ]);
    }

    public function userinfoAction()
    {
        return new ViewModel();
    }




    /**
     * Handle Data from admin/manager-page to insert or delete an item
     * @return ViewModel
     */
    public function menuAction()
    {
        $items = $this->dataInterface->getItems();

        $request = $this->getRequest();
        $response = $this->getResponse();

        if($request->isPost()) {

            $addPost = $this->params()->fromPost('add');
            $deletePost = $this->params()->fromPost('delete');
            $createPost = $this->params()->fromPost('create');
            $deleteCategroy = $this->params()->fromPost('delete-category');



            if($createPost){
                if($createPost != ''){
                    if(!empty($createPost)){

                        $this->dataInterface->createCategory($createPost);
                        $newCategory = $this->dataInterface->getLatestFromCategory();
                        return $response->setContent(\Zend\Json\Json::encode($newCategory));
                    }
                }
            }

            if($addPost){
                if(!empty($addPost)){
                    $categoryId = $addPost['category_id'];
                    $articleName = $addPost['article_name'];
                    $articlePrice = $addPost['article_price'];

                    $this->dataInterface->insertItems($categoryId,$articleName,$articlePrice);

                    $latestItem = $this->dataInterface->getLatestItem();
                    return $response->setContent(\Zend\Json\Json::encode($latestItem));
                }
            }


            if($deletePost){
                if(!empty($deletePost)){
                    if(is_numeric($deletePost)){
                        $this->dataInterface->removeSingleFoodorderWithItemId($deletePost);
                        $this->dataInterface->removeSingleItem($deletePost);
                        return $response->setContent(\Zend\Json\Json::encode('{test:ets}'));
                    }
                }
            }

            if($deleteCategroy){
                if(!empty($deleteCategroy)){
                    if(is_numeric($deleteCategroy)){
                        $this->dataInterface->removeCategory($deleteCategroy);
                        return $response->setContent(\Zend\Json\Json::encode('delete category'));
                    }
                }
            }
        }

        foreach($items as $item){

            $itemId[] = $item['id'];

        }


        return new ViewModel([
            'categories' => $this->dataInterface->getCategories(),
            'items' => $items,
            'itemId' => $itemId
        ]);
    }
}