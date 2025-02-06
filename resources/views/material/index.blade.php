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
                                            <th>Judul Materi</th>
                                            <th>Nama Modul</th>
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
                                                    {{ $item->title }}
                                                </td>
                                                <td>
                                                    {{ $item->module->module_name }}
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a class="btn btn-primary shadow btn-icon-sm me-1" href="#"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $item->_id }}">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <button class="btn btn-danger shadow btn-icon-sm me-1"
                                                            onclick="confirmDelete('{{ $item->_id }}')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <a class="btn btn-warning shadow btn-icon-sm me-1" href="#"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#detailModal{{ $item->_id }}">
                                                            <i class="fa fa-solid fa-circle-exclamation"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                {{-- update modal --}}
                                                <div class="modal fade" id="editModal{{ $item->_id }}" tabindex="-1"
                                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-center">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="editModalLabel">Edit
                                                                    Material
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
                                                                        <select class="default-select form-control wide"
                                                                            id="module_id" name="module_id">
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
                                                                        @foreach ($data['materialTypeData'] as $items)
                                                                            <input class="form-check-input" type="radio"
                                                                                name="type_id" id="type_idedit"
                                                                                value="{{ $items->_id }}" checked>
                                                                            <label class="form-check-label"
                                                                                for="text_question">Pertanyaan
                                                                                {{ $items->type_name }}</label>
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="title">Judul Materi</label>
                                                                        <input class="form-control" type="text"
                                                                            name="title" id="title"
                                                                            autocomplete="off"
                                                                            value="{{ $item->title }}" required>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="description">Deskripsi Materi</label>
                                                                        <textarea class="form-control" type="text" name="description" id="description" rows="10" cols="30">{{ $item->description }}</textarea>
                                                                    </div>
                                                                    <div class="form-group mb-3"
                                                                        id="file-input-groupedit">
                                                                        <label for="file_path">File Materi</label>
                                                                        <input class="form-control" type="file"
                                                                            name="file_path" id="file_path"
                                                                            autocomplete="off">
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
                                                {{-- update modal --}}
                                                {{-- detail modal --}}
                                                <div class="modal fade" id="detailModal{{ $item->_id }}"
                                                    tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-center">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="detailModalLabel">Detail
                                                                    Quiz</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mb-3">
                                                                    <h4 class="text-primary mb-2">
                                                                        Judul Materi
                                                                    </h4>
                                                                    <p class="">
                                                                        {{ $item->title }}
                                                                    </p>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <h4 class="text-primary mb-2">
                                                                        Waktu Dibikin
                                                                    </h4>
                                                                    <p class="">
                                                                        {{ $item->created_at }}
                                                                    </p>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <h4 class="text-primary mb-2">
                                                                        Nama Module
                                                                    </h4>
                                                                    <p class="">
                                                                        {{ $item->module->module_name }}
                                                                    </p>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <h4 class="text-primary mb-2">
                                                                        Tipe Quiz
                                                                    </h4>
                                                                    <p class="">
                                                                        {{ $item->type->type_name }}
                                                                    </p>
                                                                </div>

                                                                <div class="row mb-3">
                                                                    <h4 class="text-primary mb-2">
                                                                        Deskripsi Materi
                                                                    </h4>
                                                                    <p class="">
                                                                        {{ $item->description }}
                                                                    </p>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <h4 class="text-primary mb-2">
                                                                        Durasi Materi
                                                                    </h4>
                                                                    <p class="">
                                                                        {{ intdiv($item->duration, 60) . ' menit ' . $item->duration % 60 . ' detik' }}
                                                                    </p>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <h4 class="text-primary mb-2">
                                                                        Isi Materi
                                                                    </h4>
                                                                    @if ($item->type->type_name == 'video')
                                                                        <div class="w-25">
                                                                            <video class="" style="width: 300px;"
                                                                                controls>
                                                                                <source src="{{ $item->file_path }}"
                                                                                    type="video/mp4">
                                                                                <source src="{{ $item->file_path }}"
                                                                                    type="video/ogg">
                                                                                <source src="{{ $item->file_path }}"
                                                                                    type="video/quicktime">
                                                                                Your browser does not support the video tag.
                                                                            </video>
                                                                        </div>
                                                                    @elseif ($item->type->type_name == 'text')
                                                                        {{ $item->file_path }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- detail modal --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Materi</th>
                                            <th>Nama Modul</th>
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
                                <input class="form-check-input" type="radio" name="type_id" id="type_idadd"
                                    value="{{ $item->_id }}" checked>
                                <label class="form-check-label" for="text_question">Pertanyaan
                                    {{ $item->type_name }}</label>
                            @endforeach
                        </div>
                        <div class="form-group mb-3">
                            <label for="title">Judul Materi</label>
                            <input class="form-control" type="text" name="title" id="title" autocomplete="off"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Deskripsi Materi</label>
                            <textarea class="form-control" type="text" name="description" id="description" rows="10" cols="30"></textarea>
                        </div>
                        <div class="form-group mb-3" id="file-input-groupadd" style="">
                            <label for="file_path">File Materi</label>
                            <input class="form-control" type="file" name="file_path" id="file_path"
                                autocomplete="off" required>
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
    <script src="{{ asset('templates/vendor/wow-master/dist/wow.min.js') }}"></script>

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
                            success: function(data) {
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
        $(document).ready(function() {
            var $fileInputDiv = $('#file-input-groupadd'); // Div untuk input file
            var $typeSelect = $('#type_id'); // Select untuk tipe materi

            // Default state: sembunyikan file input jika tipe materi selain video
            $('#file-input-group').prop('checked', true);
            $fileInputDiv.hide();

            // Ketika tipe materi diubah
            $('input[id="type_idadd"]').change(function() {
                if ($(this).val() === '66f96f06a3685f699503deca') {

                    $fileInputDiv.show();
                } else {
                    $fileInputDiv.hide();
                }
            });
        });
        $(document).ready(function() {
            var $fileInputDiv = $('#file-input-groupedit'); // Div untuk input file
            var $typeSelect = $('#type_id'); // Select untuk tipe materi

            // Default state: sembunyikan file input jika tipe materi selain video
            $('#file-input-group').prop('checked', true);
            $fileInputDiv.hide();

            // Ketika tipe materi diubah
            $('input[id="type_idedit"]').change(function() {
                if ($(this).val() === '66f96f06a3685f699503deca') {

                    $fileInputDiv.show();
                } else {
                    $fileInputDiv.hide();
                }
            });
        });
    </script>
@endpush
