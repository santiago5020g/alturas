<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Customer controller.
 * @Security("has_role('ROLE_ADMIN')")
 * @Route("cliente")
 */
class CustomerController extends Controller
{
    /**
     * Lists all customer entities.
     *
     * @Route("/", name="cliente_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {

        // $_POST parameters
        //se capturan los campos del formulario
        $nombre = $request->request->get('nombre');
        $cedula = $request->request->get('cedula');
        $numeroRegistro = $request->request->get('numeroRegistro');
        $filtro = "";
        //para llevar estos campos al enviar el formulario
        $busqueda = array("nombre"=>$nombre,"cedula"=>$cedula,"numeroRegistro"=>$numeroRegistro);

        //esta es para la busqueda del formulario
        if($nombre != "")
           { $filtro .= "and c.nombre = '$nombre'"; }
       if($cedula != "")
           { $filtro .= "and c.cedula = '$cedula'"; }
       if($numeroRegistro != "")
           { $filtro .= "and c.numeroRegistro = '$numeroRegistro'"; }


        //empezar la consulta
        $em    = $this->get('doctrine.orm.entity_manager');
        //1=1 $filtro es la logica para poder implementar filtros en la consulta
        $customer   = "SELECT c FROM AppBundle:Customer c WHERE 1=1 $filtro";
        $query = $em->createQuery($customer);
        //el paginador
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );


        return $this->render('customer/index.html.twig', array('pagination' => $pagination,'busqueda'=>$busqueda));
    }





    /**
     * Creates a new customer entity.
     *
     * @Route("/new", name="cliente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $customer = new Customer();
        $form = $this->createForm('AppBundle\Form\CustomerType', $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush($customer);

            $this->addFlash(
            'mensaje',
            'Cliente creado correctamente'
            );

            return $this->redirectToRoute('cliente_index');
        }

        return $this->render('customer/new.html.twig', array(
            'customer' => $customer,
            'form' => $form->createView(),
        ));
    }



    /**
     * Displays a form to edit an existing customer entity.
     *
     * @Route("/{id}/edit", name="cliente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Customer $customer)
    {
        $deleteForm = $this->createDeleteForm($customer);
        $editForm = $this->createForm('AppBundle\Form\CustomerType', $customer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
            'mensaje',
            'Cliente actualizado correctamente'
            );

            return $this->redirectToRoute('cliente_edit', array('id' => $customer->getId()));
        }

        return $this->render('customer/edit.html.twig', array(
            'customer' => $customer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a customer entity.
     *
     * @Route("/{id}", name="cliente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Customer $customer)
    {
        $form = $this->createDeleteForm($customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($customer);
            $em->flush($customer);
        }

        return $this->redirectToRoute('cliente_index');
    }

    /**
     * Creates a form to delete a customer entity.
     *
     * @param Customer $customer The customer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Customer $customer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cliente_delete', array('id' => $customer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
