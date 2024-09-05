@extends('templates.master')
@section('title', 'Data Packet')
@section('page-name', 'Data Packet')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endpush
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('packetfull.postEntryQuestion') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name_packet">Paket </label>
                                <select name="packet_id" id="name_packet" class="form-control">
                                    <option value="{{ $dataPacketFull->_id }}"> {{ $dataPacketFull->name_packet }} </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="question">Tipe Inputan Pertanyaan</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="question_type" id="text_question" value="text"
                                        checked>
                                    <label class="form-check-label" for="text_question">Pertanyaan Teks</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="question_type" id="image_question" value="image">
                                    <label class="form-check-label" for="image_question">Pertanyaan Gambar / Voice</label>
                                </div>
                            </div>

                            <div class="form-group" id="text_question_div">
                                <label for="question">Pertanyaan</label>
                                <textarea name="question" id="question" class="form-control"></textarea>
                            </div>

                            <div class="form-group" id="image_question_div">
                                <label for="image_question_input">Upload Pertanyaan</label>
                                <input type="file" name="question" id="image_question_input" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="key_question">Kunci Jawaban</label>
                                <input type="text" name="key_question" id="key_question" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="type_question">Tipe Pertanyaan</label>
                                <select id="type_question" name="type_question" class="form-control">
                                    <option value="">-- Pilih Tipe Pertanyaan --</option>
                                    <option value="Listening">Listening</option>
                                    <option value="Structure And Written Expression">Structure And Written Expression</option>
                                    <option value="Reading">Reading</option>
                                </select>
                            </div>
                            <div class="form-group" id="part_question_div" style="display: none;">
                                <label for="part_question">Part Pertanyaan</label>
                                <select name="part_question" id="part_question" class="form-control">
                                    <option value="">-- Pilih Part Pertanyaan --</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script>
    $(document).ready(function() {
        var $textQuestionDiv = $('#text_question_div');
        var $imageQuestionDiv = $('#image_question_div');
        var $partQuestionDiv = $('#part_question_div');
        var $partQuestionSelect = $('#part_question');

        // Default state
        $('#text_question').prop('checked', true);
        $textQuestionDiv.show();
        $imageQuestionDiv.hide();

        $('input[name="question_type"]').change(function() {
            if ($(this).val() === 'image') {
                $textQuestionDiv.hide();
                $imageQuestionDiv.show();
            } else {
                $textQuestionDiv.show();
                $imageQuestionDiv.hide();
            }
        });

        $('#type_question').change(function() {
            var typeQuestion = $(this).val();

            // Clear previous options
            $partQuestionSelect.empty().append('<option value="">-- Pilih Part Pertanyaan --</option>');

            if (typeQuestion === 'Listening' || typeQuestion === 'Structure And Written Expression') {
                $partQuestionDiv.show();
            } else {
                $partQuestionDiv.hide();
                return;
            }

            var options = [];
            if (typeQuestion === 'Listening') {
                options = [
                    { value: "A-SHORT TALKS", text: "A - Short Talks" },
                    { value: "B-Long Conversation", text: "B - Long Conversation" },
                    { value: "C-Mini-Lectures", text: "C - Mini-Lectures" }
                ];
            } else if (typeQuestion === 'Structure And Written Expression') {
                options = [
                    { value: "A-Sentence Completitions", text: "A - Sentence Completitions" },
                    { value: "B-Error Recognition", text: "B - Error Recognition" }
                ];
            }

            $.each(options, function(index, optionData) {
                $partQuestionSelect.append($('<option>', {
                    value: optionData.value,
                    text: optionData.text
                }));
            });
        });
    });
</script>
@endpush
