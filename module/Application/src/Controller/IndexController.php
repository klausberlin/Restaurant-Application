<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Form;
use Zend\Form\Annotation\InputFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $form = new Form\Login();



        // if form is post
        if($this->getRequest()->isPost()){

            //Get data from post
            $data = $this->getRequest()->getPost();

            //Set data into form to validate data
            $form->setData($data);

            //checks if form is valid
            if($form->isValid()) {
                echo $this->getRequest()->getContent();
            }


        }

        return new ViewModel([
            'form'=>$form
        ]);
    }
}
