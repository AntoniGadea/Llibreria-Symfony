<?php
namespace App\Controller;

use App\Entity\Usuari;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class UsuariController extends AbstractController{

/**
 * @Route("/usuari", name="usuari")
 */
public function users(){
    $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Accés restringit a administradors');
    $repositori = $this->getDoctrine()->getRepository(Usuari::class);
    $usuaris = $repositori->findAll();
    return $this->render('usuari.html.twig', array('usuaris' => $usuaris));
}

/**
 * @Route("/usuari/eliminar/{id}", name="eliminar_usuari")
 */

public function eliminar($id){
    $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Accés restringit a administradors');
    $repositori = $this->getDoctrine()->getRepository(Usuari::class);
    $entityManager = $this->getDoctrine()->getManager();
    $usuari = $repositori->find($id);
    $entityManager->remove($usuari);
    $entityManager->flush();

    return $this->redirect('/usuari');
}

 /**
 * @Route("/usuari/editar/{id<\d+>}", name="editar_usuari")
 */
public function editar(Request $request, $id){
    $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Accés restringit a administradors');
    $repositori = $this->getDoctrine()->getRepository(Usuari::class);
    $usuari = $repositori->find($id);

    $formulari = $this->createFormBuilder($usuari)
            ->add('login', TextType::class)
            ->add('password', TextType::class)
            ->add('email', TextType::class)
            ->add('rol', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Enviar'))
            ->getForm();
            $formulari->handleRequest($request);
            if($formulari->isSubmitted() && $formulari->isValid()){
                $usuari = $formulari->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($usuari);
                $entityManager->flush();
                return $this->redirectToRoute('usuari');
            }
            return $this->render('formusuari.html.twig',array('formulari' => $formulari->createView()));
     }

/**
 * @Route("/usuari/nou", name="nou_usuari")
 */
public function nou(Request $request, UserPasswordEncoderInterface $passwordEncoder){
    $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Accés restringit a administradors');
    $entityManager = $this->getDoctrine()->getManager();
    $usuari = new Usuari();

    $formulari = $this->createFormBuilder($usuari)
            ->add('login', TextType::class)
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
            ->add('email', TextType::class)
            ->add('rol', HiddenType::class,['required' => false, 'empty_data' => 'ROLE_USER'] )
            ->add('save', SubmitType::class, array('label' => 'Enviar'))
            ->getForm();
            $formulari->handleRequest($request);
            if($formulari->isSubmitted() && $formulari->isValid()){
                $usuari = $formulari->getData();
                $entityManager = $this->getDoctrine()->getManager();

                $password = $passwordEncoder->encodePassword($usuari, $usuari->getPassword());
                $usuari->setPassword($password);

                $entityManager->persist($usuari);
                $entityManager->flush();
                return $this->redirectToRoute('usuari');
            }
            return $this->render('formusuari.html.twig',array('formulari' => $formulari->createView()));
     }

}



?>