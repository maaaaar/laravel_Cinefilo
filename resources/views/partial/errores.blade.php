{{-- PARA PODER MOSTRAR LOS ERRORES --}}

{{-- i exsiste eso en la session lo muestras --}}
@if (Session::has('error'))
    <div class="alert alert-danger mt-4" role="alert">
        {{ Session::get('error') }}
    </div>
@endif

