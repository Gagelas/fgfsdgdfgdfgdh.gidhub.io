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
	@if($u->ban_ticket != 1)
		
		<div class="title-block">
            <h2 style="color: #ffffff;">
               {{ $support_title = \App\Http\Controllers\SupportController::SUPPORT_TITLE }}
            </h2>
        </div>
	@forelse($loots as $ticket)

	@if($ticket->username == $u->username || $u->is_admin == 1 || $u->is_moderator == 1)
	

	<div class="support">
		@if($ticket->status == 0)<div class="oticket">Данный тикет открыт, если мы вам помогли, то закройте его.</div>
		@else <div class="fticket">Данный тикет закрыт!</div> @endif
		
		<div class="sticket">
			<div class="suticket">
				<div class="avatar"><img src="{{$ticket->avatarka}}" alt="" title="" /></div>	
				<div class="tfe">
					<div class="time_user">{{$ticket->date}}</div>
					<div class="title">{{$ticket->username}}</div>
					<div class="msg">{{$ticket->messages}}</div>
				</div>
				
			</div>
			@if($ticket->ask == 1 || $ticket->ask == 2)			
				@forelse($mess as $ticketm)
					@if($ticketm->admin_id == 1)
					<div class="suticket_admin">
						<div class="avatar"><img src="/assets/img/adm-ava.png" alt=" "="" title=""></div>	
						<div class="tfe">
							<div class="time">{{$ticketm->date}}</div>
							<div class="title_admin">{{ $support_name = \App\Http\Controllers\SupportController::SUPPORT_NAME }}</div>
							<div class="msg">{{$ticketm->messages}}</div>
						</div>
					</div>
					@else
					<div class="suticket">
						<div class="avatar_user"><img src="{{$ticket->avatarka}}" alt="" title="" /></div>	
						<div class="tfe">
							<div class="time_user">{{$ticketm->date}}</div>
							<div class="title">{{$ticket->username}}</div>
							<div class="msg">{{$ticketm->messages}}</div>
						</div>
					</div>
					@endif
				@empty
				@endforelse
			@endif
			<div class="newtif">
				
				@if($ticket->ask == 1 && $ticket->status == 0) 
				<span class="oticket">Ваша заявка ожидает ответа от технической поддержки. Пожалуйста, не дублируйте письма повторно мы ответим вам в течение 24 часов.</span> 
				
				<form action="/support/{{$ticket->id}}" method="POST"> 
					<textarea type="text" name="mess" placeholder="Введите ваше сообщение..." maxlength="64" autocomplete="off"></textarea> 
					<input type="submit" name="submit" value="Отправить"> 
					<input type="hidden" name="_token" value="{{csrf_token()}}"/>
				</form>
				@endif
				@if($ticket->ask == 2 && $ticket->status == 0) 
				<span class="oticket">Техническая поддержка ответила на ваш запрос, ознакомьтесь с ним и в случае, если мы вам помогли, закройте тикет.</span> 
				
				<form action="/support/{{$ticket->id}}" method="POST"> 
					<textarea type="text" name="mess" placeholder="Введите ваше сообщение..." maxlength="64" autocomplete="off"></textarea>
					<input type="submit" name="submit" value="Отправить"> 
					<input type="hidden" name="_token" value="{{csrf_token()}}"/>
				</form> 
				@endif
				@if($ticket->ask == 2 && $ticket->status == 1 || $ticket->ask == 1 && $ticket->status == 1) 
				<span class="fticket2">Спасибо за обращение в техническую поддержку CSGOALLIN.RU, мы были рады Вам помочь!</span>
				
				<br> 
				@endif
				@if($ticket->status == 0) 
				<form action="/support/{{$ticket->id}}" method="POST"> 
					<br><br><input type="submit" name="close" value="Закрыть тикет">
					<input type="hidden" name="_token" value="{{csrf_token()}}"/>
				</form>
				@endif
				@if($u->is_admin == 1 && $ticket->status == 0) 
				<form action="/support/{{$ticket->id}}" method="POST"> 
					<br><br><input type="submit" name="ban" value="Заблокировать">
					<input type="hidden" name="_token" value="{{csrf_token()}}"/>
				</form>
				@endif
			</div>	
		</div>
	</div>
	@else
	<center><h1 style="color: #fff;">Такого запроса не существует!</h1></center>
	@endif
	@empty
	<center><h1 style="color: #fff;">Такого запроса не существует!</h1></center>
	@endforelse	
	@else	
	<div class="other-title">Ошибка! Вы были заблокированы за флуд.</div>	
	@endif		
</div>

@endsection