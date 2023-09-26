<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Livre;
use App\Entity\Auteur;
use App\Entity\Genre;
use App\Entity\Emprunt;
use App\Entity\Emprunteur;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\Repository\RepositoryFactory;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/test')]
class TestController extends AbstractController
{
    #[Route('/user', name: 'app_test_user')]
    public function user(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $repository = $em->getRepository(User::class);

        //fonction all user order by email
        $users = $repository->allUsersOrderByMail();
        $user1 = $repository->find(1);
        $fooUser = $repository->emailFooFOo();
        $roles = $repository->roles();
        $userFalse = $repository->falseEnabled();


        $title = "test users";

        return $this->render('test/user.html.twig', [
            'controller_name' => 'TestController',
            'title' => $title,
            'users' => $users,
            'user1' => $user1,
            'fooUser' => $fooUser,
            'roles' => $roles,
            'userFalse' => $userFalse,
        ]);
    }

    #[Route('/livre', name: 'app_test_livre')]
    public function livre(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $livreRepository = $em->getRepository(Livre::class);
        $auteurRepository = $em->getRepository(Auteur::class);
        $genreRepositoy = $em->getRepository(Genre::class);
        // $auteurRepository = $em->getRepository(Auteur::class);

        $livres = $livreRepository->findAllLivre();
        $livre1 = $livreRepository->find(1);
        $titreLorem = $livreRepository->findTitreLorem('lorem');
        $listeLivre2 = $livreRepository->findBy([
            'auteur' => 2,
        ], [
            'titre' => 'ASC',
        ]);
        $livreGenre = $livreRepository->findBooksByGenre('roman');
        $auteur2 = $auteurRepository->find(2);
        $genre6 = $genreRepositoy->find(6);
        $livre2 = $livreRepository->find(2);
        $genre5 = $genreRepositoy->find(5);
        $livre123 = $livreRepository->find(123);
        $auteurs = $auteurRepository->findAllAuteur();



        $newBook = new Livre();
        $newBook->setTitre('Totum autem id externum');
        $newBook->setAnneeEdition('2020');
        $newBook->setNombrePages('300');
        $newBook->setCodeIsbn('9790412882714');
        $newBook->setAuteur($auteur2);
        $newBook->addGenre($genre6);

        $em->persist($newBook);
        $em->flush();

        $livre2->setTitre('Aperiendum est igitur');
        $livre2->addGenre($genre5);

        $em->persist($livre2);
        $em->flush();

        if ($livre123) {
            $em->remove($livre123);
            $em->flush();
        }


        $title = 'je suis un titre';


        return $this->render('test/livre.html.twig', [
            'controller_name' => 'TestController',
            'title' => $title,
            'livres' => $livres,
            'livre1' => $livre1,
            'titreLorem' => $titreLorem,
            'listeLivre2' => $listeLivre2,
            'livreGenre' => $livreGenre,
        ]);
    }


    #[Route('/emprunt', name: 'app_test_emprunt')]
    public function emprunt(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $empruntRepository = $em->getRepository(Emprunt::class);
        $emprunteurRepository = $em->getRepository(Emprunteur::class);
        $livreRepository = $em->getRepository(Livre::class);

        $title = 'titre 123';

        $value1 = 10;
        $value = 10;
        $value3 = 3;
        $livreId1 = $livreRepository->find(1);
        $emprunteurId1 = $emprunteurRepository->find(1);
        $empruntReturn3 = $empruntRepository->find(3);
        $emprunt42 = $empruntRepository->find(42);

        $listeDernierEmprunt = $empruntRepository->findLastEmprunt($value);
        $emprunteur2 = $empruntRepository->findEmprunt2();
        $emprunteur3 = $empruntRepository->findEmprunt3();
        $emprunteurLast10 = $empruntRepository->findLastEmprunt10($value1);
        $findEmpruntNotReturn = $empruntRepository->findEmpruntNotReturn();
        $findEmpruntId3 = $empruntRepository -> findEmpruntId3($value3);
        

        $newEmprunt = new Emprunt();
        $newEmprunt->setDateEmprunt(new DateTime('2020-07-07 20:00:00'));
        $newEmprunt->setDateRetour(new DateTime('2020-08-07 20:00:00'));
        $newEmprunt->setLivre($livreId1);
        $newEmprunt->setEmprunteur($emprunteurId1);

        $em->persist($newEmprunt);
        $em->flush();

        $empruntReturn3->setDateRetour(new DateTime('01-05-2020  10:00:00'));

        $em->flush();

        if ($emprunt42) {
            $em->remove($emprunt42);
            $em->flush();
        }

        return $this->render('test/emprunt.html.twig', [
            'controller_name' => 'TestController',
            'title' => $title,
            'listeDernierEmprunt' => $listeDernierEmprunt,
            'emprunteur2' => $emprunteur2,
            'emprunteur3' => $emprunteur3,
            'emprunteurLast10' => $emprunteurLast10,
            'findEmpruntNotReturn' => $findEmpruntNotReturn,
            'findEmpruntId3' => $findEmpruntId3,

        ]);
    }

}