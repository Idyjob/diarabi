<?php
namespace Frontend\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class LanguageController extends Controller
{
  public function localeAction(Request $request,$locale)
  {



  $request->getSession()->set('_locale', $locale);



   $referer = $request->headers->get('referer');
   if (empty($referer)) {
       throw $this->createNotFoundException('ngs_not_found');
   }

   return $this->redirect($referer);
}


}
