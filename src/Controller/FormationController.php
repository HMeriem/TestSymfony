<?php
/**
 * Created by PhpStorm.
 * User: MHAM
 * Date: 21/02/2019
 * Time: 14:37
 */
namespace App\Controller;
use App\Entity\Formation;
use App\Form\FormationType;
use App\Entity\User;
use App\Repository\FormationRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use function Sodium\add;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;


class FormationController extends AbstractController
{
    /**
     * @var FormationRepository
     */
    private $formationRepository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(FormationRepository $formationRepository, ObjectManager $em)
    {
        $this->formationRepository = $formationRepository;
        $this->em = $em;
    }

    /**
     * @Route("/formation/{id}", defaults={"id"=null}, name="formation")
     * @ParamConverter("formation", options={"id" = "id"})
     * @param Request $request
     * @param FormationRepository $eps
     * @param Formation|null $formationA
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */

    public function formation(Request $request,  FormationRepository $eps, Formation $formationA = null)
{
    $formation = $formationA ?? new Formation();

    $user = $this->getUser();
    $form = $this->createForm(FormationType::class, $formation);
    $form->handleRequest($request);
    $now = new \DateTime();

    if ($form->isSubmitted() && $form->isValid()){
        $formation = $form->getData();
        $formation->setUser($user);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($formation->setLastCreated($now));
        $this->em->flush();
    }

    return $this->render('form/formation.html.twig',[
        'formu' => $form->createView()
    ]);
}
    /**
     * @Route("/my-formation", name="formationView")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */
    public function formationView(Request $request)
    {
        $user = $this->getUser();
        $formation = $this->formationRepository->findBy(['User'=> $user]);
        return $this->render('formationView.html.twig', [
                'formation'  => $formation
        ]);
    }
    /**
     * @Route("/formation/delete/{id}", defaults={"id"=null}, name="formation_delete")
     * @ParamConverter("formation", options={"id" = "id"})
     * @param Request $request
     * @param Formation|null $formationA
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */

    public function formationDelete(Request $request,  Formation $formationA = null)
    {
        $user = $this->getUser();
        $formation = $formationA;
        $formation->setUser($user);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($formation);
        $entityManager->flush();
        $formation = $this->formationRepository->findBy(['User'=> $user]);
        return $this->render('formationView.html.twig', [
            'formation'  => $formation
        ]);
    }

}
