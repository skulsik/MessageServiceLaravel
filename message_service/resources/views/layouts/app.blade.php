<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @hasSection('title')
            @yield('title')
        @else
            Главная
        @endif
    </title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <h2><span class="text-primary">Message</span><span class="text-muted">Service</span></h2>
                </a>
            </div>

            @guest
                <div class="col-md-3 text-end">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Войти</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Регистрация</a>
                </div>
            @else
                <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
                    <li><a href="{{ route('form_message') }}" class="nav-link px-2">Создать сообщение</a></li>
                    <li><a href="#" class="nav-link px-2">Сообщения</a></li>
                    <li><a href="#" class="nav-link px-2">Новые сообщения</a></li>
                </ul>

                <div>
                    <form action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-outline-primary me-2">Выйти</button>
                    </form>
                </div>
            @endguest

        </header>
    </div>

    @hasSection('content')
        @yield('content')
    @else
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <h2 class="text-center text-hide">Рад, приветствовать вас!</h2>
                    <br>
                    <p class="text-muted" style="text-align: justify;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspМы рады представить вам наш инновационный сервис сообщений, который делает общение легким и эффективным. Наш сервис обеспечивает быструю и надежную доставку сообщений, гарантируя, что ваши общения будут всегда на связи.</p>
                    <p class="text-muted" style="text-align: justify;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspС уникальными функциями, такими как возможность отправки мгновенных голосовых сообщений, стикеров и эмодзи, мы создали приятный и разнообразный опыт общения. Наша система удобна в использовании и адаптирована для различных устройств, чтобы вы могли быть на связи, где бы вы ни находились.</p>
                    <p class="text-muted" style="text-align: justify;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspБезопасность ваших данных - наш приоритет. Мы используем передовые технологии шифрования, чтобы обеспечить конфиденциальность ваших личных сообщений. Наша команда постоянно работает над внедрением новых функций и улучшениями, чтобы сделать наш сервис еще более удобным и современным.</p>
                    <p class="text-muted" style="text-align: justify;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspПрисоединяйтесь к нашему сервису сообщений, где каждое общение - это удовольствие, а каждое сообщение - важное событие!</p>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <span class="mb-3 mb-md-0 text-body-secondary">© 2023 Ващенко Алексей, PHP developer</span>
            </div>
            <h6><span class="text-hide">Тел.: </span><span class="text-primary">8(952)-895-87-58.</span></h6>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
