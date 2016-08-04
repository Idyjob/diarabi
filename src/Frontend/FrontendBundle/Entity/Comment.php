<?php

namespace Frontend\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Comment
 *
 * @ORM\Table("comments")
 * @ORM\Entity(repositoryClass="Frontend\FrontendBundle\Repository\CommentRepository")
 */
class Comment
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
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="Frontend\FrontendBundle\Entity\User",inversedBy="comments",fetch="EAGER",cascade={ "detach"})
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
     * @ORM\ManyToOne(targetEntity="Frontend\FrontendBundle\Entity\Article", inversedBy="comments", cascade={ "detach"})
     * @ORM\JoinColumn(nullable = true)
     */
     private $article;


     /**
     * @var Collection
     * @ORM\ManyToOne(targetEntity="Frontend\FrontendBundle\Entity\Event", inversedBy="comments", cascade={ "persist","detach"})
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
     * Set contenu
     *
     * @param string $contenu
     * @return Comment
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
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
     * @return Comment
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
     * @return Comment
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
     * @return Comment
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
     * @return Comment
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
