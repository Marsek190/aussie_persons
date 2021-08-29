<?php

namespace Api\V1\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomersController extends AbstractController
{
    /**
     * @Route("/v1/customers/", name="customers")
     */
    public function customers(): Response
    {
        return new Response(null, 200);
    }
}