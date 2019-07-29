<?php namespace Tests\Repositories;

use App\Models\BotanicalChemical;
use App\Repositories\BotanicalChemicalRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBotanicalChemicalTrait;
use Tests\ApiTestTrait;

class BotanicalChemicalRepositoryTest extends TestCase
{
    use MakeBotanicalChemicalTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BotanicalChemicalRepository
     */
    protected $botanicalChemicalRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->botanicalChemicalRepo = \App::make(BotanicalChemicalRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_botanical_chemical()
    {
        $botanicalChemical = $this->fakeBotanicalChemicalData();
        $createdBotanicalChemical = $this->botanicalChemicalRepo->create($botanicalChemical);
        $createdBotanicalChemical = $createdBotanicalChemical->toArray();
        $this->assertArrayHasKey('id', $createdBotanicalChemical);
        $this->assertNotNull($createdBotanicalChemical['id'], 'Created BotanicalChemical must have id specified');
        $this->assertNotNull(BotanicalChemical::find($createdBotanicalChemical['id']), 'BotanicalChemical with given id must be in DB');
        $this->assertModelData($botanicalChemical, $createdBotanicalChemical);
    }

    /**
     * @test read
     */
    public function test_read_botanical_chemical()
    {
        $botanicalChemical = $this->makeBotanicalChemical();
        $dbBotanicalChemical = $this->botanicalChemicalRepo->find($botanicalChemical->id);
        $dbBotanicalChemical = $dbBotanicalChemical->toArray();
        $this->assertModelData($botanicalChemical->toArray(), $dbBotanicalChemical);
    }

    /**
     * @test update
     */
    public function test_update_botanical_chemical()
    {
        $botanicalChemical = $this->makeBotanicalChemical();
        $fakeBotanicalChemical = $this->fakeBotanicalChemicalData();
        $updatedBotanicalChemical = $this->botanicalChemicalRepo->update($fakeBotanicalChemical, $botanicalChemical->id);
        $this->assertModelData($fakeBotanicalChemical, $updatedBotanicalChemical->toArray());
        $dbBotanicalChemical = $this->botanicalChemicalRepo->find($botanicalChemical->id);
        $this->assertModelData($fakeBotanicalChemical, $dbBotanicalChemical->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_botanical_chemical()
    {
        $botanicalChemical = $this->makeBotanicalChemical();
        $resp = $this->botanicalChemicalRepo->delete($botanicalChemical->id);
        $this->assertTrue($resp);
        $this->assertNull(BotanicalChemical::find($botanicalChemical->id), 'BotanicalChemical should not exist in DB');
    }
}
