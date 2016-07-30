<?php

namespace Frontend\FrontendBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="members")
 * @ORM\Entity(repositoryClass="Frontend\FrontendBundle\Repository\UserRepository")
 */
class User extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Frontend\FrontendBundle\Entity\Group", inversedBy="users")
     * @ORM\JoinTable(name="members_groups",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
     * @ORM\Column(type="integer", length=6, options={"default":0})
     */
    protected $loginCount = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $firstLogin;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_activity",type="datetime", nullable=true)
     */
    private   $lastActivity;
    /**
    *@Gedmo\Timestampable(on="create")
    *@ORM\Column(name = "created_at", type="datetime",nullable=true)
    *
    */
    private $createdAt;

    /**
    *@Gedmo\Timestampable(on="update")
    *@ORM\Column(name = "updated_at", type="datetime",nullable=true)
    *
    */
    private $updatedAt;

    public function __construct() {
        parent::__construct();
        $this->groups = new ArrayCollection();
    }
    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set loginCount
     *
     * @param integer $loginCount
     *
     * @return User
     */
    public function setLoginCount($loginCount) {
        $this->loginCount = $loginCount;
        return $this;
    }

    /**
     * Get loginCount
     *
     * @return integer
     */
    public function getLoginCount() {
        return $this->loginCount;
    }

    /**
     * Set firstLogin
     *
     * @param \DateTime $firstLogin
     *
     * @return User
     */
    public function setFirstLogin($firstLogin) {
        $this->firstLogin = $firstLogin;
        return $this;
    }

    /**
     * Get firstLogin
     *
     * @return \DateTime
     */
    public function getFirstLogin() {
        return $this->firstLogin;
    }

    function getEnabled() {
        return $this->enabled;
    }

    function getLocked() {
        return $this->locked;
    }

    function getExpired() {
        return $this->expired;
    }

    function getExpiresAt() {
        return $this->expiresAt;
    }

    function getCredentialsExpired() {
        return $this->credentialsExpired;
    }

    function getCredentialsExpireAt() {
        return $this->credentialsExpireAt;
    }

    function setSalt($salt) {
        $this->salt = $salt;
    }

    public function setPassword($password) {
        if ($password !== null)
            $this->password = $password;
        return $this;
    }

    function setGroups(Collection $groups = null) {
        if ($groups !== null)
            $this->groups = $groups;
    }

    public function setRoles(array $roles = array()) {
        $this->roles = array();
        foreach ($roles as $role)
            $this->addRole($role);
        return $this;
    }

    public function hasGroup($name = '') {
        return in_array($name, $this->getGroupNames());
    }
public function isActiveNow(){
$this->setLastActivity(new \DateTime());
}

    /**
     * Set lastActivity
     *
     * @param \DateTime $lastActivity
     * @return User
     */
    public function setLastActivity($lastActivity)
    {
        $this->lastActivity = $lastActivity;

        return $this;
    }

    /**
     * Get lastActivity
     *
     * @return \DateTime
     */
    public function getLastActivity()
    {
        return $this->lastActivity;
    }
}
