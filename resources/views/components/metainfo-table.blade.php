<table class="table" data-bs-theme="dark">
    <thead>
        <tr>
            <th scope="col" class="col-1">#</th>
            <th scope="col" class="col-3">Nome tag</th>
            <th scope="col" class="col-2">Q.ta articoli collegati</th>
            <th scope="col" class="col-4 text-center">Aggiorna</th>
            <th scope="col" class="col-2 text-center">Cancella</th>
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
                <div class="d-flex justify-content-center">
                    <div class="inp-upd-cst">
                        <form action="{{route('admin.editTag', ['tag'=>$metaInfo])}}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="name" placeholder="Inserisci nuovo nome tag" class="form-control d-inline me-2 crd-cst-in">
                                <button type="submit" class="btn btn-outline-info">Aggiorna</button>
                            </div>
                        </form>
                    </div>           
                </div>
            </td>
            <td class="d-flex justify-content-center">
                <div class="d-flex justify-content-between">
                    <form action="{{route('admin.deleteTag', ['tag'=>$metaInfo])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Cancella</button>
                    </form>
                </div>
            </td>   
            @else
            <td>
                <div class="d-flex justify-content-center">
                    <div class="inp-upd-cst">
                        <form action="{{route('admin.editCategory', ['category'=>$metaInfo])}}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="name" placeholder="Inserisci nuovo nome categoria" class="form-control d-inline me-2 crd-cst-in">
                                <button type="submit" class="btn btn-outline-info">Aggiorna</button>
                            </div>
                        </form> 
                    </div>
                </div>
            </td>
            <td class="d-flex justify-content-center">
                <div class="d-flex justify-content-between">
                    <form action="{{route('admin.deleteCategory', ['category'=>$metaInfo])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Cancella</button>
                    </form>
                </div>
            </td>
            @endif
        </tr>    
        @endforeach
    </tbody>
</table>