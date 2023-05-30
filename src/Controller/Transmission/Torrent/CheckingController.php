<?php

namespace App\Controller\Transmission\Torrent;

use App\Business\TransmissionBusiness;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class CheckingController extends AbstractController
{
    #[Route(
        path: '/torrent/{id}/check',
        name: 'app_transmission_torrent_checking_check',
        requirements: ['id' => '\d+']
    )]
    public function check(TransmissionBusiness $transmissionBusiness, int $id): RedirectResponse
    {
        $transmission = $transmissionBusiness->getTransmission();
        $torrent = $transmission->get($id);
        $transmission->verify($torrent);
        return $this->redirectToRoute('app_transmission_torrent_listing_list_all');
    }
}
