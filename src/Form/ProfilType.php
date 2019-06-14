<?php
/**
 * Created by PhpStorm.
 * User: MHAM
 * Date: 19/02/2019
 * Time: 10:52
 */
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvents;


class ProfilType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('plainPassword', HiddenType::class)
            ->add('dateDeNaissance', BirthdayType::class )
            ->add('expPro', NumberType::class )
            ->add('poste', TextType::class)
            ->add('adresse', TextType::class,[
                'label' => 'Ville'
            ])
            ->add('anglais', ChoiceType::class,[
                'choices' => $this->reverseConst(),
            ])
//            ->add('age', HiddenType::class, [
//                'data' => $this->ageByBirthday('dateDeNaissance')
//                    ])

            ->add('submit', SubmitType::class, ['label'=>'Envoyer', 'attr'=>['class'=>'btn-primary btn-block']])
        ;


    }

    public function reverseConst(){
        $reverse = [];
        foreach (User::EnglishLevel as $k => $v){
            $reverse[$v] = $k;
        }
        return $reverse;
    }
//    public function ageByBirthday($dateDeNaissance) {
//        return (int) ((time() - strtotime($dateDeNaissance))) ;
//    }
}