<?php

namespace App\Controller\Transmission\Torrent;

use App\Business\TransmissionBusiness;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class DeletingController extends AbstractController
{
    #[Route(
        path: '/torrent/{id}/delete',
        name: 'app_transmission_torrent_deleting_delete',
        requirements: ['id' => '\d+']
    )]
    public function delete(TransmissionBusiness $transmissionBusiness, int $id): RedirectResponse
    {
        $transmission = $transmissionBusiness->getTransmission();
        $torrent = $transmission->get($id);
        $transmission->remove($torrent);
        return $this->redirectToRoute('app_transmission_torrent_listing_list_all');
    }
}
