<x-layout title="Conferma password">
    <div class="formContainer">
        <div class="formWrapper form-loading">
            <form action="{{url('user/confirm-password')}}" method="POST">
                @csrf
                <h2 class="text-center text-warning fs-1">The Aulab Post</h2>
                <h4 class="text-center text-warning">Conferma la tua Password</h4>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword">
                </div>
                @error('password')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror             
                <div class="d-flex justify-content-center py-3">
                    <button type="submit" class="btn btn-outline-warning px-4 fs-5 text-uppercase">Conferma</button>
                </div>
            </form>
        </div>
    </div>    
</x-layout>