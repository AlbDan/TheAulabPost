<x-layout title="Leggi Articolo">
    <div class="container my-5">
        <div class="row">
            <div class="col-12 my-3">
                <article class="card bg-dark p-3" data-bs-theme="dark">
                    <header class="d-flex flex-column pb-3 border-bottom border-1">
                        <h3 class="text-center fw-bold">{{$article->title}}</h3>
                        <h4 class="text-center">{{$article->subtitle}}</h4>
                        <div class="d-flex justify-content-center my-3">
                            <div class="card-top-bg" style="background-image: url('{{Storage::url($article->image)}}')"></div>
                        </div>
                        @if ($article->category)
                        <div class="d-flex justify-content-center">
                            <a href="{{route('article.byCategory', $article->category)}}" class="text-center link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">{{$article->category->name}}</a>
                        </div>
                        @else
                        <p class="small text-muted text-center">Articolo senza categoria</p>
                        @endif
                        <address class="text-center mb-1">Articolo redatto da <a rel="author" href="{{route('article.byEditor', $article->user)}}" class="text-center link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">{{$article->user->name}}</a></address> 
                        <time class="text-center">data: {{$article->created_at->format('d/m/Y')}}</time>
                        <p class="small fst-italic text-capitalize text-center my-2">
                            @foreach ($article->tags as $tag)
                            #{{$tag->name}}
                            @endforeach
                        </p>
                    </header>
                    <p class="my-3">{{$article->body}}</p>
                    <div class="d-flex justify-content-center my-3">
                        <a href="{{route('article.index')}}" class="btn btn-outline-warning">Torna indietro</a>
                    </div>
                    @if (Auth::user() && Auth::user()->is_revisor)
                    <div class="d-flex justify-content-center my-3">
                        <a href="{{route('revisor.acceptArticle', compact('article'))}}" class=" mx-3 btn btn-outline-success">Accetta Articolo</a>
                        <a href="{{route('revisor.rejectArticle', compact('article'))}}" class=" mx-3 btn btn-outline-danger">Rifiuta Articolo</a>                    
                    </div>
                    @endif
                </article>
            </div>
        </div>
    </div>
</x-layout>