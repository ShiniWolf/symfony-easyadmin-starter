<?php

namespace AuthenticationBundle\Controller;

use AuthenticationBundle\Entity\User;
use AuthenticationBundle\Form\UserLoginType;
use AuthenticationBundle\Form\UserRegisterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        throw new \Exception('this should not be reached!');
    }

    /**
     * @Route("/login", name="login")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request)
    {
        $authentication_utils = $this->get('security.authentication_utils');

        $error = $authentication_utils->getLastAuthenticationError();

        $lastUsername = $authentication_utils->getLastUsername();

        $form = $this->createForm(UserLoginType::class, [
            '_username' => $lastUsername,
        ]);

        return $this->render(
            '@Authentication/security/login.twig',
            [
                'loginError' => $error,
                'loginForm' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/register", name="register")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $registerForm = $this->createForm(UserRegisterType::class, $user);
        $registerForm->handleRequest($request);
        if ($registerForm->isSubmitted() && $registerForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            '@Authentication/security/register.html.twig',
            [
                'registerForm' => $registerForm->createView(),
                'loginForm' => $this->createForm(UserLoginType::class)->createView(),
            ]
        );
    }

//    /**
//     * @Route("/activation-compte/{token}", name="account_activation")
//     * @ParamConverter("user", class="AuthenticationBundle:User", options={"mapping": {"token"="token"}})
//     *
//     * @param \Symfony\Component\HttpFoundation\Request $request
//     * @param User $user
//     *
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
//     */
//    public function accountActivationAction(Request $request, User $user)
//    {
//        if ($user->getActive() === 0) {
//            $user->setActive(1);
//
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($user);
//            $entityManager->flush();
//
//            $this->addFlash('success', 'Votre compte a bien été activé, vous pouvez maintenant vous connecter.');
//        } else {
//            $this->addFlash('danger', 'Ce compte ne peut pas être activé.');
//        }
//
//        return $this->redirectToRoute('homepage');
//    }
//
//    /**
//     * @Route("/password-recovery", name="password_recovery")
//     *
//     * @param \Symfony\Component\HttpFoundation\Request $request
//     *
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
//     */
//    public function passwordRecoveryAction(Request $request)
//    {
//        $form = $this->createForm(UserPasswordRecoveryType::class, []);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $email = $form->getData()['email'];
//            $entityManager = $this->getDoctrine()->getManager();
//            if ($user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email])) {
//                $this->addFlash('success', 'Un mail de réinitialisation du mot de passe vous a été envoyé à l\'adresse mail : ' . $user->getEmail());
//            } else {
//                $this->addFlash('danger', 'Aucun compte n\'a été trouvé avec cette adresse mail');
//            }
//
//            return $this->redirectToRoute('password_recovery');
//        }
//
//        return $this->render(
//            '@Authentication/security/password_recovery.html.twig',
//            [
//                'form' => $form->createView(),
//            ]
//        );
//    }
//
//    /**
//     * @Route("/password-recovery/{token}", name="password_reset")
//     * @ParamConverter("user", class="AuthenticationBundle:User", options={"mapping": {"token"="token"}})
//     *
//     * @param \Symfony\Component\HttpFoundation\Request $request
//     * @param User $user
//     *
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
//     */
//    public function passwordResetAction(Request $request, User $user)
//    {
//        $form = $this->createForm(UserPasswordResetType::class, $user);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($user);
//            $entityManager->flush();
//
//            $this->addFlash('success', 'Votre mot de passe a bien été modifié');
//
//            return $this->redirectToRoute('homepage');
//        }
//
//        return $this->render(
//            '@Authentication/security/password_reset.html.twig',
//            [
//                'form' => $form->createView(),
//                'user' => $user,
//            ]
//        );
//    }

}
