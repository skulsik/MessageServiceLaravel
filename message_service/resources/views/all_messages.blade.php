@extends('layouts.app')

@section('title')
    Мои сообщения
@endsection

@auth
    @section('content')
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <h3>Моя переписка</h3>
                    <hr>
                    @foreach($messages as $interlocutor)
                        Переписка с пользователем: {{ $interlocutor[0]->name }}
                        @foreach($interlocutor[1] as $message)
                            <div class="card">
                                <div class="card-header">
                                    <div style="margin-top: 5px;">
                                        <h6 class="text-primary">
                                            @if($message->user_id == $user->id)
                                                Вы написали
                                            @else
                                                <span class="text-muted">Написал</span> {{ $interlocutor[0]->name }}
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: 5px;">
                                    {{ $message->message_text }}
                                </div>
                                <div class="card-footer">
                                    <p style="font-size: 12px; ">Дата сообщения: <span class="text-muted">{{ $message->created_at }}</span></p>
                                </div>
                            </div>
                            <br>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    @endsection
@endauth