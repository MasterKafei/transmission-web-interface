<?php

namespace App\Controller\Transmission\Torrent;

use App\Business\TransmissionBusiness;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class PlayingController extends AbstractController
{
    #[Route(
        path: '/torrent/{id}/play',
        name: 'app_transmission_torrent_playing_play',
        requirements: ['id' => '\d+']
    )]
    public function play(TransmissionBusiness $transmissionBusiness, int $id): RedirectResponse
    {
        $transmission = $transmissionBusiness->getTransmission();
        $torrent = $transmission->get($id);
        $transmission->start($torrent);

        return $this->redirectToRoute('app_transmission_torrent_listing_list_all');
    }
}
