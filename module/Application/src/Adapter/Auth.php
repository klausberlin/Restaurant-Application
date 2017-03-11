<?php
/**
 * Created by PhpStorm.
 * User: Pawel_000
 * Date: 06.03.2017
 * Time: 19:48
 */

namespace Application\Auth;


use Zend\Authentication\Result;
use Zend\Authentication\Adapter\AdapterInterface;

class Auth implements AdapterInterface
{


    protected $email;

    protected $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;

    }
    /**
     * @return Result
     */
    public function authenticate()
    {





//        /** @var User $user */
//        $user = $this->entityManager->getRepository(User::class)->findOneBy(
//            [
//                'email' => $this->email,
//                'password' => User::encryptPassword($this->password)
//            ]
//        );
//        if (null === $user) {
//            return new Result(Result::FAILURE_CREDENTIAL_INVALID, null);
//        } elseif (false === $user->getActive()) {
//            return new Result(Result::FAILURE_IDENTITY_AMBIGUOUS, null);
//        } else {
//            return new Result(Result::SUCCESS, $user->getId());
//        }


    }

}