<x-layout title="Admin Dashboard">
    
    <div class="container my-5 pt-5 min-vh-100>
        <h1 class="mb-5">Dashboard Admin</h1>    
        @if (session('status'))
        <div class="alert alert-success text-center" role="alert">
            {{session('status')}}
        </div>
        @endif
        @error('name')
        <div class="alert alert-danger text-center" role="alert">
            {{$message}}
        </div>
        @enderror
        
        <div class="row justify-content-center">
            <div class="col-12">
                <h3>Richieste per ruolo revisor</h3>
                <div class="tableCont">
                    <div class="tableWrapper">
                        <x-requests-table :roleRequests="$revisorRequests" role="revisor"/>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        
        <div class="row justify-content-center">
            <div class="col-12">
                <h3>Richieste per ruolo writer</h3>
                <div class="tableCont">
                    <div class="tableWrapper">
                        <x-requests-table :roleRequests="$writerRequests" role="writer"/> 
                    </div>
                </div>
            </div>
        </div>
        <hr>
        
        <div class="row justify-content-center">
            <div class="col-12">
                <h3>Richieste per ruolo amministratore</h3>
                <div class="tableCont">
                    <div class="tableWrapper">
                        <x-requests-table :roleRequests="$adminRequests" role="admin"/> 
                    </div>
                </div>
            </div>
        </div>
        <hr>
        
        <div class="row justify-content-center">
            <div class="col-12">
                <h3>I tags della piattaforma</h3>
                <div class="tableCont">
                    <div class="tableWrapper">
                        <x-metainfo-table :metaInfos="$tags" metaType="tags"/>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        
        <div class="row">
            <div class="col-12">
                <h3>Le categorie della piattaforma</h3>
                <div class="tableCont">
                    <div class="tableWrapper">
                        <x-metainfo-table :metaInfos="$categories" metaType="categories"/> 
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <h3>Crea una nuova categoria</h3>
                <form action="{{route('admin.storeCategory')}}" method="POST" class="d-flex crd-cst p-3 border-cst">
                    @csrf
                    <input type="text" name="name" class="form-control me-2" placeholder="Inserisci una nuova categoria">
                    <button type="submit" class="btn btn-outline-light">Aggiungi</button>
                </form>
            </div>
        </div>
        <hr>  
    </div>
    
</x-layout>