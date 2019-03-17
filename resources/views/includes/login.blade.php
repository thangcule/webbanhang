@extends('layouts/master')
@section('content')
<div class="divide80"></div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="post-2046" class="post-2046 page type-page status-publish hentry">
    			<div class="woocommerce">
					<div class="u-columns col2-set" id="customer_login">
						<div class="u-column1 col-1">
							@if(Session('error1'))
								<div class="alert alert-danger">{{session('error1')}}</div>
							@endif
							<h2>Login</h2>
							<form method="post" class="login" action="{{route('signin_user')}}">
								{{ csrf_field() }}   
								<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
									<label for="username">Email address <span class="required">*</span></label>
									<input type="email" required class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="username" value="" />
								</p>
								<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
									<label for="password">Password <span class="required">*</span></label>
									<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
								</p>
								<p class="form-row">
									<input type="hidden" id="woocommerce-login-nonce" name="woocommerce-login-nonce" value="68d6b81066" /><input type="hidden" name="_wp_http_referer" value="/demo/assan/my-account/" />				<input type="submit" class="woocommerce-Button button" name="login" value="Login" />
									<label for="rememberme" class="inline">
										<input class="woocommerce-Input woocommerce-Input--checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember me				
									</label>
								</p>
								<p class="woocommerce-LostPassword lost_password">
									<a href="#">Lost your password?</a>
								</p>
							</form>
						</div>

						<div class="u-column2 col-2">
							@if(Session('error2'))
								<div class="alert alert-danger">{{session('error2')}}</div>
							@endif
							<h2>Register</h2>
								<form method="post" class="register" action="{{route('register_user')}}">
									{{ csrf_field() }}
									<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
										<label for="reg_password">Name <span class="required">*</span></label>
										<input type="text" autocomplete="off" class="" required name="name" id="reg_password" />
									</p>
									<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
										<label for="reg_address">Address<span class="required">*</span></label>
										<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" required name="address" id="reg_email" value="" />
									</p>
									<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
										<label for="reg_email">Email address <span class="required">*</span></label>
										<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" required name="email" id="reg_email" value="" />
									</p>
									<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
										<label for="reg_birthday">Birthday <span class="required">*</span></label>
										<input type="date" class="woocommerce-Input woocommerce-Input--text input-text" required name="birthday" id="reg_email" value="" />
									</p>
									<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
										<label for="reg_password">Password <span class="required">*</span></label>
										<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" required name="password" id="reg_password" autocomplete="off" />
									</p>
									<input type="submit" class="btn btn-info" value="Register">
								</form>
						</div>
					</div>
				</div>
	
			</div><!-- #post-## -->
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('input').attr("autocomplete", "off");
	});
</script>
@stop