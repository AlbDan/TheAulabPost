<x-layout title="Articoli per autore">
    <div class="container my-5 min-vh-100">
        <div class="row">
            <div class="col-12 mt-5">
                <h2 class="text-center display-5 my-5">Redattore: {{$user->name}}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6 col-xxl-4">
                <div class="row">
                    <div class="col-12 col-sm-5 my-3 d-flex justify-content-center">
                        <p class="m-0 fs-3">Ordina per:</p>                    
                    </div>
                    <div class="col-12 col-sm-7 my-3 d-flex justify-content-center">
                        <div class="filter-container">
                            <div class="filter-selected">
                                <p class="my-2 filt-sel-cst">Articoli più recenti</p>
                            </div>
                            <div class="container-list-cst">
                                <div class="cont-inner-cst">
                                    <ul class="list-cst">
                                        <li><a href="{{route('article.byEditorNewest', $user)}}" id="ArtByNewest" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Articoli più recenti</a></li>
                                        <li><a href="{{route('article.byEditorOldest', $user)}}" id="ArtByOldest" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Articoli più vecchi</a></li>                                    
                                    </ul>
                                </div>
                            </div>
                        </div>                    
                    </div>                 
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($articles as $article)
            <div class="col-12 col-md-6 my-3">
                <article class="card p-3 crd-cst articleWrapper article-loading" data-bs-theme="dark">
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
        <div class="row">
            <div class="d-flex justify-content-center align-items-center h3">
                {{-- @if ($articles->currentPage()!=1)
                    <a href="{{$articles->previousPageUrl()}}" class="me-3 text-white">
                        <div class="arrow-cst">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                            </svg>
                        </div>  
                    </a>
                    @endif --}}
                    @switch(true)
                    @case($articles->lastPage()<=5)
                    @for($i=1;$i<=$articles->lastPage();$i++)
                    <a href="{{$articles->url($i)}}" class="mx-1 @if($articles->currentPage()==$i) sel-cst-act @else sel-cst @endif"><span class="sel-cst1">{{$i}}</span></a>
                    @endfor
                    @break
                    @case($articles->currentPage()<4)
                    @for($i=1;$i<=4;$i++)
                    <a href="{{$articles->url($i)}}" class="mx-1 @if($articles->currentPage()==$i) sel-cst-act @else sel-cst @endif"><span class="sel-cst1">{{$i}}</span></a>
                    @endfor
                    <div class="dots-cst"><span class="dots-cst1">...</span></div> 
                    <a href="{{$articles->url($articles->lastPage())}}" class="mx-1 sel-cst"><span class="sel-cst1">{{$articles->lastPage()}}</span></a>
                    @break
                    @case($articles->currentPage()<$articles->lastPage()-2)
                    <a href="{{$articles->url(1)}}" class="mx-1 sel-cst"><span class="sel-cst1">{{1}}</span></a>
                    <div class="dots-cst"><span class="dots-cst1">...</span></div> 
                    @for ($i = $articles->currentPage()-1; $i <= $articles->currentPage()+1; $i++)
                    <a href="{{$articles->url($i)}}" class="mx-1 @if($articles->currentPage()==$i) sel-cst-act @else sel-cst @endif"><span class="sel-cst1">{{$i}}</span></a>
                    @endfor
                    <div class="dots-cst"><span class="dots-cst1">...</span></div> 
                    <a href="{{$articles->url($articles->lastPage())}}" class="mx-1 sel-cst"><span class="sel-cst1">{{$articles->lastPage()}}</span></a>
                    @break
                    @default
                    <a href="{{$articles->url(1)}}" class="mx-1 sel-cst"><span class="sel-cst1">{{1}}</span></a>
                    <div class="dots-cst"><span class="dots-cst1">...</span></div> 
                    @for($i=$articles->lastPage()-3;$i<=$articles->lastPage();$i++)
                    <a href="{{$articles->url($i)}}" class="mx-1 @if($articles->currentPage()==$i) sel-cst-act @else sel-cst @endif"><span class="sel-cst1">{{$i}}</span></a>
                    @endfor       
                    @endswitch
                    {{-- @if ($articles->currentPage()!=$articles->lastPage())
                        <a href="{{$articles->nextPageUrl()}}" class="ms-3 text-white">
                            <div class="arrow-cst">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </div>  
                        </a>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>