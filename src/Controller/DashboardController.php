<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index()
    {
        $user = $this->getUser();
        return $this->render('dashboard/index.html.twig', [
            'name' => $user->getFirstName() . ' ' . $user->getLastName(),
            'selected_menu' => 'dashboard'
        ]);
    }
}
