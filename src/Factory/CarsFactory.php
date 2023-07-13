<?php

namespace App\Factory;

use App\Entity\Cars;
use App\Repository\CarsRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Cars>
 *
 * @method        Cars|Proxy create(array|callable $attributes = [])
 * @method static Cars|Proxy createOne(array $attributes = [])
 * @method static Cars|Proxy find(object|array|mixed $criteria)
 * @method static Cars|Proxy findOrCreate(array $attributes)
 * @method static Cars|Proxy first(string $sortedField = 'id')
 * @method static Cars|Proxy last(string $sortedField = 'id')
 * @method static Cars|Proxy random(array $attributes = [])
 * @method static Cars|Proxy randomOrCreate(array $attributes = [])
 * @method static CarsRepository|RepositoryProxy repository()
 * @method static Cars[]|Proxy[] all()
 * @method static Cars[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Cars[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Cars[]|Proxy[] findBy(array $attributes)
 * @method static Cars[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Cars[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CarsFactory extends ModelFactory
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
            'carsBrand' => self::faker()->text(10),
            'carsEnergy' => self::faker()->text(10),
            'carsKm' => self::faker()->randomNumber(),
            'carsModel' => self::faker()->text(10),
            'carsPrice' => self::faker()->randomFloat(),
            'carsYear' => self::faker()->dateTime(),
            'carscatalogue' => CarsCatalogueFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Cars $cars): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Cars::class;
    }
}
