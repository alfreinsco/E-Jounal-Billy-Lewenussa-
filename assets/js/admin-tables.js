$(document).ready(function () {
    if (!$('.datatable-admin').length) {
        return;
    }

    function jumlahKolom($table) {
        return $table.find('thead tr').first().children('th').length;
    }

    function tabelValid($table) {
        var kolom = jumlahKolom($table);
        if (kolom === 0) {
            return false;
        }

        var valid = true;
        $table.find('tbody tr').each(function () {
            var $row = $(this);
            if ($row.children('td[colspan]').length) {
                valid = false;
                return false;
            }
            var sel = $row.children('td').length;
            if (sel > 0 && sel !== kolom) {
                valid = false;
                return false;
            }
        });
        return valid;
    }

    $('.datatable-admin').each(function () {
        var $table = $(this);

        if ($.fn.DataTable.isDataTable($table[0])) {
            $table.DataTable().destroy();
            $table.removeClass('dataTable');
        }

        if (!tabelValid($table)) {
            console.warn('DataTables dilewati: jumlah kolom tidak konsisten.', $table);
            return;
        }

        var tidakUrut = ($table.attr('data-no-order') || '').toString();
        var targets = tidakUrut.split(',').map(function (v) {
            return parseInt(v.trim(), 10);
        }).filter(function (n) {
            return !isNaN(n);
        });

        var kolom = jumlahKolom($table);
        targets = targets.filter(function (i) {
            return i >= 0 && i < kolom;
        });

        if (targets.length === 0) {
            targets = [kolom - 1];
        }

        $table.DataTable({
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'Semua']],
            order: [],
            autoWidth: false,
            language: {
                emptyTable: 'Tidak ada data tersedia',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                infoEmpty: 'Menampilkan 0 sampai 0 dari 0 data',
                infoFiltered: '(disaring dari _MAX_ total data)',
                lengthMenu: 'Tampilkan _MENU_ data',
                loadingRecords: 'Memuat...',
                processing: 'Memproses...',
                search: 'Cari:',
                zeroRecords: 'Tidak ditemukan data yang sesuai',
                paginate: {
                    first: 'Awal',
                    last: 'Akhir',
                    next: 'Berikutnya',
                    previous: 'Sebelumnya',
                },
            },
            columnDefs: [
                { orderable: false, searchable: false, targets: targets },
            ],
        });
    });
});
