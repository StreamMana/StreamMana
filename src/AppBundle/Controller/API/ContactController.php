<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;

class ContactController extends FOSRestController
{
    /**
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new contact from the submitted data.",
     *   input = "AppBundle\Form\ContactType",
     *   statusCodes = {
     *     201 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @Route("/api/contact")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->submit($data);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $response = new Response("Correcto");
            $response->setStatusCode(201);
            return $response;
        }

        $response = new Response("Incorrecto");
        $response->setStatusCode(400);
        return $response;
    }

}
