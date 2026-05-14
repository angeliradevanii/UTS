<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeRedirectTest extends TestCase
{
    use RefreshDatabase;

    public function test_root_redirects_to_balitas_index(): void
    {
        $this->get('/')->assertRedirect(route('balitas.index'));
    }
}
