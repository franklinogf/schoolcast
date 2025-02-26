<?php

namespace Tests;

use App\Models\Tenant;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

abstract class TenantCase extends BaseTestCase
{
    public $tenantId = 'test';

    protected function setUp(): void
    {
        parent::setUp();

        $this->initializeTenancy();
    }

    public function initializeTenancy(): void
    {
        Schema::dropDatabaseIfExists("tenant_{$this->tenantId}");

        $tenant = Tenant::create(['id' => $this->tenantId, 'name' => 'Test Tenant']);

        $tenant->domains()->create(['domain' => $this->tenantId]);

        tenancy()->initialize($tenant);

        // URL::forceRootUrl("http://{$this->tenantId}.localhost:8000");
        URL::defaults(['tenant' => $this->tenantId]);
        // URL::forceRootUrl(config('app.url')."/{$this->tenantId}");

    }
}
