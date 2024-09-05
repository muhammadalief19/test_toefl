@extends('templates.master')
@section('title', 'Nested Question ')
@section('page-name', 'Assign Nested Question')
@push('link-template')
<link rel="stylesheet" href="{{ asset('assets/vendor/chartist/css/chartist.min.css') }}">
<link href="{{ asset('assets/vendor/wow-master/css/libs/animate.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha256-PI8n5gCcz9cQqQXm3PEtDuPG8qx9oFsFctPg0S5zb8g=" crossorigin="anonymous">
<link href="{{ asset('assets/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">

@endpush
@push('styles')
<style>
    .modal {
        z-index: 100;
    }

    .modal-content {
        background-color: #ffffff;
        border-radius: 10px;
    }

    .modal-header {
        background-color: #f0f0f0;
    }

    .modal-body {
        background-color: #f0f0f0;
    }

    .modal-footer {
        background-color: #f0f0f0;
    }
</style>
@endpush

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                {{-- @if (Session::has('error'))
                <div class="alert alert-danger solid alert-dismissible fade show">
                    <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    <strong>Error!</strong> {{ Session::get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                </div>
                @endif
                @if(Session::has('success'))
                <div class="alert alert-success solid alert-dismissible fade show">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                    <strong>Success!</strong> {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                </div>
                @endif --}}
            </div>
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page-title flex-wrap">
                            {{-- <form action="{{ route('packetfull.search') }}" method="GET" class="input-group search-area mb-md-0 mb-3" >
                                <input type="search" class="form-control" name="search" placeholder="Search here...">
                                <span class="input-group-text">
                                    <button type="submit">
                                        <svg width="15" height="15" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.5605 15.4395L13.7527 11.6317C14.5395 10.446 15 9.02625 15 7.5C15 3.3645 11.6355 0 7.5 0C3.3645 0 0 3.3645 0 7.5C0 11.6355 3.3645 15 7.5 15C9.02625 15 10.446 14.5395 11.6317 13.7527L15.4395 17.5605C16.0245 18.1462 16.9755 18.1462 17.5605 17.5605C18.1462 16.9747 18.1462 16.0252 17.5605 15.4395V15.4395ZM2.25 7.5C2.25 4.605 4.605 2.25 7.5 2.25C10.395 2.25 12.75 4.605 12.75 7.5C12.75 10.395 10.395 12.75 7.5 12.75C4.605 12.75 2.25 10.395 2.25 7.5V7.5Z" fill="#01A3FF"/>
                                        </svg>
                                    </button>
                                </span>
                            </form> --}}
                            <div>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNested">
                                    <i class="fa fa-plus"></i>
                                    Tambah Pertanyaan Nested 😎
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="table-responsive full-data">
                            <table class="table-responsive-lg table display dataTablesCard student-tab dataTable no-footer" id="example-student">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pertanyaan Nested</th>
                                        <th>Assign Pertanyaan Nested Ke Pertanyaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nestedQuestionPacket as $nested)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td>
                                            @if(Str::startsWith($nested->question_nested, 'nested_question/'))
                                                @if(Str::endsWith($nested->question_nested, ['.jpg', '.jpeg', '.png', '.gif']))
                                                    {{-- Menampilkan gambar --}}
                                                    <img src="{{ asset('storage/'.$nested->question_nested) }}" alt="Question Image" style="max-width: 100px;">
                                                @elseif(Str::endsWith($nested->question_nested, ['.mp3', '.wav', '.ogg']))
                                                    {{-- Menampilkan audio --}}
                                                    <audio controls>
                                                        <source src="{{ asset('storage/'.$nested->question_nested) }}" type="audio/mpeg">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                @else
                                                    {{-- Menampilkan teks --}}
                                                    @if(strlen($nested->question_nested) > 50)
                                                        <button class="btn btn-sm" type="button" data-toggle="modal"
                                                                data-target="#questionDetailModal_{{ $nested->_id }}">
                                                            <i class="fas fa-eye mx-2 view-detail"></i>
                                                        </button>
                                                    @endif
                                                    {{ Str::limit($nested->question_nested, 50, '...') }}
                                                @endif
                                            @else
                                                {{-- Menampilkan teks jika tidak ada prefix 'questions/' --}}
                                                @if(strlen($nested->question_nested) > 50)
                                                    <button class="btn btn-sm" type="button" data-toggle="modal"
                                                            data-target="#questionDetailModal_{{ $nested->_id }}">
                                                        <i class="fas fa-eye mx-2 view-detail"></i>
                                                    </button>
                                                @endif
                                                {{ Str::limit($nested->question_nested, 50, '...') }}
                                            @endif
                                                {{-- packetfull.editNested --}}
                                                <button class="btn btn-sm" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#editNested{{ $nested->_id }}">
                                                    <i class="fas fa-pencil"></i>
                                                </button>
                                                <div class="modal fade" id="editNested{{ $nested->_id }}" tabindex="-1"
                                                    role="dialog"
                                                    aria-labelledby="editInstructionsModalLabel{{ $nested->_id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editInstructionsModalLabel{{ $nested->_id }}">
                                                                    Edit nested🤗</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true"></span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('packetfull.editNested', ['id' => $nested->_id]) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('patch')
                                                                    <div class="modal-body">
                                                                        <p><small class="text-danger">Catatan: Silahkan pilih
                                                                                salah satu
                                                                                antara pertanyaan nested teks atau voice/gambar.
                                                                                🤗</small></p>

                                                                        <div class="form-group">
                                                                            <label for="question">Pertanyaan Text</label>
                                                                            <textarea name="question_nested"
                                                                                class="ckeditor form-control"></textarea>
                                                                        </div>

                                                                        <p>Atau</p>

                                                                        <div class="form-group">
                                                                            <label for="image_question_input">Pertanyaan Gambar
                                                                                / Voice</label>
                                                                            <input type="file" name="question_nested"
                                                                                class="form-control">
                                                                        </div>

                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger"
                                                                            data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Simpan
                                                                            Perubahan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </td>
                                        <td><a class="btn btn-sm btn-success"
                                                href="{{ route('packetfull.getAllNested', ['idNested' => $nested->_id, 'idPacket' => $initPaket]) }}"><i
                                                    class="fas fa-sign-in-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addNested" tabindex="-1" aria-labelledby="addNesteds" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNesteds">Service Tambah Pertanyaan Nested</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('packetfull.addNested', $initPaket) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <p><small class="text-danger">Catatan: Silahkan pilih salah satu antara pertanyaan nested teks atau voice/gambar. 🤗</small></p>
                        <label for="question_nested">Pertanyaan Nested</label>
                        <textarea class="ckeditor form-control" name="question_nested" id="question_nested" rows="5" style="resize: vertical;"></textarea>
                        <br>
                        <p>Atau </p>
                        <label for="question_nested_imeg">Pertanyaan Nested Gambar/Voice</label><br>
                        <input class="form-control" type="file" name="question_nested" id="question_nested_imeg">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha256-3gQJhtmj7YnV1fmtbVcnAV6eI4ws0Tr48bVZCThtCGQ=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/vendor/wow-master/dist/wow.min.js') }}"></script>

{{-- <script>
    $(document).ready(function() {
        $('#table2').DataTable({
            "paging": true,
            "searching": true,
            "columnDefs": [
                { "searchable": true, "targets": [0, 1] }
            ],
        });
    });
</script> --}}
<script>
    function confirmDelete(deleteUrl) {
        // Tampilkan SweetAlert2 untuk konfirmasi penghapusan
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
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi, arahkan ke URL penghapusan
                window.location.href = deleteUrl;
            }
        });
    }
