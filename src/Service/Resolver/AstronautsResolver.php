<?php

namespace App\Service\Resolver;

use App\Entity\Astronaut;
use App\Repository\AstronautRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

final class AstronautsResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var AstronautRepository
     */
    private $astronautRepository;

    /**
     *
     * @param AstronautRepository $astronautRepository
     */
    public function __construct(AstronautRepository $astronautRepository)
    {
        $this->astronautRepository = $astronautRepository;
    }

    /**
     * @return Astronaut
     */
    public function resolve()
    {
        return $this->astronautRepository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Astronauts',
        ];
    }
}