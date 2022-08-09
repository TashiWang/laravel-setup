<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo width="82" />
            </a>
        </x-slot>

        <div class="card-body">

            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <!-- Session Status -->
                <x-auth-session-status class="mb-3" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-3" :errors="$errors" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="input-group mb-3">
                        <x-input id="email" type="email" name="email" :value="old('email')" required autofocus
                            autocomplete="email" placeholder="Email" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="appended-icon fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="input-group mb-3">
                        <x-input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="Password" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="appended-icon fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-3">
                        <div class="form-check">
                            <x-checkbox id="remember_me" name="remember" />

                            <label class="form-check-label" for="remember_me">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="mb-0">
                        <div class="d-flex justify-content-end align-items-baseline">
                            @if (Route::has('password.request'))
                                <a class="text-muted me-3" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-button>
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
