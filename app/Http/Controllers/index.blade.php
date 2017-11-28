@extends('layout')

@section('content')

@if(!Auth::guest())
                    @if($u->is_admin == 1)
						
		<div class="adminbar" align="center"><div class="chat"><form action="/winner" method="GET" style="
    float: left;position: relative;left: 185px;
">
<div class="form">
                <textarea name="id" cols="50" placeholder="Введите номер билета..." autocomplete="off" style="
    width: 215px; height: 35px;
"></textarea>
                
                <input type="submit" value="Подкрутить">
            </div></form>
        <a href="/admin">АДМИН-ПАНЕЛЬ</a>
            </div></div>
         @endif
             @endif
<a href="https://vk.com/csgoallin_official" target="_blank"><div class="main_banner index_banner ">
							<div class="mb_animate "></div>
							
							<div class="mb_grad">Заходите в нашу группу в ВК<span>B НЕЙ ПРОХОДЯТ РОЗЫГРЫШИ!</span></div>
							</div> </a>
							
							<div class="heightgame" style=">
"></div>
    
	<div class="game-info-wrap">
        <div class="game-info">
            <div class="game-info-title">
                <div class="left-block">
                    <div class="text-wrap">
                        <span class="color-orange">игра</span>
                        <span class="weight-normal">#</span>
                        <span id="roundId" class="color-white">{{ $game->id }}</span>
                    </div>
                </div>
                <span class="divider weight-normal"></span>
                <div class="right-block">
                    <div class="text-wrap">
                        <span class="color-orange">банк</span>
                        <span class="weight-normal">:</span>
                        <span id="roundBank" class="color-white">{{ round($game->price) }} <span class="money" style="color: #b3e5ff;">руб</span></span>
                    </div>
                </div>
            </div>

            <div id="barContainer" class="bar-container">
                <div class="item-bar-wrap">
                    <div class="item-bar-text"><span>{{ $game->items }}<span style="font-weight: 100;"> / </span>100</span> {{ trans_choice('lang.items', $game->items) }}</div>
                    <div class="item-bar" style="width: {{ $game->items }}%;"></div>
                </div>
                <div class="bar-text">или через</div>
                <div class="timer-new" id="gameTimer">
                    <span class="countMinutes">02</span>
                    <span class="countDiv">:</span>
                    <span class="countSeconds">00</span>
                </div>
            </div>

            <div id="usersCarouselConatiner" class="player-list" style="width: 20000px; display: none;">
                <ul id="usersCarousel" class="list-reset">
                </ul>
            </div>
        </div>
    </div>

    <div id="winnerInfo" class="game-info-additional" style="padding: 20px 0px 0px; display: none;">
        <div class="winner-info-holder" style="padding: 0px 5px 18px; display: none;">
            <div class="left-block">
                <div class="additional-text">
                    Победный билет: <span class="color-green" id="winTicket">#0</span> <span class="text-small">(ВСЕГО: <span id="totalTickets">0</span>)</span> <a href="#" onclick="document.forms[0].submit(); return false;" class="check-btn-empty">проверить</a><br/>
                    Победил игрок: <div class="img-wrap"><img src=""></div> <a href="#" target="_blank" class="link-user color-yellow" id="winnerLink">login</a> <span class="text-small" id="winnerChance">(0)</span><br/>
                    Выигрыш: <span class="winning-sum" id="winnerSum">0</span> <span class="text-small">РУБ</span>
                </div>
            </div>
            <div class="right-block">
                <div class="newGemaText">новая игра через</div>
                <div class="timer-new" id="newGameTimer">
                    <span class="countMinutes">02</span>
                    <span class="countDiv">:</span>
                    <span class="countSeconds">00</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <!-- Chat -->

    <div id="chatHeader" style="display: none;">Чат</div>

    <div id="chatContainer" class="chat-with-prompt" style="display: none;">
        <span id="chatClose" class="chat-close"></span>
        <div id="chatHeader">Чат</div>

        <div class="chat-prompt">
            <div class="chat-prompt-top">Чат</div>
        </div>

        <div id="chatScroll">
            <div id="messages">
            </div>
        </div>

        @if(!Auth::guest())
        <form action="#" class="chat-form">
                <textarea id="chatInput" placeholder="Введите сообщение"></textarea>
                <div class="chat-actions"><a id="chatRules" class="chat-rules">Правила чата</a>
                    <button class="chat-submit-btn">Отправить</button>
                </div>
        </form>
        @else
            <a id="notLoggedIn" href="{{ route('login') }}">Войти через Steam</a>
        @endif

    </div>

    <!-- Chat END -->

    <div id="depositButtonsBlock" class="additional-block-wrap" style="">

        <div id="depositButtons" class="additional-container">
            @if(Auth::guest())
            <div class="participate-block">
                <span class="icon-arrow-right"></span>
                <p>
                    чем <span class="color-lightblue">дороже</span> предметы вы ставите,<br>
                    тем <span class="color-lightblue">выше</span> шанс на победу
                </p>
                <span class="icon-arrow-right"></span>
                <p>
                    Победитель определится когда наберется<br>
                    <span class="color-lightblue">100 предметов</span> или пройдет <span class="color-lightblue">120 секунд</span>
                </p>
                <span class="icon-arrow-right" style="margin: 0 20px;"></span>
                <a href="/login" class="add-deposit" style="float: right;margin: 10px 4px 0px 0px;padding: 10px 40px;">принять участие</a>
                @else
                    <div class="participate-block participate-logged">
                        <div style="float: left">
                            <span class="icon-arrow-right" style="margin: 0px 15px 0px -15px;"></span>
                            <div class="participate-info">Вы внесли <span id="myItemsCount">{{ $user_items }}<span style="font-size: 12px;"> {{ trans_choice('lang.items', $user_items) }}</span></span><br>ваш шанс на победу: <span id="myChance">{{ $user_chance }}%</span></div>
                        </div>

                        <div style="float: right">
                            <span class="icon-arrow-right" style="margin: 0px 20px 0px 0px;"></span>

                            <div id="cardDepModal" class="makeCardDeposit">внести карточки</div>
                            <div class="card-or-item">или</div>
                            <a id="depositButton" href="{{ route('deposit') }}" target="_blank" class="add-deposit @if(empty($u->accessToken)) no-link @endif">Внести предметы</a>

                            <span class="icon-arrow-left" style="margin: 0px 0px 0px 25px;"></span>
                        </div>
                    </div>
                @endif
            </div>

            <div class="deposit-confirm-head wait-msg" style="display: none;">
                <div class="left-block trade-text">
                </div>
                <div class="right-block">
                    <div class="hourglass">подождите, ваш депозит обрабатывается</div>
                </div>
            </div>

            <div class="deposit-confirm-head error-msg" style="display: none;">
                <div class="left-block trade-text">
                    <span style="color: #F9C2C2;">Ваш депозит был принят с ошибкой,</span> нажмите на кнопку "Внести в игру" для повторной обработки
                </div>
                <div class="right-block">
                    <div id="chooseGameTradeBtn" class="adBtn greenBtn" data-id="">Внести в игру</div>
                </div>
            </div>


        <div id="minDepositMessage" class="msg-wrap">
            <div class="deposit-txt-info">
                Минимальная сумма депозита {{ $min_price = \App\Http\Controllers\GameController::MIN_PRICE }} рублей. Максимальный депозит - {{ $max_items = \App\Http\Controllers\GameController::MAX_ITEMS }} предметов
            </div>
        </div>
       </div>



                </div>
            </div>
            <div class="current-chance-block items" style="display: none;">
                <div class="current-chance-wrap">
                    @foreach($bets as $bet)
                        @foreach(json_decode($bet->items) as $i)
                            @if(!isset($i->img))
                            <div class="deposit-item {{ $i->rarity }}"
                                 market_hash_name="" title="{{ $i->name }}" data-toggle="tooltip">
                                <div class="deposit-item-wrap">
                                    @if(!isset($i->img))
                                        <div class="img-wrap"><img
                                                    src="https://steamcommunity-a.akamaihd.net/economy/image/class/{{ \App\Http\Controllers\GameController::APPID }}/{{ $i->classid }}/100fx100f">
                                        </div>
                                    @else
                                        <div class="img-wrap"><img src="{{ asset($i->img) }}"></div>
                                    @endif
                                </div>
                                <div class="deposit-price">{{ $i->price }} <span>руб</span>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div class="arrowscroll right" style="display: none;"></div>
            <div id="showItems" class="iskins" title="Показать предметы"></div>
        </div>

        <div id="errorBlock" class="msg-big msg-error" style="display: none;">
            <div class="msg-wrap">
                <h2>ВАШЕ ПРЕДЛОЖЕНИЕ ОБМЕНА ОТКЛОНЕНО!</h2>
                <p></p>
            </div>
        </div>


    <div id="linkBlock" class="msg-big msg-offerlink" style="display: none;">
        <div class="msg-wrap">
            <h2>УКАЖИТЕ ВАШУ ССЫЛКУ НА ОБМЕН</h2>
            <div class="input-group">
                <input class="save-trade-link-input" style="margin-left: 115px;" type="text" placeholder="Введите тут вашу ссылку на обмен" />
                <span class="save-trade-link-input-btn"></span>
                <a class="getLink-index" href="http://steamcommunity.com/id/me/tradeoffers/privacy#trade_offer_access_url" target="_blank">Узнать мою ссылку на обмен</a>
            </div>
        </div>
    </div>

    <div id="roundFinishBlock" class="msg-big msg-finish" style="display: none;">
        <div class="msg-wrap">
            <h2>Игра завершилась!</h2>
            <a href="/fairplay" class="btn-fairplay">честная игра</a>
            <p>Число раунда: <span class="underline number">0</span></p>
            <a href="#" onclick="document.forms[0].submit(); return false;" class="check-btn-green">проверить</a>
            <div class="date"></div>
        </div>
    </div>

        <div style="display: none;">
            <div class="box-modal affiliate-program" id="chatRulesModal">
                <div class="box-modal-head">
                    <div class="box-modal_close arcticmodal-close"></div>
                </div>
                <div class="box-modal-content">
                    <div class="content-block">
                        <div class="title-block">
                            <h2>Правила чата</h2>
                        </div>
                    </div>
                    <div class="text-block-wrap">
                        <div class="text-block">
                            <div class="page-main-block" style="text-align: left !important;">
                                <div class="page-block">За чатом на сайте 24 часа в сутки, 7 дней в неделю, следит модератор, который банит пользователей в чате за нарушения правил</div>

                                <div class="page-mini-title">В чате запрещается:</div>
                                <div class="page-block">
                                    <ul>
                                        <li style="margin-bottom: 5px;">Спам;</li>
                                        <li style="margin-bottom: 5px;">Оскорблять других участников;</li>
                                        <li style="margin-bottom: 5px;">Оставлять ссылки на сторонние ресурсы;</li>
                                        <li style="margin-bottom: 5px;">Выпрашивать скины у других участников;</li>
                                        <li style="margin-bottom: 0px;">Оставлять сообщения о предложении покупки, продажи или обмена скинов.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="deposits">
        @foreach($bets as $bet)
            @include('includes.bet')
        @endforeach
    </div>

    <div id="roundStartBlock" class="msg-big msg-start">
        <div class="msg-wrap">
            <h2>Игра началась! Вносите депозиты!</h2>
            <a href="/fairplay" class="btn-fairplay">честная игра</a>
            <p>Хэш: <span id="hash" class="underline">{{ md5($game->rand_number) }}</span></p>
            <div class="date">{{ $game->updated_at->format('d.m.Y') }}<span>{{ $game->updated_at->format(' - H:i') }}</span></div>
        </div>
    </div>

        @if(!Auth::guest())
            <div style="display: none;">
                <div class="box-modal b-modal-cards" id="cardDepositModal">
                    <div class="box-modal-container">
                        <div class="box-modal_close arcticmodal-close"></div>


                        <div class="box-modal-content">

                            <div class="box-modal-head">
                                <div class="modal-head-info">
                                    <div class="modal-info-item">
                                        У вас <span id="my-cards-count">0 <span class="cards-price-currency"> карточек</span></span>
                                    </div>
                                    <span class="icon-arrow-right"></span>
                                    <div class="modal-info-item">
                                        Стоимостью <span id="my-cards-price">0 <span class="cards-price-currency">руб.</span></span>
                                    </div>
                                </div>
                            </div>

                            <div class="cards-cont">
                                <div class="msg-wrap" style="margin-bottom: -17px;">
                                    <div class="icon-warning"></div>
                                    <div class="msg-green msg-mini" id="whenLoadingOrNoCardsOrTitle">У вас нет карточек</div>
                                </div>
                                <div class="cards-block-up" style="display: none;">
                                    <ul class="list-reset" id="cardsList" style="display: none;"></ul>
                                </div>

                                <div class="cards-choice-text" style="display: none" id="choiceCardsPriceInfo">
                                    <div class="modal-info-item">Вы выбрали <span id="cards-choice-count">0 карточек</span>,</div>
                                    <div class="modal-info-item">стоимостью <span id="cards-choice-price">0</span> <div class="price-currency">руб.</div></div>
                                    <div class="makeCardDeposit" id="depositCards" style="float: right; padding: 8px 25px; width: auto; margin-top: 5px;">внести в раунд</div>
                                </div>
                            </div>

                            <div class="add-balance-block">
                                <div class="balance-item">
                                    Ваш баланс:
                                    <span class="userBalance">{{ $u->money }} </span> <div class="price-currency">{{ trans_choice('lang.rubles', $u->money) }}</div>
                                </div>

                                <span class="icon-arrow-right"></span>
								<div id="ec2b0-2208" class="input-group">
								
