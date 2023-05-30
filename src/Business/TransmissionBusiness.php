<?php

namespace App\Business;

use Transmission\Client;
use Transmission\Transmission;

class TransmissionBusiness
{
    private readonly Transmission $transmission;

    public function __construct(
        string $baseUri,
        string $username,
        string $password,
    )
    {
        [
            'host' => $host,
            'port' => $port,
            'path' => $path,
        ] = parse_url($baseUri);
        $client = new Client($host, $port, $path);
        $client->authenticate($username, $password);

        $this->transmission = new Transmission();
        $this->transmission->setClient($client);
    }

    public function getTransmission(): Transmission
    {
        return $this->transmission;
    }
}
