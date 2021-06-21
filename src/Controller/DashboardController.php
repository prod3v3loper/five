<?php

namespace App\Controller;

use App\Repository\HookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController {

    /**
     * Hook Repo
     * @var type obj
     */
    private $hookrep = NULL;

    /**
     * 
     * @param HookRepository $hookrep
     */
    public function __construct(HookRepository $hookrep) {
        $this->hookrep = $hookrep;
    }

    /**
     * @Route("/dashboard", name="dashboard")
     * @return Response
     */
    public function index(): Response {
        
        // Check if user loggedin
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // Next steps check role etc.

        // Get all hooks
        $rep = $this->hookrep->findAll();

        // Prepare for output
        $arr = array();
        foreach ($rep as $hooks) {
            $arr[] = json_decode($hooks->getData(), true);
        }

//        echo '<pre>';
//        var_dump($arr);
//        echo '</pre>';
        // Get user data
        $user = $this->getUser();

        return $this->render('dashboard/index.html.twig', [
                    'controller_name' => 'DashboardController',
                    'user_name' => $user->getUsername(),
                    'data' => $arr,
        ]);
    }

}
