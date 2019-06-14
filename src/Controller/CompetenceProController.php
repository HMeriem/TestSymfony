<?php
/**
 * Created by PhpStorm.
 * User: MHAM
 * Date: 21/02/2019
 * Time: 14:37
 */
namespace App\Controller;

use App\Entity\CompetencePro;
use App\Form\CompetenceProType;
use App\Repository\CompetenceProRepository;
use App\Repository\ExperienceProRepository;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class CompetenceProController
 * @package App\Controller
 */
class CompetenceProController extends AbstractController
{
    /**
     * @var CompetenceProRepository
     */
    private $competenceProRepository;
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * @param CompetenceProRepository $competenceProRepository
     * @param ObjectManager $em
     */
    public function __construct(CompetenceProRepository $competenceProRepository, ObjectManager $em)
    {
        $this->competenceProRepository = $competenceProRepository;
        $this->em = $em;
    }

    /**
     * @Route("/competencePro/{id}", defaults={"id"=null}, name="competencePro")
     * @param Request $request
     * @param ExperienceProRepository $eps
     * @param CompetencePro $competenceP
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */

    public function competencePro(Request $request, ExperienceProRepository $eps, CompetencePro $competenceP = null)
    {
        $competencePro = $competenceP ?? new CompetencePro();
        $form = $this->createForm(CompetenceProType::class, $competencePro, ['eps'=>$eps]);
        $form->handleRequest($request);
        $now = new DateTime();

        if ($form->isSubmitted() && $form->isValid()) {
            $competencePro = $form->getData();
            $this->em->persist($competencePro->setLastCreated($now));
            $this->em->flush();
        }
        return $this->render('form/competencePro.html.twig',[
            'formCompetencePro' => $form->createView()
        ]);
    }
    /**
     * @Route("/competencePro/delete/{id}", defaults={"id"=null}, name="competencePro_delete")
     * @param Request $request
     * @param CompetencePro|null $competenceProA
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */

    public function competenceProDelete(Request $request,  CompetencePro $competenceProA = null)
    {
        $competencePro = $competenceProA;
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($competencePro);
        $entityManager->flush();
        return $this->redirectToRoute('experienceProView');
    }
}