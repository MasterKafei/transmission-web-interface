<?php

namespace App\Controller\Transmission\Torrent;

use App\Business\TransmissionBusiness;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class PausingController extends AbstractController
{
    #[Route(
        path: '/torrent/{id}/pause',
        name: 'app_transmission_torrent_pausing_pause',
        requirements: ['id' => '\d+']
    )]
    public function pause(TransmissionBusiness $transmissionBusiness, int $id): RedirectResponse
    {
        $transmission = $transmissionBusiness->getTransmission();
        $torrent = $transmission->get($id);
        $transmission->stop($torrent);

        return $this->redirectToRoute('app_transmission_torrent_listing_list_all');
    }
}
