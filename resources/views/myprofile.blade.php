<x-layout title="Il mio profilo">
    <div class="min-vh-100 mt-5 d-flex align-items-center justify-content-center">
        <div class="myprofile-wrapper form-loading">
            <h1 class="text-center mb-3">Il mio profilo</h1>
            <div class="row fs-5 mb-4 pb-2 border-bottom border-1 border-warning">
                <div class="col-12 col-sm-4">
                    <p class="my-1">Username:</p>
                </div>
                <div class="col-12 col-sm-8 text-sm-end">
                    <p class="text-white my-1 break-l-w">{{Auth::user()->name}}</p>
                </div> 
            </div>
            <div class="fs-5 mb-4 pb-2 border-bottom border-1 border-warning"> 
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <p class="my-1 me-3">Email:</p>
                    </div>
                    <div class="col-12 col-sm-8 text-sm-end">
                        <p class="text-white my-1 break-l-w">{{Auth::user()->email}}</p>
                    </div>
                </div>
                @if (!Auth::user()->email_verified_at)
                <div class="d-flex justify-content-sm-end">
                    <a href="{{route('verification.notice')}}" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover fs-5">Verifica la tua email</a>
                </div>            
                @endif
            </div>
            <div class="row fs-5 mb-4 pb-2 border-bottom border-1 border-warning">
                <div class="col-12 col-sm-4">
                    <p class="my-1">Nome:</p>
                </div>
                <div class="col-12 col-sm-8 text-sm-end">
                    <p class="text-white my-1 break-l-w">{{Auth::user()->detail->realname}}</p>
                </div> 
            </div>
            <div class="row fs-5 mb-4 pb-2 border-bottom border-1 border-warning">
                <div class="col-12 col-sm-4">
                    <p class="my-1">Cognome:</p>
                </div>
                <div class="col-12 col-sm-8 text-sm-end">
                    <p class="text-white my-1 break-l-w">{{Auth::user()->detail->surname}}</p>
                </div> 
            </div>
            <div class="row fs-5 mb-4 pb-2 border-bottom border-1 border-warning">
                <div class="col-12 col-sm-4">
                    <p class="my-1">Città:</p>
                </div>
                <div class="col-12 col-sm-8 text-sm-end">
                    <p class="text-white my-1 break-l-w">{{Auth::user()->detail->city}}</p>
                </div> 
            </div>
            <div class="mb-4 pb-2 d-flex justify-content-center"> 
                <a href="{{route('modMyProfile')}}" class="btn btn-outline-warning fs-5 px-5 py-3">Modifica profilo</a>
            </div>
            <div class="fs-5 d-flex justify-content-center"> 
                <a href="{{route('twoFA')}}" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Configura la verifica a due passaggi</a>
            </div>
        </div>       
    </div>
</x-layout>