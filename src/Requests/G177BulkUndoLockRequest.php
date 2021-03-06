<?php
declare(strict_types=1);

namespace NGT\NMVS\Requests;

use NGT\NMVS\Contracts\Request as RequestContract;
use NGT\NMVS\Requests\Abstracts\BulkUndoRequest;

class G177BulkUndoLockRequest extends BulkUndoRequest implements RequestContract
{
    public function getUseCaseNumber(): string
    {
        return 'G177';
    }
}
