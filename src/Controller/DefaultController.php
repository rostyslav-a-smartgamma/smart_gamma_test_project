<?php

namespace App\Controller;

use App\Form\Type\OrganizationType;
use App\Service\YamlDataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private $yamlDataService;
    
    public function __construct(YamlDataService $yamlDataService)
    {
        $this->yamlDataService = $yamlDataService;
    }

    /**
     * @Route("/", name="org_list")
     */
    public function list(Request $request): Response
    {
        return $this->render('index.html.twig', $this->yamlDataService->readData());
    }

    /**
     * @Route("/new", name="org_new")
     */
    public function new(Request $request): Response
    {
        $form = $this->createForm(OrganizationType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->yamlDataService->createOrg($data);

            return $this->redirectToRoute('org_list');
        }

        return $this->render('form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{index}", name="org_edit")
     */
    public function edit(Request $request, $index): Response
    {
        $form = $this->createForm(OrganizationType::class, $this->yamlDataService->getOrgByIndex($index));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->yamlDataService->updateOrgByIndex($index, $data);

            return $this->redirectToRoute('org_list');
        }

        return $this->render('form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{index}", name="org_delete")
     */
    public function delete(Request $request, $index): Response
    {
        $this->yamlDataService->deleteOrgByIndex($index);
    
        return $this->redirectToRoute('org_list');
    }
}