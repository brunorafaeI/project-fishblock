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
     * Bidirectional
     *
     * @ORM\ManyToMany(targetEntity="Genre", inversedBy="listeDesSeries")
     * @ORM\JoinTable(name="_assoc_serie_genre",
     *   joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="serie_id", referencedColumnName="id")}
     * )
     */
    protected $listeDesGenres;

    /**
     * @ORM\Column(type="string", length=120)
     */
    protected $titre;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @var \Image
     *
     * @ORM\OneToOne(targetEntity="Image", inversedBy="serie", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     *
     */
    private $image;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->listeDesGenres = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add listeDesGenres
     *
     * @param \Acme\FishBlockBundle\Entity\Genre $listeDesGenres
     * @return Serie
     */
    public function addListeDesGenre(\Acme\FishBlockBundle\Entity\Genre $listeDesGenres)
    {
        $this->listeDesGenres[] = $listeDesGenres;

        return $this;
    }

    /**
     * Remove listeDesGenres
     *
     * @param \Acme\FishBlockBundle\Entity\Genre $listeDesGenres
     */
    public function removeListeDesGenre(\Acme\FishBlockBundle\Entity\Genre $listeDesGenres)
    {
        $this->listeDesGenres->removeElement($listeDesGenres);
    }

    /**
     * Get listeDesGenres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getListeDesGenres()
    {
        return $this->listeDesGenres;
    }

    /**
     * Affichage d'une entité Serie avec echo
     * @return string Représentation du serie
     */
    public function __toString()
    {
        return $this->titre;
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
}
