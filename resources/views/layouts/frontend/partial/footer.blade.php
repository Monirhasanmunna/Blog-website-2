
	<footer>

		<div class="container">
			<div class="row pb-0">

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">

						<a class="logo" href="#"><img src="{{asset('images/logo.png')}}" alt="Logo Image"></a>
						<p class="copyright">Bona @ 2017. All rights reserved.</p>
						<p class="copyright">Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a>.Downloaded from <a href="https://themeslab.org/" target="_blank">Themeslab</a></p>
						<ul class="icons">
							<li><a href="#"><i class="ion-social-facebook-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-twitter-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-vimeo-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-pinterest-outline"></i></a></li>
						</ul>

					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

				{{-- <div class="col-lg-4 col-md-6">
						<div class="footer-section">
						<h4 class="title"><b>CATAGORIES</b></h4>
						<ul>
							@foreach ($categories as $category)
								<li><a href="{{$category->slug}}">{{$category->name}}</a></li>
							@endforeach
							

						</ul>
					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 --> --}}

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">

						<h4 class="title"><b>SUBSCRIBE</b></h4>
							@if ($errors->any())
								<div class="alert text-danger" style="padding-left: 0px;margin-bottom: 0px;">
									
										@foreach ($errors->all() as $error)
											<span><strong>{{ $error }}</strong></span>
										@endforeach
									
								</div>
							@endif
						<div class="input-area">
							<form method="POST" action="{{route('subscriber.email')}}">
								@csrf
								<input class="email-input" name="email" type="text" placeholder="Enter your email" class="@error('email') is-invalid @enderror">
								<button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
							</form>
						</div>

					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

			</div><!-- row -->
		</div><!-- container -->
	</footer>