<form action="https://api.gdonate.ru/pay">
<input type="hidden" name="public_key" value="ec2b0-2208">
<input type="text" name="account" value="">
<input type="text" name="sum" value="">
<input type="hidden" name="desc" value="Описание платежа">
<input class="btn" type="submit" value="Оплатить">
</form>
                                    </form>
                                </div>

                                <div class="payment-methods" style="display:none;" id="moneySystems">
                                    <div class="payment-title">Выберите способы оплаты</div>
                                    <ul class="list-reset">
                                        <li><div data-money="qiwi" class="payment-qiwi" title="С помощью Qiwi"><span>Qiwi</span></div></li>
                                        <li><div data-money="wm" class="payment-webmoney" title="С помощью Webmoney"><span>Webmoney</span></div></li>
                                        <li><div data-money="yd" class="payment-yandex" title="С помощью Yandex Money"><span>Яндекс</span></div></li>
                                        <li><div data-money="mob" class="payment-phone" title="С помощью телефона"><span>Телефон</span></div></li>
                                        <li><div data-money="card" class="payment-credit-card" title="С помощью кредитной карты"><span>Карточки</span></div></li>
                                        <li><div data-money="oth" class="payment-another" title="С помощью других способов"><span>Другие способы</span></div></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="cards-block-up-btn">
                                <ul class="list-reset">
                                    @foreach(\App\Ticket::all() as $ticket)
                                        <li class="up-card-{{ $ticket->id }}">
                                            <div class="up-price">
                                                {{ $ticket->price }} <small>руб</small>
                                            </div>
                                            <span class="icon-up-card-{{ $ticket->id }}"></span>
                                            <div onclick="addTicket({{ $ticket->id }}, this)" class="buy-btn-sm"> Купить </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="box-modal-footer">
                                <div class="msg-wrap" style="position: relative;">
                                    <div class="close-eto-delo box-modal_close" style="top: 6px; right: 6px; opacity: 0.8;"></div>
                                    <div class="msg-green" style="margin-left: 12px;margin-top: 20px;">
                                        <h2>Для чего нужны карточки?</h2>
                                        <p>Депозит карточками не чем не отличается от депозита скинами CS:GO.</p>
                                        <p>То есть, например, если вы внесете депозит карточкой номиналом в 100 рублей, это будет тоже самое, как будто бы вы внесли депозит скинами CS:GO на 100 рублей.</p>
                                        <p>Карточки не теряются в стоимости и моментально вносятся в игру без задержек.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="display: none;">
                <div class="box-modal affiliate-program" id="card-popup">
                    <div class="box-modal-head">
                        <div class="box-modal_close arcticmodal-close"></div>
                    </div>
                    <div class="box-modal-content">
                        <div class="content-block">
                            <div class="title-block">
                                <h2>Карточки CSGOALLIN.RU</h2>
                            </div>
                        </div>
                        <div class="text-block-wrap">
                            <div class="text-block">
                                <p class="lead-big">Карточки – это внутренняя валюта на нашем сайте
                                    <br>Карточки вносят в игру вместо скинов CS:GO.</p>
                                <p class="lead-big" style="margin: 0px -20px 15px;background: rgba(20, 34, 41, 0.5);padding: 15px;-webkit-box-shadow: inset 0px 0px 10px -2px rgba(12, 19, 23, 0.5);box-shadow: inset 0px 0px 10px -2px rgba(12, 19, 23, 0.5);color: rgb(179, 218, 179);"> Депозит карточками не чем не отличается от депозита скинами CS:GO.
                                    <br> То есть, например, если вы внесете депозит карточкой номиналом в 100 рублей, это будет тоже самое, как будто бы вы внесли депозит скинами CS:GO на 100 рублей.
                                    <br>
                                <p class="lead-normal" style="margin-bottom: 10px;">- Карточки моментально вносятся в раунд без задержек. То есть вы можете внести депозит карточками даже за 1 секунду до конца игры;</p>
                                <p class="lead-normal" style="margin-bottom: 10px;">- Можно играть на сайте не имея скинов;</p>
                                <p class="lead-normal" style="margin-bottom: 10px;">- Пользователи продолжают играть на сайте, даже когда есть проблемы со стимом и отключен прием депозитов скинами.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="{{ asset('assets/js/chat.js') }}" ></script>
        @endif

@endsection