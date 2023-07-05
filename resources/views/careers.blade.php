<x-layout title="Careers">
    <div class="formContainer">
        <div class="formWrapper form-loading">
            <form action="{{route('careers.submit')}}" method="POST">
                @csrf
                <h2 class="text-center text-warning fs-1">The Aulab Post</h2>
                <h4 class="text-center text-warning">Lavora con noi</h4>
                @if (session('status'))
                <div class="alert alert-success text-center" role="alert">
                    {{session('status')}}
                </div>
                @endif
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" value="{{Auth::user()->email}}" readonly required>
                </div>
                @error('email')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3">
                    <label for="selectRole" class="form-label">Scegli il tuo ruolo</label>
                    <select id="selectRole" name="role" class="form-select @error('role') is-invalid @enderror" aria-label="selectRole" required>
                        <option selected>Seleziona qui il tuo ruolo</option>
                        <option value="writer">Scrittore</option>
                        <option value="revisor">Revisore</option>
                        <option value="admin">Amministratore</option>
                    </select>
                </div>
                @error('role')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                
                <div class="mb-3">
                    <label for="msg" class="form-label">Presentati</label>
                    <div class="form-floating">
                        <textarea class="form-control @error('msg') is-invalid @enderror" name="msg" maxlength="150" style="height: 100px" required>{{old('msg')}}</textarea>
                        <label for="floatingTextarea2">Massimo 150 caratteri</label>
                    </div>
                </div>
                @error('msg')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                
                <div class="d-flex justify-content-center py-3">
                    <button type="submit" class="btn btn-outline-warning px-4 fs-5 text-uppercase">Invia</button>
                </div>
            </form>
        </div>
    </div>    
</x-layout>