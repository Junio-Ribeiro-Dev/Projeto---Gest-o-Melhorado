@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-calendar2-week-fill"></i> Ver Chamada
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url()->previous()}}">Cursos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ver Chamada</li>
                        </ol>
                    </nav>
                    @if(request()->query('course_name'))
                        <h3><i class="bi bi-compass"></i> Course: {{request()->query('course_name')}} </h3>
                    @elseif(request()->query('section_name'))
                        <h3><i class="bi bi-diagram-2"></i> Section: {{request()->query('section_name')}} </h3>
                    @endif
                    <div class="mt-4">Data e Hora atual: {{ date('Y-m-d H:i:s') }}</div>
                    <div class="row mt-4">
                        <div class="col bg-white border shadow-sm pt-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome do aluno</th>
                                        <th scope="col">Status de hoje</th>
                                        <th scope="col">Data da Presença</th> {{-- Nova coluna --}}
                                        <th scope="col">Total de participantes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances as $attendance)
                                        @php
                                            $total_attended = \App\Models\Attendance::where('student_id', $attendance->student_id)
                                                ->where('session_id', $attendance->session_id)
                                                ->count();
                                        @endphp
                                        <tr>
                                            <td>{{$attendance->student->first_name}} {{$attendance->student->last_name}}</td>
                                            <td>
                                                @if ($attendance->status == "on" || $attendance->status == 1)
                                                    <span class="badge bg-success">PRESENTE</span>
                                                @else
                                                    <span class="badge bg-danger">FALTANTE</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- Exibe data formatada --}}
                                                {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d/m/Y H:i') }}
                                            </td>
                                            <td>{{$total_attended}}</td>
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
@endsection
