@extends('layout')

@section('content')
    <div class="container">

        <div class="card my-2">
            <div class="card-body">
                Bienvenido a sistema CRUD con laravel, empecemos a ver los registros
                <form action="{{ route('dashboard') }}" method="get">
                    <button type="submit" class="btn btn-primary ">Empecemos</button>
                </form>
            </div>
        </div>




    </div>
@endsection
