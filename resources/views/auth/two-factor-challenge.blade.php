<x-layout title="Conferma password">
    <div class="formContainer">
        <div class="formWrapper form-loading d-flex flex-column">
            <h2 class="text-center text-warning fs-1">The Aulab Post</h2>
            <div id="authChWrapper" class="d-block visible">
                <h4 class="text-center text-warning">Per favore inserisci il tuo codice di autentificazione</h4>  
                <form action="{{url('/two-factor-challenge')}}" method="POST">
                    @csrf
                    <input type="text" class="form-control my-3 @error('code') is-invalid @enderror" name="code">
                    @error('code')
                    <div class="text-danger mb-2">{{$message}}</div>
                    @enderror   
                    <div class="d-flex justify-content-center py-3">
                        <button type="submit" class="btn btn-outline-warning px-4 fs-5 text-uppercase">Conferma</button>
                    </div>
                </form>
                <div class="d-flex justify-content-center">
                    <p id="recoveryCodeWrapper" class="filt-sel-cst d-inline">Usa un codice di recupero</p>
                </div>
            </div>
            <div id="recoveryChWrapper" class="d-none invisible">
                <h4 class="text-center text-warning">Per favore inserisci un tuo codice di recupero</h4>  
                <form action="{{url('/two-factor-challenge')}}" method="POST">
                    @csrf
                    <input type="text" class="form-control my-3 @error('recovery_code') is-invalid @enderror" name="recovery_code">
                    @error('recovery_code')
                    <div class="text-danger mb-2">{{$message}}</div>
                    @enderror   
                    <div class="d-flex justify-content-center py-3">
                        <button type="submit" class="btn btn-outline-warning px-4 fs-5 text-uppercase">Conferma</button>
                    </div>
                </form>
                <div class="d-flex justify-content-center">
                    <p id="authCodeWrapper" class="filt-sel-cst d-inline">Usa il codice di autentificazione</p>
                </div>
            </div>
        </div>
    </div>    
</x-layout>