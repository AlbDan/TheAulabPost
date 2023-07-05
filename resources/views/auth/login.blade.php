<x-layout title="Login">
    <div class="formContainer">
        <div class="formWrapper form-loading">
            <form action="{{route('login')}}" method="POST">
                @csrf
                <h2 class="text-center text-warning fs-1">The Aulab Post</h2>
                <h4 class="text-center text-warning">Login</h4>
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" aria-describedby="emailHelp">
                </div>
                @error('email')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword">
                </div>
                @error('password')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Ricordati di me</label>
                </div>
                <div class="mb-3">
                    <a href="{{url('auth/google')}}" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Login con Google</a>
                </div>    
                <div class="mb-3">
                    <a href="{{route('password.request')}}" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Password dimenticata?</a>
                </div>               
                <div class="d-flex justify-content-center py-3">
                    <button type="submit" class="btn btn-outline-warning px-4 fs-5 text-uppercase">Login</button>
                </div>
            </form>
        </div>
    </div>    
</x-layout>