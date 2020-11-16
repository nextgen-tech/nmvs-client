<?php
declare(strict_types=1);

namespace NGT\NMVS\Requests;

use NGT\NMVS\Contracts\Request as RequestContract;
use NGT\NMVS\Requests\Abstracts\BulkRequest;

class G135BulkDestroyRequest extends BulkRequest implements RequestContract
{
    public function getUseCaseNumber(): string
    {
        return 'G135';
    }
}
