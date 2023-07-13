<?php

namespace App\Factory;

use App\Entity\Opinion;
use App\Repository\OpinionRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Opinion>
 *
 * @method        Opinion|Proxy create(array|callable $attributes = [])
 * @method static Opinion|Proxy createOne(array $attributes = [])
 * @method static Opinion|Proxy find(object|array|mixed $criteria)
 * @method static Opinion|Proxy findOrCreate(array $attributes)
 * @method static Opinion|Proxy first(string $sortedField = 'id')
 * @method static Opinion|Proxy last(string $sortedField = 'id')
 * @method static Opinion|Proxy random(array $attributes = [])
 * @method static Opinion|Proxy randomOrCreate(array $attributes = [])
 * @method static OpinionRepository|RepositoryProxy repository()
 * @method static Opinion[]|Proxy[] all()
 * @method static Opinion[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Opinion[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Opinion[]|Proxy[] findBy(array $attributes)
 * @method static Opinion[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Opinion[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class OpinionFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'emailOpinion' => self::faker()->text(10),
            'messageOpinion' => self::faker()->text(30),
            'nameOpinion' => self::faker()->text(10),
            'phoneOpinion' => self::faker()->randomNumber(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Opinion $opinion): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Opinion::class;
    }
}
