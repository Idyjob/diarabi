<?php

namespace Settings\SettingsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Settings\SettingsBundle\Entity\Artiste;
use Settings\SettingsBundle\Form\Type\ArtisteType;

/**
 * Artiste controller.
 *
 */
class ArtisteAdminController extends Controller
{
    /**
     * Lists all Artiste entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('SettingsBundle:Artiste')->findAll();
                return $this->render('SettingsBundle:Artiste:index.html.twig', array(
            'entities'  => $entities,
        ));
    }

    /**
     * Finds and displays a Artiste entity.
     *
     */
    public function showAction(Artiste $artiste)
    {
        $deleteForm = $this->createDeleteForm($artiste->getId(), 'admin_artistes_delete');

        return $this->render('SettingsBundle:Artiste:show.html.twig', array(
            'artiste' => $artiste,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Artiste entity.
     *
     */
    public function newAction()
    {
        $artiste = new Artiste();
        $form = $this->createForm(new ArtisteType(), $artiste);

        return $this->render('SettingsBundle:Artiste:new.html.twig', array(
            'artiste' => $artiste,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Artiste entity.
     *
     */
    public function createAction(Request $request)
    {
        $artiste = new Artiste();
        $form = $this->createForm(new ArtisteType(), $artiste);
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($artiste);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_artistes_show', array('id' => $artiste->getId())));
        }

        return $this->render('SettingsBundle:Artiste:new.html.twig', array(
            'artiste' => $artiste,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Artiste entity.
     *
     */
    public function editAction(Artiste $artiste)
    {
        $editForm = $this->createForm(new ArtisteType(), $artiste, array(
            'action' => $this->generateUrl('admin_artistes_update', array('id' => $artiste->getId())),
            'method' => 'PUT',
        ));
        $deleteForm = $this->createDeleteForm($artiste->getId(), 'admin_artistes_delete');

        return $this->render('SettingsBundle:Artiste:edit.html.twig', array(
            'artiste' => $artiste,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Artiste entity.
     *
     */
    public function updateAction(Artiste $artiste, Request $request)
    {
        $editForm = $this->createForm(new ArtisteType(), $artiste, array(
            'action' => $this->generateUrl('admin_artistes_update', array('id' => $artiste->getId())),
            'method' => 'PUT',
        ));
        if ($editForm->handleRequest($request)->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('admin_artistes_edit', array('id' => $artiste->getId())));
        }
        $deleteForm = $this->createDeleteForm($artiste->getId(), 'admin_artistes_delete');

        return $this->render('SettingsBundle:Artiste:edit.html.twig', array(
            'artiste' => $artiste,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Artiste entity.
     *
     */
    public function deleteAction(Artiste $artiste, Request $request)
    {
        $form = $this->createDeleteForm($artiste->getId(), 'admin_artistes_delete');
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($artiste);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_artistes'));
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
