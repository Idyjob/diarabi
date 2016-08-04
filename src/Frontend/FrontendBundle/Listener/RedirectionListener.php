<?php
namespace Frontend\FrontendBundle\Listener;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;


class RedirectionListener{

  public function __construct(ContainerInterface $container, Session $session){
    $this->session = $session;
    $this->router = $container->get('router');
    $this->securityContext = $container->get('security.context');
    $this->translator = $container->get('translator');
  }

  public function  onKernelRequest(GetResponseEvent $event){
    $route = $event->getRequest()->attributes->get('_route');

    if($route && ($route == 'fos_user_security_login' || $route == 'fos_user_registration_register')){

      if(is_object($this->securityContext->getToken()->getUser())){
        $this->session->getFlashBag()->add('notice',$this->translator->trans('alreadyconnected'));
        $event->setResponse(new RedirectResponse($this->router->generate('homepage')));
      }
      }



  }







}
