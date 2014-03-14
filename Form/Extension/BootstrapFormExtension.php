<?php

/**
 * BootstrapFormExtension.php
 */

namespace Peredaj\BootstrapBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class BootstrapFormExtension extends AbstractTypeExtension
{

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        foreach(array('form_style', 'help', 'cols') as $param)
            $view->vars[$param] = $options[$param];
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        foreach($view->children as $child)
        {
            foreach(array('form_style', 'cols') as $param)
                $child->vars[$param] = $options[$param];
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $defaults = array(
            'form_style' => 'simple',
            'help'       => false,
            'cols'       => array(
                'left'  => 4,
                'right' => 8
            ),
        );

        $resolver->setDefaults(array(
            'form_style' => null,
            'help' => null,
            'cols' => array(
                'left' => 4,
                'right' => 8,
            ),
        )); 
        
        $resolver->setNormalizers(array(
            'form_style' => function(Options $options, $form_style)
            {
                return in_array($form_style, array('simple', 'horizontal', 'inline')) ? $form_style : 'simple'; 
            },
        ));
    }

    public function getExtendedType()
    {
        return 'form';
    }

}
