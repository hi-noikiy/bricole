<div class="modal fade" id="quickLogin" tabindex="-1" role="dialog">
	<div class="modal-dialog  modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">{{ t('Close') }}</span>
				</button>
				<h4 class="modal-title"><i class="icon-login fa"></i> {{ t('Log In') }} </h4>
			</div>
			<form role="form" method="POST" action="{{ lurl(trans('routes.login')) }}">
				{!! csrf_field() !!}
				<div class="modal-body">

					@if (isset($errors) and $errors->any() and old('quickLoginForm')=='1')
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<ul class="list list-check">
								@foreach($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					
					@if (config('settings.activation_social_login'))
						<div class="container text-center" style="margin-top: 20px; margin-bottom: 30px;">
							<div class="row">
								<div class="btn btn-fb" style="width: 194px; margin-right: 1px; margin-bottom: 2px;">
									<a href="{{ lurl('auth/facebook') }}" class="btn-fb"><i class="icon-facebook"></i> Facebook</a>
								</div>
								<div class="btn btn-danger" style="width: 194px; margin-left: 1px; margin-bottom: 2px;">
									<a href="{{ lurl('auth/google') }}" class="btn-danger"><i class="icon-googleplus-rect"></i> Google+</a>
								</div>
							</div>
						</div>
					@endif
					
					<?php
						$loginValue = (session()->has('login')) ? session('login') : old('login');
						$loginField = getLoginField($loginValue);
						if ($loginField == 'phone') {
							$loginValue = phoneFormat($loginValue, old('country', $country->get('code')));
						}
					?>
					<!-- Login -->
					<div class="form-group <?php echo (isset($errors) and $errors->has('login')) ? 'has-error' : ''; ?>">
						<label for="login" class="control-label">{{ t('Login') . ' (' . getLoginLabel() . ')' }}</label>
						<div class="input-icon"><i class="icon-user fa"></i>
							<input id="login" name="login" type="text" placeholder="{{ getLoginLabel() }}" class="form-control" value="{{ $loginValue }}">
						</div>
					</div>
					
					<!-- Password -->
					<div class="form-group <?php echo (isset($errors) and $errors->has('password')) ? 'has-error' : ''; ?>">
						<label for="password" class="control-label">{{ t('Password') }}</label>
						<div class="input-icon"><i class="icon-lock fa"></i>
							<input id="password" name="password" type="password" class="form-control" placeholder="{{ t('Password') }}">
						</div>
					</div>
						
					<div class="form-group <?php echo (isset($errors) and $errors->has('remember')) ? 'has-error' : ''; ?>">
						<label class="checkbox pull-left" style="padding-left: 20px; font-weight: normal;">
							<input type="checkbox" value="1" name="remember" id="remember"> {{ t('Keep me logged in') }}
						</label>
						<p class="pull-right" style="margin-top: 10px;">
							<a href="{{ lurl('password/reset') }}"> {{ t('Lost your password?') }} </a> / <a href="{{ lurl(trans('routes.register')) }}">{{ t('Register') }}</a>
						</p>
						<div style=" clear:both"></div>
					</div>
					
					@if (config('settings.activation_recaptcha'))
						<!-- recaptcha -->
						<div class="form-group required <?php echo (isset($errors) and $errors->has('g-recaptcha-response')) ? 'has-error' : ''; ?>">
							<label class="control-label" for="g-recaptcha-response">{{ t('We do not like robots') }}</label>
							<div>
								{!! Recaptcha::render(['lang' => config('app.locale')]) !!}
							</div>
						</div>
					@endif
					
					<input type="hidden" name="quickLoginForm" value="1">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">{{ t('Cancel') }}</button>
					<button type="submit" class="btn btn-success pull-right">{{ t('Log In') }}</button>
				</div>
			</form>
		</div>
	</div>
</div>
