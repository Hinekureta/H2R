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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\Response
     * @internal param $id
     */
    public function postAction(Post $post)
    {
        return $this->render('default/post.html.twig', [
           'post' => $post,
        ]);
    }

    /**
     * @Route("/posts/{id}/delete", name="delete-post")
     * @Security("has_role('ROLE_ADMIN')")
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @internal param $id
     */
    public function deletePostAction(Post $post)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/posts/{id}/edit", name="edit-post")
     * @Security("has_role('ROLE_ADMIN')")
     * @param Request $request
     * @param Post $post
     * @return JsonResponse
     * @internal param $id
     */
    public function editPostAction(Request $request, Post $post)
    {
        $postContent = $request->request->get('content');
        $post->setContent($postContent);

        $manager = $this->getDoctrine()->getManager();
        $manager->flush();
        return new JsonResponse(['post' => $post]);
    }

}