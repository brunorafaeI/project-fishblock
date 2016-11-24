<?php
# Fichier Serie.php

/*******************************************************************************************
 *  Namespace dans lequel se trouvera notre objet "Serie" .
 * Les namespace servent à définir un espace de noms dans lesquels seront stockés notre objet.
 * Ici on dit que notre classe Genre fait partit de l'espace de Nom Entity,
 * ainsi  Symfony saura qu'il s'agit bien d'une entité.
 *
 * Dès lors qu'on utilisera l'instruction "use Acme\FishBlockBundle\Entity\Serie" dans un fichier PHP,
 * on pourra accéder à notre entité sans utiliser à chaque fois une référence complète vers l'objet !
 *
 * On pourra donc faire new Serie() au lieu de new Acme\FishBlockBundle\Entity\Serie();
 ********************************************************************************************/

namespace Acme\FishBlockBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/*******************************************************************************************
 *
 * Ci-dessous, nous allons décrire notre table, telle qu'elle sera gérée par Doctrine.
 *
 * Vous allez voir des commentaires faisant apparaître le mot clé @ORM,
 * ces balises sont très importantes, elles permettent principalement de définir de quel
 * type de champ il s'agit. Ainsi Doctrine saura comment créé ce champ dans la base
 * de données de votre choix.
 *
 *******************************************************************************************/
/**
 * @ORM\Entity(repositoryClass="Acme\FishBlockBundle\Repository\SerieRepository")
 */
class Serie
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;


    /**
     * @ORM\Column(type="string", length=120)
     */
    protected $titre;

    /**
     * @ORM\Column(type="string", length=120)
     */
    protected $auteur;

    /**
     * @ORM\Column(type="string", length=120)
     */
    protected $acteurs;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @var String
     *
     * @ORM\OneToOne(targetEntity="Image")
     * @Assert\File(mimeTypes={ "image/jpg", "image/png", "image/jpeg" }, maxSize = "4096k")
     */
    protected $image;


    /**
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="serie", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;


    /**
     * @var \Seasion
     * @ORM\OneToMany(targetEntity="Seasion", mappedBy="serie")
     *
     */
    private $seasion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->seasion = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set titre
     *
     * @param string $titre
     * @return Serie
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
     * Set auteur
     *
     * @param string $auteur
     * @return Serie
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set acteurs
     *
     * @param string $acteurs
     * @return Serie
     */
    public function setActeurs($acteurs)
    {
        $this->acteurs = $acteurs;

        return $this;
    }

    /**
     * Get acteurs
     *
     * @return string
     */
    public function getActeurs()
    {
        return $this->acteurs;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Serie
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image
     *
     * @param \Acme\FishBlockBundle\Entity\Image $image
     * @return Serie
     */
    public function setImage(\Acme\FishBlockBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Acme\FishBlockBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set category
     *
     * @param \Acme\FishBlockBundle\Entity\Category $category
     * @return Serie
     */
    public function setCategory(\Acme\FishBlockBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Acme\FishBlockBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add seasion
     *
     * @param \Acme\FishBlockBundle\Entity\Seasion $seasion
     * @return Serie
     */
    public function addSeasion(\Acme\FishBlockBundle\Entity\Seasion $seasion)
    {
        $this->seasion[] = $seasion;

        return $this;
    }

    /**
     * Remove seasion
     *
     * @param \Acme\FishBlockBundle\Entity\Seasion $seasion
     */
    public function removeSeasion(\Acme\FishBlockBundle\Entity\Seasion $seasion)
    {
        $this->seasion->removeElement($seasion);
    }

    /**
     * Get seasion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeasion()
    {
        return $this->seasion;
    }


    /**
     * Affichage d'une entité Serie avec echo
     * @return string Représentation de la série
     */
    public function __toString()
    {
        return array(
            $this->getImage(),
            $this->getTitre(),
            $this->getDescription(),
            $this->getCategory(),
            $this->getAuteur(),
            $this->getActeurs(),
            $this->getId()

        );
    }


}
