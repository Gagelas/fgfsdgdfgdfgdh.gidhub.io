$(document).ready(function () {

    $('a[href="' + document.location.pathname + '"]').parent().addClass('active');

    $('.history-block-item .user .username').each(function () {
        $(this).text(replaceLogin($(this).text()));
    });

    $('.deposit-item:not(.card)').tooltip({container: 'body'});

    $('[data-toggle="popover"]').popover({
        "container": "body"
    });

    EZYSKINS.init();

    $('.close-eto-delo').click(function (e) {
        $(this).parent('.msg-wrap').slideUp();
    });

    $(document).on('click', '.no-link', function () {
        $('#linkBlock').slideDown();
        return false;
    });

    $(document).on('click', '#cardDepModal', function () {
        $('#cardDepositModal').arcticmodal();
    });

    $(document).on('click', '.deposit-no-link', function () {
        $('#linkBlock').slideDown();
        return false;
    });

    $(document).on('click', '.tooltip-btn.level', function () {
        $('.profile-level').tooltip('hide');
        $('#level-popup').arcticmodal();
    });
    $(document).on('click', '.tooltip-btn.card', function () {
        $('.deposit-item.card').tooltip('hide');
        $('#card-popup').arcticmodal();
    });
    $(document).on('click', '.tooltip-btn.ticket', function () {
        $('.ticket-number').tooltip('hide');
        $('#ticket-popup').arcticmodal();
    });
    $(document).on('click', '#user-level-btn', function () {
        $('.level-badge').tooltip('hide');
        $('#level-popup').arcticmodal();
    });

    $('.tooltip').remove();

    $('.ticket-number').tooltip({
        html: true,
        trigger: 'hover',
        delay: {show: 50, hide: 200},
        title: function () {
            var text = '1 билет = 1 коп';
            var btn = 'для чего нужен билет?';

            return '<span class="tooltip-title ticket">' + text + '</span><br/><span class="tooltip-btn ticket">' + btn + '</span>';
        }
    });

    $('.deposit-item:not(.card)').tooltip({
        container: 'body',
        //delay: {show: 50, hide: 200}
    });

    $('.deposit-item.card').each(function () {
        var that = $(this);
        that.data('old-title', that.attr('title'));
        that.attr('title', null);
        that.tooltip({
            html: true,
            trigger: 'hover',
            delay: {show: 50, hide: 200},
            title: function () {
                var text = $(this).data('old-title');
                var btn = 'для чего нужны карточки?';

                return '<span class="tooltip-title card">' + text + '</span><br/><span class="tooltip-btn card">' + btn + '</span>';
            }
        });
    });


    $('.save-trade-link-input')
        .keypress(function (e) {
            if (e.which == 13) $(this).next().click()
        })
        .on('paste', function () {
            var that = $(this);
            setTimeout(function () {
                that.next().click();
            }, 0);
        });

    $('.save-trade-link-input-btn').click(function () {
        var that = $(this).prev();
        $.ajax({
            url: '/settings/save',
            type: 'POST',
            dataType: 'json',
            data: {trade_link: $(this).prev().val()},
            success: function (data) {
                if (data.status == 'success') {
                    $('#linkBlock').slideUp();
                    $('.no-link').removeClass('no-link');
                    if (data.msg) return $.notify(data.msg, 'success');
                }
                if (data.msg) $.notify(data.msg, 'error');
            },
            error: function () {
                ajaxError();
            }
        });
        return false;
    });

    $('.tooltip').remove();
    $('.current-user').tooltip({container: 'body'});

});

function updateBackground() {
    var mainHeight = $('.dad-container').height();
    var windowHeight = $(window).height();

    if (mainHeight > windowHeight) {
        $('.main-container').height('auto');
    }
    else {
        $('.main-container').height('100%');
    }
}

function replaceLogin(login) {
    function replacer(match, p1, p2, p3, offset, string) {
        var links = ['CSGO-BEEN.RU', 'csgo-vznos.com'];
        return links.indexOf(match.toLowerCase()) == -1 ? '' : match;
    }

    login = login.replace('сom', 'com').replace('cоm', 'com').replace('соm', 'com');
    var res = login.replace(/([а-яa-z0-9-]+) *\. *(ru|com|net|gl|su|red|ws|us)+/i, replacer);
    if (!res.trim()) {

        var check = login.toLowerCase().split('CSGO-BEEN.RU').length > 1 || login.toLowerCase().split('csgo-vznos.com').length > 1;

        if (check) {
            res = login;
        }
        else {
            res = login.replace(/csgo/i, '').replace(/ *\. *ru/i, '').replace(/ *\. *com/i, '');
            if (!res.trim()) {
                res = 'UNKNOWN';
            }
        }
    }

    res = res.split('script').join('srcipt');
    return res;
}

