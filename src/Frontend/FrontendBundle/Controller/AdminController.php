<?php

namespace Frontend\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
      $em = $this->getDoctrine()->getManager();
      $users = $em->getRepository('FrontendBundle:User')->getOnlineUsers();


        return $this->render('FrontendBundle:Default:admin/admin.html.twig',array('users' =>$users));
    }
}
