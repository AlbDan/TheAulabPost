<x-layout title="Revisor Dashboard">
    
    <div class="container my-5 pt-5 min-vh-100">
        <h1 class="mb-5">Revisor Dashboard</h1>
        @if (session('status'))
        <div class="alert alert-success text-center" role="alert">
            {{session('status')}}
        </div>
        @endif
        
        <div class="row justify-content-center">
            <div class="col-12">
                <h3>Articoli da revisionare</h3>
                <div class="tableCont">
                    <div class="tableWrapper">
                        <x-articles-table :articles="$pendingArticles"/> 
                    </div>
                </div>
            </div>
        </div>
        <hr>
        
        <div class="row justify-content-center">
            <div class="col-12">
                <h3>Articoli accettati</h3>
                <div class="tableCont">
                    <div class="tableWrapper">
                        <x-articles-table :articles="$accepterArticles"/>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        
        <div class="row justify-content-center">
            <div class="col-12">
                <h3>Articoli rifiutati</h3>
                <div class="tableCont">
                    <div class="tableWrapper">
                        <x-articles-table :articles="$rejectedArticles"/>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
    
</x-layout>