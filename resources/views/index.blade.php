@extends('layout')

@section('content')
    <div class="container my-2">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center">

                            Bienvenido a sistema CRUD con laravel, empecemos a ver los registros


                        </div>
                        <div class="row justify-content-center">
                            <form action="{{ route('dashboard') }}" method="get">
                                <button type="submit" class="btn btn-primary block">Empecemos</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>




    </div>
@endsection