function updateScrollbar() {
    $('.current-chance-block').perfectScrollbar('destroy');
    $('.current-chance-block').perfectScrollbar({suppressScrollY: true, useBothWheelAxes: true});
}

updateScrollbar();
updateBackground();

function getRarity(type) {
    var rarity = '';
    var arr = type.split(',');
    if (arr.length == 2) type = arr[1].trim();
    if (arr.length == 3) type = arr[2].trim();
    if (arr.length && arr[0] == 'Нож') type = '★';
    switch (type) {
        case 'Армейское качество':
            rarity = 'milspec';
            break;
        case 'Запрещенное':
            rarity = 'restricted';
            break;
        case 'Засекреченное':
            rarity = 'classified';
            break;
        case 'Тайное':
            rarity = 'covert';
            break;
        case 'Ширпотреб':
            rarity = 'common';
            break;
        case 'Промышленное качество':
            rarity = 'common';
            break;
        case '★':
            rarity = 'rare';
            break;
        case 'card':
            rarity = 'card';
            break;
    }
    return rarity;
}

function n2w(n, w) {
    n %= 100;
    if (n > 19) n %= 10;

    switch (n) {
        case 1:
            return w[0];
        case 2:
        case 3:
        case 4:
            return w[1];
        default:
            return w[2];
    }
}

function lpad(str, length) {
    while (str.toString().length < length)
        str = '0' + str;
    return str;
}

$(document).on('click', '#showUsers, #showItems', function () {
    if ($(this).is('.active')) return;

    $('#showUsers, #showItems').removeClass('active');
    $(this).addClass('active');

    $('#usersChances .users').toggle();
    $('#usersChances .items').toggle();
    updateScrollbar();
});

$('#usersChances').hover(function () {
    var block = $('#showUsers').is('.active') ? $('.current-chance-block.users') : $('.current-chance-block.items');
    var min = $('#showUsers').is('.active') ? 10 : 9;

    if (block.find('.current-chance-wrap').children().length > min) $('.arrowscroll').show();
}, function () {
    $('.arrowscroll').hide();
});
$('.arrowscroll').click(function () {
    var block = $('#showUsers').is('.active') ? $('.current-chance-block.users') : $('.current-chance-block.items');
    var direction = $(this).is('.left') ? '-' : '+';

    block
        .stop(true, false)
        .animate({scrollLeft: direction + "=250"});
});

