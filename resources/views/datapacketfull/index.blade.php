@extends('layouts.layout')

@section('content')
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
            <div class="card" id="accordion-two">
                <div class="card-header flex-wrap d-flex justify-content-between px-3">
                    <div>
                        <h4 class="card-title">Question Full Packet</h4>
                    </div>
                    <ul class="nav nav-tabs dzm-tabs" id="myTab" role="tablist">
                        @if (request()->routeIs('packetfull.index'))
                        <a href="{{ route('packetfull.entryQuestion', $dataId) }}" class="btn btn-primary" >
                            + New Question
                        </a>
                        @endif
                        @if (request()->routeIs('packetmini.index'))
                        <a href="{{ route('packetfull.entryQuestion', $dataId) }}" class="btn btn-primary" >
                            + New Question
                        </a>
                        @endif
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table id="example" class="display table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                                <th>Pertanyaan</th>
                                                <th>Kunci Jawaban</th>
                                                <th>Pilihan Ganda</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dataPacketFull as $key => $packet)
                                        @foreach($packet->questions as $question)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if(Str::startsWith($question->question_text, 'questions/'))
                                                    @if(Str::endsWith($question->question_text, ['.jpg', '.jpeg', '.png', '.gif']))
                                                        Menampilkan gambar
                                                        <img src="{{ asset('storage/'.$question->question) }}" alt="Question Image" style="max-width: 100px;">
                                                    @elseif(Str::endsWith($question->question_text, ['.mp3', '.wav', '.ogg']))
                                                        Menampilkan audio
                                                        <audio controls>
                                                            <source src="{{ asset('storage/'.$question->question) }}" type="audio/mpeg">
                                                            Your browser does not support the audio element.
                                                        </audio>
                                                    @else
                                                        Menampilkan teks
                                                        @if(strlen($question->question) > 50)
                                                            <button class="btn btn-sm" type="button" data-bs-toggle="modal"
                                                                    data-target="#questionDetailModal_{{ $question->_id }}">
                                                                <i class="fas fa-eye mx-2 view-detail"></i>
                                                            </button>
                                                        @endif
                                                        {{ Str::limit($question->question_text, 50, '...') }}
                                                    @endif
                                                @else
                                                    {{-- Menampilkan teks jika tidak ada prefix 'questions/' --}}
                                                    @if(strlen($question->question) > 50)
                                                        <button class="btn btn-sm" type="button" data-toggle="modal"
                                                                data-target="#questionDetailModal_{{ $question->_id }}">
                                                            <i class="fas fa-eye mx-2 view-detail"></i>
                                                        </button>
                                                    @endif
                                                    {{ Str::limit($question->question_text, 50, '...') }}
                                                @endif

                                                <button class="btn btn-sm" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#editInstructionsModale{{ $question->_id }}">
                                                    <i class="fas fa-pencil"></i>
                                                </button>
                                                <div class="modal fade" id="editInstructionsModale{{ $question->_id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="editInstructionsModalLabel{{ $question->_id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editInstructionsModalLabel{{ $question->_id }}">
                                                                    Edit Question🤗</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"></span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('packetfull.editQuestion', ['id' => $question->_id]) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('patch')
                                                                <div class="modal-body">
                                                                    <p><small class="text-danger">Catatan: Silahkan pilih salah satu
                                                                            antara pertanyaan nested teks atau voice/gambar. 🤗</small></p>

                                                                    <div class="form-group" id="text_question_div">
                                                                        <label for="question">Pertanyaan Text</label>
                                                                        <textarea name="question" id="question_text"
                                                                            class="form-control"></textarea>
                                                                    </div>

                                                                    <p>Atau</p>

                                                                    <div class="form-group" id="image_question_div">
                                                                        <label for="image_question_input">Pertanyaan Gambar / Voice</label>
                                                                        <input type="file" name="question" id="question_image_input"
                                                                            class="form-control">
                                                                    </div>

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- qeustionDetailModal --}}
                                                <div class="modal fade" id="questionDetailModal_{{ $question->_id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="questionDetailModalLabel_{{ $question->_id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Detail Pertanyaan😉</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{ $question->question }}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if(strlen($question->key_question) > 50)
                                                <button class="btn btn-sm" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#keyQuestionDetailModal_{{ $question->_id }}">
                                                    <i class="fas fa-eye mx-2 view-detail"></i>
                                                </button>
                                                @endif
                                                {{ Str::limit($question->key_question, 40, '...') }}
                                                <button class="btn btn-sm" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#editInstructionsModal{{ $question->_id }}">
                                                    <i class="fas fa-pencil"></i>
                                                </button>
                                                {{-- modal detail keyquestion --}}
                                                <div class="modal fade" id="keyQuestionDetailModal_{{ $question->_id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="questionDetailModalLabel_{{ $question->_id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Detail Key Question😉</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{ $question->key_question }}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="editInstructionsModal{{ $question->_id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="editInstructionsModalLabel{{ $question->_id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editInstructionsModalLabel{{ $question->_id }}">
                                                                    Edit Jawaban
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('packetfull.editAnswer', ['id' => $question->_id]) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="editedQuestion{{ $question->_id }}">Jawaban</label>
                                                                        <textarea class="form-control" id="editedQuestion{{ $question->_id }}" name="key_question" rows="6">{{ $question->key_question }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#multipleChoiceModal_{{ $question->_id }}"> <i
                                                            class="fas fa-list"></i></button>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="multipleChoiceModal_{{ $question->_id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="multipleChoiceModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="multipleChoiceModalLabel">Pilihan Ganda Entry
                                                                    Service
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"></span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="multipleChoiceForm_{{ $question->_id }}" method="POST"
                                                                    action="{{ route('packetfull.entryMultiple', ['id' => $question->_id]) }}">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <div id="multipleChoicesContainer_{{ $question->_id }}">
                                                                            <p>Kunci Jawaban : </p>
                                                                            <p><small class="text-danger">Catatan: Kunci jawaban tidak perlu
                                                                                    diimasukkan lagi yaa. 🤗</small></p>
                                                                            <input type="text" class="form-control mb-2" name=""
                                                                                value="{{ $question->key_question }}" required readonly hidden>
                                                                            <p><small class="text-danger">jika mau edit kunci jawaban,
                                                                                    silahkan edit di halaman sebelumnya yaa🤗</small></p>

                                                                            <p>Pilihan Ganda : </p>
                                                                            @if($question->multipleChoices)
                                                                            @foreach($question->multipleChoices as $choice)
                                                                            @if($choice->choice != $question->key_question)
                                                                            <input type="text" class="form-control mb-2" name="choice[]"
                                                                                value="{{ $choice->choice }}" required>
                                                                            @endif
                                                                            @endforeach

                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <button type="button" class="btn btn-success btn-add-choice"
                                                                        data-max-choices="5"
                                                                        data-parent="#multipleChoicesContainer_{{ $question->_id }}"><i
                                                                            class="fa fa-plus"></i> Tambah
                                                                        Pilihan Jawaban</button>
                                                                    <div class="modal-footer mt-3">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="submit" class="btn btn-primary btn-save-choices"
                                                                            data-question-id="{{ $question->_id }}">Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            </form>
                                        </tr>
                                        @endforeach
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
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>


<script src="{{ asset('assets/vendor/wow-master/dist/wow.min.js') }}"></script>
<script>
    $(document).ready(function(){
            $('.edit-button').click(function(){
                var inputField = $(this).closest('.input-group').find('input[type="text"]');
                inputField.removeAttr('readonly');
            });

            $('.btn-add-choice').click(function(){
                var maxChoices = $(this).data('max-choices');
                var parent = $($(this).data('parent'));
                var numChoices = parent.find('.form-control').length;
                if (numChoices < maxChoices) {
                    parent.append('<input type="text" class="form-control mb-2" name="choice[]" required>');
                } else {
                    alert('Anda telah mencapai jumlah maksimum pilihan jawaban.');
                }
            });

            $('.btn-save-choices').click(function(){
                var questionId = $(this).data('question-id');
                var formData = $('#multipleChoiceForm_' + questionId).serializeArray();
                console.log('Question ID:', questionId);
                console.log('Pilihan Jawaban:', formData);

                $('#multipleChoiceModal_' + questionId).modal('hide');
            });
        });


</script>

<script>
    $(document).ready(function() {
        $('#table1').DataTable({
            "paging": true,
            "searching": true,
            "columnDefs": [
                { "searchable": true, "targets": [0, 1] } // Kolom yang tidak ingin dicari
            ],

        });
    });
</script>
@endpush
