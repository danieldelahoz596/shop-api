<section class="min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 justify-content-center">
                @if (session()->has('message'))
                    <div class="alert alert-success shadow-soft mb-4 mb-lg-5" role="alert">
                        <span class="alert-inner--icon icon-lg"><span class="far fa-thumbs-up"></span></span>
                        <span class="alert-heading">Nice!</span>
                        <p>{{ session('message') }}</p>
                        <hr>
                        <p class="mb-0">You will now be redirected. to login page</p>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger shadow-soft mb-4 mb-lg-5" role="alert">
                        <span class="alert-inner--icon icon-lg">
                            <span class="fas fa-fire"></span>
                        </span>
                        <span class="alert-heading">Oh No!</span>
                        <p>{{ session('error') }}</p>
                        <hr>
                        <p class="mb-0">Please contact the system administrator : {{ env('mail_username') }}</p>
                    </div>
                @endif
                <div class="card shadow-soft border-light p-4">
                    <div class="card-header text-center pb-0">
                        <h2 class="h4">Welcome to {{ config('app.name') }}</h2>
                    </div>
                    <div class="card-body">
                        <form class="mt-4">
                            <!-- Form -->
                            <div class="form-group">
                                <label for="email">Your email</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fas fa-envelope"></span></span>
                                    </div>
                                    <input class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" placeholder="example@company.com" type="text"
                                        aria-label="email adress" wire:model="email" wire:keydown.enter="login">
                                </div>
                                @error('email')
                                    <small><span class="text-danger error">{{ $message }}</span></small>
                                @enderror
                            </div>
                            <!-- End of Form -->
                            <div class="form-group">
                                <!-- Form -->
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><span
                                                    class="fas fa-unlock-alt"></span></span>
                                        </div>
                                        <input class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="Password" type="password"
                                            aria-label="Password" wire:model="password" wire:keydown.enter="login">
                                    </div>
                                    @error('password')
                                        <small><span class="text-danger error">{{ $message }}</span></small>
                                    @enderror
                                </div>
                                <!-- End of Form -->
                                <div class="d-block d-sm-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="remember_me"
                                            name="remember_me" wire:model="remember_me">
                                        <label class="form-check-label" for="remember_me">
                                            Remember me
                                        </label>
                                    </div>
                                    <div><a href="/forgot-password" class="small text-right">Lost password?</a></div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-block btn-primary" wire:click.prevent="login">
                                <span wire:loading>
                                    <span class="spinner-border" role="status">
                                        <span class="visually-hidden"></span>
                                    </span>
                                </span>
                                <span wire:loading.remove>Sign in</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>