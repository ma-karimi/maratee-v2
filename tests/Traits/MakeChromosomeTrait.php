<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Chromosome;
use App\Repositories\ChromosomeRepository;

trait MakeChromosomeTrait
{
    /**
     * Create fake instance of Chromosome and save it in database
     *
     * @param array $chromosomeFields
     * @return Chromosome
     */
    public function makeChromosome($chromosomeFields = [])
    {
        /** @var ChromosomeRepository $chromosomeRepo */
        $chromosomeRepo = \App::make(ChromosomeRepository::class);
        $theme = $this->fakeChromosomeData($chromosomeFields);
        return $chromosomeRepo->create($theme);
    }

    /**
     * Get fake instance of Chromosome
     *
     * @param array $chromosomeFields
     * @return Chromosome
     */
    public function fakeChromosome($chromosomeFields = [])
    {
        return new Chromosome($this->fakeChromosomeData($chromosomeFields));
    }

    /**
     * Get fake data of Chromosome
     *
     * @param array $chromosomeFields
     * @return array
     */
    public function fakeChromosomeData($chromosomeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $chromosomeFields);
    }
}
