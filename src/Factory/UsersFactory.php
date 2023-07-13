<?php

namespace App\Factory;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Users>
 *
 * @method        Users|Proxy create(array|callable $attributes = [])
 * @method static Users|Proxy createOne(array $attributes = [])
 * @method static Users|Proxy find(object|array|mixed $criteria)
 * @method static Users|Proxy findOrCreate(array $attributes)
 * @method static Users|Proxy first(string $sortedField = 'id')
 * @method static Users|Proxy last(string $sortedField = 'id')
 * @method static Users|Proxy random(array $attributes = [])
 * @method static Users|Proxy randomOrCreate(array $attributes = [])
 * @method static UsersRepository|RepositoryProxy repository()
 * @method static Users[]|Proxy[] all()
 * @method static Users[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Users[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Users[]|Proxy[] findBy(array $attributes)
 * @method static Users[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Users[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class UsersFactory extends ModelFactory
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
            'email' => 'admin@garage-vparrot.com',
            'roles' => ['ROLE_ADMIN'],
            'password' => '$2y$13$w7usfxJhm1MP8qjT8TDNzOq.UuYWFuZszfwqX/agMwG8JeqWgacZ.',
            
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Users $users): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Users::class;
    }
}
