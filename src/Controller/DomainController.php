<?php

namespace App\Controller;

use App\Entity\Domain;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DomainController extends AbstractController
{

    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/domain-manager", name="domain_manager")
     */
    public function index()
    {

        $domains = $this->entityManager->getRepository(Domain::class)->findAll();

        return $this->render('domain/index.html.twig', [
            'domains' => $domains,
        ]);
    }
}
