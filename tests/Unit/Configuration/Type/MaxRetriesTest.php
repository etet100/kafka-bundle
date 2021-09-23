<?php

declare(strict_types=1);

namespace Sts\KafkaBundle\Tests\Unit\Configuration\Type;

use Sts\KafkaBundle\Configuration\Contract\ConfigurationInterface;
use Sts\KafkaBundle\Configuration\Type\MaxRetries;

class MaxRetriesTest extends AbstractConfigurationTest
{
    protected function getConfiguration(): ConfigurationInterface
    {
        return new MaxRetries();
    }

    protected function getValidValues(): array
    {
        return ['1', 2];
    }

    protected function getInvalidValues(): array
    {
        return [-1, '-1', 1.51, '1.51', '', [], null, new \stdClass(), false, true];
    }
}
