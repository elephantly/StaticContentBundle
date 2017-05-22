<?php

namespace Elephantly\StaticContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StaticContentType extends AbstractType
{

    public function __construct()
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('slug')
            ->add('value')
        ;
    }


    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $staticContent = $form->getNormData();

        if(!$staticContent){
            return;
        }

        if($staticContent->getCreatedAt()){
            $view->children['slug']->vars['read_only'] = true;
        }
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'      => 'Elephantly\StaticContentBundle\Entity\StaticContent',
        ));
    }

    public function getName()
    {
        return 'static_content_form';
    }
}
