// src/AppBundle/Controller/RegistrationController.php
namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use AppBundle\Entity\Usuarios;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller
{
    /**
     * @Route("/registro", name="formderegistro")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $Usuario = new Usuario();
        $form = $this->createForm(UserType::class, $Usuario);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($Usuario, $Usuario->getPlainPassword());
            $Usuario->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Usuario);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('replace_with_some_route');
        }

        return $this->render(
            'registro.html.twig',
            ['form' => $form->createView()]
        );
    }
}