<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Nivel_certificado;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Nivel_certificado controller.
 *
 * @Route("nivel_certificado")
 */
class Nivel_certificadoController extends Controller
{
    /**
     * Lists all nivel_certificado entities.
     *
     * @Route("/", name="nivel_certificado_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $nivel_certificados = $em->getRepository('AppBundle:Nivel_certificado')->findAll();

        return $this->render('nivel_certificado/index.html.twig', array(
            'nivel_certificados' => $nivel_certificados,
        ));
    }

    /**
     * Creates a new nivel_certificado entity.
     *
     * @Route("/new", name="nivel_certificado_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $nivel_certificado = new Nivel_certificado();
        $form = $this->createForm('AppBundle\Form\Nivel_certificadoType', $nivel_certificado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($nivel_certificado);
            $em->flush($nivel_certificado);

            return $this->redirectToRoute('nivel_certificado_show', array('id' => $nivel_certificado->getId()));
        }

        return $this->render('nivel_certificado/new.html.twig', array(
            'nivel_certificado' => $nivel_certificado,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a nivel_certificado entity.
     *
     * @Route("/{id}", name="nivel_certificado_show")
     * @Method("GET")
     */
    public function showAction(Nivel_certificado $nivel_certificado)
    {
        $deleteForm = $this->createDeleteForm($nivel_certificado);

        return $this->render('nivel_certificado/show.html.twig', array(
            'nivel_certificado' => $nivel_certificado,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing nivel_certificado entity.
     *
     * @Route("/{id}/edit", name="nivel_certificado_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Nivel_certificado $nivel_certificado)
    {
        $deleteForm = $this->createDeleteForm($nivel_certificado);
        $editForm = $this->createForm('AppBundle\Form\Nivel_certificadoType', $nivel_certificado);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nivel_certificado_edit', array('id' => $nivel_certificado->getId()));
        }

        return $this->render('nivel_certificado/edit.html.twig', array(
            'nivel_certificado' => $nivel_certificado,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a nivel_certificado entity.
     *
     * @Route("/{id}", name="nivel_certificado_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Nivel_certificado $nivel_certificado)
    {
        $form = $this->createDeleteForm($nivel_certificado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($nivel_certificado);
            $em->flush($nivel_certificado);
        }

        return $this->redirectToRoute('nivel_certificado_index');
    }

    /**
     * Creates a form to delete a nivel_certificado entity.
     *
     * @param Nivel_certificado $nivel_certificado The nivel_certificado entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Nivel_certificado $nivel_certificado)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nivel_certificado_delete', array('id' => $nivel_certificado->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
