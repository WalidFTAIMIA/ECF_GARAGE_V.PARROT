<?php

namespace App\Factory;

use App\Entity\CarsCatalogue;
use App\Repository\CarsCatalogueRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<CarsCatalogue>
 *
 * @method        CarsCatalogue|Proxy create(array|callable $attributes = [])
 * @method static CarsCatalogue|Proxy createOne(array $attributes = [])
 * @method static CarsCatalogue|Proxy find(object|array|mixed $criteria)
 * @method static CarsCatalogue|Proxy findOrCreate(array $attributes)
 * @method static CarsCatalogue|Proxy first(string $sortedField = 'id')
 * @method static CarsCatalogue|Proxy last(string $sortedField = 'id')
 * @method static CarsCatalogue|Proxy random(array $attributes = [])
 * @method static CarsCatalogue|Proxy randomOrCreate(array $attributes = [])
 * @method static CarsCatalogueRepository|RepositoryProxy repository()
 * @method static CarsCatalogue[]|Proxy[] all()
 * @method static CarsCatalogue[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static CarsCatalogue[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static CarsCatalogue[]|Proxy[] findBy(array $attributes)
 * @method static CarsCatalogue[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CarsCatalogue[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CarsCatalogueFactory extends ModelFactory
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
            'pictureCarsCatalogue' => self::faker()->text(10),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(CarsCatalogue $carsCatalogue): void {})
        ;
    }

    protected static function getClass(): string
    {
        return CarsCatalogue::class;
    }
}
