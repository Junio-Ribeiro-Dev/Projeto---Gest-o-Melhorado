@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3"><i class="bi bi-calendar4-range"></i> Rotina</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
                            <li class="breadcrumb-item"><a href="{{url()->previous()}}">Turmas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Rotina da Seção</li>
                        </ol>
                    </nav>
                    @php
                        function getDayName($weekday) {
                            $days = [
                                1 => "Segunda-feira",
                                2 => "Terça-feira",
                                3 => "Quarta-feira",
                                4 => "Quinta-feira",
                                5 => "Sexta-feira",
                                6 => "Sábado",
                                7 => "Domingo",
                            ];
                            return $days[$weekday] ?? "Dia inválido";
                        }
                    @endphp
                    @if(count($routines) > 0)
                    <div class="bg-white p-3 border shadow-sm">
                        <table class="table table-bordered text-center align-middle">
                            <thead>
                                <tr>
                                    <th>Dia</th>
                                    <th>Horário e Curso</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($routines as $day => $courses)
                                    <tr>
                                        <th scope="row">{{ getDayName($day) }}</th>
                                        <td>
                                            @php
                                                $courses = $courses->sortBy('start');
                                            @endphp
                                            @foreach($courses as $course)
                                                <div class="mb-2">
                                                    <strong>{{$course->course->course_name}}</strong><br>
                                                    <small>{{$course->start}} - {{$course->end}}</small>
                                                </div>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="p-3 bg-white border shadow-sm text-center">Nenhuma rotina encontrada.</div>
                    @endif
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
