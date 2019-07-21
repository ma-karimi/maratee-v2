<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Table;
use App\Repositories\TableRepository;

trait MakeTableTrait
{
    /**
     * Create fake instance of Table and save it in database
     *
     * @param array $tableFields
     * @return Table
     */
    public function makeTable($tableFields = [])
    {
        /** @var TableRepository $tableRepo */
        $tableRepo = \App::make(TableRepository::class);
        $theme = $this->fakeTableData($tableFields);
        return $tableRepo->create($theme);
    }

    /**
     * Get fake instance of Table
     *
     * @param array $tableFields
     * @return Table
     */
    public function fakeTable($tableFields = [])
    {
        return new Table($this->fakeTableData($tableFields));
    }

    /**
     * Get fake data of Table
     *
     * @param array $tableFields
     * @return array
     */
    public function fakeTableData($tableFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $tableFields);
    }
}
