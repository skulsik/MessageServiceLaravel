@extends('layouts.app')

@section('title')
    Вход в систему
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
                        <h5 class="text-muted">Добро пожаловать, войдите в систему!</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Введите почту" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Введите пароль" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <label>
                                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Запомнить
                                                    </label>
                                                </td>
                                                <td class="text-right">
                                                    <button type="submit" class="btn btn-primary">
                                                        Войти
                                                    </button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Забыли пароль?
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
