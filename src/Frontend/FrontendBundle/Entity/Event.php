<?php

namespace Frontend\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Event
 *
 * @ORM\Table("events")
 * @ORM\Entity(repositoryClass="Frontend\FrontendBundle\Repository\EventRepository")
 */
class Event
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

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
    * @ORM\ManyToMany(targetEntity="Frontend\FrontendBundle\Entity\Media" , indexBy="id",cascade={ "persist","remove","detach"})
    * @ORM\JoinTable(name="events_medias",
    *      inverseJoinColumns={@ORM\JoinColumn(name="mediaId", referencedColumnName="id")},
    *      joinColumns={@ORM\JoinColumn(name="produitId", referencedColumnName="id")}
    *      )
  */
    private $medias;

    /**
    * @var Collection
    * @ORM\OneToMany(targetEntity="Frontend\FrontendBundle\Entity\Comment", mappedBy="event")
    * @ORM\JoinColumn(nullable = true)
    */
   private $comments;

   /**
   * @var Collection
   * @ORM\OneToMany(targetEntity="Frontend\FrontendBundle\Entity\Likeable", mappedBy="event")
   * @ORM\JoinColumn(nullable = true)
   */
   private $likes;

    /**
     * @var string
     *@Gedmo\Slug(fields={"titre"})
     * @ORM\Column(name="slug", type="string", unique=true,length=255)
     */
    private $slug;

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
     * @return Event
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
     * Set titre
     *
     * @param string $titre
     * @return Event
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Event
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
     * Constructor
     */
    public function __construct()
    {
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->likes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Event
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Event
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add medias
     *
     * @param \Frontend\FrontendBundle\Entity\Media $medias
     * @return Event
     */
    public function addMedia(\Frontend\FrontendBundle\Entity\Media $medias)
    {
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \Frontend\FrontendBundle\Entity\Media $medias
     */
    public function removeMedia(\Frontend\FrontendBundle\Entity\Media $medias)
    {
        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * Add comments
     *
     * @param \Frontend\FrontendBundle\Entity\Comment $comments
     * @return Event
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
     * @return Event
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
