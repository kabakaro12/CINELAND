<?php

namespace App\Controller\cineland;

use App\Entity\Film;
use App\Form\FilmType;
use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use	Symfony\Component\Form\Extension\Core\Type\DateType;
use	Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class FilmController extends AbstractController
{

    public function index(FilmRepository $filmRepository): Response
    {
        return $this->render('film/index.html.twig', [
            'films' => $filmRepository->findAll(),
        ]);
    }


    public function new(Request $request): Response
    {
        $film = new Film();
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($film);
            $entityManager->flush();

            return $this->redirectToRoute('film_index');
        }

        return $this->render('film/new.html.twig', [
            'film' => $film,
            'form' => $form->createView(),
        ]);
    }


    public function show(Film $film): Response
    {
        return $this->render('film/show.html.twig', [
            'film' => $film,
        ]);
    }


    public function edit(Request $request, Film $film): Response
    {
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('film_index');
        }

        return $this->render('film/edit.html.twig', [
            'film' => $film,
            'form' => $form->createView(),
        ]);
    }


    public function delete(Request $request, Film $film): Response
    {
        if ($this->isCsrfTokenValid('delete'.$film->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($film);
            $entityManager->flush();
        }

        return $this->redirectToRoute('film_index');
    }
	

	
	public function dateEntredeux(Request $request)
	{
		$form = $this->createFormBuilder()
					 ->add('DateMinimum',DateType::class,['widget' => 'choice', 'years' => range(1895,2021)])
					 ->add('DateMaximum',DateType::class,['widget' => 'choice', 'years' => range(1895,2021)])
					 ->add('Chercher', SubmitType::class)
					 ->getForm();
		;
		$form->handleRequest($request);
		if($form->isSubmitted())
		{
			$min = $form['DateMinimum']->getData();
			$max = $form['DateMaximum']->getData();
			$films = $this->getDoctrine()->getRepository(Film::class)->findAllBetweenDate($min, $max); 
			$result = "";
			foreach( $films as $f) 
			{
				$result .= $f->getTitre().", ";
			}
			return $this->render('film/between.html.twig',['result' => $result, 'min'=> $min, 'max'=>$max]); 
		}
		return $this->render('film/formbetween.html.twig',array('form' => $form->createView())); 
	}
	
	
	public function dateInf(Request $request)
	{
		$form = $this->createFormBuilder()
				->add('Date',DateType::class,['widget' => 'choice', 'years' => range(1895,2021),'format'=>'yMd'])
				->add('Chercher', SubmitType::class)
				->getForm();
		;
		$form->handleRequest($request);
		if($form->isSubmitted())
		{
			$date = $form['Date']->getData();
			$films = $this->getDoctrine()->getRepository(Film::class)->findAllInfDate($date); 
			$result = "";
			foreach( $films as $f) 
			{
				$result .= $f->getTitre().", ";
			}
			return $this->render('film/inf.html.twig',['result' => $result, 'date'=> $date]); 
		}
		return $this->render('film/forminf.html.twig',array('form' => $form->createView())); 

	}
	public function niveauA(FilmRepository $filmRepository): Response
    {
        return $this->render('film/augmenter.html.twig', [
            'films' => $filmRepository->findAll(),
        ]);
    }



	

	   
	


}
