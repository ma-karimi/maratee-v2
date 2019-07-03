<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Torann\GeoIP\Services\AbstractService;
use Torann\GeoIP\Support\HttpClient;

class LocationCheck extends AbstractService
{

    /**
     * Http client instance.
     *
     * @var HttpClient
     */
    protected $client;

    /**
     * The "booting" method of the service.
     *
     * @return void
     */
    public function boot()
    {
        $this->client = new HttpClient([
            'base_uri' => 'http://api.foobar-ip-to-location.com/',
            'query' => [
                'some_option' => $this->config('some_option'),
            ],
        ]);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle($request, Closure $next)
    {
        if ($locate = $this->locate($request->ip())) {
            $request->headers->set('lat' ,$locate['lat']);
            $request->headers->set('lng' ,$locate['lng']);
        }
        return $next($request);
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function locate($ip)
    {
        $data = geoip()->getLocation($ip);
        //  Parse body content
        return [
            'ip' => $ip,
            'city' => $data['city'],
            'state' => $data['state'],
            'state_name' => $data['state_name'],
            'lat' => $data->lat,
            'lng' => $data->lon,
        ];
    }
}
