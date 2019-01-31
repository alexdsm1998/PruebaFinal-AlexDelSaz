<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class EventoType extends AbstractType
{
/**
* {@inheritdoc}
*/
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder
->add('titulo', TextType::class)
->add('descripcion', TextType::class)
->add('activo', TextType::class)
->add('save', SubmitType::class, array('label' => 'enviar'));
}
}