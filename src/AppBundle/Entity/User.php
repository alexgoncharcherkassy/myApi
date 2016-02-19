<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 19.02.16
 * Time: 17:19
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository", )
 */
class User implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", nullable=true)
     */
    protected $email;
    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", nullable=true)
     */
    protected $firstName;
    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", nullable=true)
     */
    protected $lastName;
    /**
     * @var string
     *
     * @ORM\Column(name="fb_token", type="string", nullable=true)
     */
    protected $fb_token;
    /**
     * @var string
     *
     * @ORM\Column(name="fb_id", type="string", nullable=true)
     */
    protected $fb_id;
    /**
     * @var string
     *
     * @ORM\Column(name="g_token", type="string", nullable=true)
     */
    protected $g_token;
    /**
     * @var string
     *
     * @ORM\Column(name="g_id", type="string", nullable=true)
     */
    protected $g_id;
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", nullable=true)
     */
    protected $type;
    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="string", nullable=true)
     */
    protected $roles;
    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", nullable=true)
     */
    protected $salt;
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", nullable=true)
     */
    protected $password;
    /**
     * @var string $plainPassword
     */
    protected $plainPassword;

    public function __construct()
    {
        $this->salt = md5(uniqid());
        $this->setRoles('ROLE_USER');
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        return [$this->roles];
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        return null;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fb_token
     *
     * @param string $fbToken
     * @return User
     */
    public function setFbToken($fbToken)
    {
        $this->fb_token = $fbToken;
        return $this;
    }

    /**
     * Get fb_token
     *
     * @return string
     */
    public function getFbToken()
    {
        return $this->fb_token;
    }

    /**
     * Set g_token
     *
     * @param string $gToken
     * @return User
     */
    public function setGToken($gToken)
    {
        $this->g_token = $gToken;
        return $this;
    }

    /**
     * Get g_token
     *
     * @return string
     */
    public function getGToken()
    {
        return $this->g_token;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Set fb_id
     *
     * @param string $fbId
     * @return User
     */
    public function setFbId($fbId)
    {
        $this->fb_id = $fbId;
        return $this;
    }

    /**
     * Get fb_id
     *
     * @return string
     */
    public function getFbId()
    {
        return $this->fb_id;
    }

    /**
     * Set g_id
     *
     * @param string $gId
     * @return User
     */
    public function setGId($gId)
    {
        $this->g_id = $gId;
        return $this;
    }

    /**
     * Get g_id
     *
     * @return string
     */
    public function getGId()
    {
        return $this->g_id;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return User
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set role
     *
     * @param Array $role
     * @return User
     */
    public function setRoles($role)
    {
        $this->roles = $role;
        return $this;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
        ));
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            ) = unserialize($serialized);
    }
}