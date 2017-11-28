<!doctype html>
<html class="no-js ru" lang="ru">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ $title }} {{ $SITENAME = \App\Http\Controllers\GameController::SITENAME }}</title>
    <meta name="keywords" content="csgo джекпот,csgo jackpot, рулетка csgo,fast рулетка,игры на скины csgo,игра на депозит,LuckySkins.Ru" />
    <meta name="description" content="CSGO-BEEN.RU- Умножь свои скины CS:GO" />

    <meta name="csrf-token" content="{!!  csrf_token()   !!}">
    <link rel="icon" type="image/png" href="{{ $SITENAME = \App\Http\Controllers\GameController::FAVICON }}"/>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/loot.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/chat.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css' />
    <script src="{{ asset('assets/js/main.js') }}" ></script>
    <script src="{{ asset('assets/js/vendor.js') }}" ></script>
    <script src="{{ asset('assets/js/moment.min.js') }}" ></script>

    <script>
    @if(!Auth::guest())
		var avatar = '{{ $u->avatar }}';
        const USER_ID = '{{ $u->steamid64 }}';
    @else
        const USER_ID = 'null';
    @endif
        var START = true;
    </script>
</head>
<body>

<div class="main-container">
        <div class="dad-container">
            <header>
    <div class="header-container">
        <div class="header-top">
            <div class="logotype active">
                <a href="/"><img src="{{ $SITENAME = \App\Http\Controllers\GameController::SITELOGO }}"></a>
            </div>
<!--<span class="text sound_on" style="display:none;margin-left: 3px;margin-top: 6px;cursor: pointer;"><img src="/assets/img/sound-off.png"><div class="sound"></div></span> 
<span class="text sound_off" style="margin-left: 3px; margin-top: 6px; cursor: pointer;"><img src="/assets/img/sound-on.png"><div class="sound-off"></div></span>-->
            <div class="header-menu">
                <ul id="headNav" class="list-reset">
                    <li class="top"><a href="{{ route('top') }}"><img src="/assets/img/top.png" alt="">Топ</a></li>
                    <li class="history"><a href="{{ route('history') }}"><img src="/assets/img/history.png" alt="">История игр</a></li>
                    <li class="about"><a href="{{ route('about') }}"><img src="/assets/img/about.png" alt="">О сайте</a></li>
                    <li class="faq"><a href="{{ route('support') }}"><img src="/assets/img/tp.png" alt="">Поддержка</a></li>
                    <li class="fairplay"><a href="{{ route('fairplay') }}"><img src="/assets/img/fair.png" alt="">Честная игра</a></li>
                    <li class="cards"><a href="{{ route('ref') }}"><img src="/assets/img/history.png" alt="">Рефералка</a></li>
					<li class="fairplay"><a href="{{ $SITENAME = \App\Http\Controllers\GameController::LINKVK }}" target="_blank"><img src="/assets/img/vk3.png" alt=""></a></li>
                   <!-- <li class="magazine last"><a href="{{ route('cards') }}"><img src="/assets/img/shop.png" alt=""> Магазин</a></li>-->
                </ul>
            </div>
        </div>

        <div class="header-bottom">
            <div class="left-block">
                <div class="information-block">
					<ul class="list-reset">
					<div class="statBot">
					<span class="normal" title="Нагрузка серверов Steam: Средняя" data-toggle="tooltip"></span>
                        </div>
						<li><span class="stats-onlineNow">0</span> сейчас онлайн</li>
                        <li><span>{{ \App\Game::gamesToday() }}</span> игр сегодня</li>
                        <li><span>{{ \App\Game::maxPrice() }}</span> макс. выигрыш</li>
                        <li class="max-bank">
                            <a href="/game/{{ \App\Game::lastGame() }}">
                                <span>{{ \App\Game::lastGame() }}</span> последняя игра
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="right-block">
            @if(Auth::guest())
                <div class="profile">
                    <a href="{{ route('login') }}" class="authorization">войти через steam</a>
                </div>
            @else
            <div class="profile">
                   <div class="profile-block">
                        <div class="user-avatar">
                            <img src="{{ $u->avatar }}">
                        </div>
                        <div class="profile-wrap-block">
                            <div class="profile-head">
                                <div class="user-login">{{ $u->username }}</div>
                                <a href="{{ route('logout') }}" class="exit">выйти</a>
                            </div>

                            <div class="profile-footer">
                                <ul class="list-reset">
									<li><a href="{{ route('send') }}">Перевод</a></li>
                                    <li><a href="{{ route('my-history') }}">мои игры</a></li>
                                    <li><a href="{{ route('my-inventory') }}">инвентарь</a></li>
                                </ul>
                         </div>
                       </div>
                    </div>
                  </div>
               @endif
                </div>

        </div>
    </div>
</header>
<main>
     <div class="content-block">
            @yield('content')
    </main>
  </div>
</body>
</div>

<script src="{{ asset('assets/js/app.js') }}" ></script>

<script>
    @if(!Auth::guest())
    function updateBalance() {
        $.post('{{route('get.balance')}}', function (data) {
            $('.userBalance').text(data);
        });
    }
    function addTicket(id, btn){
        $.post('{{route('add.ticket')}}',{id:id}, function(data){
            updateBalance();
            return $.notify(data.text, data.type);
        });
    }
    @endif

   
</script>
</html>
