<?php

namespace App\Controller;

use App\Entity\CatalogAuto;
use App\Entity\Comment;
use App\Form\AddAutoFormType;
use App\Form\CommentFormType;
use App\Form\LoginFormType;
use App\Form\RegisterFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ClientController extends AbstractController
{
    /**
    * @Route("/", name="main")
    */
    public function index() 
    {
        return $this->render('client/index.html.twig');
    }

    // Путь для запроса каталога на сайте
    /**
    * @Route("/catalog", name="catalog")
    */
    public function catalog(EntityManagerInterface $entityManager) 
    {
        $allAuto = $entityManager->getRepository(CatalogAuto::class)->findBy(['isDeleted' => false], ['id' => 'DESC']);

        return $this->render('client/catalog.html.twig', [
            'autos' => $allAuto
        ]);
    }

    /**
    * @Route("/catalog/{catalogAuto}", name="catalogAuto")
    */
    public function catalogAuto(CatalogAuto $catalogAuto, Request $request, EntityManagerInterface $entityManager) 
    {
        $commentForm = $this->createForm(CommentFormType::class);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $comment = $commentForm->getData();

            $comment->setPage($catalogAuto);
            $comment->setIsDeleted(false);
            $comment->setUser($this->getUser());

            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('catalogAuto', ['catalogAuto' => $catalogAuto->getId()]);
        }

        
        return $this->render('client/auto.html.twig', [
            'auto' => $catalogAuto,
            'btntext' => 'Добавить комментарий',
            'commentForm' =>  $commentForm->createView()
        ]);
    }

    /**
    *  
    * @Route("/catalog/{catalogAuto}/commentedit/{comment}", name="commentEdit")
    * @IsGranted("ROLE_USER");
    */
    public function CommentEdit(CatalogAuto $catalogAuto, Comment $comment, Request $request, EntityManagerInterface $entityManager) 
    {
        // Могу редактировать только свой комментарий
        if($comment->getUser() != $this->getUser()) {
            return $this->redirectToRoute('catalogAuto', ['catalogAuto' => $catalogAuto->getId()]);  
        }

        $commentForm = $this->createForm(CommentFormType::class, $comment);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            
            $entityManager->flush();

            return $this->redirectToRoute('catalogAuto', ['catalogAuto' => $catalogAuto->getId()]);
        }
        
        return $this->render('client/auto.html.twig', [
            'auto' => $catalogAuto,
            'commentForm' =>  $commentForm->createView()
        ]);
    }

    /**
    *  
    * @Route("/catalog/{catalogAuto}/commentdelete/{comment}", name="commentDelete")
    * @IsGranted("ROLE_USER");
    */
    public function CommentDelete(CatalogAuto $catalogAuto, Comment $comment, EntityManagerInterface $entityManager) 
    {
        // Если это не мой комметарий, и не мое объявление, то я не могу его удалить -> редирект
        if($comment->getUser() != $this->getUser() && $catalogAuto->getUser() != $this->getUser()) {
            return $this->redirectToRoute('catalogAuto', ['catalogAuto' => $catalogAuto->getId()]);
        }

        $comment->setIsDeleted(true);
        $entityManager->flush();

        return $this->redirectToRoute('catalogAuto', ['catalogAuto' => $catalogAuto->getId()]);
    }

    /**
    * @Route("/register", name="userRegister")
    */
    public function userRegister(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder) 
    {
        $registerForm = $this->createForm(RegisterFormType::class);
        $registerForm->handleRequest($request);

        if ($registerForm->isSubmitted() && $registerForm->isValid()) {
            $user = $registerForm->getData();

            $password = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $user->setRoles(['ROLE_USER']);

            $entityManager->persist($user);
            $entityManager->flush();
            
            return $this->redirectToRoute('main');
        }
        

        return $this->render('client/register.html.twig', [
            'registerform' => $registerForm->createView()
        ]);
    }



    /**
     * @Route("/login", name="userLogin")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $loginForm = $this->createForm(LoginFormType::class);

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('client/login.html.twig', [
            'loginform' => $loginForm->createView(),
            'last_username' => $lastUsername, 
            'error' => $error]
        );
    }

    /**
     * @Route("/logout", name="userLogout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }




    /**
     * @Route("/user", name="user")
     * @IsGranted("ROLE_USER");
     */
    public function user()
    {
        $user = $this->getUser();
        return $this->render('client/user.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/user/addauto", name="userAddAuto")
     * @IsGranted("ROLE_USER");
     */
    public function userAddAuto(Request $request, EntityManagerInterface $entityManager)
    {
        $addautoForm = $this->createForm(AddAutoFormType::class);
        $addautoForm->handleRequest($request);

        if ($addautoForm->isSubmitted() && $addautoForm->isValid()) {
            $auto = $addautoForm->getData();

            $auto->setUser($this->getUser());
            //$auto->setIsDeleted(false);

            $entityManager->persist($auto);
            $entityManager->flush();

            $auto = $entityManager->getRepository(CatalogAuto::class)->findOneBy([], ['id' => 'DESC']);

            return $this->redirectToRoute('catalogAuto', ['catalogAuto' => $auto->getId()]);
        }

        return $this->render('client/addauto.html.twig', [
            'user' => $this->getUser(),
            'addautoForm' => $addautoForm->createView()
        ]);
    }

    /**
     * @Route("/user/editauto/{catalogAuto}", name="userEditAuto")
     * @IsGranted("ROLE_USER");
     */
    public function userEditAuto(CatalogAuto $catalogAuto, Request $request, EntityManagerInterface $entityManager)
    {
        // Могу редактировать только свое объявление
        if($catalogAuto->getUser() != $this->getUser()) {
            return $this->redirectToRoute('catalogAuto', ['catalogAuto' => $catalogAuto->getId()]);  
        }

        $addautoForm = $this->createForm(AddAutoFormType::class, $catalogAuto);
        $addautoForm->handleRequest($request);

        if ($addautoForm->isSubmitted() && $addautoForm->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('catalogAuto', ['catalogAuto' => $catalogAuto->getId()]);
        }

        return $this->render('client/addauto.html.twig', [
            'user' => $this->getUser(),
            'addautoForm' => $addautoForm->createView()
        ]);
    }

    /**
     * @Route("/user/deleteauto/{catalogAuto}", name="userDeleteAuto")
     * @IsGranted("ROLE_USER");
     */
    public function userDeleteAuto(CatalogAuto $catalogAuto, EntityManagerInterface $entityManager)
    {
        // Могу удалить только свое объявление
        if($catalogAuto->getUser() != $this->getUser()) {
            return $this->redirectToRoute('catalogAuto', ['catalogAuto' => $catalogAuto->getId()]);  
        }

        $catalogAuto->setIsDeleted(true);
        $entityManager->flush();

        return $this->redirectToRoute('catalog');
    }
}
