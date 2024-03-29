@extends('layout')

@section('content')
    <div class="faq-page">

        <div class="title-block">
            <h2>
                Поддержка
            </h2>
        </div>

        <div class="page-content">

            <div class="page-main-block">
                <div class="page-mini-title">Мне пришли не все предметы после победы!</div>
                <div class="page-block">
                    С каждой игры мы берем комиссию от 5% до 10% в зависимости от банка и уровня игрока.
                </div>
            </div>

            <div class="page-main-block">
                <div class="page-mini-title">Мне не пришел выигрыш!</div>
                <div class="page-block">
                    Отправка выигрыша происходит спустя 1 минуту после окончания игры, а также обратите<br>внимание на то, что в настройках приватности вашего аккаунта Steam ваш инвентарь должен быть открыт: <br>
                    <a href="http://steamcommunity.com/id/me/edit/settings/" target="_blank">http://steamcommunity.com/id/me/edit/settings/</a>
                </div>
            </div>

            <div class="page-main-block">
                <div class="page-mini-title">Я внес депозит, но предметы не вошли в игру.</div>
                <div class="page-block">
                    Такое бывает крайне редко и происходит это исключительно из-за проблем со стимом. В таком случае вам нужно будет написать нашему саппорту в VK и он повторит обработку трейда.
                </div>
            </div>

            <div class="page-main-block">
                <div class="page-mini-title">Ваш бот отклоняет мой трейд!</div>
                <div class="page-block">
                    Когда ваш трейд отклонился - на сайте вы должны были увидеть ошибку с причиной отклонения,<br>
                    это может быть одна из следующий причин:<br>
                    - минимальная сумма депозита 5$;<br>
                    - можно отправлять не более 20 предметов за трейд;<br>
                    - принимаются предметы только с CS:GO
                </div>
            </div>

            <div class="faq-block faq-last">
                <div class="faq-text">
                    Если вы не нашли здесь ответа на ваш вопрос, тогда вы можете задать <br>его нашему саппорту через эту форму отправки сообщений в VK.
                </div>
                <a href="http://vk.com/mrshoka" target="_blank" class="btn-vk">Отправить сообщение саппорту в VK</a>
            </div>

        </div>

    </div>
@endsection