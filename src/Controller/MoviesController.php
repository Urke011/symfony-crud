<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;

class MoviesController extends AbstractController
{

  private $em;
  private  $movieRepository;
  public function __construct(MovieRepository $movieRepository, EntityManagerInterface $em){

    $this->movieRepository = $movieRepository;
    $this->em = $em;
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
  
    #[Route('/movies', methods: ['GET'], name: 'app_movies')]
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
    

    #[Route('/movies/create', name: 'create_movie')]
    public function create(Request $request): Response{
      $movie = new Movie();
      $form =  $this->createForm(MovieFormType::class,$movie);

      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
          $newMovie = $form->getData();
          $imagePath = $form->get('imagePath')->getData();
          if($imagePath){
            $newFileName = uniqid().'.'.$imagePath->guessExtension();

            try {
              $imagePath->move(
                $this->getParameter('kernel.project_dir').'/public/uploads',$newFileName
              );
            }catch(FileException $e){
                  return new Response($e->getMessage());
            }
            $newMovie->setImagePath('/uploads/'.$newFileName);
          }
          $this->em->persist($newMovie);
          $this->em->flush();
        return $this->redirectToRoute('movies');
      }

      return $this->render('movies/create.html.twig',[
        'form' => $form->createView()
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
