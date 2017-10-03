<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();
        return $this->render('default/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        return $this->render('default/about.html.twig');
    }

    /**
     * @Route("/author", name="author")
     */
    public function authorAction()
    {
        return $this->render(':default:author.html.twig');
    }
}
