<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfilType;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\{ObjectManager};
use PhpParser\Error;
use PHPUnit\Runner\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class ProfilController extends AbstractController {

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * IndexController constructor.
     * @param UserRepository $userRepository
     * @param ObjectManager $em
     */
    public function __construct(UserRepository $userRepository, ObjectManager $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }
    /**
     * @Route("/profil", name="index_profil")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */
    public function profil(Request $request)
    {
        $profil = $this->getUser();
        $form = $this->createForm(ProfilType::class, $profil);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $now = new \DateTime('now');
            $diff = $profil->getDateDeNaissance()->diff($now)->y;
            $profil->setAge($diff);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profil);
            $this->em->flush();
        }

        return $this->render('form/profil.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/my-profile", name="profilView")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */
    public function profilView(Request $request)
    {
        return $this->render('user.html.twig');
    }
}

