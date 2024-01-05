@extends('layouts.app')

@section('title')
    Создание сообщения
@endsection

@auth
    @section('content')
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <h3>Создайте новое сообщение</h3>
                    <form method="POST" action="/create_message" class="form-control">
                        {{ csrf_field() }}
                        @if($errors->any())
                            <br>
                            <div>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li class="alert alert-warning">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <br>
                        <textarea name="message_text" id="message_text" placeholder="Введите ваше сообщение" rows="8" class="form-control"></textarea>
                        <br>
                        <select name="client_id" id="client" class="form-control">
                            <option selected disabled hidden>Выберите пользователя, которому хотите написать</option>
                            @foreach($users_list as $user)
                                @if($user->email != $email)
                                    <option value="{{ $user->id }}">Имя пользователя:{{ $user->name }}. Почта: {{ $user->email }}</option>
                                @endif
                            @endforeach
                        </select>
                        <br>
                        <button type="submit" class="btn btn-primary">Отправить сообщение</button>
                        <br>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    @endsection
@endauth