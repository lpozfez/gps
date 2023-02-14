<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\MensajeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\orm\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Mensaje;
use App\Entity\Modo;
use App\Entity\Banda;
use App\Entity\User;
use App\Repository\ModoRepository;
use App\Repository\BandaRepository;
use App\Repository\UserRepository;



#[Route('/api', name: 'api_mensaje')]
class ApiMensajeController extends AbstractController
{

    #[Route('/mensaje/{id}', name: 'api_get_mensaje', methods:['GET', 'HEAD'])]
    public function getMensaje(mensajeRepository $mensajeBd,int $id): JsonResponse
    {
       $mensaje=$mensajeBd->find($id);
       if(!$mensaje){
            return $this->json('Mensaje no encontrado', 404);
        }else{
            $datos[] = $mensaje->toArray();
            return $this->json($datos, $status=200);
        }
    }


    #[Route("/mensaje", name:"api_getAll_mensaje", methods:['GET', 'HEAD'])]
    public function getMensajes(MensajeRepository $mensajeBd): JsonResponse 
    { 
        $mensajes = $mensajeBd->findAll(); 
        $datos = []; 
    
        foreach ($mensajes as $mensaje) { 
            $datos[] = $mensaje->toArray();
        } 
    
        return $this->json($datos, $status=200); 
    }


    #[Route('/mensaje', name:'api_add_mensaje', methods:['POST'])]
    public function addMensaje(Request $request, MensajeRepository $mensajeBd, UserRepository $userBd, ModoRepository $modoBd,BandaRepository $bandaBd) :JsonResponse
    {
        //Cogemos los datos de la Request
        $data=json_decode($request->getContent(), true);
        //$fecha=new DateTime(getDate());
        $validado=$data['validado'];
        $modo=$data['modo'];
        $banda=$data['banda'];
        $user=$data['user'];
        $juez=$data['juez'];
        //Creamos el objeto $Mensaje
        $mensaje=new Mensaje();
        //Añadimos los datos de la Request al nuevo objeto
        $mensaje->setFecha(new \DateTime('@'.strtotime('now')));
        $mensaje->setValidado($validado);
        $mensaje->setModo($modoBd->find($modo));
        $mensaje->setBanda($bandaBd->find($banda));
        $mensaje->setUser($userBd->find($user));
        $mensaje->setJuez($juez);
        //Grabamos en Base de datos
        $mensajeBd->save($mensaje,true);
        //devolvemos el objeto creado en BD
        return $this->json($mensaje->toArray(),$status=201);
    }

    #[Route('/mensaje/{id}', name:'borra_mensaje', methods:['DELETE'])]
    public function deleteuser(Request $request,MensajeRepository $mensajeBd, int $id):JsonResponse
    {
        $mensaje=$mensajeBd->find($id);
        var_dump($mensaje);
        if($mensaje==null){
            return $this->json('Mensaje no encontrado', 404);
        }else{
            $mensajeBd->remove($mensaje, true);
            return $this->json('Mensaje borrado', 200);
        }
    }
}
