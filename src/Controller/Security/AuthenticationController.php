<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\Type\Security\Authentication\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthenticationController extends AbstractController
{
    #[Route('/login', name: 'app_security_authentication_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->isGranted(User::ROLE_USER)) {
            return $this->redirectToRoute('app_home_index');
        }

        $form = $this->createForm(LoginType::class);

        $form->get('_username')->setData($authenticationUtils->getLastUsername());

        return $this->render('Page/Security/Authentication/login.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/logout', name: 'app_security_authentication_logout')]
    public function logout(): void
    {
        throw new \RuntimeException('Should never be called');
    }
}
