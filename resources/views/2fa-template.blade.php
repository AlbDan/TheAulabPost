<x-layout title="2FA">
    <div class="formContainer">
        <div class="formWrapper my-5">
            @if (!Auth::user()->two_factor_secret)
            <form action="{{url('user/two-factor-authentication')}}" method="POST">
                @csrf
                <p>Non hai attivato la verifica a due passaggi</p>
                <button type="submit" class="btn btn-outline-warning px-4 fs-5">Attiva</button>
            </form>
            @else
            <form action="{{url('user/two-factor-authentication')}}" method="POST">
                @csrf
                @method('DELETE')
                <p>La verifica a due passaggi è attiva</p>
                <button type="submit" class="btn btn-outline-warning px-4 fs-5">Disattiva</button>
                {{-- @if (session('status') == 'two-factor-authentication-enabled') --}}
                <div class="my-4 font-medium text-sm">
                    <p>Hai attivato la verifica a due passaggi, per favore fai la scansione del sequente codice QR nell'applicazione di autentificazione dei tuoi dispositivi mobili</p>
                    {!!auth()->user()->twoFactorQrCodeSvg()!!}
                    <p class="mt-4">Per favore conserva i seguenti codici di recupero in un posto sicuro</p>
                    @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
                    <p>{{trim($code)}}</p>
                    @endforeach
                </div>
                {{-- @endif --}}
            </form>
            @endif
        </div>
    </div>    
</x-layout>