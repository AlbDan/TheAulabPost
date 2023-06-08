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
                        <a href="{{route('article.byCategory', $article->category)}}" class="text-center link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">{{$article->category->name}}</a>
                        <address class="text-center mb-1">Articolo redatto da <a rel="author" href="{{route('article.byEditor', $article->user)}}" class="text-center link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">{{$article->user->name}}</a></address> 
                        <time class="text-center">data: {{$article->created_at->format('d/m/Y')}}</time>
                    </header>
                    <p class="my-3">{{$article->body}}</p>
                </article>
            </div>
        </div>
    </div>
</x-layout>