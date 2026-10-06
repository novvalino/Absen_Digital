@if ($errors->any())
    <div class="alert alert-danger">
        <div class="font-bold mb-1"><i class="bi bi-exclamation-triangle-fill"></i> Periksa kembali isian Anda:</div>
        <ul class="mb-0 ps-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
