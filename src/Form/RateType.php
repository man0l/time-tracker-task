<?php

namespace App\Form;

use App\Entity\Rate;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

class RateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('from_hours', NumberType::class, ['constraints' => [
                new NotBlank(),
                new PositiveOrZero()
            ]])
            ->add('to_hours',NumberType::class, ['constraints' => [
                new NotBlank(),
                new PositiveOrZero()
            ]])
            ->add('rate', NumberType::class, ['constraints' => [
                new NotBlank(),
                new PositiveOrZero()
            ]])
            ->add('weekday')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rate::class,
        ]);
    }
}
