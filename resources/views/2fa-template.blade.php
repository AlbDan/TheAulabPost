<x-layout title="2FA">
    <div class="formContainer">
        <div class="formWrapper form-loading tfaWrapper tfa-cst my-5">
            @if (!Auth::user()->two_factor_secret)
            <form action="{{url('user/two-factor-authentication')}}" method="POST" class="deactivated">
                @csrf
                <h1 class="text-center text-warning">Verifica a due passaggi</h1>
                <p class="text-center">Non hai attivato la verifica a due passaggi</p>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-warning px-4 fs-5">Attiva</button>
                </div>
                <div class="col-12 d-flex justify-content-center mt-3">
                    <a href="{{route('myProfile')}}" class="text-center link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Torna al mio profilo</a>
                </div>
            </form>
            @else
            <form action="{{url('user/two-factor-authentication')}}" method="POST" class="activated">
                @csrf
                @method('DELETE')
                <div class="container">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h1 class="text-center text-warning">Verifica a due passaggi</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <p>La verifica a due passaggi è attiva</p>
                            <button type="submit" class="btn btn-outline-warning px-4 fs-5">Disattiva</button>
                            <div class="my-4 font-medium text-sm">
                                <p>Hai attivato la verifica a due passaggi, per favore fai la scansione del sequente codice QR nell'applicazione di autentificazione dei tuoi dispositivi mobili</p>
                                {!!auth()->user()->twoFactorQrCodeSvg()!!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <p>Per favore conserva i seguenti codici di recupero in un posto sicuro</p>
                            @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
                            <p>{{trim($code)}}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-center">
                            <a href="{{route('myProfile')}}" class="text-center link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Torna al mio profilo</a>
                        </div>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>    
</x-layout>