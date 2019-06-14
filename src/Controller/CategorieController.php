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
use App\Form\CategoriesType;
use App\Form\CompetencesType;
use App\Entity\User;
use App\Repository\CategorieRepository;
use App\Repository\CompetencesRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use function Sodium\add;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



class CategorieController extends AbstractController
{
    /**
     * @var CategorieRepository
     */
    private $categorieRepository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(CategorieRepository $categoriesRepository, ObjectManager $em)
    {
        $this->categorieRepository = $categoriesRepository;
        $this->em = $em;
    }

    /**
     * @Route("/categories", name="categories")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_ADMIN")
     */

    public function categories (Request $request)
    {
        $categories = new Categorie();
        $form = $this->createForm(CategoriesType::class, $categories);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($categories);
            $this->em->flush();
        }

        return $this->render('form/categories.html.twig',[
            'formi' => $form->createView()
        ]);
    }


}
