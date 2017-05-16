<h1>Hola mundo</h1>

<div class="table-responsive" >
    <table  class="table table-striped table-bordered table-condensed table-hover">
        <thead>
        <tr>
            <th>codigo</th>
            <th>Nombre</th>
            <th>Email</th>
        </tr>
        </thead>

        <tbody>
        @foreach($user as $usuario)
            <tr role="row" class="odd">

                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->nombres}}</td>
                <td>{{ $usuario->email }}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
