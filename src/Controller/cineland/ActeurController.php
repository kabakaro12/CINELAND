<?php

namespace App\Controller\cineland;

use App\Entity\Acteur;
use App\Form\ActeurType;
use App\Repository\ActeurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ActeurController extends AbstractController
{

    public function index(ActeurRepository $acteurRepository): Response
    {
        return $this->render('acteur/index.html.twig', [
            'acteurs' => $acteurRepository->findAll(),
        ]);
    }



    public function new(Request $request)//: Response
    {
        $acteur = new Acteur();
        $form = $this->createForm(ActeurType::class, $acteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($acteur);
            $entityManager->flush();

            return $this->redirectToRoute('acteur_index');
        }

        return $this->render('acteur/new.html.twig', [
            'acteur' => $acteur,
            'form' => $form->createView(),
        ]);
    }


    public function show(Acteur $acteur): Response
    {
        return $this->render('acteur/show.html.twig', [
            'acteur' => $acteur,
        ]);
    }

    
    public function edit(Request $request, Acteur $acteur): Response
    {
        $form = $this->createForm(ActeurType::class, $acteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('acteur_index');
        }

        return $this->render('acteur/edit.html.twig', [
            'acteur' => $acteur,
            'form' => $form->createView(),
        ]);
    }


    public function delete(Request $request, Acteur $acteur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$acteur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($acteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('acteur_index');
    }
	
	public function filmSupTrois()
	{
		$acteur = $this->getDoctrine()->getRepository(Acteur::class)->findActorFilmSup2(); 
		$result = "";
		foreach( $acteur as $a) 
		{
			$result .= $a->getNomPrenom().", ";
		}
		return $this->render('acteur/filmsuptrois.html.twig',['result' => $result]); 
	}
	
	public function listfilm() 
	{
		$acteur = $this->getDoctrine()->getRepository(Acteur::class)->listFilm(); 
		$result = "";
		foreach( $acteur as $a) 
		{
			$result .= $a['nomPrenom'].":".$a['titre'].'<br/>';

		}
		return new Response('<html>
								<body>	
									<title>Acteur</title>
										<h1 ALIGN = Center> Liste des films pour chaque acteur</h1>'.$result.'
										<a href = http://localhost:8000/cineland/menu > Retour au menu des actions </a>
								</body>
							</html>');
	}
   

	
	
	
}
