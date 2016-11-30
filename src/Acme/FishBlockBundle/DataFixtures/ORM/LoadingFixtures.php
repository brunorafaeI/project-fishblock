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
use Acme\FishBlockBundle\Entity\User;

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

        // Création d'un Categorie Horreur
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

         // Création d'un genre Serial drama
        $Serial_drama = new Category();
        $Serial_drama->setLabel("Serial drama");
        // Enregistrment dans la base de données
        $manager->persist($Serial_drama);
        $manager->flush();

        // Création d'un genre Comédie
        $Comedie = new Category();
        $Comedie->setLabel("Comédie");
        // Enregistrment dans la base de données
        $manager->persist($Comedie);
        $manager->flush();

        // Création d'un genre Musical
        $Musical = new Category();
        $Musical->setLabel("Musical");
        // Enregistrment dans la base de données
        $manager->persist($Musical);
        $manager->flush();

        // Création d'un genre Animation
        $Animation = new Category();
        $Animation->setLabel("Animation");
        // Enregistrment dans la base de données
        $manager->persist($Animation);
        $manager->flush();

        // Création d'un genre Médical
        $Medical = new Category();
        $Medical->setLabel("Médical");
        // Enregistrment dans la base de données
        $manager->persist($Medical);
        $manager->flush();

        // Création d'un genre Dramatique
        $Dramatique = new Category();
        $Dramatique->setLabel("Dramatique");
        // Enregistrment dans la base de données
        $manager->persist($Dramatique);
        $manager->flush();

        // Création d'un genre Romantique
        $Romantique = new Category();
        $Romantique->setLabel("Romantique");
        // Enregistrment dans la base de données
        $manager->persist($Romantique);
        $manager->flush();

        // Création d'un genre Fantasy
        $Fantasy = new Category();
        $Fantasy->setLabel("Fantasy");
        // Enregistrment dans la base de données
        $manager->persist($Fantasy);
        $manager->flush();

        // On crée la série !
        $Serie = new Series();
        $Serie->setTitre("Game of thrones");
        $Serie->setImage("got.jpg");
        $Serie->setDescription("Sur le continent de Westeros, le roi Robert Baratheon gouverne le Royaume des Sept Couronnes depuis plus de dix-sept ans, à la suite de la rébellion qu'il a menée contre le « roi fou » Aerys II Targaryen. Jon Arryn, époux de la sœur de Lady Catelyn Stark, Lady Arryn, son guide et principal conseiller, vient de décéder, et le roi part alors dans le nord du royaume demander à son vieil ami Eddard « Ned » Stark de remplacer leur regretté mentor au poste de Main du roi. Ned, seigneur suzerain du nord depuis Winterfell et de la maison Stark, est peu désireux de quitter ses terres. Mais il accepte à contre-cœur de partir pour la capitale Port-Réal avec ses deux filles, Sansa et Arya. Juste avant leur départ pour le sud, Bran, l'un des jeunes fils d'Eddard, est poussé de l'une des tours de Winterfell après avoir été témoin de la liaison incestueuse de la reine Cersei Baratheon et son frère jumeau, Jaime Lannister. Leur frère, Tyrion Lannister, surnommé « le gnome », est alors accusé du crime par Lady Catelyn Stark.");
        $Serie->getListeDesCategories()->add($Dramatique);
        $Serie->getListeDesCategories()->add($Fantasy);
        // Enregistrment dans la base de données
        $manager->persist($Serie);
        $manager->flush();

        // On crée la série !
        $Serie = new Series();
        $Serie->setTitre("Supernatural");
        $Serie->setImage("sn.jpg");
        $Serie->setDescription("Deux frères, Sam et Dean Winchester, chasseurs de créatures surnaturelles, sillonnent les États-Unis à bord d'une Chevrolet Impala noire de 1967 et enquêtent sur des phénomènes paranormaux (souvent issus du folklore, des superstitions, mythes et légendes urbaines américaines, mais aussi des monstres surnaturels tels que les fantômes, loups-garous, démons, vampires…).

De manière générale, chaque épisode se déroule dans un lieu différent du pays et correspond à une enquête sur un phénomène paranormal.");
        $Serie->getListeDesCategories()->add($Dramatique);
        $Serie->getListeDesCategories()->add($Fantasy);
        $Serie->getListeDesCategories()->add($Horreur);
        // Enregistrment dans la base de données
        $manager->persist($Serie);
        $manager->flush();

        // On crée la série !
        $Serie = new Series();
        $Serie->setTitre("The walking dead");
        $Serie->setImage("twd.jpg");
        $Serie->setDescription("Après une épidémie post-apocalyptique ayant transformé la quasi-totalité de la population américaine et mondiale en mort-vivants ou « rôdeurs », un groupe d'hommes et de femmes mené par l'adjoint du shérif du comté de Kings (en Géorgie), Rick Grimes, qui se réveille tout juste d'un coma, tente de survivre…
Ensemble, ils vont devoir tant bien que mal faire face à ce nouveau monde devenu méconnaissable, à travers leur périple dans le Sud profond des États-Unis.");
        $Serie->getListeDesCategories()->add($Dramatique);
        $Serie->getListeDesCategories()->add($Horreur);
        // Enregistrment dans la base de données
        $manager->persist($Serie);
        $manager->flush();

        // On crée la série !
        $Serie = new Series();
        $Serie->setTitre("Dexter");
        $Serie->setImage("dexter.jpg");
        $Serie->setDescription("Expert en médecine légale spécialisé dans l'analyse de traces de sang dans la police le jour, tueur en série la nuit, Dexter Morgan n'est pas exactement un citoyen américain comme les autres. Il porte, en effet, un lourd secret. Traumatisé dans sa plus tendre enfance par le meurtre de sa mère, il a été ensuite recueilli par un officier de police de Miami. Il se dit incapable de ressentir la moindre émotion. Incapable, si ce n'est lorsqu'il satisfait les pulsions meurtrières que son père adoptif lui a appris à canaliser : de fait, Dexter ne tue que des criminels qui échappent au système judiciaire. Bien que sa soif de tuer lui pèse, il parvient à mener une existence relativement normale et à sauver les apparences auprès de ses collègues, amis et petite amie.");
        $Serie->getListeDesCategories()->add($Dramatique);
        $Serie->getListeDesCategories()->add($Horreur);
        // Enregistrment dans la base de données
        $manager->persist($Serie);
        $manager->flush();

        // On crée la série !
        $Serie = new Series();
        $Serie->setTitre("Hero corp");
        $Serie->setImage("hc.jpg");
        $Serie->setDescription("À la suite d’une guerre dans les années 1980, il est décidé de créer l’agence Hero Corp, une organisation regroupant tous les super-héros afin de maintenir un climat de paix. Cette agence possède plusieurs sites secrets sur la planète et dans le département de la Lozère se trouvent les retraités, mis au rancart, démissionnaires, démasqués, pas-formés. Coupés du monde, ils peuvent retrouver une vie calme et paisible. Vingt ans après, ce calme paisible vole en éclats lorsque réapparaît The Lord.
				Face au retour de The Lord, le plus grand super-vilain de l’Histoire, le village est démuni. Selon une prédiction, John est l'unique solution face à ce danger que Hero Corp préfère garder sous silence.
John arrive dans un village isolé pour aller enterrer sa tante. Il se rend compte que les habitants cachent quelque chose et qu’ils n’ont pas l’air décidés à le laisser partir.");
        $Serie->getListeDesCategories()->add($Comedie);
        // Enregistrment dans la base de données
        $manager->persist($Serie);
        $manager->flush();

        // On crée la série !
        $Serie = new Series();
        $Serie->setTitre("Vikings");
        $Serie->setImage("vikings.jpg");
        $Serie->setDescription("La série suit les exploits d'un groupe de Vikings mené par Ragnar Lothbrok, l'un des plus populaires héros vikings de tous les temps au destin semi-légendaire. Ragnar serait d'origine danoise, suédoise ou encore norvégienne selon les sources. Il est supposé avoir unifié les clans vikings en un royaume aux frontières indéterminées à la fin du VIIIe siècle (le roi Echbert mentionne avoir vécu à la cour du roi Charlemagne, sacré empereur en l'an 800). Mais il est surtout connu pour avoir été le promoteur des tous premiers raids vikings en terres chrétiennes, saxonnes, franques ou celtiques.
Ce simple fermier, homme lige du jarl Haraldson, se rebelle contre les choix stratégiques de son suzerain. Au lieu d'attaquer les païens slaves et baltes de la Baltique, il décide de se lancer dans l'attaque des riches terres de l'Ouest, là où les monastères regorgent de trésors qui n'attendent que d'être pillés par des guerriers ambitieux.
Clandestinement, Ragnar va monter sa propre expédition et sa réussite changera le destin des Vikings comme celui des royaumes chrétiens du sud, que le simple nom de « Vikings » terrorisera pendant plus de deux siècles.");
        $Serie->getListeDesCategories()->add($Action);
        $Serie->getListeDesCategories()->add($Dramatique);
        // Enregistrment dans la base de données
        $manager->persist($Serie);
        $manager->flush();
    }
}
?>