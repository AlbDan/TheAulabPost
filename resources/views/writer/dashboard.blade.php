<x-layout title="Writer Dashboard">
    
    <div class="container-fluid px-5 my-5 min-vh-100">
        <h1 class="mb-5 pt-5">Writer Dashboard</h1>
        @if (session('status'))
        <div class="alert alert-success text-center" role="alert">
            {{session('status')}}
        </div>
        @endif
        
        <div class="row justify-content-center">
            <div class="col-12">
                <h3>Articoli pubblicati</h3>
                <div class="tableCont">
                    <div class="tableWrapper">
                        <x-writer-articles-table :articles="$acceptedArticles"/>
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
                        <x-writer-articles-table :articles="$rejectedArticles"/> 
                    </div>
                </div>
            </div>
        </div>
        <hr>
        
        <div class="row justify-content-center">
            <div class="col-12">
                <h3>Articoli in fase di revisione</h3>
                <div class="tableCont">
                    <div class="tableWrapper">
                        <x-writer-articles-table :articles="$unrevisionedArticles"/> 
                    </div>                
                </div>
            </div>
        </div>
        <hr>
        
        
        
        
    </div>
    
</x-layout>