<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $headers = [];
    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate:refresh');
        Artisan::call('passport:install');

        $this->headers = ['Content-Type' => 'application/json', 'X-Requested-With' => 'XMLHttpRequest'];
    }
}
