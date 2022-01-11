<?php

namespace Tests\Feature;

use Faker\Factory;
use Faker\Generator;
use Faker\Provider\UserAgent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoggerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_logger_request()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $response = $this
                ->withHeaders([
                    'User-Agent' => $faker->userAgent()
                ])
                ->withServerVariables(['REMOTE_ADDR' => $faker->ipv4()])
                ->get(route('logger', ['userId' => rand(1, 10000)]));

            $this->assertEquals(200, $response->getStatusCode());
        }
    }
}
