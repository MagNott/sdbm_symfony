<?php

namespace App\Controller;

use App\Entity\Fabricant;
use App\Form\FabricantType;
use App\Repository\FabricantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fabricant')]
class FabricantController extends AbstractController
{
    #[Route('/', name: 'app_fabricant_index', methods: ['GET', 'POST'])]
    public function index(FabricantRepository $fabricantRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $fabricant = new Fabricant();

        // Création du formulaire associé à ce Fabricant.
        $form = $this->createForm(FabricantType::class, $fabricant);

        // On gère la requête avec le formulaire. Si le formulaire est soumis, il hydrate (mettre des valeurs en propriété) l'objet $fabricant avec les données soumises.
        $form->handleRequest($request);

        // Vérifie si le formulaire a été soumis et est valide.
        if ($form->isSubmitted() && $form->isValid()) {

            // Persiste (prépare à sauvegarder, garde l'info en suspens) l'objet $fabricant.
            $entityManager->persist($fabricant);

             // Exécute la requête pour réellement sauvegarder l'objet dans la base de données.
            $entityManager->flush();

            // Génération du message d'information
          $this->addFlash(
            'success',
            'Le Fabricant a bien été ajouté !'
          );

            // Redirige l'utilisateur vers la même route pour éviter les doubles soumissions de formulaire.
            // Utilise le code HTTP 303 (SEE_OTHER) pour indiquer qu'une autre ressource doit être récupérée.
            return $this->redirectToRoute('app_fabricant_index', [], Response::HTTP_SEE_OTHER);
        }

       // Si le formulaire n'est pas soumis ou est invalide, on affiche le template 'fabricant/index.html.twig' avec les variables nécessaires.
        return $this->render('fabricant/index.html.twig', [
            'fabricants' => $fabricantRepository->findAll(),
            'fabricant' => $fabricant,
            'form' => $form,
        ]);
    }

    // #[Route('/new', name: 'app_fabricant_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $fabricant = new Fabricant();
    //     $form = $this->createForm(FabricantType::class, $fabricant);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->persist($fabricant);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_fabricant_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('fabricant/new.html.twig', [
    //         'fabricant' => $fabricant,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/{idFabricant}', name: 'app_fabricant_show', methods: ['GET'])]
    public function show(Fabricant $fabricant): Response
    {
        return $this->render('fabricant/show.html.twig', [
            'fabricant' => $fabricant,
        ]);
    }

    #[Route('/{idFabricant}/edit', name: 'app_fabricant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fabricant $fabricant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FabricantType::class, $fabricant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

             // Génération du message d'information
          $this->addFlash(
            'info',
            'Le Fabricant a bien été modifié !'
          );


            return $this->redirectToRoute('app_fabricant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fabricant/edit.html.twig', [
            'fabricant' => $fabricant,
            'form' => $form,
        ]);
    }

    #[Route('/{idFabricant}', name: 'app_fabricant_delete', methods: ['POST'])]
    public function delete(Request $request, Fabricant $fabricant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fabricant->getIdFabricant(), $request->request->get('_token'))) {
            $entityManager->remove($fabricant);
            $entityManager->flush();

            // Génération du message d'information
          $this->addFlash(
            'danger',
            'Le Fabricant a bien été supprimé !'
          );
        }

        return $this->redirectToRoute('app_fabricant_index', [], Response::HTTP_SEE_OTHER);
    }
}
