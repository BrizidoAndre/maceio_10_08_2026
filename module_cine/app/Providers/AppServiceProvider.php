<?php

namespace App\Providers;

use App\Exceptions\ApiException;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Model::unguard();
        Model::automaticallyEagerLoadRelationships();
        JsonResource::withoutWrapping();

        \Auth::viaRequest('api', function (Request $request) {
            $bearer = $request->bearerToken();
            $user = Customer::where('token', $bearer)->first();
            if (!$bearer || !$user) {
                throw new ApiException(401, [
                    'message' => 'Unauthenticated',
                ]);
            }
            return $user;
        });

    }
}
