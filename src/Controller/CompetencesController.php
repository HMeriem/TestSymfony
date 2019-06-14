<?php
/**
 * Created by PhpStorm.
 * User: MHAM
 * Date: 21/02/2019
 * Time: 14:37
 */
namespace App\Controller;
use App\Entity\Categorie;
use App\Entity\Competences;
use App\Form\CompetencesType;
use App\Entity\User;
use App\Repository\CompetencesRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use function Sodium\add;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



class CompetencesController extends AbstractController
{
    /**
     * @var CompetencesRepository
     */
    private $competencesRepository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(CompetencesRepository $competencesRepository, ObjectManager $em)
    {
        $this->competencesRepository = $competencesRepository;
        $this->em = $em;
    }

    /**
     * @Route("/competence/{id}", defaults={"id"=null}, name="competences")
     * @param Request $request
     * @param Competences $competence
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */

    public function competences (Request $request, Competences $competence = null)
    {
        $competences = $competence ?? new Competences();
        $now = new \DateTime();
        $user = $this->getUser();
        $form = $this->createForm(CompetencesType::class, $competences);
        $form->handleRequest($request);
        if($competences->getLastCreated() != null){

        }

        if ($form->isSubmitted() && $form->isValid()){
            $competences = $form->getData();
            $competences->setUser($user);
          //  $categorie = $entityManager->getRepository(Categorie::class)->findAll();
           // $competences->setCategorie($categorie);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($competences->setLastCreated($now));
            $this->em->flush();

            if ($request->isXmlHttpRequest())
            {
                return new JsonResponse(false);
            }
        }

        return $this->render('form/competences.html.twig',[
            'formCompetences' => $form->createView()
        ]);
    }
    /**
     * @Route("/my-competence", name="competenceView")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */
    public function competenceView(Request $request)
    {
        $user = $this->getUser();
        $competence = $this->competencesRepository->findBy(['User'=> $user]);
        return $this->render('competenceView.html.twig', [
            'competence'  => $competence
        ]);
    }

    /**
     * @Route("/competence/delete/{id}", defaults={"id"=null}, name="competence_delete")
     * @param Request $request
     * @param Competences|null $competenceA
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */

    public function formationDelete(Request $request,  Competences $competenceA = null)
    {
        $user = $this->getUser();
        $competence = $competenceA;
        $competence->setUser($user);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($competenceA);
        $entityManager->flush();
        $competence = $this->competencesRepository->findBy(['User'=> $user]);
        return $this->render('competenceView.html.twig', [
            'competence'  => $competence
        ]);
    }

    /**
     * @Route("/test", name="test")
     */
    public function test(Request $request)
    {
        return new JsonResponse(rand(0, 2) > 1?true: false);
    }

}
