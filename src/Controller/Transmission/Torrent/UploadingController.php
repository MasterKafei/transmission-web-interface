<?php

namespace App\Controller\Transmission\Torrent;

use App\Business\TransmissionBusiness;
use App\Form\Model\Transmission\Torrent\Uploading\UploadTorrentModel;
use App\Form\Type\Transmission\Torrent\Uploading\UploadTorrentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadingController extends AbstractController
{
    #[Route(path: '/torrent/upload', name: 'app_transmission_torrent_uploading_upload')]
    public function upload(TransmissionBusiness $transmissionBusiness, Request $request): Response|RedirectResponse
    {
        $transmission = $transmissionBusiness->getTransmission();
        $uploadTorrentModel = new UploadTorrentModel();
        $uploadTorrentModel->setSavePath($transmission->getSession()->getDownloadDir());
        $form = $this->createForm(UploadTorrentType::class, $uploadTorrentModel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (null === $uploadTorrentModel->getSavePath()) {
                $form->addError(new FormError('Vous devez obligatoirement renseigner un chemin de sauvegarde'));
            }

            if (null === $uploadTorrentModel->getUrl() && null === $uploadTorrentModel->getFile()) {
                $form->addError(new FormError('Vous devez obligatoirement renseigner un lien ou un fichier'));
            }

            if ($form->getErrors(true)->count() === 0) {
                if (null !== $uploadTorrentModel->getUrl()) {
                    $transmission->add($uploadTorrentModel->getUrl(), false, $uploadTorrentModel->getSavePath());
                } else if (null !== $uploadTorrentModel->getFile()) {
                    $transmission->add(base64_encode($uploadTorrentModel->getFile()->getContent()), true, $uploadTorrentModel->getSavePath());
                }
                return $this->redirectToRoute('app_transmission_torrent_listing_list_all');
            }
        }

        return $this->render('Page/Transmission/Torrent/upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
