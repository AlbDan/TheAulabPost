<table class="table" data-bs-theme="dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titolo</th>
            <th scope="col">Sottotitolo</th>
            <th scope="col">Categoria</th>
            <th scope="col"><span>Creato il</span></th>
            <th scope="col">Tags</th>
            <th scope="col" class="text-center">Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            <th scope="row">{{$article->id}}</th>
            <td><p class="strm0-cst">{{$article->title}}</p></td>
            <td><p class="strm0-cst">{{$article->subtitle}}</p></td>
            <td><p class="strm0-cst">{{$article->category->name ?? 'Non categorizzato'}}</p></td>
            <td><p class="date_cst">{{$article->created_at->format('d/m/y')}}</p></td>
            <td>
                <p class="strm1-cst">
                    @foreach ($article->tags as $tag)
                    {{$tag->name}}
                    @endforeach
                </p>
            </td>
            <td class="d-flex justify-content-center">
                <div class="d-flex justify-content-between art-act-cst">
                    <a href="{{route('article.show', compact('article'))}}" class="btn btn-outline-info my-1">Leggi Articolo</a>
                    <a href="{{route('article.edit', compact('article'))}}" class="btn btn-outline-warning my-1">Modifica Articolo</a>
                    <form action="{{route('article.delete', compact('article'))}}" method="POST" class="my-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">Elimina articolo</button>
                    </form>
                </div>
            </td>
        </tr>    
        @endforeach
    </tbody>
</table>