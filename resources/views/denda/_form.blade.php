{{--
    Form denda (dipakai create & edit)
    Variabel: $action, $method, $denda (null saat tambah), $submitLabel
    Saat edit, "Jenis" dikunci karena dipakai sebagai acuan perhitungan denda.
--}}
@php $edit = ($method ?? 'POST') === 'PUT'; @endphp

<form method="POST" action="{{ $action }}">
    @csrf
    @if ($edit) @method('PUT') @endif

    <div class="form-body">

        <div class="form-section"><i class="bi bi-list-check"></i> Aturan</div>

        <div class="field">
            <label for="prioritas">Urutan / Prioritas</label>
            <div class="input-icon">
                <i class="bi bi-sort-numeric-down"></i>
                <input type="number" id="prioritas" name="prioritas" inputmode="numeric"
                    class="form-control @error('prioritas') is-invalid @enderror"
                    value="{{ old('prioritas', $denda->prioritas ?? '') }}" placeholder="Contoh: 1" required>
            </div>
            @error('prioritas') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label for="jenis">Jenis Denda</label>
            <div class="input-icon">
                <i class="bi bi-tag"></i>
                <input type="text" id="jenis" name="jenis"
                    class="form-control @error('jenis') is-invalid @enderror"
                    value="{{ old('jenis', $denda->jenis ?? '') }}" placeholder="Contoh: Terlambat Masuk"
                    {{ $edit ? 'readonly' : 'required' }}>
            </div>
            @error('jenis') <div class="field-error">{{ $message }}</div> @enderror
            @if ($edit) <div class="field-hint">Jenis denda tidak dapat diubah.</div> @endif
        </div>

        <div class="form-section amber sep"><i class="bi bi-cash-stack"></i> Nominal</div>

        <div class="field">
            <label for="rupiah_pertama">Nominal Pertama (Rp)</label>
            <div class="input-icon">
                <i class="bi bi-cash-coin"></i>
                <input type="number" id="rupiah_pertama" name="rupiah_pertama" inputmode="numeric"
                    class="form-control @error('rupiah_pertama') is-invalid @enderror"
                    value="{{ old('rupiah_pertama', $denda->rupiah_pertama ?? '') }}" placeholder="Contoh: 1000" required>
            </div>
            @error('rupiah_pertama') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label for="per_menit">Interval (Menit) <span class="opt">(opsional)</span></label>
            <div class="input-icon">
                <i class="bi bi-stopwatch"></i>
                <input type="number" id="per_menit" name="per_menit" inputmode="numeric"
                    class="form-control @error('per_menit') is-invalid @enderror"
                    value="{{ old('per_menit', $denda->per_menit ?? '') }}" placeholder="Kosongkan jika flat">
            </div>
            @error('per_menit') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <div class="field full">
            <label for="rupiah_selanjutnya">Nominal Selanjutnya (Rp) <span class="opt">(opsional)</span></label>
            <div class="input-icon">
                <i class="bi bi-graph-up-arrow"></i>
                <input type="number" id="rupiah_selanjutnya" name="rupiah_selanjutnya" inputmode="numeric"
                    class="form-control @error('rupiah_selanjutnya') is-invalid @enderror"
                    value="{{ old('rupiah_selanjutnya', $denda->rupiah_selanjutnya ?? '') }}" placeholder="Kosongkan jika flat">
            </div>
            @error('rupiah_selanjutnya') <div class="field-error">{{ $message }}</div> @enderror
            <div class="field-hint">Isi Interval dan Nominal Selanjutnya untuk denda progresif / berulang.</div>
        </div>

    </div>

    <div class="form-actions">
        <a href="{{ route('denda.index') }}" class="btn-x btn-cancel"><i class="bi bi-x-lg"></i> Batal</a>
        <button type="submit" class="btn-x btn-submit"><i class="bi bi-check2-circle"></i> {{ $submitLabel }}</button>
    </div>
</form>
