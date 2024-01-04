@extends('layouts.app')

@section('title')
    Мои сообщения
@endsection

@auth
    @section('content')
        <div class="container">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3>Моя переписка</h3>
                        </div>
                        <div class="col-lg-4">
                            @if(!$count_new_messages)
                                <h5 class="text-primary">Новых сообщений нет</h5>
                            @else
                                <h5 class="text-danger">Новые сообщения({{ $count_new_messages }})</h5>
                            @endif
                        </div>
                    </div>
                    <div class="container py-3">
                        <div class="accordion" id="menu">
                            @foreach($messages as $interlocutor)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#item{{ $interlocutor[0]->id }}">
                                            Переписка с пользователем: {{ $interlocutor[0]->name }}
                                        </button>
                                    </h2>
                                    <!-- класс show делает пункт открытым -->
                                    <div id="item{{ $interlocutor[0]->id }}" class="accordion-collapse collapse" data-bs-parent="#menu">
                                        <div class="accordion-body">
                                            @foreach($interlocutor[1] as $index => $message)
                                                <div class="form-control" style="background-color:
                                                               @if($message["user_id"] == $user->id)
                                                                   #f5f5f5;
                                                               @endif
                                                           ">
                                                    <div class="row">
                                                        <div class="text-primary col-lg-6">
                                                            @if($message["user_id"] == $user->id)
                                                                Вы
                                                            @else
                                                                {{ $interlocutor[0]->name }}
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-2">
                                                            @if($message["read"] and $message["user_id"] != $user->id)
                                                                <span class="text-danger" style="font-size: 10px;">новое</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <span style="font-size: 10px;">Дата сообщения: <span class="text-muted">{{ $message["created_at"] }}</span></span>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    {{ $message["message_text"] }}
                                                    <br><br>
                                                </div>
                                                <br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endauth