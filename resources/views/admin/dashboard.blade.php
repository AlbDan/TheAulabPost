<x-layout title="Admin Dashboard">
    
    <div class="container">
        <h1 class="my-5">Dashboard Admin</h1>    
        @if (session('status'))
        <div class="alert alert-success text-center" role="alert">
            {{session('status')}}
        </div>
        @endif
        <h3>Richieste per ruolo revisor</h3>
        <x-requests-table :roleRequests="$revisorRequests" role="revisor"/>
        <hr>
        <h3>Richieste per ruolo writer</h3>
        <hr>
        <x-requests-table :roleRequests="$writerRequests" role="writer"/>
        <h3>Richieste per ruolo amministratore</h3>
        <hr>
        <x-requests-table :roleRequests="$adminRequests" role="admin"/>
        <hr>
    </div>
    
    
</x-layout>