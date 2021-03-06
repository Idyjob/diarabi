<?php
namespace Frontend\FrontendBundle\Entity;
 use FOS\UserBundle\Model\Group as BaseGroup;
 use Doctrine\ORM\Mapping as ORM;
 use Gedmo\Mapping\Annotation as Gedmo;
 /**
 * @ORM\Table(name="groupes")
 * @ORM\Entity(repositoryClass="Frontend\FrontendBundle\Repository\GroupRepository")
 */
 class Group extends BaseGroup
  {
    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;
    /**
     * @ORM\ManyToMany(targetEntity="Frontend\FrontendBundle\Entity\User", mappedBy="groups")
    */
    protected $users;

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
    public function __construct($name = '', $roles = array()){
      $this->name = $name;
      $this->roles = $roles;
    }

    public function __toString() {
        return $this->getName();
    }

    function getUsers() {
        return $this->users;
    }


    /**
     * Add users
     *
     * @param \Frontend\FrontendBundle\Entity\User $users
     * @return Group
     */
    public function addUser(\Frontend\FrontendBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Frontend\FrontendBundle\Entity\User $users
     */
    public function removeUser(\Frontend\FrontendBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Group
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
     * @return Group
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
