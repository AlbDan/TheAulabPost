<x-layout title="Forgot password">
    <div class="formContainer">
        <div class="formWrapper">
            <form action="{{route('password.request')}}" method="POST">
                @csrf
                <h2 class="text-center text-warning fs-1">The Aulab Post</h2>
                <h4 class="text-center text-warning">Reset Password</h4>
                @if (session('status'))
                <div class="alert alert-success text-center" role="alert">
                    {{session('status')}}
                </div>
                @endif
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" aria-describedby="emailHelp">
                </div>
                @error('email')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror           
                <div class="d-flex justify-content-center py-3">
                    <button type="submit" class="btn btn-outline-warning px-4 fs-5 text-uppercase">Invia</button>
                </div>
            </form>
        </div>
    </div>    
</x-layout>