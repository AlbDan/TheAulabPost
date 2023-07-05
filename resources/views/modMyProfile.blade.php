<x-layout title="Modifica Profilo">
    <div class="formContainer mt-5">
        <div class="formWrapper form-loading my-5">
            <form action="{{route('user-profile-information.update')}}" method="POST">
                @csrf
                @method('PUT')
                <h2 class="text-center text-warning fs-1">The Aulab Post</h2>
                <h4 class="text-center text-warning">Modifica Profilo</h4>
                @if (session('status'))
                <div class="alert alert-success text-center" role="alert">
                    {{session('status')}}
                </div>
                @endif
                <div class="mb-3">
                    <label for="inputRealname" class="form-label">Nome</label>
                    <input type="text" name="realname" class="form-control @error('realname') is-invalid @enderror" id="inputRealname" aria-describedby="realnameHelp" value="{{Auth::user()->detail->realname}}">
                </div>
                @error('realname')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3">
                    <label for="inputSurname" class="form-label">Cognome</label>
                    <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror" id="inputSurname" aria-describedby="surnameHelp" value="{{Auth::user()->detail->surname}}">
                </div>
                @error('surname')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3">
                    <label for="inputCity" class="form-label">Città</label>
                    <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" id="inputCity" aria-describedby="cityHelp" value="{{Auth::user()->detail->city}}">
                </div>
                @error('city')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3">
                    <label for="inputUsername" class="form-label">Username</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputUsername" aria-describedby="usernameHelp" value="{{Auth::user()->name}}">
                </div>
                @error('name')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" aria-describedby="emailHelp" value="{{Auth::user()->email}}">
                </div>
                @error('email')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="d-flex justify-content-center py-3">
                    <button type="submit" class="btn btn-outline-warning px-4 fs-5 text-uppercase">Modifica</button>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{route('myProfile')}}" class="text-center link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Torna al mio profilo</a>
                </div>
            </form>
        </div>
    </div>    
</x-layout>