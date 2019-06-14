<?php
namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Competences;
use App\Repository\CategorieRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * Created by PhpStorm.
 * User: MHAM
 * Date: 20/02/2019
 * Time: 16:24
 */
class CompetencesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var $categorie */
        $builder
            ->add('intitule', TextType::class)
            ->add('niveau', ChoiceType::class,[
                'choices' => $this->reverseConst()
            ])
            ->add('categorie', EntityType::class, array(
                    'class' => 'App:Categorie',
                    'choice_label' => 'intitule',
                    'label' => 'Categorie',
            ))
            ->add('submit', SubmitType::class, ['label' => 'Envoyer', 'attr' => ['class' => 'btn-primary btn-block']]);


    }
    public function reverseConst(){
        $reverse = [];
        foreach (Competences::CompetencesLevel as $k => $v){
            $reverse[$v] = $k;
        }
        return $reverse;
    }
}