<x-layout title="Modifica Articolo">
    <div class="formContainer my-5">
        <div class="formWrapper-article">
            <form action="{{route('article.update', compact('article'))}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h2 class="text-center text-warning fs-1">The Aulab Post</h2>
                <h4 class="text-center text-warning">Modifica Articolo</h4>
                @if (session('status'))
                <div class="alert alert-success text-center" role="alert">
                    {{session('status')}}
                </div>
                @endif
                <div class="mb-3">
                    <label for="inputTitle" class="form-label">Titolo</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="inputTitle" value="{{$article->title}}">
                </div>
                @error('title')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3">
                    <label for="inputSubtitle" class="form-label">Sottotitolo</label>
                    <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror" id="inputSubtitle" value="{{$article->subtitle}}">
                </div>
                @error('subtitle')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3 d-flex flex-column">
                    <label for="insertCategory" class="form-label">Categoria</label>
                    <select name="id" id="insertCategory" class="form-select @error('id') is-invalid @enderror">
                        @foreach ($categories as $category)
                        <option value="{{$category['id']}}" @if ($article->category && $category->id == $article->category->id) selected @endif>{{$category['name']}}</option>
                        @endforeach
                    </select>
                </div>
                @error('id')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3">
                    <label for="inputBody" class="form-label">Body</label>
                    <textarea name="body" id="inputBody" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{$article->body}}</textarea>
                </div>
                @error('body')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3">
                    <label for="tags" class="form-label">Tags:</label>
                    <input type="text" name="tags" class="form-control  @error('tags') is-invalid @enderror" id="tags" value="{{$article->tags->implode('name',', ')}}">
                    <span class="small fst-italic">Inserisci i tags separati da una virgola</span>
                </div>
                @error('tags')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <label for="insertImage" class="form-label">Inserisci Immagine</label>
                        <div class="art-bgedit mb-3" style="background-image: url('{{Storage::url($article->image)}}')"></div>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="insertImage">
                    </div>      
                </div>
                @error('image')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="d-flex justify-content-center py-3">
                    <button type="submit" class="btn btn-outline-warning px-4 fs-5 text-uppercase">Modifica</button>
                </div>
            </form>
        </div>
    </div>    
</x-layout>