<?php
namespace Settings\SettingsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{

  public function menuAction(){
    $em=$this->getDoctrine()->getManager();
    $artiste = $em->getRepository('SettingsBundle:Artiste')->getLastEntity();
    $pages= $em->getRepository('SettingsBundle:Pages')->findAll();
    return $this->render('SettingsBundle:Default:pages/menu.html.twig', array('pages'=>$pages,'artiste'=>$artiste));




  }
    public function pageAction($slug)
    {
        $em=$this->getDoctrine()->getManager();
        $page= $em->getRepository('SettingsBundle:Pages')->findOneBySlug($slug);

        if(!$page){
          throw $this->createNotFoundException('Cette page n\'existe pas');
        }
        return $this->render('SettingsBundle:Default:pages/page.html.twig',array('page'=>$page));
    }

    public function artisteMainProfileAction(){
      $em=$this->getDoctrine()->getManager();
      $artiste = $em->getRepository('SettingsBundle:Artiste')->getLastEntity();

      return $this->render('SettingsBundle:Default:pages/artisteMainProfile.html.twig', array( 'artiste'=>$artiste));


    }
}
