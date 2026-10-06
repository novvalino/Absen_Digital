{{-- Pesan sesi (sukses / info / peringatan / gagal). Tag <b> dari controller tetap ditampilkan, selain itu di-escape. --}}
@php
    $flashMap = [
        'success'       => ['success', 'bi-check-circle-fill'],
        'successAdd'    => ['success', 'bi-check-circle-fill'],
        'successEdit'   => ['info',    'bi-pencil-square'],
        'successDelete' => ['success', 'bi-trash3-fill'],
        'warning'       => ['warning', 'bi-exclamation-triangle-fill'],
        'error'         => ['danger',  'bi-x-octagon-fill'],
    ];
@endphp
@foreach ($flashMap as $key => [$type, $icon])
    @if (session($key) && ! ($key === 'error' && $errors->any()))
        <div class="flash flash-{{ $type }}" role="alert">
            <i class="bi {{ $icon }}"></i>
            <span>{!! str_replace(['&lt;b&gt;', '&lt;/b&gt;'], ['<b>', '</b>'], e(session($key))) !!}</span>
        </div>
    @endif
@endforeach
