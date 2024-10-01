@extends('layouts.layout')

@section('content')
<div class="row">
    <div class="col-xl-12">
        @if (Session::has('error'))
            <div class="alert alert-danger solid alert-dismissible fade show">
                <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none"
                    stroke-linecap="round" stroke-linejoin="round" class="me-2">
                    <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
                <strong>Error!</strong> {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                </button>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success solid alert-dismissible fade show">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                    fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                    <polyline points="9 11 12 14 22 4"></polyline>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                </svg>
                <strong>Success!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                </button>
            </div>
        @endif
    </div>
    <div class="col-xl-12">
        <div class="card" id="accordion-two">
            <div class="card-header flex-wrap d-flex justify-content-between px-3">
                <div>
                    <h4 class="card-title">Data Material</h4>
                </div>
                <ul class="nav nav-tabs dzm-tabs" id="myTab" role="tablist">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        + New Material
                    </button>
                </ul>
            </div>

            <!-- tab-content -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="example" class="display table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Modul</th>
                                        <th>Tipe Materi</th>
                                        <th>Judul Materi</th>
                                        <th>Deskripsi Materi</th>
                                        <th>Isi Materi</th>
                                        <th>Durasi Materi</th>
                                        <th>Waktu Bikin Materi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['materialData'] as $item)
                                        <tr>
                                            <td>
                                                {{ $data['no']++ }}
                                            </td>
                                            <td>
                                                {{ $item->module->module_name }}
                                            </td>
                                            <td>
                                                {{ $item->type->type_name }}
                                            </td>
                                            <td>
                                                {{ $item->title }}
                                            </td>
                                            <td>
                                                {{ implode(' ', array_slice(explode(' ', $item->description), 0,10)) }}...
                                            </td>
                                            <td>
                                                @if($item->type->type_name =='video')
                                                <div class="w-25">
                                                    <video class="" style="width: 300px;" controls>
                                                        <source src="{{ $item->file_path }}" type="video/mp4">
                                                        <source src="{{ $item->file_path }}" type="video/ogg">
                                                        <source src="{{ $item->file_path }}" type="video/quicktime">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </div>
                                                @elseif ($item->type->type_name =='text')
                                                {{ $item->file_path }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ intdiv($item->duration, 60) . ' menit ' . ($item->duration % 60) . ' detik' }}
                                            </td>
                                            <td>
                                                {{ $item->created_at }}
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn btn-primary shadow btn-icon-sm me-1" href="#"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $item->_id }}">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <button class="btn btn-danger shadow btn-icon-sm"
                                                        onclick="confirmDelete('{{  $item->_id }}')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            {{-- update modal --}}
                                            <div class="modal fade" id="editModal{{ $item->_id }}" tabindex="-1"
                                                aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="editModalLabel">Edit Material
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('material.update', $item->_id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PATCH')
                                                                <div class="form-group mb-3">
                                                                    <label for="module_id">Pilih Module</label>
                                                                    <select class="default-select form-control wide" id="module_id" name="module_id">
                                                                        <option value="{{ $item->module_id }}">
                                                                            {{ $item->module->module_name }}
                                                                        </option>
                                                                        @foreach ($data['moduleData'] as $items)
                                                                            <option value="{{ $items->_id }}">
                                                                                {{ $items->module_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="type_id">Pilih Tipe Materi</label>
                                                                    <select class="default-select form-control wide" id="type_id" name="type_id">
                                                                        <option value="{{ $item->type_id }}">
                                                                            {{ $item->type->type_name }}
                                                                        </option>
                                                                        @foreach ($data['materialTypeData'] as $items)
                                                                            <option value="{{ $items->_id }}">
                                                                                {{ $items->type_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="title">Judul Materi</label>
                                                                    <input class="form-control" type="text" name="title" id="title" autocomplete="off" value="{{ $item->title }}" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="description">Deskripsi Materi</label>
                                                                    <input class="form-control" type="text" name="description" id="description" autocomplete="off" value="{{ $item->description }}" required>
                                                                </div>
                                                                <div class="form-group mb-3" id="file-input-group" style="display:none;">
                                                                    <label for="file_path">File Materi</label>
                                                                    <input class="form-control" type="file" name="file_path"  id="file_path" autocomplete="off">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan
                                                                        Perubahan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Modul</th>
                                        <th>Tipe Materi</th>
                                        <th>Judul Materi</th>
                                        <th>Deskripsi Materi</th>
                                        <th>Isi Materi</th>
                                        <th>Durasi Materi</th>
                                        <th>Waktu Bikin Materi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /tab-content -->

        </div>
    </div>
</div>
@endsection

@section('modal')
    {{-- add modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Materi Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('material.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="module_id">Pilih Module</label>
                            <select class="default-select form-control wide" id="module_id" name="module_id">
                                <option value="">
                                    Not Selected
                                </option>
                                @foreach ($data['moduleData'] as $item)
                                    <option value="{{ $item->_id }}">
                                        {{ $item->module_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="type_id">Pilih Tipe Materi</label>
                            {{-- <select class="default-select form-control wide" id="type_id" name="type_id" >
                                <option value="">
                                    Not Selected
                                </option>
                                @foreach ($data['materialTypeData'] as $item)
                                    <option value="{{ $item->_id }}" id="">
                                        {{ $item->type_name }}
                                    </option>
                                @endforeach
                            </select> --}}
                            @foreach ($data['materialTypeData'] as $item)
                            <input class="form-check-input" type="radio" name="type_id" id="type_id" value="{{ $item->_id }}"
                            checked>
                            <label class="form-check-label" for="text_question">Pertanyaan {{ $item->type_name }}</label>
                            @endforeach
                        </div>
                        <div class="form-group mb-3">
                            <label for="title">Judul Materi</label>
                            <input class="form-control" type="text" name="title" id="title" autocomplete="off" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Deskripsi Materi</label>
                            <input class="form-control" type="text" name="description" id="description" autocomplete="off" required>
                        </div>
                        <div class="form-group mb-3" id="file-input-group" style="">
                            <label for="file_path">File Materi</label>
                            <input class="form-control" type="file" name="file_path"  id="file_path" autocomplete="off" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="{{ asset('') }}templates/vendor/wow-master/dist/wow.min.js"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: `/material/delete/${id}`,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "_method": 'DELETE',
                            },
                            success: function (data) {
                                window.location.href = "/material";
                            }
                        });
                    }
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swal.fire(
                        'Cancelled',
                        'Data is not deleted',
                        'error'
                    )
                }
            });
        }
    </script>
<script>
    // $(document).ready(function() {
    //     // Saat type_id berubah
    //     $('#type_id').on('change', function() {
    //         var selectedType = $(this).val(); // Ambil nilai yang dipilih

    //         // Cek apakah tipe yang dipilih adalah 'video' (ganti dengan id yang sesuai)
    //         if (selectedType === 'video') {
    //             // Jika video, tampilkan input file
    //             $('#file-input-group').show();
    //             $('#file_path').attr('required', true); // Buat input file wajib diisi
    //         } else {
    //             // Jika bukan video, sembunyikan input file
    //             $('#file-input-group').hide();
    //             $('#file_path').attr('required', false); // Buat input file tidak wajib diisi
    //         }
    //     });
    // });
    $(document).ready(function() {
        var $fileInputDiv = $('#file-input-group'); // Div untuk input file
        var $typeSelect = $('#type_id'); // Select untuk tipe materi

        // Default state: sembunyikan file input jika tipe materi selain video
        $fileInputDiv.hide();

        // Ketika tipe materi diubah
        $typeSelect.change(function() {
            var selectedType = $(this).val(); // Ambil nilai tipe materi yang dipilih

            if (selectedType === '66f96f06a3685f699503deca') {
                // Jika tipe materi adalah 'video', tampilkan file input
                $fileInputDiv.show();
                $('#file_path').attr('required', true); // Set input file wajib diisi
            } else {
                // Jika tipe materi bukan 'video', sembunyikan file input
                $fileInputDiv.hide();
                $('#file_path').attr('required', false); // Set input file tidak wajib diisi
            }
        });
    });

</script>
@endpush

@push('scripts')
@endpush
