@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/fullcalendar5.9.0.min.css') }}">
<script src="{{ asset('js/fullcalendar5.9.0.main.min.js') }}"></script>

@php
use Carbon\Carbon;

// Preparar eventos para o calendário no formato ISO8601 e cores corretas
$events = [];
foreach ($attendances as $attendance) {
    $isPresent = ($attendance->status == 1 || $attendance->status === "1");
    $statusText = $isPresent ? 'Present' : 'Absent';
    $color = $isPresent ? 'green' : 'red';

    if ($attendance->attendance_date) {
        $start = Carbon::parse($attendance->attendance_date)->format('Y-m-d\TH:i:s');
        $events[] = [
            'title' => $statusText,
            'start' => $start,
            'color' => $color,
        ];
    }
}
@endphp

<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-calendar2-week"></i> Ver Chamada
                    </h1>

                    <h5><i class="bi bi-person"></i> Nome do Aluno: {{ $student->first_name }} {{ $student->last_name }}</h5>

                    <div class="row mt-3">
                        <div class="col bg-white p-3 border shadow-sm">
                            <div id="attendanceCalendar"></div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col bg-white border shadow-sm p-3">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Status</th>
                                        <th scope="col">Data</th>
                                        <th scope="col">Contexto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances as $attendance)
                                        <tr>
                                            <td>
                                                @if ($attendance->status == 1 || $attendance->status === "1")
                                                    <span class="badge bg-success">PRESENTE</span>
                                                @else
                                                    <span class="badge bg-danger">FALTANTE</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d/m/Y H:i') }}
                                            </td>
                                            <td>
                                                {{ $attendance->section ? $attendance->section->section_name : ($attendance->course ? $attendance->course->course_name : '-') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('attendanceCalendar');
    var attEvents = @json($events);

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 350,
        locale: 'pt-br',  // define o idioma português do Brasil
        events: attEvents,
    });

    calendar.render();
});
</script>


<script src="{{ asset('js/fullcalendar5.9.0.main.min.js') }}"></script>
<script src="{{ asset('js/locales/pt-br.js') }}"></script> 
@endsection
