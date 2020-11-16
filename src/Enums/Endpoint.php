<?php
declare(strict_types=1);

namespace NGT\NMVS\Enums;

final class Endpoint
{
    /** E.g. verification, dispense, undo... */
    const SINGLE_TRANSACTIONS = 'https://ws-single-transactions-int-bp.nmvs.eu:8443/WS_SINGLE_TRANSACTIONS_V1/SinglePackServiceV40';

    /** E.g. bulk verification, bulk dispense... */
    const BULK_TRANSACTIONS = 'https://ws-bulk-transactions-int-bp.nmvs.eu:8445/WS_BULK_TRANSACTIONS_V1/BulkServiceV40';

    const MIXED_BULK_TRANSACTIONS = 'https://ws-mixed-bulk-transactions-int-bp.nmvs.eu:8446/WS_MIXED_BULK_TRANSACTIONS_V1/MixedBulkServiceV40';

    const MASTER_DATA_TRANSACTIONS = 'https://ws-master-data-int-bp.nmvs.eu:8447/WS_MASTER_DATA_V1/MasterDataServiceV40';

    /** E.g. terms & conditions, password change, ping... */
    const SUPPORT_TRANSACTIONS = 'https://ws-support-int-bp.nmvs.eu:8448/WS_SUPPORT_V1/SupportServiceV40';

    const DOWNLOAD_USER_CERTIFICATE_WITH_TAN = 'https://ws-pki-int-bp.nmvs.eu:8444/WS_PKI_V1/PkiServiceV40';

    const DOWNLOAD_USER_CERTIFICATE_WITH_CERT = 'https://ws-pki-with-cert-int-bp.nmvs.eu:8458/WS_PKI_V1/PkiServiceV40';
}
