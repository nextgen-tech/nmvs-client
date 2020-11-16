<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Spatie\Snapshots\MatchesSnapshots;

class TestCase extends BaseTestCase
{
    use MatchesSnapshots;
}
