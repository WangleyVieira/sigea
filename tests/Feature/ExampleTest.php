<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Basic smoke test: confirms web routes are loaded.
     *
     * @return void
     */
    public function testLoginRouteIsRegistered()
    {
        $this->assertTrue(Route::has('login'));
    }
}
