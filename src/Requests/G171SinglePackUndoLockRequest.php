<?php
declare(strict_types=1);

namespace NGT\NMVS\Requests;

use NGT\NMVS\Contracts\Request as RequestContract;
use NGT\NMVS\Requests\Abstracts\SinglePackUndoRequest;

class G171SinglePackUndoLockRequest extends SinglePackUndoRequest implements RequestContract
{
    public function getUseCaseNumber(): string
    {
        return 'G171';
    }
}
