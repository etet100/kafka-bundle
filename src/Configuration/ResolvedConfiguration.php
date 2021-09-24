<?php

declare(strict_types=1);

namespace Sts\KafkaBundle\Configuration;

use Sts\KafkaBundle\Configuration\Contract\ConfigurationInterface;
use Sts\KafkaBundle\Configuration\Contract\ConsumerConfigurationInterface;
use Sts\KafkaBundle\Configuration\Contract\KafkaConfigurationInterface;
use Sts\KafkaBundle\Configuration\Contract\ProducerConfigurationInterface;
use Sts\KafkaBundle\Configuration\Exception\UnknownConfigurationType;

class ResolvedConfiguration
{
    public const ALL_TYPES = 'all';
    public const KAFKA_TYPES = 'kafka';
    public const CONSUMER_TYPES = 'consumer';
    public const PRODUCER_TYPES = 'producer';

    private array $configurations = [];

    /**
     * @param mixed $resolvedValue
     * @param ConfigurationInterface $configuration
     * @return ResolvedConfiguration
     */
    public function addConfiguration(ConfigurationInterface $configuration, $resolvedValue): self
    {
        $this->configurations[$configuration->getName()] = [
            'configuration' => $configuration,
            'resolvedValue' => $resolvedValue
        ];

        return $this;
    }

    /**
     * @param string $type
     * @return array
     */
    public function getConfigurations(string $type = self::ALL_TYPES): array
    {
        switch ($type) {
            case self::ALL_TYPES:
                $interface = ConfigurationInterface::class;
                break;
            case self::KAFKA_TYPES:
                $interface = KafkaConfigurationInterface::class;
                break;
            case self::CONSUMER_TYPES:
                $interface = ConsumerConfigurationInterface::class;
                break;
            case self::PRODUCER_TYPES:
                $interface = ProducerConfigurationInterface::class;
                break;
            default:
                throw new UnknownConfigurationType(sprintf('Unknown configuration type %s', $type));
        }

        $configurations = [];
        foreach ($this->configurations as $configuration) {
            if ($configuration['configuration'] instanceof $interface) {
                $configurations[] = $configuration;
            }
        }

        return $configurations;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getValue(string $name)
    {
        return $this->configurations[$name]['resolvedValue'];
    }
}
