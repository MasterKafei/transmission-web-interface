# Transmission Web Interface Project

This Symfony project is a Transmission web interface, providing a web interface for managing Transmission BitTorrent client instances.

## Prerequisites

Ensure you have the following prerequisites installed on your development machine:

- PHP >= 8.1 (along with `ext-ctype` and `ext-iconv` extensions)
- Composer
- Doctrine

## Installation

To get the project up and running, follow these steps:

1. Clone the repository to your local machine:

```git clone git@github.com:MasterKafei/transmission-web-interface.git```

2. Navigate into the project directory:

```cd transmission-web-interface```

3. Install the dependencies via composer:

```composer install```

This will install the necessary packages defined in the `composer.json` file, including `symfony`, `doctrine`, and `transmission-php` among others.

## Configuration

Create a .env.local file with the necessary environment variables :

- DATABASE_USER=
- DATABASE_PASSWORD=
- DATABASE_HOST=
- DATABASE_NAME=
- APP_DEFAULT_USERNAME=
- APP_DEFAULT_PLAIN_PASSWORD=
- TRANSMISSION_BASE_URI=
- TRANSMISSION_USERNAME=
- TRANSMISSION_PASSWORD=

Execute the project install command to configure database and create default user :

```composer install-database```

