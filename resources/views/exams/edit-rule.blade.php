@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.left-menu')

        <div class="col-lg-10 col-md-9 col-sm-12">
            <div class="pt-3">
                <h1 class="display-6 fw-bold mb-3 text-primary">
                    <i class="bi bi-file-plus"></i> Edit Exam Rule
                </h1>

                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb bg-light p-2 rounded">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}"><i class="bi bi-house"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url()->previous() }}">Exams Rules</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Exam Rule</li>
                    </ol>
                </nav>

                @include('session-messages')

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white fw-semibold">
                        <i class="bi bi-pencil-square"></i> Update Rule
                    </div>
                    <div class="card-body">
                        <form action="{{ route('exam.rule.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="exam_rule_id" value="{{ $exam_rule_id }}">

                            <div class="mb-3">
                                <label for="inputTotalMarks" class="form-label">
                                    Total Marks <sup><i class="bi bi-asterisk text-danger"></i></sup>
                                </label>
                                <input type="number" 
                                    class="form-control" 
                                    id="inputTotalMarks" 
                                    name="total_marks" 
                                    value="{{ $exam_rule->total_marks }}" 
                                    step="0.01" 
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="inputPassMarks" class="form-label">
                                    Pass Marks <sup><i class="bi bi-asterisk text-danger"></i></sup>
                                </label>
                                <input type="number" 
                                    class="form-control" 
                                    id="inputPassMarks" 
                                    name="pass_marks" 
                                    value="{{ $exam_rule->pass_marks }}" 
                                    step="0.01" 
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="inputMarksDistributionNote" class="form-label">
                                    Marks Distribution Note <sup><i class="bi bi-asterisk text-danger"></i></sup>
                                </label>
                                <textarea 
                                    class="form-control" 
                                    id="inputMarksDistributionNote" 
                                    rows="3" 
                                    name="marks_distribution_note" 
                                    required>{{ $exam_rule->marks_distribution_note }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-2">
                                    <i class="bi bi-arrow-left"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                @include('layouts.footer')
            </div>
        </div>
    </div>
</div>
@endsection
