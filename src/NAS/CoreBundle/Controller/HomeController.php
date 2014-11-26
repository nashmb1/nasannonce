<?php

namespace NAS\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller{

    public function indexAction(){

        // récupéreration de l'ensemble des annonomes
        $em = $this->getDoctrine()->getManager();
        $listAdverts = $em->getRepository('OCPlatformBundle:Advert')->findBy(array(),array('id' => 'DESC'), 3);

        // Et modifiez le 2nd argument pour injecter notre liste
        return $this->render('NASCoreBundle:Home:home.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }

    public function contactAction(Request $request){

        $session = $request->getSession();

        $session->getFlashbag()->add('info','La page de contact n\'est pas encore réalisé! merci');

        return $this->redirect( $this->generateUrl('nas_core_homepage'));
    }
}




?>
