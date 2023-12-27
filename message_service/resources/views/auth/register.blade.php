@extends('layouts.app')

@section('title')
    Регистрация
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="about-info text-center">
                            <br>
                            <h5 class="text-muted">Добро пожаловать! Пожалуйста, зарегистрируйтесь!</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ваше имя" required autofocus>
                                        @if ($errors->has('name'))
                                            <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                        @endif
                                    </div>
                                    <br>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Почта" required>
                                        @if ($errors->has('email'))
                                            <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                        @endif
                                    </div>
                                    <br>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Пароль" required>
                                        @if ($errors->has('password'))
                                            <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                        @endif
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Повторите пароль" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            Регистрация
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
