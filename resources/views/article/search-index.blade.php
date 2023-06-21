<x-layout title="Articoli cercati">
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center display-5">Risultati per la ricerca: {{$query}}</h2>
            </div>
            @foreach ($articles as $article)
            <div class="col-12 my-3">
                <article class="card bg-dark p-3" data-bs-theme="dark">
                    <h3 class="text-center fw-bold">{{$article->title}}</h3>
                    <h4 class="text-center">{{$article->subtitle}}</h4>
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
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{route('article.show', $article)}}" class="btn btn-outline-warning">Leggi articolo</a>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</x-layout>