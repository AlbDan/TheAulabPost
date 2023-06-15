<table class="table bg-dark" data-bs-theme="dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Azioni</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach ($roleRequests as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                @switch($role)
                @case('revisor')
                <a href="{{route('admin.setRevisor', compact('user'))}}" class="btn btn-outline-warning">Attiva Ruolo {{$role}}</a>
                <a href="{{route('admin.dontsetRevisor', compact('user'))}}" class="btn btn-outline-danger">Rifiuta Ruolo {{$role}}</a>

                @break
                @case('writer')
                <a href="{{route('admin.setWriter', compact('user'))}}" class="btn btn-outline-warning">Attiva Ruolo {{$role}}</a>
                <a href="{{route('admin.dontsetWriter', compact('user'))}}" class="btn btn-outline-danger">Rifiuta Ruolo {{$role}}</a>

                @break
                @case('admin')
                <a href="{{route('admin.setAdmin', compact('user'))}}" class="btn btn-outline-warning">Attiva Ruolo {{$role}}</a>
                <a href="{{route('admin.dontsetAdmin', compact('user'))}}" class="btn btn-outline-danger">Rifiuta Ruolo {{$role}}</a>

                @break
                @endswitch
            </td>
        </tr>      
        @endforeach
        
    </tbody>
</table>