<?php

namespace App\Module\Message\Application\Form;

use App\Module\Message\Domain\Dto\Sort\MessageSortDto;
use App\Module\Message\Domain\Dto\Sort\MessageSortOptionEnum;
use App\Module\Message\Domain\Enum\SortDirectionEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageSortFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sortOption', EnumType::class, [
                'class' => MessageSortOptionEnum::class
            ])
            ->add('sortDirection', EnumType::class, [
                'class' => SortDirectionEnum::class,
                'empty_data' => SortDirectionEnum::ASC
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MessageSortDto::class,
            'csrf_protection' => false,
        ]);
    }
}
