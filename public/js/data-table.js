/**
 * Inisialisasi DataTables seragam untuk semua halaman daftar.
 * Pemakaian: initDataTable('#idTabel', { title: 'Daftar Mesin', order: [[0, 'desc']], pageLength: 10 });
 *
 * Kelas khusus pada <th>:
 *   no-export : kolom tidak ikut Salin / Excel / PDF / Cetak (mis. kolom Aksi)
 *   no-sort   : kolom tidak bisa diurutkan
 */
window.initDataTable = function (selector, opts) {
    opts = opts || {};
    var title = opts.title || document.title;
    var filename = title.toLowerCase().replace(/[^a-z0-9]+/g, '_').replace(/^_|_$/g, '');
    var exp = { columns: ':not(.no-export)' };

    return $(selector).DataTable({
        pageLength: opts.pageLength || 10,
        order: opts.order || [],
        autoWidth: false,
        dom: '<"dt-top"Bf>rt<"dt-bottom"ip>',
        columnDefs: [{ targets: 'no-sort', orderable: false }],
        buttons: [
            { extend: 'copy',  text: '<i class="bi bi-clipboard"></i> Salin', title: title, exportOptions: exp },
            { extend: 'excel', text: '<i class="bi bi-file-earmark-excel"></i> Excel', title: title, filename: filename, exportOptions: exp },
            { extend: 'pdf',   text: '<i class="bi bi-file-earmark-pdf"></i> PDF', title: title, filename: filename, exportOptions: exp },
            { extend: 'print', text: '<i class="bi bi-printer"></i> Cetak', title: title, exportOptions: exp },
            { extend: 'colvis', text: '<i class="bi bi-layout-three-columns"></i> Kolom', columns: ':not(.no-export)' }
        ],
        language: {
            search: '',
            searchPlaceholder: 'Cari data…',
            emptyTable: opts.emptyText || 'Belum ada data',
            zeroRecords: 'Data tidak ditemukan',
            info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
            infoEmpty: 'Tidak ada data',
            infoFiltered: '(disaring dari _MAX_ data)',
            paginate: { previous: '‹', next: '›' }
        }
    });
};
