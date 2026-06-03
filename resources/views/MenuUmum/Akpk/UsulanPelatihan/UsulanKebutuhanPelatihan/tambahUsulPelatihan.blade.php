<!-- Tambahkan ini di bagian <head> atau file CSS Anda -->
<style>
    /* Modal Background */
    .modal.fade.show {
        background-color: rgba(0, 0, 0, 0.5);
    }

    /* Modal Dialog Styling */
    .modal-dialog {
        max-width: 600px;
        margin: 1.75rem auto;
    }

    /* Modal Content Styling */
    .modal-content {
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        border: none;
    }

    /* Modal Header */
    .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        padding: 16px 24px;
    }

    .modal-title {
        font-weight: 600;
        font-size: 1.25rem;
        color: #343a40;
    }

    /* Form inside Modal */
    .modal-body form {
        padding: 0 24px;
    }

    /* Form Label */
    .form-label {
        font-weight: 500;
        color: #495057;
    }

    /* Form Input */
    .form-control,
    .form-select {
        border-radius: 6px;
        padding: 10px 12px;
        border: 1px solid #ced4da;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
    }

    /* Modal Footer */
    .modal-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #dee2e6;
        padding: 12px 24px;
    }

    /* Buttons */
    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
        border-radius: 6px;
        padding: 8px 16px;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }

    .btn-secondary {
        border-radius: 6px;
        padding: 8px 16px;
        font-weight: 500;
    }
</style>

<!-- Modal Tambah Usulan -->
<div class="modal fade" id="modalTambahUsulan" tabindex="-1" aria-labelledby="modalTambahUsulanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahUsulanLabel">Tambah Usulan Pelatihan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formTambahUsulan" action="{{ route('usulan-kebutuhan-pelatihan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="tahunPelatihan" class="form-label">Tahun</label>
                        <select class="form-select" id="tahunPelatihan" name="tahun">
                            <option selected disabled>Pilih Tahun</option>
                            @for ($year = date('Y'); $year >= 2020; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="namaPelatihan" class="form-label">Nama Pelatihan</label>
                        <input type="text" class="form-control" id="namaPelatihan" name="nama_pelatihan" placeholder="Masukkan Nama Pelatihan">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
