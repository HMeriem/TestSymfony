<?php
namespace App\Controller;

use App\Entity\User;
use App\Repository\CategorieRepository;
use App\Repository\CompetenceProRepository;
use App\Repository\CompetencesRepository;
use App\Repository\ExperienceProRepository;
use App\Repository\FormationRepository;
use App\Repository\TechnoProRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use PhpParser\Node\Expr\Array_;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Extension\AbstractExtension;
use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Spipu\Html2Pdf\Extension\ExtensionInterface;
use \Spipu\Html2Pdf\Tag\AbstractTag;
use \Spipu\Html2Pdf\Tag\TagInterface;
use \Spipu\Html2Pdf\Tag;



class PdfController extends AbstractController

{
    /**
     * @var ObjectManager
     */
    private $em;

    private $userRepository;
    private $formationRepository;
    private $categorieRepository;
    private $competencesRepository;
    private $experienceProRepository;
    private $competenceProRepository;
    private $technoProRepository;



    /**
     * PdfController constructor.
     * @param UserRepository $userRepository
     * @param FormationRepository $formationRepository
     * @param CategorieRepository $categorieRepository
     * @param CompetencesRepository $competencesRepository
     * @param ExperienceProRepository $experienceProRepository
     * @param CompetenceProRepository $competenceProRepository
     * @param TechnoProRepository $technoProRepository
     */
    public function __construct(UserRepository $userRepository, FormationRepository $formationRepository, CategorieRepository $categorieRepository, CompetencesRepository $competencesRepository, ExperienceProRepository $experienceProRepository, TechnoProRepository $technoProRepository, CompetenceProRepository $competenceProRepository, ObjectManager $em)
    {
        $this->userRepository = $userRepository;
        $this->formationRepository = $formationRepository;
        $this->categorieRepository = $categorieRepository;
        $this->competencesRepository = $competencesRepository;
        $this->competenceProRepository = $competenceProRepository;
        $this->technoProRepository = $technoProRepository;
        $this->experienceProRepository = $experienceProRepository;
        $this->em = $em;
    }
    /**
     * @return Response
     * @Route("/convert2Pdf", name="convert2Pdf")
     * @IsGranted("ROLE_USER")
     */
    public function convert2Pdf()
    {
        try {
            $currentUser = $this->getUser();

            $formations = $this->formationRepository->findBy(['User'=> $currentUser]);
            $categories = $this->categorieRepository->createQueryBuilder('cat')->select(['cat.id', 'cat.intitule', 'cat.type'])->getQuery()->execute();
            $competences = $this->competencesRepository->findAll();
            $expPro = $this->experienceProRepository->findAll();
            $technoPro = $this->technoProRepository->findAll();
            $competencePro = $this->competenceProRepository->findAll();
            $now = new \DateTime();

            $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8');
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML(
                "<style>\n".file_get_contents( '../templates/pdfs.css' )."</style>".
                $this->renderView('pdfs.html.twig', [
                'formations'  => $formations,
                'competences' => $competences,
                'categories'  => $categories,
                'expPros' => $expPro,
                'technoPros' => $technoPro,
                'competencePros' => $competencePro
            ]));//$content);
            $this->em->persist($currentUser->setLastPDF($now));
            $this->em->flush();
            return new Response($html2pdf->output('example00.pdf'));
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
            $formatter = new ExceptionFormatter($e);
            return new Response($formatter->getHtmlMessage());
        }
    }
}
