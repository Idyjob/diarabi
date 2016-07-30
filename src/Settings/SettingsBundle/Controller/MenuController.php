<?php

namespace Settings\SettingsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    public function navadminAction()
    {
        return $this->render('SettingsBundle:Default:admin/navadmin.html.twig' );
    }
}
