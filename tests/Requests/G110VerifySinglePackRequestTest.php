<?php
declare(strict_types=1);

namespace Tests\Requests;

use NGT\NMVS\Requests\G110SinglePackVerifyRequest;
use Tests\Support;
use Tests\TestCase;

class G110SinglePackVerifyRequestTest extends TestCase
{
    /** @var \NGT\NMVS\Requests\G110SinglePackVerifyRequest */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new G110SinglePackVerifyRequest();
        $this->request->setCredentials(Support::credentials());
        $this->request->setSoftwareDetails(Support::softwareDetails());
    }

    public function testXml(): void
    {
        $this->request->setTransactionId('trxId');
        $this->request->setProduct(Support::product());
        $this->request->setPack(Support::pack());

        $this->assertMatchesSnapshot($this->request->toXml());
    }
}
