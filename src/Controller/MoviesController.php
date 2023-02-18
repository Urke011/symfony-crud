<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MoviesController extends AbstractController
{
    /*
    #[Route('/movies/{name}', name: 'app_movies', defaults:['name'=> null], methods:['GET','HEAD'])]
    public function index($name): JsonResponse
    {
        return $this->json([
            'message' => $name,
            'path' => 'src/Controller/MoviesController.php',
        ]);
    }
    */
    #[Route('/movies', name: 'app_movies')]
    public function index(): Response
    {
         $movies =['uros', 'sara','sonja', 'ljuba','deja','milos'];
         /*
       return $this->render('index.html.twig',[
        'title'=> 'avangers: end game'
       ]);
       */
      return $this->render('index.html.twig',array(
        'movies' => $movies
      ));
    }
}