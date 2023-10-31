<?php

namespace App\Controller;

use App\Entity\Pays;
use App\Form\PaysType;
use App\Repository\PaysRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/pays')]
class PaysController extends AbstractController
{
    #[Route('/', name: 'app_pays_index', methods: ['GET', 'POST'])]
    public function index(PaysRepository $paysRepository, EntityManagerInterface $entityManager, Request $request, TranslatorInterface $translator): Response
    
    //Le typage ici n'est pas un typage primitif comme en php, c'est un typage de classe
    {
        //Integration du code de ajout dans index
        //ATTENTION IL A FALLU RAJOUTER LES PARAMETRES NECESSAIRES A L'AJOUT DANS INDEX AU DESSUS (avec le typage de classe) - AUTOWIRING
        $pay = new Pays();
        $form = $this->createForm(PaysType::class, $pay);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pay);
            $entityManager->flush();
            
            // Génération du message d'information
            $this->addFlash(
                'success',
                $translator->trans('Le Pays a bien été ajouté !')
            );
            
            return $this->redirectToRoute('app_pays_index', [], Response::HTTP_SEE_OTHER);
        }
        //Fin d'intégration du code de ajout dans index
        
        return $this->render('pays/index.html.twig', [
            'pays' => $paysRepository->findAll(),
            'pay' => $pay, // ajout les infos formulaires de ajout pays
            'form' => $form, // ajout les infos formulaires de ajout pays
        ]);
    }
    
    // N'EST PLUS UTILE CAR INTEGRE A LA VUE INDEX
    
    // #[Route('/new', name: 'app_pays_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
        //     $pay = new Pays();
        //     $form = $this->createForm(PaysType::class, $pay);
        //     $form->handleRequest($request);
        
        //     if ($form->isSubmitted() && $form->isValid()) {
            //         $entityManager->persist($pay);
            //         $entityManager->flush();
            
            //         return $this->redirectToRoute('app_pays_index', [], Response::HTTP_SEE_OTHER);
            //     }
            
            //     return $this->render('pays/new.html.twig', [
                //         'pay' => $pay,
                //         'form' => $form,
                //     ]);
                // }
                
                
                #[Route('/{idPays}', name: 'app_pays_show', methods: ['GET'])]
                public function show(Pays $pay): Response
                {
                    return $this->render('pays/show.html.twig', [
                        'pay' => $pay,
                    ]);
                }
                
                #[Route('/{idPays}/edit', name: 'app_pays_edit', methods: ['GET', 'POST'])]
                public function edit(Request $request, Pays $pay, EntityManagerInterface $entityManager, TranslatorInterface $translator): Response
                {
                    $form = $this->createForm(PaysType::class, $pay);
                    $form->handleRequest($request);
                    
                    if ($form->isSubmitted() && $form->isValid()) {
                        $entityManager->flush();
                        
                        // Génération du message d'information
                        $this->addFlash(
                            'info',
                            $translator->trans('Le Pays a bien été modifié !')
                        );
                        
                        return $this->redirectToRoute('app_pays_index', [], Response::HTTP_SEE_OTHER);
                    }
                    
                    return $this->render('pays/edit.html.twig', [
                        'pay' => $pay,
                        'form' => $form,
                    ]);
                }
                
                #[Route('/{idPays}', name: 'app_pays_delete', methods: ['POST'])]
                public function delete(Request $request, Pays $pay, EntityManagerInterface $entityManager, TranslatorInterface $translator): Response
                {
                    if ($this->isCsrfTokenValid('delete'.$pay->getIdPays(), $request->request->get('_token'))) {
                        $entityManager->remove($pay);
                        $entityManager->flush();
                    }
                    
                    // Génération du message d'information
                    $this->addFlash(
                        'danger',
                        $translator->trans('Le Pays a bien été supprimé !')
                    );
                    
                    return $this->redirectToRoute('app_pays_index', [], Response::HTTP_SEE_OTHER);
                }
            }
            