<table class="table" data-bs-theme="dark">
    <thead>
        <tr>
            <th scope="col" class="col-1">#</th>
            <th scope="col" class="col-3">Titolo</th>
            <th scope="col" class="col-3">Sottotitolo</th>
            <th scope="col" class="col-1">Redattore</th>
            <th scope="col" class="col-4 text-center">Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            <th scope="row">{{$article->id}}</th>
            <td><p class="strm1-cst">{{$article->title}}</p></td>
            <td><p class="strm1-cst">{{$article->subtitle}}</p></td>
            <td><p class="strm0-cst">{{$article->user->name}}</p></td>
            <td>
                <div class="art-act1-cst">
                    @if (is_null($article->is_accepted))
                    <a href="{{route('article.show', compact('article'))}}" class="btn btn-outline-info">Leggi Articolo</a>
                    <a href="{{route('revisor.acceptArticle', compact('article'))}}" class="btn btn-outline-success">Accetta Articolo</a>
                    <a href="{{route('revisor.rejectArticle', compact('article'))}}" class="btn btn-outline-danger">Rifiuta Articolo</a>                    
                    @else
                    <a href="{{route('revisor.undoArticle', compact('article'))}}" class="btn btn-outline-warning">Riporta in revisione</a>            
                    @endif          
                </div>
            </td>
        </tr>    
        @endforeach
    </tbody>
</table>