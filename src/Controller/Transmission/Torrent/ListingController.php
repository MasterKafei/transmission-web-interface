<?php

namespace App\Controller\Transmission\Torrent;

use App\Business\TransmissionBusiness;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ListingController extends AbstractController
{
    #[Route(path: '/torrent', name: 'app_transmission_torrent_listing_list_all')]
    #[IsGranted(User::ROLE_USER)]
    public function listAll(TransmissionBusiness $transmissionBusiness): Response
    {
        $torrents = $transmissionBusiness->getTransmission()->all();

        return $this->render('Page/Transmission/Torrent/list_all.html.twig', [
            'torrents' => $torrents,
        ]);
    }
}
