<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ContinentRepository;
use App\Entity\Continent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityRepository;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(ContinentRepository $continentRepository): Response
    {

        // $lescontinentsbieres = $this->getDoctrine()->getRepository(Continent::class)->getContinentArticleCount();

        $lescontinentsbieres = $continentRepository->getContinentArticleCount();


        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'continents_bieres' => $lescontinentsbieres,
        ]);
    }
}
