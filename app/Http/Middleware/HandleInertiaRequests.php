<?php

namespace App\Http\Middleware;

use App\Models\User;
use Inertia\Middleware;
use App\Models\Vendedor;
use Illuminate\Http\Request;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = User::query()->find($request->user()->id, ['id', 'name', 'email']);
        $vendedor = Vendedor::query()->where('id_user', $user?->id)->first(['nome', 'alias', 'email', 'telefone']);

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $user,
                'vendedor' => $vendedor
            ],
        ];
    }
}
