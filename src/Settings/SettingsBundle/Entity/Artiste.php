<?php

namespace Settings\SettingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Artiste
 *
 * @ORM\Table(name="artistes")
 * @ORM\Entity(repositoryClass="Settings\SettingsBundle\Repository\ArtisteRepository")
 */
class Artiste
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="biography", type="text")
     */
    private $biography;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;


    /**
    * @ORM\OneToOne(targetEntity="Frontend\FrontendBundle\Entity\Media" ,cascade={ "persist","detach"})
    * @ORM\JoinColumn(nullable = false)
  */
    private $media;

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
     *@Gedmo\Slug(fields={"nom","prenom"})
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
     * Set nom
     *
     * @param string $nom
     * @return Artiste
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Artiste
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set biography
     *
     * @param string $biography
     * @return Artiste
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get biography
     *
     * @return string
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Artiste
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Artiste
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
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
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set medias
     *
     * @param \Frontend\FrontendBundle\Entity\Media $medias
     * @return Artiste
     */
    public function setMedia(\Frontend\FrontendBundle\Entity\Media $media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get medias
     *
     * @return \Frontend\FrontendBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }
}
