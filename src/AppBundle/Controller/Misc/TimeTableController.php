<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 04/11/2017
 * Time: 17:59
 */

namespace AppBundle\Controller\Misc;


use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class TimeTableController extends Controller
{
    /**
     * @Route("/user/{id}/timetable", name="user_timetable")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $isUser = $user instanceof User;

        $targetUser = $this->getDoctrine()->getRepository(User::class)->find($id);
        $targetUserExists = $targetUser instanceof User;
        if (!$isUser || !$targetUserExists || ($user->getId() != $id && !$user->isAdmin())) {
            throw new AccessDeniedException("This is not the droid you looking for.");
        }
        return $this->render('base.html.twig');
    }
}