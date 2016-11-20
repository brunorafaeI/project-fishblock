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
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @var String
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\File(mimeTypes={ "image/jpg", "image/png", "image/jpeg" }, maxSize = "4096k")
     */
    protected $image;


    /**
     * @var \Category
     *
     * @ORM\OneToOne(targetEntity="Category", inversedBy="serie", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;


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
     * @param string $image
     * @return Serie
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
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
            $this->getId()

        );
    }


}
