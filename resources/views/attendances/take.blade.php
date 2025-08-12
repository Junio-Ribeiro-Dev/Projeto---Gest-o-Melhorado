@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-12 col-lg-10">
            <div class="row pt-2">
                <div class="col-12 px-3 px-lg-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-calendar2-week"></i> Marque presença
                    </h1>

                    @include('session-messages')

                    <h3><i class="bi bi-compass"></i>
                        Class #{{ request()->query('class_name') }}, 
                        @if ($academic_setting->attendance_type == 'course')
                            Course: {{ request()->query('course_name') }}
                        @else
                            Section #{{ request()->query('section_name') }}
                        @endif
                    </h3>

                    <div class="row mt-4">
                        <div class="col-12 bg-white border p-3 shadow-sm overflow-auto">
                            <form action="{{ route('attendances.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="session_id" value="{{ $current_school_session_id }}">
                                <input type="hidden" name="class_id" value="{{ request()->query('class_id') }}">
                                @if ($academic_setting->attendance_type == 'course')
                                    <input type="hidden" name="course_id" value="{{ request()->query('course_id') }}">
                                    <input type="hidden" name="section_id" value="0">
                                @else
                                    <input type="hidden" name="course_id" value="0">
                                    <input type="hidden" name="section_id" value="{{ request()->query('section_id') }}">
                                @endif

                                <div class="mb-4">
                                    <label for="attendance_datetime" class="form-label fw-semibold text-secondary">
                                        <i class="bi bi-clock-history me-2"></i> Data e Hora da Presença
                                    </label>
                                    <input 
                                        type="datetime-local" 
                                        id="attendance_datetime" 
                                        name="attendance_datetime" 
                                        class="form-control"
                                        value="{{ old('attendance_datetime', date('Y-m-d\TH:i')) }}" 
                                        required
                                    >
                                    <div class="form-text text-muted ps-3">
                                        Escolha a data e hora para registrar a presença do aluno.
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover mb-3">
                                        <thead>
                                            <tr>
                                                <th scope="col"># ID Card do Aluno</th>
                                                <th scope="col">Nome do aluno</th>
                                                <th scope="col">Presente</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($student_list as $student)
                                                <input type="hidden" name="student_ids[]" value="{{ $student->student_id }}">
                                                <tr>
                                                    <th scope="row">{{ $student->id_card_number }}</th>
                                                    <td>{{ $student->student->first_name }} {{ $student->student->last_name }}</td>
                                                    <td class="text-center">
                                                        <input class="form-check-input" type="checkbox" name="status[{{ $student->student_id }}]" checked>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i class="bi bi-check2"></i> Enviar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
