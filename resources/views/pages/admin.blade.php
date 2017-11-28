@extends('layout')

@section('content')
 <title>  {{ $title = \App\Http\Controllers\AdminController::TITLE_UP }}</title>

	 <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
	<script>	

  $(document).ready(function() {
		$(".newticket").click(function () {
   
		});
	});
</script>
<div class="content">
<div class="title-block">
            <h2 style="color: #ffffff;">
               Админка
            </h2>
        </div>
		

	<div class="support">
					
		
				<form action="/clearsupport" method="GET">
			<div class="gameamount" style="float: left;  margin-left: 220px;">
				<input type="submit" name="mute" value="Очистить Поддержку">
			</div>
			<input type="hidden" name="_token" value="{{csrf_token()}}"/>
		</form>
		
		
		<form action="/sendmoney" method="GET">
			<div class="gameamount2" style="float: left;  margin-left: 220px;">
				<input type="text" name="steamid" style="overflow: hidden;" cols="50" required placeholder="Имя" maxlength="40" autocomplete="off">
               <input type="number" name="mone"  style="overflow: hidden;" cols="50" required placeholder="Сумма" maxlength="6" autocomplete="off">
				<input type="submit" name="submit" value="Передать деньги">
			</div>
			<input type="hidden" name="_token" value="{{csrf_token()}}"/>
		</form>
		
		<form action="/removemoney" method="GET">
			<div class="gameamount2" style="float: left;  margin-left: 220px;">
				<input type="text" name="steamid" style="overflow: hidden;" cols="50" required placeholder="Имя" maxlength="40" autocomplete="off">
               <input type="number" name="mone"  style="overflow: hidden;" cols="50" required placeholder="Сумма" maxlength="6" autocomplete="off">
				<input type="submit" name="submit" value="Удалить деньги">
			</div>
			<input type="hidden" name="_token" value="{{csrf_token()}}"/>
		</form>
	
		
		<div class="table">
			<div class="list2">
				<div class="tb1">Имя</div>
					<div class="tb2">Деньги</div>
				<div class="tb3">Steamid</div>
				<div class="tb4">Админ</div>
				<div class="tb5">Мут</div>
				<div class="tb6">Бан</div>
			</div>
			
			
			@forelse($adminka as $ticket)
			<div class="list">
							<div class="tb1"><a href="/user/{{$ticket->steamid64}}">{{$ticket->username}}</a></div>
						
				<div class="tb2">{{$ticket->money}}</div>
				<div class="tb3"><a href="/user/{{$ticket->steamid64}}">{{$ticket->steamid64}}</a></div>
				<div class="tb4">
				@if($ticket->is_admin == 0)
				<div style="color: #cd4949;"><a href="/setadmin?steamid={{$ticket->username}}&ban=Set+admin%2FUnset">Нет</a></div>
				@else
			<div style="color: #5ccd49;">	
		<a href="/setadmin?steamid={{$ticket->username}}&ban=Set+admin%2FUnset">
				<div style="color: #5ccd49;">Да</div>
			</a>
				</div>
				@endif
				</div>
			<div class="tb5">
				@if($ticket->banchat == 0)
			<div style="color: #cd4949;" >
		<a  href="/mute?steamid={{$ticket->username}}&mute=Mute%2FUnmute" data-toggle="tooltip" data-placement="right" title="Заглушить!" >Нет</a>
		</div>
				@else
			<div style="color: #5ccd49;">	
			<a href="/mute?steamid={{$ticket->username}}&mute=Mute%2FUnmute">
				<div style="color: #5ccd49;">Да</div>
			</a>
				</div>
				@endif
				</div>
			<div class="tb6">
				@if($ticket->ban_ticket == 0)
			<div style="color: #cd4949;" >
		<a  href="/supportban?steamid={{$ticket->username}}&ban=Support+ban%2FUnban" data-toggle="tooltip" data-placement="right" title="Забанить!">Нет</a>
		</div>
				@else
			<div style="color: #5ccd49;">	
			<a href="/supportban?steamid={{$ticket->username}}&ban=Support+ban%2FUnban">
				<div style="color: #5ccd49;">Да</div>
			</a>
				</div>
				@endif
				</div>
			</div>
			
			
			@empty
			<br><center><h1 style="color: #FFF; font-weight: 300;">Нет игроков</h1></center>
			@endforelse
		</div>
		
		
	</div>


</div>

@endsection