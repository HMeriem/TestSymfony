<?php
namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Created by PhpStorm.
 * User: MHAM
 * Date: 20/02/2019
 * Time: 16:24
 */
class TechnoProType extends AbstractType
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
            ->add('submit', SubmitType::class, ['label' => 'Envoyer', 'attr' => ['class' => 'btn-primary btn-block']]);


    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'eps' => null,
        ));
    }
}