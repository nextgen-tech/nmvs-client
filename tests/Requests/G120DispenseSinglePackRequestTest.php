<?php
declare(strict_types=1);

namespace Tests\Requests;

use NGT\NMVS\Requests\G120SinglePackDispenseRequest;
use Tests\Support;
use Tests\TestCase;

class G120SinglePackDispenseRequestTest extends TestCase
{
    /** @var \NGT\NMVS\Requests\G120SinglePackDispenseRequest */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new G120SinglePackDispenseRequest();
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
