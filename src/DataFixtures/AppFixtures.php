<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Ingredient;
use App\Entity\Recipe;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 50; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName($this->faker->word())
                ->setPrice(mt_rand(1, 199));
            $manager->persist($ingredient);
        }
        for ($i = 1; $i <= 25; $i++) {
            $recipe = new Recipe();
            $recipe->setName($this->faker->words(3, true))
                   ->setTime(mt_rand(5, 120))
                   ->setNbPersons(mt_rand(1, 10))
                   ->setDifficulty(mt_rand(1, 5))
                   ->setDescription($this->faker->text(300))
                   ->setPrice(mt_rand(0, 200))
                   ->setIsFavorite($this->faker->boolean());
            $manager->persist($recipe);
        }
        $manager->flush();
    }
}
