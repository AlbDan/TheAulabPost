<x-layout title="Revisor Dashboard">

    <div class="container">
        <h1 class="my-5">Revisor Dashboard</h1>
        @if (session('status'))
        <div class="alert alert-success text-center" role="alert">
            {{session('status')}}
        </div>
        @endif
        <h3>Articoli da revisionare</h3>
        <x-articles-table :articles="$pendingArticles"/>
        <hr>
        <h3>Articoli accettati</h3>
        <x-articles-table :articles="$accepterArticles"/>
        <hr>
        <h3>Articoli rifiutati</h3>
        <x-articles-table :articles="$rejectedArticles"/>
        <hr>
    </div>
    
</x-layout>