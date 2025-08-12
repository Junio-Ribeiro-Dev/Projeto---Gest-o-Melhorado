@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-12 col-lg-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-cloud-sun"></i> Notas do Curso
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
                            <li class="breadcrumb-item"><a href="{{url()->previous()}}">Meus Cursos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Notas do Curso</li>
                        </ol>
                    </nav>
                    <h5>Curso: {{$course_name}}</h5>
                    <div class="mb-4 mt-4 p-3 bg-white border shadow-sm table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nome do Exame</th>
                                    <th scope="col">Notas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($marks as $mark)
                                    <tr>
                                        <td>{{$mark->exam->exam_name}}</td>
                                        <td>{{$mark->marks}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if(count($final_marks) > 0)
                    <h5>Resultado Final</h5>
                    <div class="bg-white border mt-4 p-3 shadow-sm table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Notas Totais</th>
                                    <th scope="col">Pontos de Nota</th>
                                    <th scope="col">Conceito</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($final_marks)
                                    @foreach ($final_marks as $mark)
                                    <tr>
                                        <td>{{$mark->final_marks}}</td>
                                        <td>{{$mark->getAttribute('point')}}</td>
                                        <td>{{$mark->getAttribute('grade')}}</td>
                                    </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
