<table class="table bg-dark" data-bs-theme="dark">
    <thead>
        <tr>
            <th scope="col" class="col-1">#</th>
            <th scope="col" class="col-3">Nome tag</th>
            <th scope="col" class="col-2">Q.ta articoli collegati</th>
            <th scope="col" class="col-4">Aggiorna</th>
            <th scope="col" class="col-2">Cancella</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach ($metaInfos as $metaInfo)
        <tr>
            <th scope="row">{{$metaInfo->id}}</th>
            <td>{{$metaInfo->name}}</td>
            <td>{{count($metaInfo->articles)}}</td>
            @if ($metaType == "tags")
            <td>
                <form action="{{route('admin.editTag', ['tag'=>$metaInfo])}}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="text" name="name" placeholder="Inserisci nuovo nome tag" class="form-control w-50 d-inline">
                    <button type="submit" class="btn btn-outline-info">Aggiorna</button>
                </form>
            </td>
            <td>
                <form action="{{route('admin.deleteTag', ['tag'=>$metaInfo])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Cancella</button>
                </form>
            </td>   
            @else
            <td>
                <form action="{{route('admin.editCategory', ['category'=>$metaInfo])}}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="text" name="name" placeholder="Inserisci nuovo nome categoria" class="form-control w-50 d-inline">
                    <button type="submit" class="btn btn-outline-info">Aggiorna</button>
                </form>
            </td>
            <td>
                <form action="{{route('admin.deleteCategory', ['category'=>$metaInfo])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Cancella</button>
                </form>
            </td>
            @endif
        </tr>    
        @endforeach
        
    </tbody>
</table>