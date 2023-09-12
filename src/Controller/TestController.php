<?php

namespace App\Controller;

use App\Entity\User;
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

        $title = "test users";

        return $this->render('test/user.html.twig', [
            'controller_name' => 'TestController',
            'title' => $title,
            'users' => $users,
        ]);
    }
}