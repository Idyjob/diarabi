<?php

namespace Frontend\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Frontend\FrontendBundle\Entity\Article;
use Frontend\FrontendBundle\Entity\User;
use Frontend\FrontendBundle\Entity\Likeable;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Frontend\FrontendBundle\Entity\Comment;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('FrontendBundle:Article')->findBy(array(),array('id' => 'DESC'));
        return $this->render('FrontendBundle:Default:index.html.twig',array('articles'=>$articles));
    }


    /**
    * add comment to article
    */

    public function addCommentArticleAction($id){

      $utilisateur = $this->get('security.context')->getToken()->getUser();
      $request = $this->getRequest();


        if($request->getMethod() == 'POST' && $request->isXmlHttpRequest() && $utilisateur  instanceof User){

            $em = $this->getDoctrine()->getManager();
            $comment = new Comment();
            $comment->setUser($utilisateur);
            $contenu = $request->request->get('comment');

            $comment->setContenu($contenu);
            $article = $em->getRepository('FrontendBundle:Article')->find($id);
            $article->addComment($comment);
            $comment->setArticle($article);
            $em->persist($article);
            $em->flush();

            $serializer = $this->container->get('jms_serializer');
            $newComment = $serializer->serialize($comment, 'json');

            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            $response->setContent($newComment);


              return $response;
        }
}



/**
* add like to article
*/

public function addLikeArticleAction($id){

  $utilisateur = $this->get('security.context')->getToken()->getUser();
  $request = $this->getRequest();


    if($request->getMethod() == 'GET' && $request->isXmlHttpRequest() && $utilisateur  instanceof User){

        $em = $this->getDoctrine()->getManager();
        $like = new Likeable();
        $like->setUser($utilisateur);



        $article = $em->getRepository('FrontendBundle:Article')->find($id);
        $article->addLike($like);
        $like->setArticle($article);
        $em->persist($article);
        $em->flush();

        $serializer = $this->container->get('jms_serializer');
        $newLike = $serializer->serialize($like, 'json');

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($newLike);


          return $response;
    }
}
/*
* present single article
*/

public function oneArticleAction($slug){
  $em = $this->getDoctrine()->getManager();
  $article = false;
  if($slug){
    $article = $em->getRepository('FrontendBundle:Article')->findOneBy(array('slug' => $slug));

  }


  return $this->render('FrontendBundle:Default:oneArticle.html.twig',array('article'=>$article));


}

}
