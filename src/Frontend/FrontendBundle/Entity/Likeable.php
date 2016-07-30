<?php

namespace Frontend\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Likeable
 *
 * @ORM\Table(name="aimes")
 * @ORM\Entity(repositoryClass="Frontend\FrontendBundle\Repository\LikeableRepository")
 */
class Likeable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Frontend\FrontendBundle\Entity\User")
     * @ORM\JoinColumn(name="member_id",nullable= false)
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;


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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Likeable
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
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
     * Set user
     *
     * @param \Frontend\FrontendBundle\Entity\User $user
     * @return Likeable
     */
    public function setUser(\Frontend\FrontendBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Frontend\FrontendBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
