<?php
namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\EventoType;
use AppBundle\Entity\Evento;

class EventoController extends Controller
{
        /**
     * @Route("/evento/", name="mostrar")
     */
    public function MostrarAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Evento::class);
        $Evento = $repository->findAll();
        return $this->render('evento.html.twig', array('Evento' => $Evento));
    }
        /**
     * @Route("/formulario/", name="formulario")
     */
    public function NuevoEventoAction(Request $request){
        $Evento = new Evento();
        $form = $this->createForm(EventoType::class, $Evento);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $Evento = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Evento);
            $entityManager = $entityManager->flush();
    }
    return $this->render('forminsertevent.html.twig', array("form" => $form->createView()));
}
  /**
     * @Route("/login", name="login")
     */
    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
}