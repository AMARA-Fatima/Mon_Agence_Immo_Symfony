<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('price')
            ->add('city')
            ->add('address')
            ->add('postal_code')
            ->add('heat', ChoiceType::class,
            [
                'choices'=>$this->getChoices()
            ])
            ->add('sold')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain'=>'forms'
        ]);
    }
    public function getChoices()
    {
        // recuperation de la const HEAT (entity/property.php/ligne13)
        $choices = Property::HEAT;
        $output = [];
        //je fais un foeeach clés/valeur sur mon tab choices
        foreach($choices as $k => $v)
        {
            //Astuce = j'utilise la valeur comme clé et la clé comme valeur
            $output[$v] = $k; 
        }
            return $output;
    }
}
