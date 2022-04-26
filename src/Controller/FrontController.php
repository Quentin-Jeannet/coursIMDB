<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Search;
use App\Form\SearchType;
use App\Repository\MovieRepository;
use App\Repository\ArtisteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     * @Route("/movies", name="front_movies")
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

    /**
     * @Route("/artistes", name="front_artistes")
     */
    public function frontArtistes(ArtisteRepository $artisteRepository, PaginatorInterface $paginator, Request $request)
    {
        $artistes = $artisteRepository->findAll();
        $pagination = $paginator->paginate(
            $artistes,
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('front/artistes.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/movie/{id}" , name="front_movie")
     */
    public function frontMovie(Movie $movie)
    {
        return $this->render('front/movie.html.twig', [
            'movie' => $movie
        ]);
    }

    /**
     * @Route("/artiste/{id}", name="front_artiste")
     */
    public function frontArtiste($id, ArtisteRepository $artisteRepository)
    {
        $artiste = $artisteRepository->findOneById($id);
        
        return $this->render('front/artiste.html.twig', [
            'artiste' => $artiste
        ]);

    }

    public function searchBar()
    {
        $search = new Search;
        $form = $this->createForm(SearchType::class, $search, [
            'action' => $this->generateUrl('front_search')
        ]);

        return $this->renderForm('front/searchbar.html.twig', [
            'form' => $form
        ]);
    }

    /**
     * @Route("/search" , name="front_search")
     */
    public function search(Request $request, ArtisteRepository $artisteRepository, MovieRepository $movieRepository)
    {
        $search = $request->query->get('search')['search'];
        $movies = [];
        $artistes = [];
        if($search != null)
        {
            $artistes = $artisteRepository->search($search);
            $movies = $movieRepository->search($search);
        }

        return $this->render('front/search.html.twig', [
            'artistes' => $artistes,
            'movies' => $movies
        ]);
    }
}