</script>

@endpush

{{-- <div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <button class="btn tbn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addNested">
                    <i class="fa fa-plus"></i>
                    Tambah Pertanyaan Nested 😎
                </button>
                modal add paket
                <div class="modal fade" id="addNested" tabindex="-1" role="dialog" aria-labelledby="addNesteds"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addNesteds">Service Tambah Pertanyaan Nested</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('packetfull.addNested', $initPaket) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <p><small class="text-danger">Catatan: Silahkan pilih salah satu
                                                antara pertanyaan nested teks atau voice/gambar. 🤗</small></p>
                                        <label for="question_nested">Pertanyaan Nested</label>
                                        <textarea class="ckeditor form-control" name="question_nested"
                                            id="question_nested" rows="5" style="resize: vertical;"></textarea>
                                        <br>
                                        <p>Atau </p>

                                        <label for="question_nested_imeg">Pertanyaan Nested Gambar/Voice</label><br>
                                        <input class="form-control" type="file" name="question_nested"
                                            id="question_nested_imeg">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="row">
                    <div class="table-responsive full-data">
                        <table class="table-responsive full-data" id="table2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pertanyaan Nested</th>
                                    <th>Count Question</th>
                                    <th>Entry Nested Question</th>
                                    <th>Assign Pertanyaan Nested Ke Pertanyaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nestedQuestionPacket as $nested)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td>@if(Str::startsWith($nested->question_nested, 'nested_question/'))
                                        <audio controls>
                                            <source src="{{ env('AWS_RESOURCE').'/'.env('AWS_BUCKET').'/'.$nested->question_nested }}"
                                                type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                        @else
                                        @if(strlen($nested->question_nested) < 60) {!! strip_tags($nested->
                                            question_nested) !!}
                                            @else
                                            <button class="btn btn-sm" type="button" data-bs-toggle="modal"
                                                data-bs-target="#detailNested{{ $nested->_id }}">
                                                <i class="fas fa-eye mx-2 view-detail"></i>
                                            </button>
                                            {!! Str::limit(strip_tags($nested->question_nested), 60, '....') !!}

                                            the modal
                                            qeustionDetailModal
                                            <div class="modal fade" id="detailNested{{ $nested->_id }}" tabindex="-1"
                                                role="dialog"
                                                aria-labelledby="nestedDetailModalLabel_{{ $nested->_id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Detail
                                                                Nested</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! html_entity_decode($nested->question_nested) !!}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            packetfull.editNested
                                            @endif
                                            <button class="btn btn-sm" type="button" data-bs-toggle="modal"
                                                data-bs-target="#editNested{{ $nested->_id }}">
                                                <i class="fas fa-pencil"></i>
                                            </button>
                                            <div class="modal fade" id="editNested{{ $nested->_id }}" tabindex="-1"
                                                role="dialog"
                                                aria-labelledby="editInstructionsModalLabel{{ $nested->_id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editInstructionsModalLabel{{ $nested->_id }}">
                                                                Edit nested🤗</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form
                                                            action="{{ route('packetfull.editNested', ['id' => $nested->_id]) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('patch')
                                                            <div class="modal-body">
                                                                <p><small class="text-danger">Catatan: Silahkan pilih
                                                                        salah satu
                                                                        antara pertanyaan nested teks atau voice/gambar.
                                                                        🤗</small></p>

                                                                <div class="form-group">
                                                                    <label for="question">Pertanyaan Text</label>
                                                                    <textarea name="question_nested"
                                                                        class="ckeditor form-control"></textarea>
                                                                </div>

                                                                <p>Atau</p>

                                                                <div class="form-group">
                                                                    <label for="image_question_input">Pertanyaan Gambar
                                                                        / Voice</label>
                                                                    <input type="file" name="question_nested"
                                                                        class="form-control">
                                                                </div>

                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan
                                                                    Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                    </td>
                                    <td><a class="btn btn-sm btn-success"
                                            href="{{ route('packetfull.getAllNested', ['idNested' => $nested->_id, 'idPacket' => $initPaket]) }}"><i
                                                class="fas fa-sign-in-alt"></i></a>
                                    </td>

                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
