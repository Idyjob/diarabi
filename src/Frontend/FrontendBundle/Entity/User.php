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
    *@Gedmo\Timestampable(on="change", field={"password","username","email"})
    *@ORM\Column(name = "updated_at", type="datetime",nullable=true)
    *
    */
    private $updatedAt;

    /**
    * @var Collection
    * @ORM\OneToMany(targetEntity="Frontend\FrontendBundle\Entity\Comment", mappedBy="user", cascade={ "remove"})
    * @ORM\JoinColumn(nullable = true)
    */
   private $comments;

   /**
   * @var Collection
   * @ORM\OneToMany(targetEntity="Frontend\FrontendBundle\Entity\Likeable", mappedBy="user", cascade={ "remove"})
   * @ORM\JoinColumn(nullable = true)
   */
   private $likes;



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

    // function setGroups(Collection $groups = null) {
    //     if ($groups !== null){
    //         $this->groups = $groups;
    //     }else{
    //         $this->groups = null;
    //     }
    //
    // }

    function setGroups(ArrayCollection $groups = null) {
        if ($groups !== null){
            $this->groups = $groups;
        }else{
            $this->groups = null;
        }

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

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Add comments
     *
     * @param \Frontend\FrontendBundle\Entity\Comment $comments
     * @return User
     */
    public function addComment(\Frontend\FrontendBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Frontend\FrontendBundle\Entity\Comment $comments
     */
    public function removeComment(\Frontend\FrontendBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add likes
     *
     * @param \Frontend\FrontendBundle\Entity\Likeable $likes
     * @return User
     */
    public function addLike(\Frontend\FrontendBundle\Entity\Likeable $likes)
    {
        $this->likes[] = $likes;

        return $this;
    }

    /**
     * Remove likes
     *
     * @param \Frontend\FrontendBundle\Entity\Likeable $likes
     */
    public function removeLike(\Frontend\FrontendBundle\Entity\Likeable $likes)
    {
        $this->likes->removeElement($likes);
    }

    /**
     * Get likes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLikes()
    {
        return $this->likes;
    }
}
