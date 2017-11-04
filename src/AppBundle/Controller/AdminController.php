<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 22/08/2017
 * Time: 22:06
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{

    /**
     * @Route("/posts/new", name="admin_new_post")
     * @Security("has_role('ROLE_ADMIN')")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newPostAction(Request $request)
    {
        $post = new Post();
        $post->setDate(new \DateTime());

        $form = $this->createFormBuilder($post)
            ->add('title', TextType::class)
            ->add('content', TextareaType::class)
            ->add('add', SubmitType::class, ['label' => 'Add'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }

        $series = scandir('./series');
        $movies = scandir('./movies');
        $series = array_slice($series, 2);
        $movies = array_slice($movies, 2);
        return $this->render(':admin:new-post.html.twig', [
            'form' => $form->createView(),
            'movies' => $movies,
            'series' => $series,
        ]);
    }
}