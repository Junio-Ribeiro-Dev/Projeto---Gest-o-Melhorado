@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.left-menu')

        <div class="col-lg-10 col-md-9 col-sm-12">
            <div class="pt-3">
                <h1 class="display-6 mb-3 text-primary">
                    <i class="bi bi-distribute-vertical"></i> Exam History
                </h1>

                <div class="card border-dark shadow-sm">
                    <div class="card-header bg-transparent border-dark fw-semibold">
                        <i class="bi bi-diagram-2"></i> Class 1
                    </div>
                    <div class="card-body">

                        <div class="accordion" id="examHistoryAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="section1Heading">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#section1Collapse"
                                        aria-expanded="false" aria-controls="section1Collapse">
                                        Section #1
                                    </button>
                                </h2>
                                <div id="section1Collapse" class="accordion-collapse collapse"
                                    aria-labelledby="section1Heading" data-bs-parent="#examHistoryAccordion">
                                    <div class="accordion-body">

                                        {{-- Timeline Item 1 --}}
                                        <div class="timeline-item d-flex mb-4">
                                            <div class="timeline-marker me-3">
                                                <span class="badge rounded-pill bg-light border">&nbsp;</span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col fs-5 fw-semibold">Quiz 1</div>
                                                            <div class="col text-end text-muted">Jan 9th 2021 9:00 AM</div>
                                                        </div>
                                                        <div class="row text-muted small">
                                                            <div class="col">Belongs to: First Semester</div>
                                                            <div class="col text-end">Starts: Jan 9th - Ends: Jan 15th</div>
                                                        </div>
                                                        <p class="mt-2 mb-0">
                                                            <span class="badge bg-secondary">Course: Math</span>
                                                            <span class="badge bg-dark">Marks: 100</span>
                                                            <span class="badge bg-primary">Category: Quiz</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Timeline Item 2 --}}
                                        <div class="timeline-item d-flex mb-4">
                                            <div class="timeline-marker me-3">
                                                <span class="badge rounded-pill bg-light border">&nbsp;</span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="text-end text-muted small">Tue, Jan 10th 2019 8:30 AM</div>
                                                        <h5 class="fw-semibold">Day 2 Sessions</h5>
                                                        <p class="mb-0">
                                                            Sign-up for the lessons and speakers that coincide with your course syllabus. Meet and greet with instructors.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Timeline Item 3 --}}
                                        <div class="timeline-item d-flex">
                                            <div class="timeline-marker me-3">
                                                <span class="badge rounded-pill bg-light border">&nbsp;</span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="text-end text-muted small">Mon, Jan 9th 2019 7:00 AM</div>
                                                        <h5 class="fw-semibold">Day 1 Orientation</h5>
                                                        <p class="mb-0">
                                                            Welcome to the campus, introduction and get started with the tour.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div> {{-- end accordion-body --}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                @include('layouts.footer')
            </div>
        </div>
    </div>
</div>
@endsection
