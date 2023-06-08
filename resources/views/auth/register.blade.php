<x-layout title="Register">
    <div class="formContainer">
        <div class="formWrapper">
            <form action="{{route('register')}}" method="POST">
                @csrf
                <h2 class="text-center text-warning fs-1">The Aulab Post</h2>
                <h4 class="text-center text-warning">Registrati</h4>
                <div class="mb-3">
                    <label for="inputRealname" class="form-label">Nome</label>
                    <input type="text" name="realname" class="form-control @error('realname') is-invalid @enderror" id="inputRealname" aria-describedby="realnameHelp" value="{{old('realname')}}">
                </div>
                @error('realname')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3">
                    <label for="inputSurname" class="form-label">Cognome</label>
                    <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror" id="inputSurname" aria-describedby="surnameHelp" value="{{old('surname')}}">
                </div>
                @error('surname')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3">
                    <label for="inputCity" class="form-label">Città</label>
                    <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" id="inputCity" aria-describedby="cityHelp" value="{{old('city')}}">
                </div>
                @error('city')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3">
                    <label for="inputUsername" class="form-label">Username</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputUsername" aria-describedby="usernameHelp" value="{{old('name')}}">
                </div>
                @error('name')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" aria-describedby="emailHelp" value="{{old('email')}}">
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
                    <button type="submit" class="btn btn-outline-warning px-4 fs-5 text-uppercase">Registrati</button>
                </div>
            </form>
        </div>
    </div>    
</x-layout>