<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MoviesController extends AbstractController
{

  private  $movieRepository;
  public function __construct(MovieRepository $movieRepository){

    $this->movieRepository = $movieRepository;
  }
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
  
    #[Route('/movies', name: 'movies')]
    public function index(): Response
    {
      //drugi metod (EntityManagerRepository $em)
      //sa konstruktorm na vrhu controlora(asp.net ist prinicp)
      
      //$movies =['uros', 'sara','sonja', 'ljuba','deja','milos'];
         /*
       return $this->render('index.html.twig',[
        'title'=> 'avangers: end game'
       ]);
       
      return $this->render('index.html.twig',array(
        'movies' => $movies
      ));
      */

      //find()
      //findAll()
      //findBy()
      //$movies = $movieRepository->findAll();
        //dd($movies);

        $movies = $this->movieRepository->findAll();
        //dd($movies);
      return $this->render('movies/index.html.twig',[
        'movies'=> $movies
      ]);

    }

    #[Route('/movies/{id}', methods: ['GET'], name: 'movies')]
    public function show($id): Response
    {
      $movie = $this->movieRepository->find($id);
      
      return $this->render('movies/show.html.twig',[
        'movie'=> $movie
      ]);

    }
}
