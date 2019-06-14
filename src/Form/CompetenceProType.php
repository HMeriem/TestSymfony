<?php
namespace App\Form;

use App\Entity\ExperiencePro;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Created by PhpStorm.
 * User: MHAM
 * Date: 20/02/2019
 * Time: 16:24
 */
class CompetenceProType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = [];
        foreach( $options['eps']->findAll() as $ep ) {
            $choices[ $ep->getId() . ' - ' . $ep->getClient() ] = $ep->getId();
        }
        $builder
            ->add('intitule', TextType::class, array(
                'required'=> true
            ))
            ->add('experiencePro', ChoiceType::class, array(
                "required" => true,
                "choices" => $choices
            ))

            /*
             * Ancienne méthode pas pratique pour mon cas
             *
             * ->add('experiencePro', EntityType::class, array(
                'class' => 'App:ExperiencePro',
                'choice_label' => 'client',
                'label' => 'Mes experiences',
//                'choice_value' => function (ExperiencePro $entity = null) {
//                    return $entity->getId();
//                    }
            ))
            ->addEventListener(FormEvents::PRE_SUBMIT, function(FormEvent $event){
                $form = $event->getForm();
                $form->remove('experiencePro')->add('experiencePro', NumberType::class);
            })*/
            ->add('submit', SubmitType::class, ['label' => 'Envoyer', 'attr' => ['class' => 'btn-primary btn-block']]);



    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'eps' => null,
        ));
    }
}