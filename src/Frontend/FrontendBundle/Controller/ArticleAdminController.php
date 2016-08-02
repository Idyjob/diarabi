<?php

namespace Frontend\FrontendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Frontend\FrontendBundle\Entity\Article;
use Frontend\FrontendBundle\Entity\Media;
use Frontend\FrontendBundle\Entity\Comment;
use Frontend\FrontendBundle\Entity\User;
use Frontend\FrontendBundle\Form\Type\ArticleType;
use Frontend\FrontendBundle\Form\Type\ArticleFilterType;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;

/**
 * Article controller.
 *
 */
class ArticleAdminController extends Controller
{

  /**
  *
  */

  public function addCommentArticleAction($id){

    $utilisateur = $this->get('security.context')->getToken()->getUser();
    $request = $this->getRequest();

      if($request->getMethod() == 'POST' && $request->isXmlHttpRequest()){

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


          $json = json_encode(array(
                'success' => $comment->getId() ,


            ));

            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            $response->setContent($json);
            return $response;
      }



  }
    /**
     * Lists all Article entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new ArticleFilterType());
        if (!is_null($response = $this->saveFilter($form, 'article', 'admin_articles'))) {
            return $response;
        }
        $qb = $em->getRepository('FrontendBundle:Article')->createQueryBuilder('a');
        $paginator = $this->filter($form, $qb, 'article');
                return $this->render('FrontendBundle:Article:index.html.twig', array(
            'form'      => $form->createView(),
            'paginator' => $paginator,
        ));
    }

    /**
     * Finds and displays a Article entity.
     *
     */
    public function showAction(Article $article)
    {
        $deleteForm = $this->createDeleteForm($article->getId(), 'admin_articles_delete');



        return $this->render('FrontendBundle:Article:show.html.twig', array(
            'article' => $article,

            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Article entity.
     *
     */
    public function newAction()
    {
        $article = new Article();
        // $media = new Media();
        // $article->addMedia($media);
        $form = $this->createForm(new ArticleType(), $article);

        return $this->render('FrontendBundle:Article:new.html.twig', array(
            'article' => $article,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Article entity.
     *
     */
    public function createAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(new ArticleType(), $article);
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_articles_show', array('id' => $article->getId())));
        }

        return $this->render('FrontendBundle:Article:new.html.twig', array(
            'article' => $article,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     */
    public function editAction(Article $article)
    {
        // $editForm = $this->createForm(new ArticleType(), $article, array(
        //     'action' => $this->generateUrl('admin_articles_update', array('id' => $article->getId())),
        //     'method' => 'PUT',
        // ));
        $editForm = $this->createForm(new ArticleType(), $article );
        $deleteForm = $this->createDeleteForm($article->getId(), 'admin_articles_delete');

        return $this->render('FrontendBundle:Article:edit.html.twig', array(
            'article' => $article,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Article entity.
     *
     */
    public function updateAction(Article $article, Request $request)
    {
        $editForm = $this->createForm(new ArticleType(), $article, array(
            'action' => $this->generateUrl('admin_articles_update', array('id' => $article->getId())),
            'method' => 'PUT',
        ));
        if ($editForm->handleRequest($request)->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('admin_articles_edit', array('id' => $article->getId())));
        }
        $deleteForm = $this->createDeleteForm($article->getId(), 'admin_articles_delete');

        return $this->render('FrontendBundle:Article:edit.html.twig', array(
            'article' => $article,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Save order.
     *
     */
    public function sortAction($field, $type)
    {
        $this->setOrder('article', $field, $type);

        return $this->redirect($this->generateUrl('admin_articles'));
    }

    /**
     * @param string $name  session name
     * @param string $field field name
     * @param string $type  sort type ("ASC"/"DESC")
     */
    protected function setOrder($name, $field, $type = 'ASC')
    {
        $this->getRequest()->getSession()->set('sort.' . $name, array('field' => $field, 'type' => $type));
    }

    /**
     * @param  string $name
     * @return array
     */
    protected function getOrder($name)
    {
        $session = $this->getRequest()->getSession();

        return $session->has('sort.' . $name) ? $session->get('sort.' . $name) : null;
    }

    /**
     * @param QueryBuilder $qb
     * @param string       $name
     */
    protected function addQueryBuilderSort(QueryBuilder $qb, $name)
    {
        $alias = current($qb->getDQLPart('from'))->getAlias();
        if (is_array($order = $this->getOrder($name))) {
            $qb->orderBy($alias . '.' . $order['field'], $order['type']);
        }
    }

    /**
     * Save filters
     *
     * @param  FormInterface $form
     * @param  string        $name   route/entity name
     * @param  string        $route  route name, if different from entity name
     * @param  array         $params possible route parameters
     * @return Response
     */
    protected function saveFilter(FormInterface $form, $name, $route = null, array $params = null)
    {
        $request = $this->getRequest();
        $url = $this->generateUrl($route ?: $name, is_null($params) ? array() : $params);
        if ($request->query->has('submit-filter') && $form->handleRequest($request)->isValid()) {
            $request->getSession()->set('filter.' . $name, $request->query->get($form->getName()));

            return $this->redirect($url);
        } elseif ($request->query->has('reset-filter')) {
            $request->getSession()->set('filter.' . $name, null);

            return $this->redirect($url);
        }
    }

    /**
     * Filter form
     *
     * @param  FormInterface                                       $form
     * @param  QueryBuilder                                        $qb
     * @param  string                                              $name
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    protected function filter(FormInterface $form, QueryBuilder $qb, $name)
    {
        if (!is_null($values = $this->getFilter($name))) {
            if ($form->submit($values)->isValid()) {
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $qb);
            }
        }

        // possible sorting
        $this->addQueryBuilderSort($qb, $name);
        return $this->get('knp_paginator')->paginate($qb, $this->getRequest()->query->get('page', 1), 20);
    }

    /**
     * Get filters from session
     *
     * @param  string $name
     * @return array
     */
    protected function getFilter($name)
    {
        return $this->getRequest()->getSession()->get('filter.' . $name);
    }

    /**
     * Deletes a Article entity.
     *
     */
    public function deleteAction(Article $article, Request $request)
    {
        $form = $this->createDeleteForm($article->getId(), 'admin_articles_delete');
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_articles'));
    }

    /**
     * Create Delete form
     *
     * @param integer                       $id
     * @param string                        $route
     * @return \Symfony\Component\Form\Form
     */
    protected function createDeleteForm($id, $route)
    {
        return $this->createFormBuilder(null, array('attr' => array('id' => 'delete')))
            ->setAction($this->generateUrl($route, array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}
