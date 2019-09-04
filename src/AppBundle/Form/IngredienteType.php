<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// src/AppBundle/Form/TaskType.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class IngredienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class)
//            ->add('descripcion', CKEditorType::class)
////            ->add('ingredientes', TextareaType::class)
//            ->add('foto', FileType::class, array('attr'=>array('onchange'=>'onChange(event)')))            
////            ->add('top')                      
//            //->add('fechaCreacion', DateType::class);      //Este se va a generar cuando se ingresen los datos (cuando se recojan los datos)
            ->add('Salvar', SubmitType::class, ['label' => 'Nuevo Ingrediente']);
    }
}