if (START) {
    updateBackground();
     var socket = io.connect('csgo-been.ru:8080');

    if (checkUrl()) {
        socket
            .on('connect', function () {
                $('#loader').hide();
            })
            .on('disconnect', function () {
                $('#loader').show();
            })
            .on('online', function (data) {
                $('.stats-onlineNow').text(Math.abs(data));
            })
            .on('newDeposit', function (data) {
				  var audio = new Audio('assets/sounds/bet.mp3');
     audio.play();
                updateBackground();
                data = JSON.parse(data);
                $('#deposits').prepend(data.html);
                var username = $('#bet_' + data.id + ' .history-block-item .user .username').text();
                $('#bet_' + data.id + ' .history-block-item .user .username').text(replaceLogin(username));
                $('#roundBank').html(Math.round(data.gamePrice) + ' <span class="money" style="color: #b3e5ff;">руб</span>');
                $('title').text(Math.round(data.gamePrice) + ' руб - CSGO-Vznos');
                $('.item-bar-text').html('<span>' + data.itemsCount + '<span style="font-weight: 100;"> / </span>100</span>' + n2w(data.itemsCount, [' предмет', ' предмета', ' предметов']));
                $('.item-bar').css('width', data.itemsCount + '%');
                $('.deposit-item').tooltip({container: 'body', placement: 'top'});

                console.log(data.chances);
                html_chances = '';

                data.chances = sortByChance(data.chances);
                data.chances.forEach(function (info) {
                    if (USER_ID == info.steamid64) {
                        $('#myItemsCount').html(info.items + '<span style="font-size: 12px;">' + n2w(info.items, [' предмет', ' предмета', ' предметов']) + '</span>');
                        $('#myChance').text(info.chance + '%');
                    }
                    $('.id-' + info.steamid64).text(info.chance + '%');
                    html_chances += '<div class="current-user" title="' + replaceLogin(info.username) + '"><a class="img-wrap" href="/user/' + info.steamid64 + '" target="_blank"><img src="' + info.avatar + '" /></a><div class="chance">' + info.chance + '%</div></div>';
                });

                $('#usersChances .users .current-chance-wrap').html(html_chances);
                $('#usersChances').show();

                $('.tooltip').remove();
                $('.current-user').tooltip({container: 'body'});

                EZYSKINS.initTheme();
            })
            .on('forceClose', function () {
                $('.forceClose').removeClass('msgs-not-visible');
            })
            .on('timer', function (time) {
				var audio = new Audio('assets/sounds/timer-tick-quiet.mp3');
audio.play();
                $('#gameTimer .countMinutes').text(lpad(Math.floor(time / 60), 2));
                $('#gameTimer .countSeconds').text(lpad(time - Math.floor(time / 60) * 60, 2));
            })
            .on('slider', function (data) {

                // Таймер
                $('#newGameTimer .countSeconds').text(lpad(data.time - Math.floor(data.time / 60) * 60, 2));

                if (ngtimerStatus) {
                    ngtimerStatus = false;
                    var users = data.users;

                    users = mulAndShuffle(users, Math.ceil(130 / users.length));
                    users[112] = data.winner;
                    html = '';
                    users.forEach(function (i) {
                        html += '<li><img src="' + i.avatar + '"></li>';
                    });
                    $('#usersCarousel').html(html);

                    $('#barContainer').hide();
                    $('#usersCarouselConatiner').show();

                    if (data.showCarousel) {
                        $('#depositButtonsBlock').slideUp();
                    }
                    else {
                        $('#depositButtonsBlock').hide();
                    }

                    $('#winnerInfo').show();

                    fillWinnerInfo(data);

                    $('#roundFinishBlock .number').text(data.round_number);
					 var stavkajjsj  = new Audio();
	                     stavkajjsj.src = '/assets/sounds/scroll.mp3';
					stavkajjsj.play();
                    $('#roundFinishBlock .date').html(data.date + '<span>' + data.date_hours + '</span>');


                    $('#usersCarousel').css('margin-left', -41);
                    if (data.showSlider) {
                        $('#usersCarousel').animate(
                            {marginLeft: -7917}, 1000 * 10,
                            function () {
                                $('#winnerInfo .winner-info-holder').slideDown();
                                $('#roundFinishBlock').slideDown();
                            });
                    }

                    function fillWinnerInfo(data) {
                        data = data || {winner: {}};

                        var obj = {
                            totalPrice: data.game.price || 0,
                            number: data.game.price ? ('#' + Math.floor(data.round_number * data.game.price)) : '???',
                            tickets: data.tickets || 0,
                            winner: {
                                image: data.winner.avatar || '???',
                                login: data.winner.username || '???',
                                id: data.winner.steamid64 || '#',
                                chance: data.chance || 0,
                                winTicket: data.ticket || '???'
                            }
                        };
                        $('#winnerInfo #winTicket').text('#' + obj.winner.winTicket);
                        $('#winnerInfo #totalTickets').text(obj.tickets);
                        $('#winnerInfo img').attr('src', obj.winner.image);
                        $('#winnerInfo #winnerLink').text(replaceLogin(obj.winner.login));
                        $('#winnerInfo #winnerLink').attr('href', '/user/' + obj.winner.id);
                        $('#winnerInfo #winnerChance').text('(ШАНС: ' + obj.winner.chance.toFixed(2) + '%)');
                        $('#winnerInfo #winnerSum').text(obj.totalPrice);
                    }
                }
            })
            .on('newGame', function (data) {
                updateBackground();
                $('#usersChances .users .current-chance-wrap').html('');
                $('#usersChances .items .current-chance-wrap').html('');
                $('#usersChances').hide();
                $('#deposits').html('');
                $('#myItemsCount').html('0 <span style="font-size: 12px;"> предметов</span>');
                $('#myChance').text('0%');
                $('#roundId').text(data.id);
                $('#roundBank').html('0 <span class="money" style="color: #b3e5ff;">руб</span>');
                $('#hash').text(data.hash);
                $('.item-bar-text').html('<span>0</span> предметов');
                $('.item-bar').css('width', '0%');
                $('#roundFinishBlock').hide();
                $('#barContainer').show();
                $('#usersCarouselConatiner').hide();
                $('#depositButtonsBlock').slideDown();
                $('#winnerInfo').hide();
                $('#gameTimer .countMinutes').text('02');
                $('#gameTimer .countSeconds').text('00');
                $('title').text('0 руб - CSGO-Vznos');
                $('#roundStartBlock #date').html(formatDate(data.created_at));
                setTimeout(updateBackground, 1000);
                ngtimerStatus = true;
            })
            .on('queue', function (data) {
                console.log(data);
                if (data) {
                    var n = data.indexOf(USER_ID);
                    if (n !== -1) {
                        $.notify('Ваш депозит обрабатывается. Вы ' + (n + 1) + ' в очереди.', {
                            clickToHide: 'false',
                            autoHide: "false",
                            className: "success"
                        });
                    }
                }
            })
            .on('chat_messages', function (data) {
                message = data;
                if (message && message.length > 0) {
                    $('#messages').html('');
                    message = message.reverse();
                    for (var i in message) {
                        var a = $("#chatScroll")[0];
                        //var isScrollDown = (a.offsetHeight + a.scrollTop) == a.scrollHeight;
                        var isScrollDown = Math.abs((a.offsetHeight + a.scrollTop) - a.scrollHeight) < 5;

                        if (message[i].admin != 1) {
                            var html = '<div class="chatMessage clearfix" data-uuid="' + message[i].id + '" data-user="' + message[i].userid + '">';
                            html += '<a href="/user/' + message[i].userid + '" target="_blank"><img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/' + _.escape(message[i].avatar).replace('_full', '') + '"></a>';
                            html += '<div class="login" href="/user/' + message[i].userid + '" target="_blank">' + message[i].username + '</div>';
                            html += '<div class="body">' + message[i].messages + '</div>';
                            html += '</div>';
                        }
                        else {
                            var html = '<div class="chatMessage clearfix" data-uuid="' + message[i].id + '">';
                             html += '<a href="/user/' + message[i].userid + '" target="_blank"><img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/' + _.escape(message[i].avatar).replace('_full', '') + '"></a>';
						    html += '<div class="login" href="/user/' + message[i].userid + '" target="_blank">' + message[i].username + ' <span class="color-orange">[Админ]</span></div>';
                            html += '<div class="body">' + message[i].messages + '</div>';
                            html += '</div>';
                        }
                        $('#messages').append(html);
                        if ($('.chatMessage').length > 100) {
                            $('.chatMessage').eq(0).remove();
                        }
                    }

                    if (isScrollDown) a.scrollTop = a.scrollHeight;
                    $("#chatScroll").perfectScrollbar('update');
                }
            })
            .on('depositDecline', function (data) {
                data = JSON.parse(data);
                if (data.user == USER_ID) {
                    clearTimeout(declineTimeout);
                    declineTimeout = setTimeout(function () {
                        $('#errorBlock').slideUp();
                    }, 1000 * 10)
                    $('#errorBlock p').text(data.msg);
                    $('#errorBlock').slideDown();
                }
            })
    }
    else {
        socket
            .on('online', function (data) {
                $('.stats-onlineNow').text(Math.abs(data));
            })
            .on('queue', function (data) {
                console.log(data);
                if (data) {
                    var n = data.indexOf(USER_ID);
                    if (n !== -1) {
                        $.notify('Ваш депозит обрабатывается. Вы ' + (n + 1) + ' в очереди.', {
                            clickToHide: 'false',
                            autoHide: "false",
                            className: "success"
                        });
                    }
                }
            })
    }
    var declineTimeout,
        timerStatus = true,
        ngtimerStatus = true;
}

