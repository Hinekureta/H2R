<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 26/10/2017
 * Time: 22:01
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoinsController extends Controller
{
    /**
     * @Route("/coins", name="admin_coins")
     */
    public function indexAction()
    {
        return $this->render('admin/coins.html.twig');
    }

}