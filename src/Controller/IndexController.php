<?php
namespace App\Controller;


use App\Entity\User;
use App\Form\ProfilType;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Created by PhpStorm.
 * User: MHAM
 * Date: 18/02/2019
 * Time: 16:25
 */

class IndexController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
//        if (User::class != null){
//            return $this->render("security/login.html.twig");
//        }
        return $this->render("index/index.html.twig");
    }

}