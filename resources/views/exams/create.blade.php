@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3"><i class="bi bi-file-plus"></i> Criar Prova</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Criar Prova</li>
                        </ol>
                    </nav>
                    @include('session-messages')
                    <div class="row">
                        <div class="col-md-5 mb-4">
                            <div class="p-3 border bg-light shadow-sm">
                                <form action="{{route('exam.create')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                                    <div>
                                        <p>Selecionar Semestre:<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                        <select class="form-select" name="semester_id">
                                            @isset($semesters)
                                                @foreach ($semesters as $semester)
                                                <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    <div>
                                        <p class="mt-2">Selecionar Turma:<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                        <select onchange="getCourses(this);" class="form-select" name="class_id">
                                            @isset($classes)
                                                <option selected disabled>Por favor, selecione uma turma</option>
                                                @foreach ($classes as $school_class)
                                                <option value="{{$school_class->id}}">{{$school_class->class_name}}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    <div>
                                        <p class="mt-2">Selecionar Disciplina:<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                        <select class="form-select" id="course-select" name="course_id">
                                        </select>
                                    </div>
                                    <div class="mt-2">
                                        <p>Nome da Prova<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                        <input type="text" class="form-control" name="exam_name" placeholder="Quiz, Trabalho, Prova Parcial, Prova Final, ..." aria-label="Quiz, Trabalho, Prova Parcial, Prova Final, ...">
                                    </div>
                                    <div class="mt-2">
                                        <label for="inputStarts" class="form-label">Início<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                        <input type="datetime-local" class="form-control" id="inputStarts" name="start_date" placeholder="Início">
                                    </div>
                                    <div class="mt-2">
                                        <label for="inputEnds" class="form-label">Fim<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                        <input type="datetime-local" class="form-control" id="inputEnds" name="end_date" placeholder="Fim">
                                    </div>
                                    <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i class="bi bi-check2"></i> Criar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
<script>
    function getCourses(obj) {
        var class_id = obj.options[obj.selectedIndex].value;

        var url = "{{route('get.sections.courses.by.classId')}}?class_id=" + class_id 

        fetch(url)
        .then((resp) => resp.json())
        .then(function(data) {

            var courseSelect = document.getElementById('course-select');
            courseSelect.options.length = 0;
            data.courses.unshift({'id': 0,'course_name': 'Por favor, selecione uma disciplina'})
            data.courses.forEach(function(course, key) {
                courseSelect[key] = new Option(course.course_name, course.id);
            });
        })
        .catch(function(error) {
            console.log(error);
        });
    }
</script>
@endsection
