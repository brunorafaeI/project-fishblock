<?php
# Fichier filrouge/src/Acme/FishBlockBundle/DataFixtures/ORM/LoadingFixtures.php
/* Les Fixtures doivent êtres stockées dans le namespace suivant */
namespace  Acme\FishBlockBundle\DataFixtures\ORM;

/*
 *  On a besoin de recourir à l'interface FixtureInterface pour définir une fixture alors on le déclare
 * Si nous n'avions pas mis ce use, on aurait dû taper
 * class LoadingFixtures implements Doctrine\Common\DataFixtures\FixtureInterface pour l'implémentation
 * de l'interface FixtureInterface, ce qui avouons-le n'est pas toujours très pratique, surtout si on
 * veut utiliser plusieurs fois l'objet / interface en question.
 */
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

# il nous faut ce namespace pour la gestion du cryptage du mot de passe
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

/*
 * Nous aurons besoin de nos entités Categorie et Serie également, on le déclare donc ici aussi...
 */
use Acme\FishBlockBundle\Entity\Category;
use Acme\FishBlockBundle\Entity\Series;


/*
 * Les fixtures sont des objets qui doivent obligatoireemnt implémenter l'interface FixtureInterface
 */
class LoadingFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Création d'un Categorie "Horreur"
        $Horreur = new Category();
        $Horreur->setLabel("Horreur");
        // Enregistrment dans la base de données
        $manager->persist($Horreur);
        $manager->flush();

        // Création d'un genre Action
        $Action = new Category();
        $Action->setLabel("Action");
        // Enregistrment dans la base de données
        $manager->persist($Action);
        $manager->flush();

        // Création d'un genre Aventure
        $Aventure = new Category();
        $Aventure->setLabel("Aventure");
        // Enregistrment dans la base de données
        $manager->persist($Aventure);
        $manager->flush();

        // Création d'un genre Science fiction
        $Science_fiction = new Category();
        $Science_fiction->setLabel("Science fiction");
        // Enregistrment dans la base de données
        $manager->persist($Science_fiction);
        $manager->flush();

        // Création d'un genre Science fiction
        $drame = new Category();
        $drame->setLabel("Drame");
        // Enregistrment dans la base de données
        $manager->persist($drame);
        $manager->flush();

        // On crée la série !
        $Serie = new Series();
        $Serie->setTitre("Game of Thrones");
        $Serie->setDescription("Game of Thrones, également désignée par le titre français de l'œuvre dont elle est adaptée, Le Trône de fer1, est une série télévisée américaine médiéval-fantastique2 créée par David Benioff et D. B. Weiss, diffusée depuis le 17 avril 2011 sur HBO. Il s'agit de l'adaptation de la saga A Song of Ice and Fire, une suite de romans écrits par George R. R. Martin depuis 1996 elle-même inspirée par exemple de la suite romanesque Les Rois maudits écrite par Maurice Druon. La saga est réputée pour son réalisme et par ses nombreuses inspirations tirées d’événements, lieux et personnages historiques réels, tels que, la guerre des Deux-Roses, le mur d'Hadrien, Henri Tudor etc.");
        $Serie->getListeDesCategories()->add($drame);
        $Serie->getListeDesCategories()->add($Science_fiction);
        // Enregistrment dans la base de données
        $manager->persist($Serie);
        $manager->flush();

        // On crée la série !
        $Serie = new Series();
        $Serie->setTitre("Game of Thrones");
        $Serie->setDescription("Game of Thrones, également désignée par le titre français de l'œuvre dont elle est adaptée, Le Trône de fer1, est une série télévisée américaine médiéval-fantastique2 créée par David Benioff et D. B. Weiss, diffusée depuis le 17 avril 2011 sur HBO. Il s'agit de l'adaptation de la saga A Song of Ice and Fire, une suite de romans écrits par George R. R. Martin depuis 1996 elle-même inspirée par exemple de la suite romanesque Les Rois maudits écrite par Maurice Druon. La saga est réputée pour son réalisme et par ses nombreuses inspirations tirées d’événements, lieux et personnages historiques réels, tels que, la guerre des Deux-Roses, le mur d'Hadrien, Henri Tudor etc.");
        $Serie->getListeDesCategories()->add($drame);
        $Serie->getListeDesCategories()->add($Science_fiction);
        // Enregistrment dans la base de données
        $manager->persist($Serie);
        $manager->flush();

    }
}
?>