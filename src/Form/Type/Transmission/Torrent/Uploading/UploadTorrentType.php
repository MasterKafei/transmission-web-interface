<?php

namespace App\Form\Type\Transmission\Torrent\Uploading;

use App\Form\Model\Transmission\Torrent\Uploading\UploadTorrentModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UploadTorrentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('savePath', TextType::class)
            ->add('url', TextType::class, [
                'required' => false
            ])
            ->add('file', FileType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UploadTorrentModel::class,
        ]);
    }
}
