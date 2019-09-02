@extends('layouts.site')

@section('content')


	<!-- banner -->
<section class="banner_inner" id="home">
	<div class="banner_inner_overlay">
	</div>
</section>
<!-- //banner -->


<!-- Contact -->
<section class="contact py-5">
	<div class="container py-lg-5 py-sm-3">
			<h2 class="heading text-capitalize text-center mb-sm-5 mb-4">Свяжись с нами</h2>
			<ul class="list-unstyled row text-center mt-lg-5 mt-4 px-lg-5">
                <li class="col-md-4 col-sm-6 adress-w3pvt-info">
                    <div class=" adress-icon">
                        <span class="fa fa-map-marker"></span>
                    </div>

                    <h6>Расположение</h6>
                    <p>Мечты сбываются
                        <br>г. Домодедово, ул. Корнеева </p>
                </li>

                <li class="col-md-4 col-sm-6 adress-w3pvt-info mt-sm-0 mt-4">
                    <div class="adress-icon">
                        <span class="fa fa-envelope-open-o"></span>
                    </div>
                    <h6>Телефон и Email</h6>
                    <p>+7 (903) 222-76-59</p>
                    <a href="mailto:info@example.com" class="mail">vidnoe1976@mail.ru</a>
                </li>
                <li class="col-md-4 col-sm-6 adress-w3pvt-info mt-md-0 mt-4">

                    <div class="adress-icon">
                        <span class="fa fa-comments-o"></span>
                    </div>

                    <h6>Оставайтесь на связи</h6>
					<ul class="social_section_1info">
						<li class="mb-2 facebook"><a href="https://www.facebook.com/groups/1537362279648252/about/" class=""><span class="fa fa-facebook"></span></a></li>
						<li class="mb-2 vk"><a href="https://vk.com/dreams_comet" class=""><span class="fa fa-vk"></span></a></li>
						<li class="mb-2 instagram"><a href="https://www.instagram.com/elena_mehtu_sbuvaytsa/"><span class="fa fa-instagram"></span></a></li>
						<li class="mb-2 odnoklassniki"><a href="https://ok.ru/group/55076417896460"><span class="fa fa-odnoklassniki"></span></a></li>
					</ul>
                </li>
            </ul>
			
			<div class="contact-grids mt-5">
				<div class="row">
					<div class="col-lg-6 col-md-6 contact-left-form">
						<form action="#" method="post">
							<div class=" form-group contact-forms">
							  <input type="text" class="form-control" placeholder="Имя" required autocomplete="name" required="">
							</div>
							<div class="form-group contact-forms">
							  <input type="email" class="form-control" required placeholder="Email" required="">
							</div>
							<div class="form-group contact-forms">
							  <input type="text" class="form-control" placeholder="Телефон" autocomplete="tel" required="">
							</div>
							<div class="form-group contact-forms">
							  <textarea class="form-control" placeholder="Сообщение" required=""></textarea>
							</div>
							<button class="btn btn-block sent-butnn">Отправить</button>
						</form>
					</div>
					<div class="col-lg-6 col-md-6 contact-right pl-lg-5">
						<h4>У вас есть вопросы? Хотите заказать индивидульный тур? Напишите нам.</h4>
						<p class="mt-md-4 mt-2">Всегда рады видеть ваши сообщения и ваш интерес. Постараемся предоставить
							любую информацию в зоне нашей компетенции. Составим индивидуальную программу основываясь на озвученных пожеланиях.</p>
						<h5 class="mt-lg-5 mt-3">Часы работы</h5>
						<p class="mt-3">Будни : 10:00 до 21:00</p>
						<p>Выходные : 12:00 до 20:00</p>
					</div>
				</div>
			</div>
	</div>
</section>
<!-- //Contact -->

<!-- map -->	
<div class="map p-2">
	<iframe width="100%" height="600" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=ru&amp;coord=55.444794, 37.754272&amp;q=Domodedovo%2C%20Kashira%20Highway%2C%20100%D0%90+(%D0%94%D0%BE%D0%BC%D0%BE%D0%B4%D0%B5%D0%B4%D0%BE%D0%B2%D0%BE)&amp;ie=UTF8&amp;t=&amp;z=12&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
</div>
<!-- //map -->

@endsection