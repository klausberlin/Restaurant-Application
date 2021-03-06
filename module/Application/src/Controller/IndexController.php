<?php

namespace Application\Controller;

use Application\Form;
use Zend\Authentication\Adapter\DbTable;
use Zend\Authentication\AuthenticationService;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;


class IndexController extends AbstractActionController
{
    /**
     * @var AuthenticationService
     */
    private $authService;

    public function __construct(AuthenticationService $auth)
    {
        $this->authService = $auth;
    }

    public function indexAction()
    {
        /** @var DbTable $adapter */
        $adapter = $this->authService->getAdapter();

        if ($this->authService->getIdentity()== true){
            $this->redirect()->toRoute('dashboard');
        }

        $form = new Form\Login();
        $form->setData($this->getRequest()->getPost()->toArray());


        // if form is post
        if($this->getRequest()->isPost()){
            if($form->isValid()){

                //Get data from post
                $data = $this->getRequest()->getPost();

                //Set data into form to validate data
                $form->setData($data);

                //checks if form is valid
                $username = $data['username'];
                $password = $data['password'];
                $worker = $data['worker'];
                $adapter->setIdentity($username); //username
                $adapter->setCredential($password); //password

                $columnsToReturn = [
                    'role',
                ];

                $result = $this->authService->authenticate();
                $role = $adapter->getResultRowObject($columnsToReturn)->role;
             //   print_r($role);
             //   exit;
                if (!$result->isValid()) {
                    // Authentication failed;
                    // print the reasons why:
                    echo "Bitte überprüfen sie Benutzername oder Password";

                } else {


                    if($role == 'Waitress'){
                        var_dump('Kellner');
                        $this->redirect()->toRoute('dashboard');

                    }elseif($role == 'Kitchen'){
                        var_dump('');
                        $this->redirect()->toRoute('dashboard');

                    }elseif($role == 'Manager') {
                        var_dump('MANAGER');
                        $this->redirect()->toRoute('dashboard');
                    } else{

                        return false;
                    }
                }
                //TEST
                // Authentication succeeded;
                // the identity ($username) is stored in the session:
                //$this->authService->getIdentity();
            }
        }
        return new ViewModel([
            'form'=>$form,
            'users'=>$this->authService->getStorage(),
        ]);
    }

    public function logoutAction()
    {
        $this->authService->clearIdentity();
        $this->redirect()->toRoute('home');
        return new ViewModel();
    }
}
