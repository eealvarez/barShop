<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use AppBundle\Entity\Tapa;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Ingrediente;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;

class DefaultController extends Controller {
    
//ASÍ ESTABA ANTES DE APLICAR API REST FULL    
//        /**
//     * @Route("/{pagina}", name="homepage")
//     */
//    public function homeAction(Request $request, $pagina = 1) {
    
    
    

    /**
     * @Route("/{pagina}", name="homepage", requirements={"pagina"="\d+"})  
     */
    public function homeAction(Request $request, $pagina = 1) {         //requirements={"pagina"="\d+"}), expresión regular que solo permite decimales

//        $numTapas=3;
//capturar el repositorio de la tabla Tapa contra la BD
        $tapaRepository = $this->getDoctrine()->getRepository(Tapa::class);
//        $tapas = $tapaRepository->findAll();
//        $tapas = $tapaRepository->findByTop(1);

        /*
          $query = $tapaRepository->createQueryBuilder('t')
          ->where('t.top > = 1')
          ->setFirstResult($numTapas*($pagina-1))
          ->setMaxResults($numTapas)
          //                ->setParameter('price', '19.99')
          //                ->orderBy('p.price', 'ASC')
          ->getQuery();
         */

//            $tapas = $query->getResult();
        $tapas = $tapaRepository->paginaTapas($pagina);


//        var_dump($tapas);
// replace this example code with whatever you need
        return $this->render('frontal/index.html.twig', array('tapas' => $tapas, 'paginaActual' => $pagina));
    }

    /**
     * @Route("/nosotros/", name="nosotros")
     */
    public function nosotrosAction(Request $request) {
// replace this example code with whatever you need
        return $this->render('frontal/nosotros.html.twig');
    }

    /**
     * @Route("/contactar/{sitio}", name="contactar")
     */
    public function contactarAction(Request $request, $sitio = "todos") {   //$sitio="todos", es una función de php, el valor "todos"
// replace this example code with whatever you need
        return $this->render('frontal/bares.html.twig', array("sitio" => $sitio));    //array asociativo para pasar parámetros para la vista por twig
    }

    /**
     * @Route("/tapa/{id}", name="tapa")
     */
    public function tapaAction(Request $request, $id = null) {   //$sitio="todos", es una función de php, el valor "todos"
        if ($id != null) {
//capturar el repositorio de la tabla Tapa contra la BD
            $tapaRepository = $this->getDoctrine()->getRepository(Tapa::class);
//        $tapas = $tapaRepository->findAll();
            $tapa = $tapaRepository->find($id);
// replace this example code with whatever you need
            return $this->render('frontal/tapa.html.twig', array("tapa" => $tapa));    //array asociativo para pasar parámetros para la vista por twig
        } else {
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @Route("/categoria/{id}", name="categoria")
     */
    public function catAction(Request $request, $id = null) {   //$sitio="todos", es una función de php, el valor "todos"
        if ($id != null) {
//capturar el repositorio de la tabla Tapa contra la BD
            $categoriaRepository = $this->getDoctrine()->getRepository(Categoria::class);
//        $tapas = $tapaRepository->findAll();
            $categoria = $categoriaRepository->find($id);
// replace this example code with whatever you need
            return $this->render('frontal/categoria.html.twig', array("categoria" => $categoria));    //array asociativo para pasar parámetros para la vista por twig
        } else {
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @Route("/ingrediente/{id}", name="ingrediente")
     */
    public function ingredienteAction(Request $request, $id = null) {   //$sitio="todos", es una función de php, el valor "todos"
        if ($id != null) {
//capturar el repositorio de la tabla Tapa contra la BD
            $ingredienteRepository = $this->getDoctrine()->getRepository(Ingrediente::class);
//        $tapas = $tapaRepository->findAll();
            $ingrediente = $ingredienteRepository->find($id);
// replace this example code with whatever you need
            return $this->render('frontal/ingrediente.html.twig', array("ingrediente" => $ingrediente));    //array asociativo para pasar parámetros para la vista por twig
        } else {
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @Route("/registro/", name="registro")
     */
    public function registroAction(Request $request, UserPasswordEncoderInterface $passwordEncoder) {

//        if(!is_null($request)){
//            $datos = $request->request->all();
//            //var_dump($datos);
//        }
// creates a task and gives it some dummy data for this example
        $usuario = new Usuario();

//$formBuilder = $this->createFormBuilder($tapa);      //$formBuilder, es para crear el formbuilder a partir del objeto tapa que hemos generado en la línea 21-22, que es la instancia del objeto Tapa.php. $formBuilder es el constructor
//Construyendo el formulario
//$form = $formBuilder->getForm();        //recogemos el formulario
        $form = $this->createForm(UsuarioType::class, $usuario);
//Recogemos la información
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
// Rellenar el Entity Tapa
// 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($usuario, $usuario->getPlainPassword());
            $usuario->setPassword($password);

// 3b) $username = $email

            $usuario->setUsername($usuario->getEmail());
            
// 3c) $roles

            $usuario->setRoles(array('ROLE_USER'));

// 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usuario);
            $entityManager->flush();

            return $this->redirectToRoute('login');

//return $this->render('test/test.html.twig');
//            return $this->redirectToRoute('tapa', array('id' => $tapa->getId()));
// ... perform some action, such as saving the task to the database
// for example, if Task is a Doctrine entity, save it!
// $entityManager = $this->getDoctrine()->getManager();
// $entityManager->persist($task);
// $entityManager->flush();
        }

        return $this->render('frontal/registro.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/login/", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authenticationUtils) {   //esta clase AuthenticationUtils $authenticationUtils dentro de los parámetros las copié desde: https://symfony.com/doc/3.4/security/form_login_setup.html, que también podemos ver con más detalle su funcionalidad visitando api.symfony.com/3.1/index.html, que están relacionada con el form_login:, del apartado main del archivo secutiry.yml
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

//    return $this->render('security/login.html.twig', [
//        'last_username' => $lastUsername,
//        'error'         => $error,
//    ]);


        return $this->render('frontal/login.html.twig', [
                    'last_username' => $lastUsername,
                    'error' => $error,
        ]);
    }

}
