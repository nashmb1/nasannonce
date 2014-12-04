<?php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Image;
use OC\PlatformBundle\Entity\AdvertSkill;
use OC\PlatformBundle\Entity\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller {
	public function indexAction($page) {
		if ($page < 1) {
			throw new NotFoundHttpException ( 'Page "' . $page . '" inexistante.' );
		}
		
		// Ici je fixe le nombre d'annonces par page à 3
		// Mais bien sûr il faudrait utiliser un paramètre, et y accéder via $this->container->getParameter('nb_per_page')
		$nbPerPage = 3;
		
		// On récupère notre objet Paginator
		$listAdverts = $this->getDoctrine ()->getManager ()->getRepository ( 'OCPlatformBundle:Advert' )->getAdverts ( $page, $nbPerPage );
		
		// On calcule le nombre total de pages grâce au count($listAdverts) qui retourne le nombre total d'annonces
		$nbPages = ceil ( count ( $listAdverts ) / $nbPerPage );
		
		// Si la page n'existe pas, on retourne une 404
		if ($page > $nbPages) {
			throw $this->createNotFoundException ( "La page " . $page . " n'existe pas." );
		}
		
		// On donne toutes les informations nécessaires à la vue
		return $this->render ( 'OCPlatformBundle:Advert:index.html.twig', array (
				'listAdverts' => $listAdverts,
				'nbPages' => $nbPages,
				'page' => $page 
		) );
	}
	public function menuAction($limit = 3) {
		
		// on la récupérera depuis la BDD !
		// récupéreration de l'ensemble des annonomes
		$em = $this->getDoctrine ()->getManager ();
		$listAdverts = $em->getRepository ( 'OCPlatformBundle:Advert' )->findBy ( array (), array (
				'id' => 'DESC' 
		), $limit, 0 );
		
		return $this->render ( 'OCPlatformBundle:Advert:menu.html.twig', array (
				'listAdverts' => $listAdverts 
		) );
	}
	public function viewAction($id) {
		$em = $this->getDoctrine ()->getManager ();
		
		// On récupère l'annonce $id
		$advert = $em->getRepository ( 'OCPlatformBundle:Advert' )->find ( $id );
		
		if (null === $advert) {
			throw new NotFoundHttpException ( "L'annonce d'id " . $id . " n'existe pas." );
		}
		
		// On récupère la liste des candidatures de cette annonce
		$listApplications = $em->getRepository ( 'OCPlatformBundle:Application' )->findBy ( array (
				'advert' => $advert 
		) );
		
		// On récupère maintenant la liste des AdvertSkill
		$listAdvertSkills = $em->getRepository ( 'OCPlatformBundle:AdvertSkill' )->findBy ( array (
				'advert' => $advert 
		) );
		
		return $this->render ( 'OCPlatformBundle:Advert:view.html.twig', array (
				'advert' => $advert,
				'listApplications' => $listApplications,
				'listAdvertSkills' => $listAdvertSkills 
		) );
	}
	public function addAction(Request $request) {
		
		    // On crée un objet Advert
    $advert = new Advert();

    // On crée le FormBuilder grâce au service form factory
    $formBuilder = $this->get('form.factory')->createBuilder('form', $advert);

    // On ajoute les champs de l'entité que l'on veut à notre formulaire
    $formBuilder
      ->add('date',      'date')
      ->add('title',     'text')
      ->add('content',   'textarea')
      ->add('author',    'text')
      ->add('published', 'checkbox',array('required'=>false))
      ->add('save',      'submit')
    ;
    // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

    // À partir du formBuilder, on génère le formulaire
    $form = $formBuilder->getForm();
    
    // On fait le lien Requête <-> Formulaire
    // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
    $form->handleRequest($request);
    
    // On vérifie que les valeurs entrées sont correctes
    // (Nous verrons la validation des objets en détail dans le prochain chapitre)
    if ($form->isValid()) {
    	// On l'enregistre notre objet $advert dans la base de données, par exemple
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($advert);
    	$em->flush();
    
    	$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
    
    	// On redirige vers la page de visualisation de l'annonce nouvellement créée
    	return $this->redirect($this->generateUrl('oc_platform_view', array('id' => $advert->getId())));
    }
		
		/*// Création de l'entité
		$advert = new Advert ();
		$advert->setTitle ( 'Recherche développeur Android et IOS' );
		$advert->setAuthor ( 'Alexandre' );
		$advert->setContent ( "Nous recherchons un développeur ANDROID et IOS débutant sur Rennes. Blabla…" );
		
		// On peut ne pas définir ni la date ni la publication,
		// car ces attributs sont définis automatiquement dans le constructeur
		
		// Création de l'entité Image
		$image = new Image ();
		$image->setUrl ( 'http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg' );
		$image->setAlt ( 'Job de rêve' );
		
		// Création d'une première candidature
		$application1 = new Application ();
		$application1->setAuthor ( 'Marine' );
		$application1->setContent ( "J'ai toutes les qualités requises." );
		
		// Création d'une deuxième candidature par exemple
		$application2 = new Application ();
		$application2->setAuthor ( 'Pierre' );
		$application2->setContent ( "Je suis très motivé." );
		
		// On lie les candidatures à l'annonce
		$application1->setAdvert ( $advert );
		$application2->setAdvert ( $advert );
		
		// On lie l'image à l'annonce;
		$advert->setImage ( $image );
		// On récupère l'EntityManager
		
		$em = $this->getDoctrine ()->getManager ();
		
		// On récupère toutes les compétences possibles
		$listSkills = $em->getRepository ( 'OCPlatformBundle:Skill' )->findAll ();
		
		// Pour chaque compétence
		foreach ( $listSkills as $skill ) {
			// On crée une nouvelle « relation entre 1 annonce et 1 compétence »
			$advertSkill = new AdvertSkill ();
			
			// On la lie à l'annonce, qui est ici toujours la même
			$advertSkill->setAdvert ( $advert );
			// On la lie à la compétence, qui change ici dans la boucle foreach
			$advertSkill->setSkill ( $skill );
			
			// Arbitrairement, on dit que chaque compétence est requise au niveau 'Expert'
			$advertSkill->setLevel ( 'Expert' );
			
			// Et bien sûr, on persiste cette entité de relation, propriétaire des deux autres relations
			$em->persist ( $advertSkill );
		}
		
		// Étape 1 : On « persiste » l'entité
		$em->persist ( $advert );
		
		// on persite les applications
		$em->persist ( $application1 );
		$em->persist ( $application2 );
		
		// Étape 2 : On « flush » tout ce qui a été persisté avant
		$em->flush ();
		
		// La gestion d'un formulaire est particulière, mais l'idée est la suivante :
		
		// Si la requête est en POST, c'est que le visiteur a soumis le formulaire
		if ($request->isMethod ( 'POST' )) {
			// Ici, on s'occupera de la création et de la gestion du formulaire
			
			$request->getSession ()->getFlashBag ()->add ( 'notice', 'Annonce bien enregistrée.' );
			
			// Puis on redirige vers la page de visualisation de cettte annonce
			return $this->redirect ( $this->generateUrl ( 'oc_platform_view', array (
					$advert - getId () 
			) ) );
		}
		
		// On récupère le service
		$antispam = $this->container->get ( 'oc_platform.antispam' );
		
		// Je pars du principe que $text contient le texte d'un message quelconque
		/*
		 $text = '...';
		 if ($antispam->isSpam($text)) {
		 throw new \Exception('Votre message a été détecté comme spam !');
		 }
		 // Si on n'est pas en POST, alors on affiche le formulaire*/
		return $this->render ( 'OCPlatformBundle:Advert:add.html.twig', array(
				'form'=>$form->createView()
				));
	}
	
	public function editAction($id, Request $request) {
		// Ici, on récupérera l'annonce correspondante à $id
		$em = $this->getDoctrine ()->getManager ();
		
		// On récupère l'annonce $id
		$advert = $em->getRepository ( 'OCPlatformBundle:Advert' )->find ( $id );
		
		if (null === $advert) {
			throw new NotFoundHttpException ( "L'annonce d'id " . $id . " n'existe pas." );
		}
		
		// La méthode findAll retourne toutes les catégories de la base de données
		$listCategories = $em->getRepository ( 'OCPlatformBundle:Category' )->findAll ();
		
		// On boucle sur les catégories pour les lier à l'annonce
		foreach ( $listCategories as $category ) {
			$advert->addCategory ( $category );
		}
		
		// Pour persister le changement dans la relation, il faut persister l'entité propriétaire
		// Ici, Advert est le propriétaire, donc inutile de la persister car on l'a récupérée depuis Doctrine
		
		// Étape 2 : On déclenche l'enregistrement
		$em->flush ();
		
		// … reste de la méthode
		
		// Même mécanisme que pour l'ajout
		if ($request->isMethod ( 'POST' )) {
			$request->getSession ()->getFlashBag ()->add ( 'notice', 'Annonce bien modifiée.' );
			
			return $this->redirect ( $this->generateUrl ( 'oc_platform_view', array (
					'id' => $id 
			) ) );
		}
		
		return $this->render ( 'OCPlatformBundle:Advert:edit.html.twig', array (
				'advert' => $advert 
		) );
	}
	public function deleteAction($id, Request $request) {
		// Ici, on récupérera l'annonce correspondant à $id
		$em = $this->getDoctrine ()->getManager ();
		
		// On récupère l'annonce $id
		$advert = $em->getRepository ( 'OCPlatformBundle:Advert' )->find ( $id );
		
		if (null === $advert) {
			throw new NotFoundHttpException ( "L'annonce d'id " . $id . " n'existe pas." );
		}
		
		if ($request->isMethod ( 'POST' )) {
			// Si la requête est en POST, on deletea l'article
			
			$request->getSession ()->getFlashBag ()->add ( 'info', 'Annonce bien supprimée.' );
			
			// Puis on redirige vers l'accueil
			return $this->redirect ( $this->generateUrl ( 'oc_platform_home' ) );
		}
		// Ici, on gérera la suppression de l'annonce en question
		// On boucle sur les catégories de l'annonce pour les supprimer
		foreach ( $advert->getCategories () as $category ) {
			$advert->removeCategory ( $category );
		}
		
		// On déclenche la modification
		$em->flush ();
		
		return $this->render ( 'OCPlatformBundle:Advert:delete.html.twig' );
	}
	public function editImageAction($advertId) {
		$em = $this->getDoctrine ()->getManager ();
		
		// On récupère l'annonce
		$advert = $em->getRepository ( 'OCPlatformBundle:Advert' )->find ( $advertId );
		
		// On modifie l'URL de l'image par exemple
		$advert->getImage ()->setUrl ( 'test.png' );
		
		// On n'a pas besoin de persister l'annonce ni l'image.
		// Rappelez-vous, ces entités sont automatiquement persistées car
		// on les a récupérées depuis Doctrine lui-même
		
		// On déclenche la modification
		$em->flush ();
		
		return new Response ( 'OK' );
	}
}
?>	
