<x-app title="Usuarios">
    <section class="container my-5">
        <div class="text-center mb-4">
            <h1 class="display-4 text-primary">Listado de Usuarios</h1>
        </div>

        <div class="card shadow-lg">
            <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                <h3 class="mb-0">Usuarios</h3>
                <a href="{{ route('users.create') }}" class="btn btn-light">Crear Usuario</a>
            </div>
            <div class="card-body">
                <div class="table-responsive my-4 mx-2">
                    <table class="table table-hover" id="user_table">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th scope="col">Cédula</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Email</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->number_id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            {{ $role->name }}{{ !$loop->last ? ',' : '' }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <button class="ms-2 btn btn-danger btn-sm" onclick="deleteForm({{ $user->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <form id="delete_form_{{ $user->id }}" action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <x-slot:scripts>
        <script>
            document.addEventListener("DOMContentLoaded", loadDatatable);

            function loadDatatable() {
                $('#user_table').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
                    },
                    responsive: true
                });
            }

            async function deleteForm(user_id) {
                const response = await Swal.fire({
                    icon: 'warning',
                    title: '¿Está seguro de eliminar?',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                });
                if (!response.isConfirmed) return;
                document.getElementById(`delete_form_${user_id}`).submit();
            }
        </script>
    </x-slot:scripts>
</x-app>
