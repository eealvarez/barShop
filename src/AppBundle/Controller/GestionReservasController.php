<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Reserva;
use AppBundle\Entity\Usuario;
use AppBundle\Form\ReservaType;

/**
 * @Route("/reservas")
 */
class GestionReservasController extends Controller {
    //ASI ESTABA ANTES DE DESARROLLAR EL ICONO DEL LÁPIZ DE EDICIÓN EN EL LISTADO DE RESERVAS
//    /**
//     * @Route("/nueva/{id}", name="nuevaReserva")
//     */
//    public function nuevaReservaAction(Request $request, $id=null) {
//
////        if(!is_null($request)){
////            $datos = $request->request->all();
////            //var_dump($datos);
////        }
//// creates a task and gives it some dummy data for this example
//        $reserva = new Reserva();
//
////$formBuilder = $this->createFormBuilder($tapa);      //$formBuilder, es para crear el formbuilder a partir del objeto tapa que hemos generado en la línea 21-22, que es la instancia del objeto Tapa.php. $formBuilder es el constructor
////Construyendo el formulario
////$form = $formBuilder->getForm();        //recogemos el formulario
//        $form = $this->createForm(ReservaType::class, $reserva);
////Recogemos la información
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//// Rellenar el Entity Tapa
//
//
//            $usuario = $this->getUser();
////$tapa->setIngredientes("");
//            $reserva->setUsuario($usuario);
////                var_dump($fotoFile);
//
////Almacenar nueva Tapa
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($reserva);
//            $em->flush();
////return $this->render('test/test.html.twig');
//            return $this->redirectToRoute('reservas');
//// ... perform some action, such as saving the task to the database
//// for example, if Task is a Doctrine entity, save it!
//// $entityManager = $this->getDoctrine()->getManager();
//// $entityManager->persist($task);
//// $entityManager->flush();
//        }
//
//        return $this->render('gestion/nuevaReserva.html.twig', array('form' => $form->createView()));
//    } 

    /**
     * @Route("/nueva/{id}", name="nuevaReserva")
     */
    public function nuevaReservaAction(Request $request, $id = null) {

//        if(!is_null($request)){
//            $datos = $request->request->all();
//            //var_dump($datos);
//        }
// creates a task and gives it some dummy data for this example

        if ($id) {
            $repository = $this->getDoctrine()->getRepository(Reserva::class);
//            $reservas= $repository->findAll();
            $reserva = $repository->find($id);
        } else {
            $reserva = new Reserva();
        }


//$formBuilder = $this->createFormBuilder($tapa);      //$formBuilder, es para crear el formbuilder a partir del objeto tapa que hemos generado en la línea 21-22, que es la instancia del objeto Tapa.php. $formBuilder es el constructor
//Construyendo el formulario
//$form = $formBuilder->getForm();        //recogemos el formulario
        $form = $this->createForm(ReservaType::class, $reserva);
//Recogemos la información
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
// Rellenar el Entity Tapa


            $usuario = $this->getUser();
//$tapa->setIngredientes("");
            $reserva->setUsuario($usuario);
//                var_dump($fotoFile);
//Almacenar nueva Tapa
            $em = $this->getDoctrine()->getManager();
            $em->persist($reserva);
            $em->flush();
//return $this->render('test/test.html.twig');
            return $this->redirectToRoute('reservas');
// ... perform some action, such as saving the task to the database
// for example, if Task is a Doctrine entity, save it!
// $entityManager = $this->getDoctrine()->getManager();
// $entityManager->persist($task);
// $entityManager->flush();
        }

        return $this->render('gestion/nuevaReserva.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/reservas", name="reservas")
     */
    public function reservasAction(Request $request) {

        //Almacenar nueva Categoria
        $repository = $this->getDoctrine()->getRepository(Reserva::class);
//            $reservas= $repository->findAll();
        $reservas = $repository->findByUsuario($this->getUser());    //findByUsuario, está relacionado con la variable $usuario definida para la relación correspondiente en la entidad Reserva.php, y el $this->getUser(), que nos proporciona automáticamente cuando nosotros estamos autenticados dentro de la aplicación

        return $this->render('gestion/reservas.html.twig', array("reservas" => $reservas));     //array de reservas: array('reservas' => $reservas)
    }

    /**
     * @Route("/borrar/{id}", name="borrarReserva")
     */
    public function borrarReservaAction(Request $request, $id = null) {

        if ($id) {
            //búsqueda de la reserva
            $repository = $this->getDoctrine()->getRepository(Reserva::class);
//            $reservas= $repository->findAll();
            $reserva = $repository->find($id);
            //borrado
            $em = $this->getDoctrine()->getManager();
            $em->remove($reserva);
            $em->flush();
        }


        return $this->redirectToRoute('reservas');
    }

}
