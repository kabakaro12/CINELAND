<?php
	namespace App\Controller\cineland;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\Validator\Constraints\DateTime;
	use App\Entity\Genre;
	use App\Entity\Acteur;
	use App\Entity\Film;
	
	class Cineland extends AbstractController
	{
		public function accueil() 
		{
			return $this->render('cineland/accueil.html.twig');
		}
		
		
		public function init() 
		{
			$entityManager = $this->getDoctrine()->getManager();
			
			$g1 = new Genre;
			$g1 -> setNom("animation");
			
			$g2 = new Genre;
			$g2 -> setNom("policier");
			
			$g3 = new Genre;
			$g3 -> setNom("drame");
			
			$g4 = new Genre;
			$g4 -> setNom("comédie");
			
			$g5 = new Genre;
			$g5 -> setNom("X");
			
			
			
			$f1 = new Film;
			$f1 -> setTitre("Astérix aux jeux olympiques");
			$f1 -> setDuree(117);
			$f1 -> setDateSortie(new \DateTime("21-01-2008"));
			$f1 -> setNote(8);
			$f1 -> setAgeMinimal(0);
			$f1 -> setGenre($g1);
			
			$f2 = new Film;
			$f2 -> setTitre("Le Dernier Métro");
			$f2 -> setDuree(131);
			$f2 -> setDateSortie(new \DateTime("17-09-1980"));
			$f2 -> setNote(15);
			$f2 -> setAgeMinimal(12);
			$f2 -> setGenre($g3);
			
			$f3 = new Film;
			$f3 -> setTitre("Le choix des armes");
			$f3 -> setDuree(135);
			$f3 -> setDateSortie(new \DateTime("19-10-1981"));
			$f3 -> setNote(13);
			$f3 -> setAgeMinimal(18);
			$f3 -> setGenre($g2);
			
			$f4 = new Film;
			$f4 -> setTitre("Les Parapluies de Cherbourg");
			$f4 -> setDuree(91);
			$f4 -> setDateSortie(new \DateTime("19-02-1964"));
			$f4 -> setNote(9);
			$f4 -> setAgeMinimal(0);
			$f4 -> setGenre($g3);
			
			$f5 = new Film;
			$f5 -> setTitre("La Guerre des boutons");
			$f5 -> setDuree(90);
			$f5 -> setDateSortie(new \DateTime("18-04-1962"));
			$f5 -> setNote(7);
			$f5 -> setAgeMinimal(0);
			$f5 -> setGenre($g4);
			
			$a1 = new Acteur;
			$a1 -> setNomPrenom("Galabru Michel");
			$a1 -> setDateNaissance(new \DateTime("27-10-1922"));
			$a1 -> setNationalite("France");
			$a1 -> addFilm($f5);
			
			$a2 = new Acteur;
			$a2 -> setNomPrenom("Deneuve Catherine");
			$a2 -> setDateNaissance(new \DateTime("22-10-1943"));
			$a2 -> setNationalite("France");
			$a2 -> addFilm($f2);
			$a2 -> addFilm($f3);
			$a2 -> addFilm($f4);
			
			$a3 = new Acteur;
			$a3 -> setNomPrenom("Depardieu Gérard");
			$a3 -> setDateNaissance(new \DateTime("27-12-1948"));
			$a3 -> setNationalite("Russie");
			$a3 -> addFilm($f2);
			$a3 -> addFilm($f3);
			
			$a4 = new Acteur;
			$a4 -> setNomPrenom("Lanvin Gérard");
			$a4 -> setDateNaissance(new \DateTime("21-06-1950"));
			$a4 -> setNationalite("France");
			$a4 -> addFilm($f3);
			
			$a5 = new Acteur;
			$a5 -> setNomPrenom("Désiré Dupond");
			$a5 -> setDateNaissance(new \DateTime("23-12-2001"));
			$a5 -> setNationalite("Groland");
			
			$entityManager->persist($a1);
			$entityManager->persist($a2);
			$entityManager->persist($a3);
			$entityManager->persist($a4);
			$entityManager->persist($a5);
			$entityManager->persist($f1);
			$entityManager->persist($g5);
			
			$entityManager->flush();

			return new Response("<html> 
									<body> 
										<h1> La base de données a été initialisée </h1>
										</br>
										<a href = 'http://localhost:8000/cineland/accueil' > Accueil </a>
									</body> 
								</html>");
		}
		
		public function menu()
		{
			return $this->render('cineland/menu.html.twig');
		}
	}
?>
