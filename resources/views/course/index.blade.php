@php
    function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
}
@endphp

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
                        <h4 class="card-title">Data Course</h4>
                    </div>
                    <ul class="nav nav-tabs dzm-tabs" id="myTab" role="tablist">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                            + New Course
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
                                            <th>Name</th>
                                            <th>Instructor</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['courseData'] as $item)
                                            <tr>
                                                <td>
                                                    {{ $data['no']++ }}
                                                </td>
                                                <td>
                                                    {{ $item->course_name }}
                                                </td>
                                                <td>
                                                    {{ $item->instructor->name }}
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
                                                                <h1 class="modal-title fs-5" id="editModalLabel">Edit Role
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('course.update', $item->_id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <div class="form-group mb-3">
                                                                        <label for="course_name">Course Name</label>
                                                                        <input class="form-control" type="text"
                                                                            name="course_name" id="course_name"
                                                                            autocomplete="off"
                                                                            value="{{ $item->course_name }}">
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="category_id">Category</label>
                                                                        <select class="default-select form-control wide"
                                                                            id="category_id" name="category_id">
                                                                            @foreach ($data['courseCategoriesData'] as $category)
                                                                                <option value="{{ $category->_id }}"
                                                                                    {{ $item->category_id == $category->_id ? 'selected' : '' }}>
                                                                                    {{ $category->category_name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="level_name">Instructor</label>
                                                                        <select class="default-select form-control wide"
                                                                            name="instructor_id" id="instructor_id">
                                                                            @foreach ($data['instructorsData'] as $instructor)
                                                                                <option value="{{ $instructor->_id }}"
                                                                                    {{ $item->instructor_id == $instructor->_id ? 'selected' : '' }}>
                                                                                    {{ $instructor->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="level_name">Level</label>
                                                                        <select class="default-select form-control wide"
                                                                            name="difficulty_level_id"
                                                                            id="difficulty_level_id">
                                                                            </option>
                                                                            @foreach ($data['levelsData'] as $level)
                                                                                <option value="{{ $level->_id }}"
                                                                                    {{ $item->level_id == $level->_id ? 'selected' : '' }}>
                                                                                    {{ $level->level_name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="duration">Duration ( Minute )</label>
                                                                        <input class="form-control" type="number"
                                                                            name="duration" id="duration"
                                                                            autocomplete="off"
                                                                            value="{{ $item->duration }}">
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="price">Price</label>
                                                                        <input class="form-control" type="number"
                                                                            name="price" id="price"
                                                                            autocomplete="off"
                                                                            value="{{ $item->price }}">
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="description">Description</label>
                                                                        <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ $item->description }}</textarea>
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
                                                                    Course</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mb-3">
                                                                    <h4 class="text-primary mb-2">
                                                                        Course Name
                                                                    </h4>
                                                                    <p class="">
                                                                        {{ $item->course_name }}
                                                                    </p>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <h4 class="text-primary mb-2">
                                                                        Category
                                                                    </h4>
                                                                    <p class="">
                                                                        {{ $item->category->category_name }}
                                                                    </p>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <h4 class="text-primary mb-2">
                                                                        Instructor
                                                                    </h4>
                                                                    <p class="">
                                                                        {{ $item->instructor->name }}
                                                                    </p>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <h4 class="text-primary mb-2">
                                                                        Level
                                                                    </h4>
                                                                    <p class="">
                                                                        {{ $item->difficultyLevel->level_name }}
                                                                    </p>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <h4 class="text-primary mb-2">
                                                                        Duration
                                                                    </h4>
                                                                    <p class="">
                                                                        {{ intdiv($item->duration, 60).' Menit '.($item->duration % 60).' Detik'; }}
                                                                    </p>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <h4 class="text-primary mb-2">
                                                                        Price
                                                                    </h4>
                                                                    <p class="">
                                                                        {{ rupiah($item->price) }}
                                                                    </p>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <h4 class="text-primary mb-2">
                                                                        Description
                                                                    </h4>
                                                                    <p class="">
                                                                        {{ $item->description }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- update modal --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Instructor</th>
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
                    <h1 class="modal-title fs-5" id="addModalLabel">Course Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('course.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="course_name">Course Name</label>
                            <input class="form-control" type="text" name="course_name" id="course_name"
                                autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="category_id">Category</label>
                            <select class="default-select form-control wide" id="category_id" name="category_id">
                                <option value="">
                                    Not Selected
                                </option>
                                @foreach ($data['courseCategoriesData'] as $item)
                                    <option value="{{ $item->_id }}">
                                        {{ $item->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="level_name">Instructor</label>
                            <select class="default-select form-control wide" name="instructor_id" id="instructor_id">
                                <option value="">
                                    Not Selected
                                </option>
                                @foreach ($data['instructorsData'] as $item)
                                    <option value="{{ $item->_id }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="level_name">Level</label>
                            <select class="default-select form-control wide" name="difficulty_level_id"
                                id="difficulty_level_id">
                                <option value="">
                                    Not Selected
                                </option>
                                @foreach ($data['levelsData'] as $item)
                                    <option value="{{ $item->_id }}">
                                        {{ $item->level_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="duration">Duration ( Minute )</label>
                            <input class="form-control" type="number" name="duration" id="duration"
                                autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="price">Price</label>
                            <input class="form-control" type="number" name="price" id="price"
                                autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
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
                            url: `/course/delete/${id}`,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "_method": 'DELETE',
                            },
                            success: function(data) {
                                window.location.href = "/course";
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
@endpush
