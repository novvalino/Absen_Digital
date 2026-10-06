{{--
    Form jabatan (dipakai create & edit)
    Variabel: $action, $method, $hakAksesList, $jabatan (null saat tambah), $submitLabel
--}}
<form method="POST" action="{{ $action }}">
    @csrf
    @if (($method ?? 'POST') === 'PUT') @method('PUT') @endif

    <div class="form-body">

        <div class="field">
            <label for="jabatan_status">Jabatan / Status</label>
            <div class="input-icon">
                <i class="bi bi-person-badge"></i>
                <input type="text" id="jabatan_status" name="jabatan_status"
                    class="form-control @error('jabatan_status') is-invalid @enderror"
                    value="{{ old('jabatan_status', $jabatan->jabatan_status ?? '') }}"
                    placeholder="Contoh: Guru, Staf, Kepala Cabang" required>
            </div>
            @error('jabatan_status') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label for="hak_akses">Hak Akses</label>
            <div class="input-icon">
                <i class="bi bi-shield-lock"></i>
                <select id="hak_akses" name="hak_akses"
                    class="form-select @error('hak_akses') is-invalid @enderror" required>
                    <option value="">-- Pilih Hak Akses --</option>
                    @foreach ($hakAksesList as $hak)
                        <option value="{{ $hak->id }}"
                            {{ (string) old('hak_akses', $jabatan->hak_akses ?? '') === (string) $hak->id ? 'selected' : '' }}>
                            {{ $hak->hak }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('hak_akses') <div class="field-error">{{ $message }}</div> @enderror
            <div class="field-hint">nusabot &amp; full dapat mengelola data. general hanya melihat rekap absensi sendiri.</div>
        </div>

    </div>

    <div class="form-actions">
        <a href="{{ route('jabatan.index') }}" class="btn-x btn-cancel"><i class="bi bi-x-lg"></i> Batal</a>
        <button type="submit" class="btn-x btn-submit"><i class="bi bi-check2-circle"></i> {{ $submitLabel }}</button>
    </div>
</form>
