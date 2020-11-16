<?php
declare(strict_types=1);

namespace Tests\Requests;

use NGT\NMVS\Requests\G115BulkVerifyRequest;
use Tests\Support;
use Tests\TestCase;

class G115BulkVerifyRequestTest extends TestCase
{
    /** @var \NGT\NMVS\Requests\G115BulkVerifyRequest */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new G115BulkVerifyRequest();
        $this->request->setCredentials(Support::credentials());
        $this->request->setSoftwareDetails(Support::softwareDetails());
    }

    public function testXml(): void
    {
        $this->request->setTransactionId('trxId');
        $this->request->setProduct(Support::product());
        $this->request->addPack(Support::pack('pack1'));
        $this->request->addPack(Support::pack('pack2'));

        $this->assertMatchesSnapshot($this->request->toXml());
    }
}
