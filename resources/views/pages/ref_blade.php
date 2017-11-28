@extends('layout')

@section('content')
<div class="about-page">
        <div class="title-block">
            <h2>РЕФЕРАЛЬНАЯ СИСТЕМА</h2>
        </div>

<div class="page-content">
<div class="about">
<div class="page-main-block">
	<div class="page-mini-title" style="text-align: center">Ваш личный код, для приглашения друзей</div>	<div class="page-block">
		<div class="page-block">
			<div class="ref_balance">
			<b style="font-weight:normal;font-size:17px;">Ваш купон</b><br>
			<span id="balance_id">{{ $u->steamid64 }}</span>
			</div>
	</div>
</div>

<div style="overflow:hidden;     margin-left: 170px;">
			
	<div class="page-main-block left" style="float: left;">
		<div class="page-block">
			<div class="ref_balance">
			<b style="font-weight:normal;font-size:17px;">Ваш Баланс</b><br>
			<span id="balance_id">{{ $u->money }}</span> Рублей
			</div>
		</div>
	</div>

		<div class="page-main-block left" style="float: left;  margin-left: 100px;">
		<div class="page-block">
			<div class="ref_balance">
			<b style="font-weight:normal;font-size:17px;"></b><br>
			</div>
		</div>
	</div>
	
		<div class="page-main-block left" style="float: left;  margin-left: 50px;">
		<div class="page-block">
			<div class="ref_balance">
			<b style="font-weight:normal;font-size:17px;">Количество людей приглашенных вами</b><br>
			<span id="balance_id">{{ $u->refcount }}</span> .
			</div>
		</div>
	</div>	

	
	
<form action="/getcoupon" method="GET" style="
    float: right; margin-top: 20px; margin-right: 300px;
">
<div class="form">
  <input  textarea name="idd" cols="17" placeholder="КУПОН" autocomplete="off" style=" width: 200px;"></textarea>

<input type="hidden" name="refid" id="desc" value={{ $u->steamid64 }}>
<input type="submit" id="submit" class="btn-add-balance" value="Активировать">
	
   </div></form> 

   
   
   
   
   
</div>
<div class="about" style="
    margin-top: 50px;
">
<div class="other-title" style="text-align: center; background: #1f2f3c;
    text-align: center;
    padding: 15px;
    font-size: 16px;
    text-shadow: 1px 1px 0px rgba(0, 0, 0, 0.15);">ИНФОРМАЦИЯ</div>
<ol>
	<li>- После активации кода вы получаете 5 руб. на свой счет вы можете потратить их в магазине или поиграть с ними на сайте..</li>
	<li>- Регистрация кода возможна только один раз!</li>
</ol>
<ol>
	<b>Чтобы получить своего реферала:</b>
	<li>- Попросите своего друга \ знакомого активировать Ваш личный код у себя в реферальной системе.</li>
	<li>- За каждого приглашенного друга \ знакомого вы получаете 3 руб., а друг 5 руб.</li>
</ol>

</div>

    </div>
    </div>



	@endsection