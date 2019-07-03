<?php

namespace Tests\Feature;

use App\Services\SubscriptionService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class TestUsersHaveReservePackage extends TestCase
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

    public function testHavePackage()
    {

        $buy = $this->buy($this->token);

        $this->successPayment($buy);

        $package = $this->package($this->package_id);

        $this->carbon5DaysToExpireMock($package);

        sleep(10);

        $buy_reserve = $this->buy($this->token);

        $this->successPayment($buy_reserve);

        $this->carbonMock($package);

        sleep(10);

        Artisan::call('ActivePackageUser:Cron');

        sleep(10);

        $this->checkNotExpired($this->token);
    }

    /**
     * @param $token
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function buy($token)
    {
        $buy = $this->withHeaders([
            'Authorization' => $token->json('access_token'),
        ])->json('POST', '/api/1.0/buy', ['package_id' => $this->package_id, 'mode' => 'online']);

        $buy->assertStatus(200);

        return $buy;
    }

    public function successPayment($buy)
    {

        $success_payment = $this->get('/buy/' . $buy->json('unique_code') . '/test');

        $success_payment->assertStatus(200)
            ->assertSee('کد');
    }

    public function carbon5DaysToExpireMock($package)
    {
        $knownDate = Carbon::now()->addDays($package->duration)->subDays(5);
        Carbon::setTestNow($knownDate);

        Artisan::call('Notify5DaysExpirePackageUser:Cron');
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
    public function checkNotExpired($token)
    {
        $package = $this->withHeaders([
            'Authorization' => $token->json('access_token'),
        ])->json('POST', '/api/1.0/user/package');

        $package->assertStatus(200);

    }

    private function package($id)
    {
        return (new SubscriptionService())->find($id);
    }
}
