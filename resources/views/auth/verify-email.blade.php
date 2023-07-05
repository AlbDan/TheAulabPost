<x-layout title="Verifica email">
    <div class="formContainer">
        <div class="formWrapper form-loading">
            <form action="{{route('verification.send')}}" method="POST">
                @csrf
                <h2 class="text-center text-warning fs-1">The Aulab Post</h2>
                <h4 class="text-center text-warning">Verifica la tua email</h4>
                @if (session('status'))
                <div class="alert alert-success text-center" role="alert">
                    {{session('status')}}
                </div>
                @endif  
                <p class="my-3">Ti abbiamo inviato una email per verificare la tua email, se l'email non è arrivata rinvia l'email.</p>            
                <div class="d-flex justify-content-center py-3">
                    <button type="submit" class="btn btn-outline-warning px-4 fs-5">Rinvia Email</button>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{route('myProfile')}}" class="text-center link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Torna al mio profilo</a>
                </div>
            </form>
        </div>
    </div>    
</x-layout>