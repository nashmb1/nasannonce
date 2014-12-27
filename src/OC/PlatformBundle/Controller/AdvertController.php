<?php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Image;
use OC\PlatformBundle\Entity\AdvertSkill;
use OC\PlatformBundle\Entity\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use OC\PlatformBundle\Form\AdvertType;
use OC\PlatformBundle\Form\AdvertEditType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

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
	
	/**
	 * @Security("has_role('ROLE_AUTEUR')")
	 */
	public function addAction(Request $request) {
		
		/*// On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
		if (!$this->get('security.context')->isGranted('ROLE_AUTEUR')) {
			// Sinon on déclenche une exception « Accès interdit »
			throw new AccessDeniedException('Accès limité aux auteurs.');
		}*/
		
    	$advert = new Advert ();
		// On recupère le formulaire
		$form = $this->createForm ( new AdvertType (), $advert );
		if ($form->handleRequest ( $request )->isValid ()) {
			// On l'enregistre notre objet $advert dans la base de données
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $advert );
			$em->flush ();
			
			$request->getSession ()->getFlashBag ()->add ( 'notice', 'Annonce bien enregistrée.' );
			
			// On redirige vers la page de visualisation de l'annonce nouvellement créée
			return $this->redirect ( $this->generateUrl ( 'oc_platform_view', array (
					'id' => $advert->getId () 
			) ) );
		}
		// Si on n'est pas en POST, alors on affiche le formulaire*/
		return $this->render ( 'OCPlatformBundle:Advert:add.html.twig', array (
				'form' => $form->createView () 
		) );
	}
	
	public function editAction($id, Request $request) {
		$em = $this->getDoctrine ()->getManager ();
		
		// On récupère l'annonce $id
		$advert = $em->getRepository ( 'OCPlatformBundle:Advert' )->find ( $id );
		
		if (null === $advert) {
			throw new NotFoundHttpException ( "L'annonce d'id " . $id . " n'existe pas." );
		}
		
	    $form = $this->createForm(new AdvertEditType(), $advert);
		
		// Même mécanisme que pour l'ajout
		if ($form->handleRequest($request)->isValid()) {
			$request->getSession()->getFlashBag ()->add ( 'notice', 'Annonce bien modifiée.' );
			
			return $this->redirect ( $this->generateUrl ( 'oc_platform_view', array (
					'id' => $advert->getId() 
			) ) );
		}
		
		return $this->render ( 'OCPlatformBundle:Advert:edit.html.twig', array (
				'advert' => $advert,
				'form' => $form->createView()
		) );
	}
	
	public function deleteAction($id, Request $request) {
		
		$em = $this->getDoctrine()->getManager ();
		// On récupère l'annonce $id
		$advert = $em->getRepository('OCPlatformBundle:Advert' )->find ( $id );
		
		if (null === $advert) {
			throw new NotFoundHttpException ( "L'annonce d'id " . $id . " n'existe pas." );
		}
		
		// On crée un formulaire vide, qui ne contiendra que le champ CSRF
    	// Cela permet de protéger la suppression d'annonce contre cette faille
    	$form = $this->createFormBuilder()->getForm();
    	
		if ($form->handleRequest($request)->isValid()) {
			$em->remove($advert);
			$em->flush();
			$request->getSession()->getFlashBag ()->add ('info', 'Annonce bien supprimée.');
			// Puis on redirige vers l'accueil
			return $this->redirect($this->generateUrl ('oc_platform_home'));
		}
		return $this->render('OCPlatformBundle:Advert:delete.html.twig', array(
			'form' => $form->createView(),
			'advert'=> $advert
		));
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
