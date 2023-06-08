<x-layout title="Il mio profilo">
    <div class="d-flex justify-content-center align-center">
        <div class="myprofile-wrapper f-kanit">
            <h1 class="text-center">Il mio profilo</h1>
            <div class="fs-3 my-2 py-2 border-bottom border-1 border-warning d-flex justify-content-between"> 
                <p>Username:</p>
                <p class="text-white">{{Auth::user()->name}}</p>
            </div>
            <div class="fs-3 my-2 py-2 border-bottom border-1 border-warning"> 
                <div class="d-flex justify-content-between">
                    <p>Email:</p>
                    <p class="text-white">{{Auth::user()->email}}</p>
                </div>
                @if (!Auth::user()->email_verified_at)
                <div class="d-flex justify-content-center">
                    <a href="{{route('verification.notice')}}" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Verifica la tua email</a>
                </div>            
                @endif
            </div>
            <div class="fs-3 my-2 py-2 border-bottom border-1 border-warning d-flex justify-content-between"> 
                <p>Nome:</p>
                <p class="text-white">{{Auth::user()->detail->realname}}</p>
            </div>
            <div class="fs-3 my-2 py-2 border-bottom border-1 border-warning d-flex justify-content-between"> 
                <p>Cognome:</p>
                <p class="text-white">{{Auth::user()->detail->surname}}</p>
            </div>
            <div class="fs-3 my-2 py-2 border-bottom border-1 border-warning d-flex justify-content-between"> 
                <p>Città:</p>
                <p class="text-white">{{Auth::user()->detail->city}}</p>
            </div>
            <div class="mt-4 py-2 d-flex justify-content-center"> 
                <a href="{{route('modMyProfile')}}" class="btn btn-outline-warning fs-5 px-5 py-3">Modifica profilo</a>
            </div>
            <div class="fs-3 my-2 py-2 d-flex justify-content-center"> 
                <a href="{{route('twoFA')}}" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Configura la verifica a due passaggi</a>
            </div>
        </div>
    </div>
</x-layout>