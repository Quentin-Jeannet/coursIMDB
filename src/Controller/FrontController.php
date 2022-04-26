<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use App\Repository\ArtisteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/front")
 */
class FrontController extends AbstractController
{
    /**
     * @Route("/home/{nom}", name="app_front")
     */
    public function index($nom): Response
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => $nom,
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(ArtisteRepository $artisteRepository, MovieRepository $movieRepository): Response
    {
        // on recherche les 5 derniers artistes entré dans la bdd
        $artistes = $artisteRepository->findLastFive();
        $movies = $movieRepository->findLastFive();

        return $this->render('front/home.html.twig', [
            'artistes' => $artistes,
            'movies' => $movies
        ]);
    }

    /**
     * @Route("movies", name="front_movies")
     */
    public function frontMovies(MovieRepository $movieRepository, PaginatorInterface $paginator, Request $request)
    {
        $movies = $movieRepository->findAll();

        $pagination = $paginator->paginate(
            $movies,
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('front/movies.html.twig', [
            'pagination' => $pagination
        ]);
    }
}
