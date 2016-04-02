<?php
namespace SellDreams\Domain;

use Symfony\Component\Security\Core\User\UserInterface;
class User implements UserInterface
{
    /**
     * User id.
     *
     * @var integer
     */
    private $id;
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * User name.
     *
     * @var string
     */
    private $username;
    public function getUsername() {
        return $this->username;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    
    /**
     * User name.
     *
     * @var string
     */
    private $userlastname;
    public function getUserlastname() {
        return $this->userlastname;
    }
    public function setUserlastname($userlastname) {
        $this->userlastname = $userlastname;
    }
    
    /**
     * User name.
     *
     * @var string
     */
    private $adress;
    public function getAdress() {
        return $this->adress;
    }
    public function setAdress($adress) {
        $this->adress = $adress;
    }
    
    /**
     * User name.
     *
     * @var string
     */
    private $postalcode;
    public function getPostalcode() {
        return $this->postalcode;
    }
    public function setPostalcode($postalcode) {
        $this->postalcode = $postalcode;
    }
    
    /**
     * User name.
     *
     * @var string
     */
    private $city;
    public function getCity() {
        return $this->city;
    }
    public function setCity($city) {
        $this->city = $city;
    }
    
    /**
     * User name.
     *
     * @var string
     */
    private $email;
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    /**
     * User password.
     *
     * @var string
     */
    private $password;
    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    
    /**
     * Salt that was originally used to encode the password.
     *
     * @var string
     */
    private $salt;
    public function getSalt()
    {
        return $this->salt;
    }
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }
    
    /**
     * Role.
     * Values : ROLE_USER or ROLE_ADMIN.
     *
     * @var string
     */
    private $role;
    public function getRole(){
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }
    public function getRoles()
    {
        return array($this->getRole());
    }
    
    
    



    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
        // Nothing to do here
    }
}