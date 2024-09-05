@extends('templates.master')
@section('title', 'Nested Question ')
@section('page-name', 'Entry Nested Question')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha256-PI8n5gCcz9cQqQXm3PEtDuPG8qx9oFsFctPg0S5zb8g=" crossorigin="anonymous">
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
                <div class="card">
                    <div class="card-header">
                        Data Pertanyaan yang sudah ke assign ke nested pertanyaan <button class="btn btn-sm"
                            data-bs-toggle="modal" data-bs-target="#cekNested"><i class="fa fa-eye"></i></button>
                        <- cek pertanyaan nested nya </div>

                            {{-- modal check nested Question --}}
                            <div class="modal fade" id="cekNested" tabindex="-1" role="dialog"
                                aria-labelledby="cekNested" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cekNested">Add Nested Question</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @if(Str::startsWith($initNestedQuestion->question_nested,
                                            'nested_question/'))
                                            <audio controls>
                                                <source
                                                    src="{{'nested_question/'.$initNestedQuestion->question_nested }}"
                                                    type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                            @else
                                            {!! html_entity_decode($initNestedQuestion->question_nested) !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body mt-3">
                                <div class="table">
                                    <table class="table table-bordered" id="table4">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Pertanyaan</th>
                                                {{-- <th>Count Question</th>
                                                <th>Entry Nested Question</th> --}}
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getAllNestedQuestionPaket as $nested)
                                            <tr>
                                                <td> {{ $loop->iteration }}</td>

                                                <td>
                                                    @if(Str::startsWith($nested->question->question, 'nested_question/'))
                                                    <audio controls>
                                                        <source
                                                            src="{{ 'nested_question/'.$nested->question->question }}"
                                                            type="audio/mpeg">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                    @else

                                                    {{ Str::limit($nested->question->question, 50, '...') }}
                                                    @endif


                                                <td>
                                                    <a href="{{ route('packetfull.deleteNestedQuestion', $nested->_id) }}"
                                                        onclick="confirmDelete(event, '{{ route('packetfull.deleteNestedQuestion', $nested->_id) }}')"
                                                        class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                                </td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Pertanyaan dari paket terkait</div>
                    <div class="card-body mt-3">
                        <div class="table">
                            <table class="table table-bordered" id="table3">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pertanyaan</th>
                                        {{-- <th>Count Question</th>
                                        <th>Entry Nested Question</th> --}}
                                        <th>Tambahkan Pertanyaan ke nested</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getAllQuestionNotNested as $question)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td>

                                            @if(Str::startsWith($question->question, 'questions/'))
                                            <audio controls>
                                                <source src="{{ 'nested_question/'. $question->question }}"
                                                    type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                            @else

                                            {{ Str::limit($question->question, 50, '...') }}
                                            @endif


                                        <td>
                                            <form action="{{ route('packetfull.storeDataNested', $question->_id) }}"
                                                method="post">
                                                @csrf
                                                <input type="hidden" name="nested_question_id" value="{{ $idNested }}">
                                                <button class="btn btn-sm btn-primary" type="submit"><i
                                                        class="fa fa-check"></i></button>
                                            </form>

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
</section>


@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha256-3gQJhtmj7YnV1fmtbVcnAV6eI4ws0Tr48bVZCThtCGQ=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#table3').DataTable({
            "paging": true,
            "searching": true,
            "pageLength" : 5,
            "columnDefs": [
                { "searchable": true, "targets": [0, 1] }
            ],

        });
    });

    $(document).ready(function() {
        $('#table4').DataTable({
            "paging": true,
            "searching": true,
            "pageLength" : 5,
            "columnDefs": [
                { "searchable": true, "targets": [0, 1] }
            ],

        });
    });
</script>

<script>
    function confirmDelete(event, deleteUrl) {
    event.preventDefault(); // Mencegah perilaku default dari tautan

    // Tampilkan SweetAlert2 untuk konfirmasi penghapusan
    Swal.fire({
        title: 'Apakah Anda yakin menghapus pertanyaan ini di nested?',
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
