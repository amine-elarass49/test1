<?php

namespace App\Form;

use App\Entity\Produits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pr_nom')
            ->add('pr_ref')
            ->add('pr_desc')
            ->add('pr_image')
            ->add('pr_desc_int')
            ->add('etat_id')
            ->add('type_id')
            ->add('um_id')
            ->add('gamme_id')
            ->add('marque_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
