<?php
// src/OC/PlatformBundle/DoctrineListener/ApplicationNotification.php

namespace OC\PlatformBundle\DoctrineListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use OC\PlatformBundle\Entity\Application;

class ApplicationNotification
{
  private $mailer;

  public function __construct(\Swift_Mailer $mailer)
  {
    $this->mailer = $mailer;
  }

  public function postPersist(LifecycleEventArgs $args)
  {
    $entity = $args->getEntity();

    // On veut envoyer un email que pour les entit�s Application
    if (!$entity instanceof Application) {
      return;
    }

    $message = new \Swift_Message(
      'Nouvelle candidature',
      'Vous avez re�u une nouvelle candidature.'
    );
    
    $message
      //->addTo($entity->getAdvert()->getAuthor()) // Ici bien s�r il faudrait un attribut "email", j'utilise "author" � la place
    ->addTo('nassirouharouna6@yahoo.fr')
      ->addFrom('admin@votresite.com')
    ;

    //$this->mailer->send($message);
  }
}