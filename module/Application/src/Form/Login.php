<?php
/**
 * Created by PhpStorm.
 * User: Pawel_000
 * Date: 06.03.2017
 * Time: 19:46
 */

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class Login extends Form
{
    public function __construct()
    {
        //define form name
        parent::__construct('auth-form');

        //set POST method for this form
        $this->setAttribute('method','post');

        $this->addElements();
        $this->addInputFilter();
    }

    protected function addElements()
    {
        $this->add(
            [
                'type' => 'text',
                'name' => 'username',
                'options' => [
                    'label' => 'Your E-mail',
                ],
            ]
        );

        $this->add(
            [
                'type' => 'password',
                'name' => 'password',
                'options' => [
                    'label' => 'Password',
                ]
            ]
        );

        $this->add(
          [
              'type' => 'radio',
              'name' => 'worker',
              'options' => array(
                  'label' => 'What is your current work position?',
                  'value_options' => array(
                      '0' => 'Waitress',
                      '1' => 'Kitchen',
                  ),
              )
          ]);

        $this->add(
            [
            'type'  => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Submit',
            ],
        ]);

    }

    private function addInputFilter()
    {

        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
           'name' => 'username',
            'require' => true,
            'filters' => [
                ['name'=>'StringTrim'],
            ],
        ]
        );

        $inputFilter->add([
           'name' => 'password',
            'require' => true,
            'filters' => [
                ['name'=>'StringTrim'],
            ],
        ]);
    }
}