function loadMyInventory() {
    $('thead').hide();
    $.ajax({
        url: '/myinventory',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            var text = '<tr><td colspan="4" style="text-align: center">РџСЂРѕРёР·РѕС€Р»Р° РѕС€РёР±РєР°. РџРѕРїСЂРѕР±СѓР№С‚Рµ РµС‰Рµ СЂР°Р·</td></tr>';
            var totalPrice = 0;

            if (!data.success && data.Error) text = '<tr><td colspan="4" style="text-align: center">' + data.Error + '</td></tr>';

            if (data.success && data.rgInventory && data.rgDescriptions) {
                text = '';
                var items = mergeWithDescriptions(data.rgInventory, data.rgDescriptions);
                console.table(items);
                items.sort(function (a, b) {
                    return parseFloat(b.price) - parseFloat(a.price)
                });
                _.each(items, function (item) {
                    item.price = item.price || 0;
                    totalPrice += parseFloat(item.price);
                    item.price = item.price;
                    item.image = 'https://steamcommunity-a.akamaihd.net/economy/image/class/730/' + item.classid + '/200fx200f';
                    item.market_name = item.market_name || '';
                    text += ''
                        + '<tr>'
                        + '<td class="item-image"><div class="item-image-wrap">' + '<img src="' + item.image + '">' + '</div></td>'
                        + '<td class="item-name">' + item.name + '</td>'
                        + '<td class="item-type">' + item.market_name.replace(item.name, '').replace('(', '').replace(')', '') + '</td>'
                        + '<td class="item-cost">' + (item.price || '---') + '</td>'
                        + '</tr>'
                });
                $('#totalPrice').text(totalPrice.toFixed(2));
                $('thead').show();
            }

            $('tbody').html(text);
            updateBackground();
        },
        error: function () {
            var text = isEn() ? 'An error has occurred. Try again' : 'РџСЂРѕРёР·РѕС€Р»Р° РѕС€РёР±РєР°. РџРѕРїСЂРѕР±СѓР№С‚Рµ РµС‰Рµ СЂР°Р·';
            $('tbody').html('<tr><td colspan="4" style="text-align: center">' + text + '<td></tr>');
        }
    });
}

