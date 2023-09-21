<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Fortify;
use Illuminate\Contracts\Support\Responsable;
class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if(request()->is('admin','admin/*')){
            Config::set([
                'fortify.guard' => 'admin',
                'fortify.prefix' => 'admin',
                'fortify.passwords' => 'admins',
                'fortify.username' => 'username',
            ]);
        }

        // $this->app->singleton(LoginResponse::class,function(){
        //     return new class{
        //         public function toResponse($request)
        //         {
        //             $user = $request->user();
        //             if($user instanceof Admin){
        //                 return redirect('admin/2fa');
        //             }
        //             return route('classrooms.index');
        //         } 
        //     };
        // });
         $this->app->instance(LoginResponse::class, new class implements Responsable{
                public function toResponse($request)
                {   
                    $user = $request->user();
                    if($user instanceof Admin){
                        return redirect('admin/2fa');
                    }
                    return redirect()->route('classrooms.index');
                } 
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        // Fortify::authenticateUsing(function (Request $request){
        //     // dd($request);
        //     $user = Admin::whereUsername($request->username)->first();
        //     if ($user && Hash::check($request->password, $user->password)) {
        //         return $user;
        //     }
        // });

        Fortify::viewPrefix('auth.');//لو احنا مسميين الفيوز بالاسماء الافتراضية ومجمعينها بملف بنعملها هيك وخلص
        // Fortify::loginView('auth.login');
        // Fortify::requestPasswordResetLinkView('auth.forgot-password');
        // Fortify::registerView(function(){
        //     return view('auth.register');
        // });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
