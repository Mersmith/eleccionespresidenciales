@extends('components.layouts.web.layout-ecommerce')


@section('content')
    <div class="g_contenedor_pagina">
        <div class="g_centrar_pagina">

            <div>
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="card shadow">
                                <div class="card-header text-center">
                                    <h4>Iniciar sesión</h4>
                                </div>
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('jefe.login.post') }}" method="POST">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Correo electrónico</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                value="{{ old('email') }}" required autofocus>
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">Contraseña</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                required>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100">
                                            Ingresar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
