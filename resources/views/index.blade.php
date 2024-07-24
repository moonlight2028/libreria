<x-app title="Inicio">
    <section class="my-4 text-center">
        <h1 class="fw-bold text-primary">Catálogo de Libros</h1>
        <p class="text-muted">Explora nuestra colección de libros disponibles</p>
    </section>

    <section class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($books as $book)
                <div class="col">
                    <div class="card h-100 border-0 shadow">
                        <img src="{{ $book->file->route }}" class="card-img-top rounded-top" alt="Portada Libro" style="height: 250px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate">{{ $book->title }}</h5>
                            <p class="card-text text-muted">{{ $book->format_description }}</p>
                            <div class="mt-auto">
                                <span class="badge bg-info text-dark me-2">{{ $book->author->name }}</span>
                                <span class="badge bg-secondary">{{ $book->category->name }}</span>
                            </div>
                        </div>
                        <div class="card-footer text-center bg-primary text-white">
                            <button class="btn btn-outline-light btn-sm">
                                Solicitar
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-app>
