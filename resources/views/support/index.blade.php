@extends('layout')

@section('content')
 <title>  {{ $title = \App\Http\Controllers\SupportController::TITLE_UP }}</title>
	<link href="{{ asset('assets/css/support.css') }}" rel="stylesheet">
	  <script src="{{ asset('assets/js/chat.js') }}" ></script>
	<script type="text/javascript">
    $(document).ready(function() {
		$(".newticket").click(function () {
			$(".support .table").hide();
			$(".support .nticket").show();
		});
		
		$(".listticket").click(function () {
			$(".support .table").show();
			$(".support .nticket").hide();
		});
		
		
	});
	</script>	
<div class="content">


	<!-- <middle> -->
	@if($u->ban_ticket != 1)
	<div class="title-block">
            <h2 style="color: #ffffff;">
                  {{ $support_title = \App\Http\Controllers\SupportController::SUPPORT_TITLE }}
            </h2>
		
        </div>

	<div class="support">
	
	
		<div class="newticket">
		
		<span class="ntitle">Создать новый запрос</span>
		<span class="nabout">Написать новое сообщение в техническую поддержку</span>
		
		</div>
		<div class="listticket"><span class="ntitle">Список тикетов</span><span class="nabout">Здесь вы сможете лицезреть список всех ваших обращений</span></div>


		<div class="table">
			<div class="list">
				<div class="tb0">ID</div>
				<div class="tb1">Аватарка</div>
				<div class="tb2">Пользователь</div>
				<div class="tb8">  Тема</div>
				<div class="tb3">Статус</div>
			</div>
			@forelse($tickets as $ticket)
			<div class="list">
				<div class="tb0"><a href="/support/{{$ticket->id}}">#{{$ticket->id}}</a></div>
				<div class="tb1"><a href="/support/{{$ticket->id}}"><img style="width:30%; border-radius: 20%;" src="{{$ticket->avatarka}}" alt="" title="" /></a></div>
				<div class="tb10"><a href="/support/{{$ticket->id}}">{{$ticket->username}}</a></div>
				<div class="tb9">{{$ticket->title}}</div>
				<div class="tbStatus">
				@if($ticket->status == 0) Открытый 
				
				@else
<div class="tbStatusZokrit">	
				Закрытый
			
				</div>
					@endif
				</div>
				
			</div>
			@empty
			<br><center><h1 style="color: #FFF; font-weight: 300;">Запросы в техническую поддержку отсутствуют!</h1></center>
			@endforelse
		</div>
		<form action="/support" method="POST">
			<div class="nticket" style="display: none;">
				<input type="text" name="title" value="" placeholder="Тема обращения" maxlength="32" autocomplete="off">
				<textarea type="text" name="mess" value="" placeholder="Опишите вашу проблему" maxlength="128" autocomplete="off"></textarea>
				<input type="submit" name="submit" value="Создать заявку">
			</div>
			<input type="hidden" name="_token" value="{{csrf_token()}}"/>
		</form>
	</div>
	@else	
	<div class="other-title">Ошибка! Вы были заблокированы за флуд.</div>		
	@endif

</div>

@endsection