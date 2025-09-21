<?php

return [

    // Multi-tenant option (single-db approach)
    'tenant' => [
        'enabled' => env('SCALEKIT_TENANCY', false),
        'tenant_header' => 'X-Tenant-ID', // or use subdomain mapping
        'tenant_column' => 'tenant_id',
    ],

    // OAuth providers (enable the providers you want)
    'oauth_providers' => [
        'google' => env('SCALEKIT_PROVIDER_GOOGLE', true),
        'github' => env('SCALEKIT_PROVIDER_GITHUB', true),
        'linkedin' => env('SCALEKIT_PROVIDER_LINKEDIN', false),
    ],

    // Spatie integration toggle
    'roles' => [
        'enabled' => env('SCALEKIT_ROLES', true),
    ],

    // Sanctum User Model
    'user_model' => \Aaqibshahzad\Scalekit\Models\User::class,
];