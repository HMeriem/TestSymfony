<?php
/**
 * Created by PhpStorm.
 * User: MHAM
 * Date: 21/02/2019
 * Time: 14:37
 */
namespace App\Controller;

use App\Entity\ExperiencePro;
use App\Form\ExperienceProType;
use App\Repository\CompetenceProRepository;
use App\Repository\ExperienceProRepository;
use App\Repository\TechnoProRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



class ExperienceProController extends AbstractController
{
    /**
     * @var ExperienceProRepository
     */
    private $experienceProRepository;
    private $competenceProRepository;
    private $technoProRepository;
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * ExperienceProController constructor.
     * @param ExperienceProRepository $experienceProRepository
     * @param ObjectManager $em
     * @param TechnoProRepository $technoProRepository
     * @param CompetenceProRepository $competenceProRepository
     */
    public function __construct(ExperienceProRepository $experienceProRepository, ObjectManager $em, TechnoProRepository $technoProRepository, CompetenceProRepository $competenceProRepository)
    {
        $this->competenceProRepository = $competenceProRepository;
        $this->technoProRepository = $technoProRepository;
        $this->experienceProRepository = $experienceProRepository;

        $this->em = $em;
    }

    /**
     * @Route("/experiencePro/{id}", defaults={"id"=null}, name="experiencePro")
     * @param Request $request
     * @param ExperiencePro $experienceP
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */

    public function experiencePro (Request $request, ExperiencePro $experienceP = null)
    {

        $experiencePro = $experienceP ?? new ExperiencePro();
        $form = $this->createForm(ExperienceProType::class, $experiencePro);
        $form->handleRequest($request);
        $user = $this->getUser();
        $now = new \DateTime();

        if ($form->isSubmitted() && $form->isValid()){
            $experiencePro = $form->getData();
            $present = $form->getData()->getPresent();
            $fin = $present ? new \DateTime(): $experiencePro->getDateFin();
            $debut = $experiencePro->getDateDebut();
            $diffA = $fin->diff($debut)->y;
            $diffM = $fin->diff($debut)->m;
            $experiencePro->setAnnee($diffA);
            $experiencePro->setMois($diffM);
            $experiencePro->setDuree($debut->format('Y'));
            $experiencePro->setDureeFin($present ? null: $fin->format('Y'));
            if($present) {
                $experiencePro->setDateFin(new \DateTime( 29900101 ));
            }

            $experiencePro->setUser($user);
            $this->em->persist($experiencePro->setLastCreated($now));
            $this->em->flush();
        }

        return $this->render('form/experiencePro.html.twig',[
            'formo' => $form->createView()
        ]);
    }
    /**
     * @Route("/my-experience", name="experienceProView")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */
    public function experienceProView(Request $request)
    {
        $technoPro = $this->technoProRepository->findAll();
        $competencePro = $this->competenceProRepository->findAll();
        $user = $this->getUser();
        $experiencePro = $this->experienceProRepository->findBy(['user'=> $user]);
        return $this->render('experienceProView.html.twig', [
            'experience'  => $experiencePro,
            'technoPros' => $technoPro,
            'competencePros' => $competencePro
        ]);
    }

    /**
     * @Route("/experiencesPro/delete/{id}", defaults={"id"=null}, name="experiencePro_delete")
     * @param Request $request
     * @param ExperiencePro|null $experienceProA
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */

    public function experienceProDelete(Request $request,  ExperiencePro $experienceProA = null)
    {
        $user = $this->getUser();
        $experience = $experienceProA;
        $experience->setUser($user);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($experience);
        $entityManager->flush();
        return $this->redirectToRoute('experienceProView');
    }

}
