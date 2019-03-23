<?php

namespace App\Controller;

use App\RestClient\RewardGatewayAPIClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private $rgClient;

    public function __construct(RewardGatewayAPIClient $rgClient)
    {
        $this->rgClient = $rgClient;
    }
    /**
     * @Route("/user", methods={"GET"})
     */
    public function listAction()
    {
        $result = $this->rgClient->fetchUsers();
        return $this->render('user/index.html.twig', ['result' => $result]);
    }


}
