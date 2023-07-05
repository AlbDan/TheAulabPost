<x-layout title="Reset password">
    <div class="formContainer">
        <div class="formWrapper form-loading">
            <form action="{{route('password.update')}}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{$request->route('token')}}">
                <h2 class="text-center text-warning fs-1">The Aulab Post</h2>
                <h4 class="text-center text-warning">Reset Password</h4>
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" aria-describedby="emailHelp" value="{{$request->email}}">
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
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Conferma Password</label>
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="inputPassword">
                </div>
                @error('password_confirmation')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror           
                <div class="d-flex justify-content-center py-3">
                    <button type="submit" class="btn btn-outline-warning px-4 fs-5 text-uppercase">Aggiorna</button>
                </div>
            </form>
        </div>
    </div>    
</x-layout>