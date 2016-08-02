<?php

namespace Frontend\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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
     * @ORM\ManyToOne(targetEntity="Frontend\FrontendBundle\Entity\User",inversedBy="likes",cascade={ "detach"})
     * @ORM\JoinColumn(name="member_id",nullable= false)
     */
    private $user;

    /**
    *@Gedmo\Timestampable(on="create")
    *@ORM\Column(name = "created_at", type="datetime",nullable=true)
    *
    */
    private $createdAt;

    /**
    * @var Collection
    * @ORM\ManyToOne(targetEntity="Frontend\FrontendBundle\Entity\Article", inversedBy="likes", cascade={ "persist","detach"})
    * @ORM\JoinColumn(nullable = true)
    */
    private $article;


    /**
    * @var Collection
    * @ORM\ManyToOne(targetEntity="Frontend\FrontendBundle\Entity\Event", inversedBy="likes", cascade={ "persist","detach"})
    * @ORM\JoinColumn(nullable = true)
    */
    private $event;



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
     * Set article
     *
     * @param \Frontend\FrontendBundle\Entity\Article $article
     * @return Likeable
     */
    public function setArticle(\Frontend\FrontendBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Frontend\FrontendBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set event
     *
     * @param \Frontend\FrontendBundle\Entity\Event $event
     * @return Likeable
     */
    public function setEvent(\Frontend\FrontendBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \Frontend\FrontendBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }
}
