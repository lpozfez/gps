<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Mensaje;
use App\Form\AddMensajeType;

class MensajeController extends AbstractController
{
    #[Route('/mensaje', name: 'app_mensaje')]
    public function index(): Response
    {
        return $this->render('mensaje/index.html.twig', [
            'controller_name' => 'MensajeController',
        ]);
    }

    #[Route('/mensaje/new', name: 'crea_mensaje')]
    public function newMensaje(EntityManagerInterface $em, Request $request): Response
    {
        $mensaje= new Mensaje();
        $form=$this->createForm(AddMensajeType::class,$mensaje);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mensaje = $form->getData();
            $em->persist($mensaje);
            $em->flush();
        }
        
        return $this->render('mensaje/nuevoMensaje.html.twig', [
            'form' => $form,
        ]);
    }
}
