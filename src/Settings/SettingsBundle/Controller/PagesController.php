<?php
namespace Settings\SettingsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{

  public function menuAction(){
    $em=$this->getDoctrine()->getManager();
    $pages= $em->getRepository('SettingsBundle:Pages')->findAll();
    return $this->render('SettingsBundle:Default:pages/menu.html.twig', array('pages'=>$pages));




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
}
