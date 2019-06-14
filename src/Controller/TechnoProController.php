<?php
/**
 * Created by PhpStorm.
 * User: MHAM
 * Date: 21/02/2019
 * Time: 14:37
 */
namespace App\Controller;

use App\Entity\CompetencePro;
use App\Entity\TechnoPro;
use App\Form\CompetenceProType;
use App\Form\TechnoProType;
use App\Repository\CompetenceProRepository;
use App\Repository\ExperienceProRepository;
use App\Repository\TechnoProRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;



class TechnoProController extends AbstractController
{
    /**
     * @var TechnoProRepository
     */
    private $technoProRepository;
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * @param TechnoProRepository $technoProRepository
     * @param ObjectManager $em
     */
    public function __construct(TechnoProRepository $technoProRepository, ObjectManager $em)
    {
        $this->technoProRepository = $technoProRepository;
        $this->em = $em;
    }

    /**
     * @Route("/technoPro/{id}", defaults={"id"=null}, name="technoPro")
     * @param Request $request
     * @param ExperienceProRepository $eps
     * @param TechnoPro|null $technoP
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */

    public function technoPro(Request $request, ExperienceProRepository $eps, TechnoPro $technoP = null)
    {

        $technoPro = $technoP ?? new TechnoPro();
        $form = $this->createForm(TechnoProType::class, $technoPro, ['eps'=>$eps]);
        $form->handleRequest($request);
        $now = new \DateTime();

        if ($form->isSubmitted() && $form->isValid()) {
            $technoPro = $form->getData();;
            $em = $this->getDoctrine()->getManager();
            $em->persist($technoPro->setLastCreated($now));
            $this->em->flush();
        }
        return $this->render('form/technoPro.html.twig',[
            'formTechnoPro' => $form->createView()
        ]);
    }
    /**
     * @Route("/technoPro/delete/{id}", defaults={"id"=null}, name="technoPro_delete")
     * @param Request $request
     * @param TechnoPro|null $technoProA
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */

    public function technoProDelete(Request $request,  TechnoPro $technoProA = null)
    {
        $technoPro = $technoProA;
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($technoPro);
        $entityManager->flush();
        return $this->redirectToRoute('experienceProView');
    }
}