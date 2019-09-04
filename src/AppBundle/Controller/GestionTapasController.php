<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\TapaType;
use AppBundle\Form\CategoriaType;
use AppBundle\Form\IngredienteType;
use AppBundle\Entity\Tapa;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Ingrediente;

/**
 * @Route("/gestionTapas")
 */
class GestionTapasController extends Controller {

    /**
     * @Route("/nuevaTapa", name="nuevaTapa")
     */
    public function nuevaTapaAction(Request $request) {

//        if(!is_null($request)){
//            $datos = $request->request->all();
//            //var_dump($datos);
//        }
// creates a task and gives it some dummy data for this example
        $tapa = new Tapa();

//$formBuilder = $this->createFormBuilder($tapa);      //$formBuilder, es para crear el formbuilder a partir del objeto tapa que hemos generado en la línea 21-22, que es la instancia del objeto Tapa.php. $formBuilder es el constructor
//Construyendo el formulario
//$form = $formBuilder->getForm();        //recogemos el formulario
        $form = $this->createForm(TapaType::class, $tapa);
//Recogemos la información
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
// Rellenar el Entity Tapa


            $tapa = $form->getData();
//$tapa->setIngredientes("");
            $fotoFile = $tapa->getFoto();
//                var_dump($fotoFile);
            $fileName = $this->generateUniqueFileName() . '.' . $fotoFile->guessExtension();
// Move the file to the directory where brochures are stored
            try {
                $fotoFile->move(
                        $this->getParameter('tapaImg_directory'), $fileName
                );
            } catch (FileException $e) {
// ... handle exception if something happens during file upload
            }
//var_dump($fileName);
            $tapa->setfoto($fileName);
//                $tapa->setTop(0);
            $tapa->setFechaCreacion(new \DateTime());

//Almacenar nueva Tapa
            $em = $this->getDoctrine()->getManager();
            $em->persist($tapa);
            $em->flush();
//return $this->render('test/test.html.twig');
            return $this->redirectToRoute('tapa', array('id' => $tapa->getId()));
// ... perform some action, such as saving the task to the database
// for example, if Task is a Doctrine entity, save it!
// $entityManager = $this->getDoctrine()->getManager();
// $entityManager->persist($task);
// $entityManager->flush();
        }

        return $this->render('gestion/nuevaTapa.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/nuevaCategoria", name="nuevaCategoria")
     */
    public function nuevaCatAction(Request $request) {
        //        if(!is_null($request)){
        //            $datos = $request->request->all();
        //            //var_dump($datos);
        //        }
        // creates a task and gives it some dummy data for this example
        $categoria = new Categoria();

        //$formBuilder = $this->createFormBuilder($tapa);      //$formBuilder, es para crear el formbuilder a partir del objeto tapa que hemos generado en la línea 21-22, que es la instancia del objeto Tapa.php. $formBuilder es el constructor
        //Construyendo el formulario
        //$form = $formBuilder->getForm();        //recogemos el formulario
        $form = $this->createForm(CategoriaType::class, $categoria);
        //Recogemos la información
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Rellenar el Entity Tapa


            $categoria = $form->getData();
            //$tapa->setIngredientes("");
            $fotoFile = $categoria->getFoto();
            //                var_dump($fotoFile);
            $fileName = $this->generateUniqueFileName() . '.' . $fotoFile->guessExtension();
            // Move the file to the directory where brochures are stored
            try {
                $fotoFile->move(
                        $this->getParameter('tapaImg_directory'), $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            //var_dump($fileName);
            $categoria->setfoto($fileName);
            //                $tapa->setTop(0);
//    $categoria->setFechaCreacion(new \DateTime());
            //Almacenar nueva Categoria
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();
            //return $this->render('test/test.html.twig');
            return $this->redirectToRoute('categoria', array('id' => $categoria->getId()));
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();
        }

        return $this->render('gestion/nuevaCategoria.html.twig', array('form' => $form->createView()));
    }

    /**
     * @return string
     */
    private function generateUniqueFileName() {
// md5() reduces the similarity of the file names generated by
// uniqid(), which is based on timestamps
        return md5(uniqid());
    }
    
        /**
     * @Route("/nuevoIngrediente", name="nuevoIngrediente")
     */
    public function nuevoIngredienteAction(Request $request) {
        //        if(!is_null($request)){
        //            $datos = $request->request->all();
        //            //var_dump($datos);
        //        }
        // creates a task and gives it some dummy data for this example
        $ingrediente = new Ingrediente();

        //$formBuilder = $this->createFormBuilder($tapa);      //$formBuilder, es para crear el formbuilder a partir del objeto tapa que hemos generado en la línea 21-22, que es la instancia del objeto Tapa.php. $formBuilder es el constructor
        //Construyendo el formulario
        //$form = $formBuilder->getForm();        //recogemos el formulario
        $form = $this->createForm(IngredienteType::class, $ingrediente);
        //Recogemos la información
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Rellenar el Entity Tapa


            $ingrediente = $form->getData();
            //$tapa->setIngredientes("");
//            $fotoFile = $ingrediente->getFoto();
//            //                var_dump($fotoFile);
//            $fileName = $this->generateUniqueFileName() . '.' . $fotoFile->guessExtension();
//            // Move the file to the directory where brochures are stored
//            try {
//                $fotoFile->move(
//                        $this->getParameter('tapaImg_directory'), $fileName
//                );
//            } catch (FileException $e) {
//                // ... handle exception if something happens during file upload
//            }
            //var_dump($fileName);
//            $categoria->setfoto($fileName);
            //                $tapa->setTop(0);
//    $categoria->setFechaCreacion(new \DateTime());
            //Almacenar nuevo Ingrediente
            $em = $this->getDoctrine()->getManager();
            $em->persist($ingrediente);
            $em->flush();
            //return $this->render('test/test.html.twig');
            return $this->redirectToRoute('ingrediente', array('id' => $ingrediente->getId()));
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();
        }

        return $this->render('gestion/nuevoIngrediente.html.twig', array('form' => $form->createView()));
    }

}
