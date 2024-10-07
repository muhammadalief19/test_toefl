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
                        <h4 class="card-title">Quiz Question</h4>
                    </div>
                    <ul class="nav nav-tabs dzm-tabs" id="myTab" role="tablist">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                            + New Quiz Question
                        </button>
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
                                            <th>Konten</th>
                                            <th>Pilihan Ganda</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['quizQuestionData'] as $question)

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $question->question }}

                                                <button class="btn btn-sm" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#questionEditModal_{{ $question->_id }}">
                                                    <i class="fas fa-pencil"></i>
                                                </button>
                                                <div class="modal fade" id="questionEditModal_{{ $question->_id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="questionDetailModalLabel_{{ $question->_id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Question</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('quizQuestion.update', ['id' => $question->_id]) }}" method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <div class="modal-body">
                                                                        <div class="form-group mb-3">
                                                                            <label for="editedQuestion{{ $question->_id }}">Quiz Question</label>
                                                                            <textarea class="form-control" id="editedQuestion{{ $question->_id }}" name="question" rows="6">{{ $question->question }}</textarea>
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
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm" type="button" data-bs-toggle="modal"
                                                data-bs-target="#questionAddContentModal_{{ $question->_id }}">
                                                    <i class="fa fa-plus-circle"></i> Add Content
                                                </button>
                                                <div class="modal fade" id="questionAddContentModal_{{ $question->_id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="questionAddContentLabel_{{ $question->_id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Detail Question Content</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group mb-3">
                                                                <div class="row mb-3">
                                                                    <h5 class="text-danger mb-2">
                                                                        Jika ingin edit content, silahkan ubah disini
                                                                    </h5>
                                                                    @foreach ( $question->contents as $content)
                                                                    <form action="{{ route('quizQuestionContent.update', ['id' => $content->_id]) }}" method="POST" class="mb-2 item-center">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <div class="">
                                                                            <input type="text" value="{{ $content->content }}" name="content" class="form-control mb-2">
                                                                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></button>
                                                                        </div>
                                                                    </form>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                                <form action="{{ route('quizQuestionContent.store') }}" method="POST">
                                                                    @csrf
                                                                        <h5 class="text-danger">silahkan tambahkan content disini</h5>
                                                                        <input type="text" class="form-control" id="addQuestionContent{{ $question->_id }}" name="quiz_question_id" value="{{ $question->_id }}" hidden>
                                                                        <div class="form-group mb-3">
                                                                            <label for="addQuestionContent{{ $question->_id }}">Content</label>
                                                                            <input type="text" class="form-control" id="addQuestionContent{{ $question->_id }}" name="content">
                                                                        </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#multipleChoiceModal_{{ $question->_id }}">
                                                        <i class="fas fa-list"></i>
                                                    </button>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="multipleChoiceModal_{{ $question->_id }}" tabindex="-1" role="dialog" aria-labelledby="multipleChoiceModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="multipleChoiceModalLabel">
                                                                    {{ $question->contents ? 'Detail Opsi Jawaban' : 'Tambah Pilihan Ganda' }}
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Kondisi jika terdapat opsi jawaban pada question -->

                                                                <div class="form-group">
                                                                    <p>Opsi Jawaban yang ada:</p>
                                                                    @foreach($question->contents as $option)
                                                                        <p>{{ $option->content }}</p>
                                                                        @foreach ($option->options as $choices)
                                                                            @if (isset($choices['options']) && is_array($choices['options']))
                                                                                @foreach($choices['options'] as $choice)
                                                                                <div>
                                                                                    <strong>Opsi:</strong> {{ $choice }}

                                                                                    <!-- Form untuk menandai sebagai kunci jawaban -->
                                                                                    <form action="{{ route('quiz.answerKey.store') }}" method="POST">
                                                                                        @csrf
                                                                                        <input type="hidden" name="quiz_content_id" value="{{ $option->_id }}">
                                                                                        <input type="hidden" name="quiz_option_id" value="{{ $choices->_id }}">
                                                                                        <input type="hidden" name="quiz_options" value="{{ $choice }}">
                                                                                        <input type="text" name="explanation" class="form-control">
                                                                                        <button type="submit" class="btn btn-success">Set as Key</button>
                                                                                    </form>
                                                                                </div>
                                                                                @endforeach
                                                                            @endif
                                                                        @endforeach
                                                                    @endforeach
                                                                </div>

                                                                    <!-- Jika tidak ada opsi, tampilkan form untuk menambah opsi baru -->
                                                                        <form id="multipleChoiceForm_{{ $question->_id }}" method="POST"
                                                                            action="{{ route('quizOptions.store', ['id' => $question->_id]) }}">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <p>Pilih Konten:</p>
                                                                                <select class="form-control mb-2" id="quiz_content_id" name="quiz_content_id">
                                                                                    <option value="">Pilih Konten</option>
                                                                                    @foreach($question->contents as $content)
                                                                                        <option value="{{ $content->_id }}">{{ $content->content }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                <div id="multipleChoicesContainer_{{ $question->_id }}">
                                                                                    <p>Tambahkan Opsi Jawaban:</p>
                                                                                    <input type="text" class="form-control mb-2" name="options[]" placeholder="Opsi Jawaban" required>
                                                                                </div>
                                                                            </div>
                                                                            <button type="button" class="btn btn-success btn-add-choice" data-max-choices="5"
                                                                                data-parent="#multipleChoicesContainer_{{ $question->_id }}">
                                                                                <i class="fa fa-plus"></i> Tambah Pilihan Jawaban
                                                                            </button>
                                                                            <div class="modal-footer mt-3">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                                            </div>
                                                                        </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                    {{-- </form> --}}
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th>No</th>
                                        <th>Pertanyaan</th>
                                        <th>Konten</th>
                                        <th>Pilihan Ganda</th>
                                        <th>Aksi</th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    {{-- add modal --}}
    <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Quiz Question Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('quizQuestion.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <input class="form-control" type="text" name="quiz_id" id="quiz_id"
                                value="{{ $data['quizzesId'] }}" hidden>
                        </div>
                        <div class="form-group mb-3">
                            <label for="question">Question Quiz</label>
                            <input class="form-control" type="text" name="question" id="question"
                                autocomplete="off">
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
                    parent.append('<input type="text" class="form-control mb-2" name="options[]" required>');
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
@endpush
