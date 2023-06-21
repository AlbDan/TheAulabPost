<x-layout title="Inserisci Articolo">
    <div class="formContainer my-5">
        <div class="formWrapper-article">
            <form action="{{route('article.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2 class="text-center text-warning fs-1">The Aulab Post</h2>
                <h4 class="text-center text-warning">Inserisci Articolo</h4>
                @if (session('status'))
                <div class="alert alert-success text-center" role="alert">
                    {{session('status')}}
                </div>
                @endif
                <div class="mb-3">
                    <label for="inputTitle" class="form-label">Titolo</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="inputTitle" value="{{old('title')}}">
                </div>
                @error('title')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3">
                    <label for="inputSubtitle" class="form-label">Sottotitolo</label>
                    <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror" id="inputSubtitle" value="{{old('subtitle')}}">
                </div>
                @error('subtitle')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3 d-flex flex-column">
                    <label for="insertCategory" class="form-label">Categoria</label>
                    <select name="id" id="insertCategory" class="form-select @error('id') is-invalid @enderror">
                        <option selected>Scegli una categoria</option>
                        @foreach ($categories as $category)
                        <option value="{{$category['id']}}">{{$category['name']}}</option>
                        @endforeach
                    </select>
                </div>
                @error('id')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="mb-3">
                    <label for="inputBody" class="form-label">Body</label>
                    <textarea name="body" id="inputBody" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{old('body')}}</textarea>
                </div>
                @error('body')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror

                <div class="mb-3">
                    <label for="tags" class="form-label">Tags:</label>
                    <input type="text" name="tags" class="form-control" id="tags" value="{{old('tags')}}">
                    <span class="small fst-italic">Inserisci i tags separati da una virgola</span>
                </div>

                <div class="mb-3">
                    <label for="insertImage" class="form-label">Inserisci Immagine</label>
                    <input type="file" name="image" class="form-control w-25 @error('image') is-invalid @enderror" id="insertImage">
                </div>
                @error('image')
                <div class="text-danger mb-2">{{$message}}</div>
                @enderror
                <div class="d-flex justify-content-center py-3">
                    <button type="submit" class="btn btn-outline-warning px-4 fs-5 text-uppercase">Inserisci</button>
                </div>
            </form>
        </div>
    </div>    
</x-layout>