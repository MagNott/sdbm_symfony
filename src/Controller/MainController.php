<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ContinentRepository;
use App\Entity\Continent;
use App\Repository\FabricantRepository;
use App\Entity\Fabricant;
use App\Repository\CouleurRepository;
use App\Entity\Couleur;
use App\Repository\TypebiereRepository;
use App\Entity\Typebiere;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityRepository;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(ContinentRepository $continentRepository, CouleurRepository $CouleurRepository, FabricantRepository $FabricantRepository,TypebiereRepository $TypebiereRepository): Response
    {
        
        $lescontinentsbieres = $continentRepository->getContinentArticleCount();
        $lescouleursbieres = $CouleurRepository->getCouleurAndArticleCount();
        $lesfabricantbieres = $FabricantRepository->getFabricantArticleCount();
        $lestypesbieres = $TypebiereRepository->getTypeAndArticleCount();
        
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'continents_bieres' => $lescontinentsbieres,
            'couleurs_bieres' => $lescouleursbieres,
            'fabricants_bieres' => $lesfabricantbieres,
            'lestypesbieres'=> $lestypesbieres,
        ]);
    }
}
