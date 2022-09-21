<?php

namespace App\Controller;

use App\Service\YamlDataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private $yamlDataService;
    
    public function __construct(YamlDataService $yamlDataService)
    {
        $this->yamlDataService = $yamlDataService;
    }

    /**
     * @Route("/", name="d_list")
     */
    public function list(): Response
    {
        return $this->render('index.html.twig', $this->yamlDataService->getData());
    }
}