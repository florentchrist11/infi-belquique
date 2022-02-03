<?php 
namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/login")
 * @package App\Controller\Security
 * @author Yves EKANGA <yves.ekanga27@gmail.com>
 */
class SecurityController extends AbstractController {

    /**
     * @Route("/", name="app_login")
     */
    public function index(): Response
    {
        return $this->render('admins/security/login.html.twig');
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}