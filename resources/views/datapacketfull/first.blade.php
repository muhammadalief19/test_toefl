@extends('templates.master')
@section('title', 'All Packet Test')
@section('page-name', 'Data Packet Full Test')
@push('link-template')
<link rel="stylesheet" href="{{ asset('assets/vendor/chartist/css/chartist.min.css') }}">
<link href="{{ asset('assets/vendor/wow-master/css/libs/animate.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="{{ asset('assets/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
@endpush

@push('styles')
<style>
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
                @if (Session::has('error'))
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
                @endif
            </div>
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page-title flex-wrap">
                            <form action="{{ route('packetfull.search') }}" method="GET" class="input-group search-area mb-md-0 mb-3" >
                                <input type="search" class="form-control" name="search" placeholder="Search here...">
                                <span class="input-group-text">
                                    <button type="submit">
                                        <svg width="15" height="15" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.5605 15.4395L13.7527 11.6317C14.5395 10.446 15 9.02625 15 7.5C15 3.3645 11.6355 0 7.5 0C3.3645 0 0 3.3645 0 7.5C0 11.6355 3.3645 15 7.5 15C9.02625 15 10.446 14.5395 11.6317 13.7527L15.4395 17.5605C16.0245 18.1462 16.9755 18.1462 17.5605 17.5605C18.1462 16.9747 18.1462 16.0252 17.5605 15.4395V15.4395ZM2.25 7.5C2.25 4.605 4.605 2.25 7.5 2.25C10.395 2.25 12.75 4.605 12.75 7.5C12.75 10.395 10.395 12.75 7.5 12.75C4.605 12.75 2.25 10.395 2.25 7.5V7.5Z" fill="#01A3FF"/>
                                        </svg>
                                    </button>
                                </span>
                            </form>
                            <div>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                                    + New Packet
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="table-responsive full-data">
                            <table class="table-responsive-lg table display dataTablesCard student-tab dataTable no-footer" id="example-student">
                                <thead>
                                    <tr>
                                        <th class="">No</th>
                                        <th class="">Packet Full Test</th>
                                        <th class="text-center">Jumlah Pertanyaan</th>
                                        <th class="text-center">Service Nested</th>
                                        <th class="text-center">Service Pertanyaan</th>
                                        <th class="">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataPacketFull as $packet)
                                    <tr>
                                        <td class="">{{ $packet->no_packet }}</td>
                                        <td class="mb-0">{{ $packet->name_packet }}</td>
                                        <td class="text-center">
                                            @if($packet->questions->count() == 0)
                                            <span class="btn btn-sm btn-danger"> {{ $packet->questions->count() }}
                                                Pertanyaan</span>
                                            @elseif($packet->questions->count() > 0 && $packet->questions->count() < 30 )
                                                <span class="btn btn-sm btn-warning"> {{ $packet->questions->count() }}
                                                Pertanyaan</span>
                                                @elseif($packet->questions->count() >= 30 && $packet->questions->count() <
                                                    50 ) <span class="btn btn-sm btn-success"> {{ $packet->questions->count()
                                                    }}
                                                    Pertanyaan</span>
                                                    @elseif($packet->questions->count() >= 50)
                                                    <span class="btn btn-sm btn-primary"> {{ $packet->questions->count() }}
                                                        Pertanyaan</span>
                                                    @endif
                                        </td>
                                        <td>
                                            @if($packet->questions->count() == 0)
                                            <div class="text-center">
                                                <button disabled>
                                                    <a class="btn btn-sm btn-sm btn-warning" >
                                                        <i class="fa fa-plus-circle"></i>
                                                    </a>
                                                </button>
                                            </div>
                                            @else
                                            <div class="text-center">
                                                <a class="btn btn-warning" href="{{ route('packetfull.entryNested', $packet->_id) }}">
                                                    <i class="fa fa-plus-circle"></i>
                                                    Tambah Nested Question
                                                </a>
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <a class="btn btn-success"
                                                    href="{{ route('packetfull.index', $packet->_id) }}">
                                                    <i class="fa fa-sign-in-alt"></i>
                                                    Tambah Pertanyaan
                                                </a>
                                            </div>
                                            <td>
                                                <a class="btn btn-primary shadow btn-xs sharp" href="#" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $packet->_id }}">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            <button class="btn btn-sm btn-danger btn-xs sharp"
                                                onclick="confirmDelete('{{ route('packetmini.delete', $packet->_id) }}')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                        {{-- edit modal --}}
                                        <div class="modal fade" id="editModal{{ $packet->_id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-center">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Packet</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('packetmini.edit', $packet->_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="form-group">
                                                                <label for="name_packet">Nama Packet</label>
                                                                <input type="text" class="form-control" id="name_packet"
                                                                    name="name_packet" value="{{ $packet->name_packet }}"
                                                                    required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Simpan
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
                            </table>
                            {{-- {{ $dataPacketFull->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Packet Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('packetmini.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="no_packet">No Packet</label>
                        <input class="form-control" type="number" name="no_packet" id="no_packet"
                            required>
                        <label for="name_packet">Nama Packet</label>
                        <input type="text" class="form-control" id="name_packet" name="name_packet"
                            required>
                        <input type="hidden" name="tipe_test_packet" value="Full Test">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{ asset('assets/vendor/wow-master/dist/wow.min.js') }}"></script>
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
                window.location.href = deleteUrl;
            }
        });
    }
</script>
@endpush
