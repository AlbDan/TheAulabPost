<x-layout title="Homepage">
    
    <header class="head-welcome head-loading">
        <h1 class="display-1 fw-bold text-warning">The Aulab Post</h1>
    </header>
    
    <div class="container mb-5 min-vh-100">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center display-5 mb-5 newsDescWrapper newsDesc-loading">I nostri ultimi articoli!</h2>
            </div>
        </div>
        <div class="row">
            @foreach ($articles as $article)
            <div class="col-12 col-md-6 my-3">
                <article class="card p-3 crd-cst articleHomeWrapper article-loading" data-bs-theme="dark">
                    <div class="titleWrapper d-flex justify-content-center">
                        <h3 class="text-center fw-bold">{{$article->title}}</h3>
                    </div>
                    <div class="subtitleWrapper d-flex justify-content-center">
                        <h4 class="text-center">{{$article->subtitle}}</h4>
                    </div>
                    <div data-artP="articlePreviewWrapper" class="d-flex justify-content-center my-3">
                        <div class="d-flex flex-column align-items-center justify-content-center cst-art c-me">
                            @if ($article->category)
                            <div>
                                <a href="{{route('article.byCategory', $article->category)}}" class="text-center link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">{{$article->category->name}}</a>
                            </div>
                            @else
                            <p class="small text-muted text-center my-0">Articolo senza categoria</p>
                            @endif
                            <span class="text-muted small fts-italic text-center my-2">- tempo di lettura {{$article->readDuration()}} min</span>
                            <address class="text-center mb-1">Articolo redatto da <a rel="author" href="{{route('article.byEditor', $article->user)}}" class="text-center link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">{{$article->user->name}}</a></address> 
                            <time class="text-center">data: {{$article->created_at->format('d/m/Y')}}</time>
                            <div class="tagsWrapper">
                                <div class="text-warning">
                                    @for ($i = 0; $i < count($article['tags']); $i++)
                                    <a href="{{route('article.byTag', $article['tags'][$i]['id'])}}" class="link-warning text-capitalize link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">{{$article['tags'][$i]['name']}}</a><span>, </span>
                                    @endfor 
                                </div>
                            </div>
                        </div>
                        <div class="cst-art cst-art-bg c-ms" style="background-image: url('{{Storage::url($article->image)}}')"></div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{route('article.show', $article)}}" class="btn btn-outline-warning">Leggi articolo</a>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</x-layout>