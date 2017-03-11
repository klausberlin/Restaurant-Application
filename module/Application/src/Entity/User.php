<?php


namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $email;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $password;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $role;
    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default": true})
     */
    private $active;
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }
    /**
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }
    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = static::encryptPassword($password);
    }
    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }
    /**
     * @param bool $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }
    /**
     * @param string $password
     * @return string
     */
    public static function encryptPassword($password)
    {
        return sha1(md5($password) . sha1($password));
    }
}