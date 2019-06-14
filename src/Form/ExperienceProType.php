<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Created by PhpStorm.
 * User: MHAM
 * Date: 20/02/2019
 * Time: 16:24
 */
class ExperienceProType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var $categorie */
        $builder
            ->add('dateDebut', DateType::class)
            ->add('dateFin', DateType::class)
            ->add('present', CheckboxType::class, [
                'label' => 'En cours',
                'required' => false
            ])
            ->add('fonction', TextType::class)
            ->add('client', TextType::class)
            ->add('environnement', TextType::class)
            ->add('description', TextType::class)
            ->add('mode', ChoiceType::class,[
                'choices' => [
                    'Forfait' => 'Forfait',
                    'Forfait/TMA' => 'Forfait/TMA',
                    'Interne' => 'Interne',
                ]
            ])

            ->add('submit', SubmitType::class, ['label' => 'Envoyer', 'attr' => ['class' => 'btn-primary btn-block']]);


    }

}