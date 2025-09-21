<?php

namespace AaqibShahzad\ScaleKit\Tests\Feature;

use Orchestra\Testbench\TestCase;
use AaqibShahzad\ScaleKit\ScaleKitServiceProvider;

class SocialiteTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ScaleKitServiceProvider::class];
    }

    public function test_basic_route_registered()
    {
        $response = $this->getJson('/scalekit/oauth/google/redirect');
        $response->assertStatus(302); // redirects to Google
    }
}