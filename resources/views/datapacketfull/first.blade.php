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
                        <h4 class="card-title">Data Full Packet</h4>
                    </div>
                    <ul class="nav nav-tabs dzm-tabs" id="myTab" role="tablist">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                            + New Packet
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
                                            <th class="">No</th>
                                            <th class="">Packet Mini Test</th>
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
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn btn-primary shadow btn-icon-sm me-1" href="#"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $packet->_id }}">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <button class="btn btn-danger shadow btn-icon-sm"
                                                        onclick="confirmDelete('{{ route('packetmini.delete', $packet->_id) }}')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
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
                                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
                                            <th class="">No</th>
                                            <th class="">Packet Full Test</th>
                                            <th class="text-center">Jumlah Pertanyaan</th>
                                            <th class="text-center">Service Nested</th>
                                            <th class="text-center">Service Pertanyaan</th>
                                            <th class="">Aksi</th>
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
