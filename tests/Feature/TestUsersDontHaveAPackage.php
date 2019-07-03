<?php

namespace Tests\Feature;

use App\Services\SubscriptionService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class TestUsersDontHaveAPackage extends TestCase
{
    use DatabaseTransactions;

    private $token;
    private $package_id;

    public function setUp()
    {
        parent::setUp();

        $this->token = $this->login();
        $this->package_id = 3;


    }

    /**
     * A basic test example.
     *
     * @return \Illuminate\Foundation\Testing\TestResponse
     */

    public function login()
    {

        $this->json('POST', '/api/1.0/token', ['cellphone' => '09124251131']);
        $token = $this->json('POST', '/api/1.0/login', ['cellphone' => '09124251131', 'password' => '1111']);

        $token->assertStatus(200);

        return $token;
    }

    public function testDontHavePackage()
    {

        $buy = $this->buy($this->token);

        $this->successPayment($buy);
        $package = $this->package($this->package_id);

        $this->carbonMock($package);

        sleep(10);

        $this->checkExpired($this->token);
    }

    public function buy($token)
    {
        $buy = $this->withHeaders([
            'Authorization' => $token->json('access_token'),
        ])->json('POST', '/api/1.0/buy', ['package_id' => '3', 'mode' => 'online']);

        $buy->assertStatus(200);

        return $buy;
    }

    public function successPayment($buy)
    {

        $success_payment = $this->get('/buy/' . $buy->json('unique_code') . '/test');

        $success_payment->assertStatus(200)
            ->assertSee('کد');
    }

    private function package($id)
    {
        return (new SubscriptionService())->find($id);
    }

    public function carbonMock($package)
    {

        $knownDate = Carbon::now()->addDays($package->duration);
        Carbon::setTestNow($knownDate);

        Artisan::call('ExpirePackageUser:Cron');
    }

    public function checkExpired($token)
    {
        $package = $this->withHeaders([
            'Authorization' => $token->json('access_token'),
        ])->json('POST', '/api/1.0/user/package');

        $package->assertStatus(200)
            ->assertJson([
                'package' => null
            ]);

    }

}
