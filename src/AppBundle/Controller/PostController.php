<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 12/09/2017
 * Time: 19:32
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{

    /**
     * @Route("/posts", name="posts")
     */
    public function postsAction()
    {
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/posts/{id}", name="post_detail")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postAction($id)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
        if (!$post) {
            throw $this->createNotFoundException("Ce post n'existe pas");
        }
        return $this->render('default/post.html.twig', [
           'post' => $post,
        ]);
    }

}