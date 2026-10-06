{{--
    Form cabang / gedung (dipakai create & edit)
    Variabel: $action, $method, $cabang (null saat tambah), $submitLabel
--}}
@php
    $hari = [0 => 'Minggu', 1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu'];

    $tersimpan = $cabang && $cabang->hari_libur !== null && $cabang->hari_libur !== ''
        ? explode(',', $cabang->hari_libur)
        : [];
    $terpilih = array_map('strval', session()->hasOldInput() ? (array) old('hari_libur', []) : $tersimpan);

    $waktu = fn ($nama) => old($nama, $cabang && $cabang->$nama ? substr($cabang->$nama, 0, 5) : '');
    $zona  = (string) old('zona_waktu', $cabang->zona_waktu ?? '1');
@endphp

<form method="POST" action="{{ $action }}">
    @csrf
    @if (($method ?? 'POST') === 'PUT') @method('PUT') @endif

    <div class="form-body">

        {{-- ===== INFORMASI ===== --}}
        <div class="form-section"><i class="bi bi-geo-alt-fill"></i> Informasi Cabang</div>

        <div class="field full">
            <label for="lokasi">Lokasi / Nama Cabang</label>
            <div class="input-icon">
                <i class="bi bi-buildings"></i>
                <input type="text" id="lokasi" name="lokasi"
                    class="form-control @error('lokasi') is-invalid @enderror"
                    value="{{ old('lokasi', $cabang->lokasi ?? '') }}" placeholder="Contoh: Gedung Utama" required>
            </div>
            @error('lokasi') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        {{-- ===== JAM ===== --}}
        <div class="form-section sep"><i class="bi bi-clock-fill"></i> Jam Operasional</div>

        <div class="field">
            <label for="jam_masuk">Jam Masuk</label>
            <div class="input-icon">
                <i class="bi bi-box-arrow-in-right"></i>
                <input type="time" id="jam_masuk" name="jam_masuk"
                    class="form-control @error('jam_masuk') is-invalid @enderror"
                    value="{{ $waktu('jam_masuk') }}" required>
            </div>
            @error('jam_masuk') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label for="jam_pulang">Jam Pulang</label>
            <div class="input-icon">
                <i class="bi bi-box-arrow-right"></i>
                <input type="time" id="jam_pulang" name="jam_pulang"
                    class="form-control @error('jam_pulang') is-invalid @enderror"
                    value="{{ $waktu('jam_pulang') }}" required>
            </div>
            @error('jam_pulang') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label for="istirahat_mulai">Mulai Istirahat</label>
            <div class="input-icon">
                <i class="bi bi-cup-hot"></i>
                <input type="time" id="istirahat_mulai" name="istirahat_mulai"
                    class="form-control @error('istirahat_mulai') is-invalid @enderror"
                    value="{{ $waktu('istirahat_mulai') }}" required>
            </div>
            @error('istirahat_mulai') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label for="istirahat_selesai">Selesai Istirahat</label>
            <div class="input-icon">
                <i class="bi bi-cup-hot-fill"></i>
                <input type="time" id="istirahat_selesai" name="istirahat_selesai"
                    class="form-control @error('istirahat_selesai') is-invalid @enderror"
                    value="{{ $waktu('istirahat_selesai') }}" required>
            </div>
            @error('istirahat_selesai') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        {{-- ===== HARI LIBUR & ZONA ===== --}}
        <div class="form-section amber sep"><i class="bi bi-calendar2-week-fill"></i> Hari Libur &amp; Zona Waktu</div>

        <div class="field full">
            <label>Hari Libur Mingguan <span class="opt">(opsional)</span></label>
            <div class="day-grid">
                @foreach ($hari as $kode => $nama)
                    <label class="day-pill">
                        <input type="checkbox" name="hari_libur[]" value="{{ $kode }}"
                            {{ in_array((string) $kode, $terpilih, true) ? 'checked' : '' }}>
                        <span>{{ $nama }}</span>
                    </label>
                @endforeach
            </div>
            @error('hari_libur') <div class="field-error">{{ $message }}</div> @enderror
            <div class="field-hint">Ketuk hari untuk menandainya sebagai hari libur cabang ini.</div>
        </div>

        <div class="field full">
            <label for="zona_waktu">Zona Waktu</label>
            <div class="input-icon">
                <i class="bi bi-globe-asia-australia"></i>
                <select id="zona_waktu" name="zona_waktu" class="form-select @error('zona_waktu') is-invalid @enderror" required>
                    <option value="1" {{ $zona === '1' ? 'selected' : '' }}>WIB (Waktu Indonesia Barat)</option>
                    <option value="2" {{ $zona === '2' ? 'selected' : '' }}>WITA (Waktu Indonesia Tengah)</option>
                    <option value="3" {{ $zona === '3' ? 'selected' : '' }}>WIT (Waktu Indonesia Timur)</option>
                </select>
            </div>
            @error('zona_waktu') <div class="field-error">{{ $message }}</div> @enderror
        </div>

    </div>

    <div class="form-actions">
        <a href="{{ route('cabang-gedung.index') }}" class="btn-x btn-cancel"><i class="bi bi-x-lg"></i> Batal</a>
        <button type="submit" class="btn-x btn-submit"><i class="bi bi-check2-circle"></i> {{ $submitLabel }}</button>
    </div>
</form>
