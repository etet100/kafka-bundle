<?php

declare(strict_types=1);

namespace Sts\KafkaBundle\Tests\Unit\Configuration\Type;

use Sts\KafkaBundle\Configuration\Contract\ConfigurationInterface;
use Sts\KafkaBundle\Configuration\Type\AutoOffsetReset;

class AutoOffsetResetTest extends AbstractConfigurationTest
{
    protected function getConfiguration(): ConfigurationInterface
    {
        return new AutoOffsetReset();
    }

    protected function getValidValues(): array
    {
        return ['smallest', 'largest'];
    }

    protected function getInvalidValues(): array
    {
        return [1, 1.51, 'Largest', 'Smallest', [], null, new \stdClass(), false, true];
    }
}
