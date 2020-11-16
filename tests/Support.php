<?php
declare(strict_types=1);

namespace Tests;

use DateTime;
use NGT\NMVS\Credentials;
use NGT\NMVS\Models\Pack;
use NGT\NMVS\Models\Product;
use NGT\NMVS\SoftwareDetails;

class Support
{
    // @phpstan-ignore-next-line
    public static function credentials($clientId = null, $userId = null, $password = null, $subUserId = null): Credentials
    {
        return new Credentials(
            $clientId ?? 'BOND',
            $userId ?? '007',
            $password ?? 'secret',
            $subUserId
        );
    }

    // @phpstan-ignore-next-line
    public static function softwareDetails($supplier = null, $name = null, $version = null): SoftwareDetails
    {
        return new SoftwareDetails(
            $supplier ?? 'NGT',
            $name ?? 'NMVS Integration',
            $version ?? '1.0.0',
        );
    }

    // @phpstan-ignore-next-line
    public static function product($code = null, $codeScheme = null, $batchId = null, $expirationDate = null): Product
    {
        return new Product(
            $code ?? '1234567890',
            $codeScheme ?? 'GTIN',
            $batchId ?? 'BATCH',
            $expirationDate ?? new DateTime('2020-01-01')
        );
    }

    // @phpstan-ignore-next-line
    public static function pack($serialNumber = null): Pack
    {
        return new Pack($serialNumber ?? 'qwertyuiop123', );
    }
}
