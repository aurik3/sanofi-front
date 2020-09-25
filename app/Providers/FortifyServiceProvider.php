<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Controllers\SFSessionController;
use App\Http\Controllers\SFTokenController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::loginView(function () {
            return view('login');
        });
        Fortify::authenticateUsing(function (Request $request) {
            $sessionController = new SFSessionController();
            $username = $request -> username;
            $password = $request -> password;
            $sessionStatus = $sessionController -> login($username, $password, 'CLIENT');
            if ($sessionStatus) {
                $user = User::where('username', $username) -> first();
                if ($user) {
                    if (Hash::check($password, $user -> password)) {
                        return $user;
                    }
                    $user -> password = $password;
                    $user -> save();
                    return $user;
                }
                $tmpUser = new User();
                $tmpUser -> username = $username;
                $tmpUser -> password = Hash::make($password);
                $tmpUser -> save();
                return $tmpUser;
            }
            return false;
        });
    }
}