function mergeWithDescriptions(items, descriptions) {
    return Object.keys(items).map(function (id) {
        var item = items[id];
        var description = descriptions[item.classid + '_' + (item.instanceid || '0')];
        for (var key in description) {
            item[key] = description[key];

            delete item['icon_url'];
            delete item['icon_drag_url'];
            delete item['icon_url_large'];
        }
        return item;
    })
}

function mulAndShuffle(arr, k) {
    var
        res = [],
        len = arr.length,
        total = k * len,
        rand, prev;
    while (total) {
        rand = arr[Math.floor(Math.random() * len)];
        if (len == 1) {
            res.push(prev = rand);
            total--;
        }
        else if (rand !== prev) {
            res.push(prev = rand);
            total--;
        }
    }
    return res;
}

$(document).on('click', '.vote', function () {
    var that = $(this);
    $.ajax({
        url: '/ajax',
        type: 'POST',
        dataType: 'json',
        data: {action: 'voteUser', id: $(this).data('profile')},
        success: function (data) {
            if (data.status == 'success') {
                $('#myProfile').find('.votes').text(data.votes || 0);
            }
            else {
                if (data.msg) that.notify(data.msg, {position: 'bottom middle', className: "error"});
            }
        },
        error: function () {
            that.notify("Произошла ошибка. Попробуйте еще раз", {position: 'bottom middle', className: "error"});
        }
    });
});

function sortByChance(arrayPtr) {
    var temp = [],
        item = 0;
    for (var counter = 0; counter < arrayPtr.length; counter++) {
        temp = arrayPtr[counter];
        item = counter - 1;
        while (item >= 0 && arrayPtr[item].chance < temp.chance) {
            arrayPtr[item + 1] = arrayPtr[item];
            arrayPtr[item] = temp;
            item--;
        }
    }
    return arrayPtr;
}

function checkUrl() {
    var pathname = window.location.pathname;

    if (pathname.indexOf('game') + 1) {
        return false;
    }
    else {
        return true;
    }

}

function formatDate(date) {
    moment(date).format('DD/MM/YYYY - <span>h:mm</span>');
}

$.notify.addStyle('custom', {html: "<div>\n<span data-notify-text></span>\n</div>"});
$.notify.defaults({style: "custom"});

$(document).on('mouseenter', '.iusers, .iskins', function () {
    $(this).tooltip('show');
});