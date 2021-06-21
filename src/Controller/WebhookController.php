<?php

namespace App\Controller;

use App\Entity\Hook;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class WebhookController extends AbstractController {

    /**
     * Server Request
     * @var type obj
     */
    private $request = NULL;

    /**
     * Entity Manager
     * @var type obj
     */
    private $manager = NULL;

    /**
     * Entity Hook
     * @var type obj
     */
    private $hook = NULL;

    /**
     * Simple secret keys
     * @var type array
     */
    private $keys = array(
        "8ibow3vndfas9tv4wtubeot8znacwur3w94bt8w912",
        "8ibow3vndfas9tv4wtubeot8znacwur3w94bt8w91",
        "8ibow3vndfas9tv4wtubeot8znacwur3w94bt8w9",
    );

    public function __construct(EntityManagerInterface $manager) {
        $this->manager = $manager;
    }

    /**
     * @Route("/v3/api", name="webhook")
     */
    public function index(Request $request = NULL): Response {

        $this->request = $request;

        // Header for JSON and Access
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header('Content-Type: application/json');

        /**
         * incoming example send from other
         * the array can be expanded, all data is stored in the database in a field as a string
         * 
         * CURL POST
         * json_encode(
         *      array(
         *          "secret" => "8ibow3vndfas9tv4wtubeot8znacwur3w94bt8w912",
         *          "website" => "Lappy",
         *          "lastaction" => "user-login",
         *          "registered" => 100,
         *          "visitors" => 33350,
         *          "sendtime" => time(),
         *      )
         * )
         * 
         */
        // Check request method
        if ($this->request->getMethod() == 'POST') {
            // Check simple secret
//            if (isset($data["secret"]) && in_array($data["secret"], $this->keys)) {
            // Check if content
            $content = $this->request->getContent();
            // Check if exists
            if ($content) {
                // Get request content decoded
                $data = json_decode($content, true);
                // Next step check data
                // Find by secret
                $this->hook = $this->manager->getRepository(Hook::class)->findBySecret($data["secret"]);
                // Exists ?
                if (!$this->hook) {
                    $this->hook = new Hook();
                    // Insert
                    $this->hook->setSecret($data["secret"]);
                    $this->hook->setData($content);
                    $this->hook->setCreated(time());
                    $this->manager->persist($this->hook);
                } else {
                    // Update
                    $this->hook->setData($content);
                    $this->manager->persist($this->hook);
                }
                // Save
                $this->manager->flush();
            }
//            }
        } elseif ($this->request->getMethod() == 'GET') {
            //..
        }

        return $this->json(array(
                    'return' => array(
                        "status" => "200"
                    )
        ));

//        return $this->render('webhook/index.html.twig', [
//                    'controller_name' => 'WebhookController',
//                    'data' => "{id: test}",
//        ]);
    }

}
