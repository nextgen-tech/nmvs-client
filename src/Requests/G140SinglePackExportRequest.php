<?php
declare(strict_types=1);

namespace NGT\NMVS\Requests;

use NGT\NMVS\Contracts\Request as RequestContract;
use NGT\NMVS\Requests\Abstracts\SinglePackRequest;

class G140SinglePackExportRequest extends SinglePackRequest implements RequestContract
{
    public function getUseCaseNumber(): string
    {
        return 'G140';
    }
}
