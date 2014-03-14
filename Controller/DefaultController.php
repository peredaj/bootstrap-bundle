<?php

namespace Peredaj\BootstrapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template
     */
    public function indexAction()
    {
        $form = $this->createFormBuilder(null, array(
//            'form_style' => 'inline',
            
            'form_style' => 'horizontal',
            'cols' => array('left' => 4, 'right' => 8),
        ))
            ->add('text', 'text', array(
                'help' => 'help text to first field',
                'constraints' => array(
                    new \Symfony\Component\Validator\Constraints\Length(array('min' => 5))
                )
            ))
            ->add('text2', 'text', array(
                'help' => 'help text to second field',
            ))
            ->add('text3', 'textarea', array(
                'help' => 'help text to textarea field',
                'constraints' => array(
                    new \Symfony\Component\Validator\Constraints\Length(array('min' => 5))
                )
            ))
            ->add('radio1', 'radio')
            ->add('radio2', 'radio')
            ->add('checkbox1', 'checkbox')
            ->add('choice1', 'choice', array(
                'choices' => array(
                    'one',
                    'two',
                    'three',
                ),
                'expanded' => true,
                'multiple' => true,
            ))
            ->add('choice2', 'choice', array(
                'choices' => array(
                    'one',
                    'two',
                    'three',
                ),
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('choice3', 'choice', array(
                'choices' => array(
                    'one',
                    'two',
                    'three',
                ),
                'expanded' => false,
                'multiple' => true,
            ))            
            ->add('choice4', 'choice', array(
                'choices' => array(
                    'one',
                    'two',
                    'three',
                ),
                'expanded' => false,
                'multiple' => false,
            ))            
            ->add('submit', 'submit', array(
                'attr' => array(
                    'class' => 'btn-default',
                )
            ))
            ->getForm();
        
        if('POST' == $this->getRequest()->getMethod())
        {
            $form->handleRequest($this->getRequest());
            if($form->isValid())
            {
                
            }
        }
        
        $view = $form->createView();
        
        return array(
            'form_view' => print_r($view, 1),
            'form' => $view,
        );
    }
}
