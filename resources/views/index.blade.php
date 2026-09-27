<style type="text/css">
	:root {
		--primary-color: #ff0000;
		--secondary-color: #ff0000;
		--black: #000000;
		--white: #ffffff;
		--gray: #efefef;
		--gray-2: #757575;

		--facebook-color: #4267B2;
		--google-color: #DB4437;
		--twitter-color: #1DA1F2;
		--insta-color: #E1306C;
	}

	@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');

	* {
		font-family: 'Poppins', sans-serif;
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

	html,
	body {
		height: 100vh;
		overflow: hidden;
	}

	.container {
		position: relative;
		min-height: 100vh;
		overflow: hidden;
	}

	.row {
		display: flex;
		flex-wrap: wrap;
		height: 100vh;
	}

	.col {
		width: 50%;
	}

	.align-items-center {
		display: flex;
		align-items: center;
		justify-content: center;
		text-align: center;
	}

	.form-wrapper {
		width: 100%;
		max-width: 28rem;
	}

	.form {
		padding: 1rem;
		background-color: var(--white);
		border-radius: 1.5rem;
		width: 100%;
		box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
		transform: scale(0);
		transition: .5s ease-in-out;
		transition-delay: 1s;
	}

	.input-group {
		position: relative;
		width: 100%;
		margin: 1rem 0;
	}

	.input-group i {
		position: absolute;
		top: 50%;
		left: 1rem;
		transform: translateY(-50%);
		font-size: 1.4rem;
		color: var(--gray-2);
	}

	.input-group input {
		width: 100%;
		padding: 1rem 3rem;
		font-size: 1rem;
		background-color: var(--gray);
		border-radius: .5rem;
		border: 0.125rem solid var(--white);
		outline: none;
	}

	.input-group input:focus {
		border: 0.125rem solid var(--primary-color);
	}

	.form button {
		cursor: pointer;
		width: 100%;
		padding: .6rem 0;
		border-radius: .5rem;
		border: none;
		background-color: var(--primary-color);
		color: var(--white);
		font-size: 1.2rem;
		outline: none;
	}

	.form p {
		margin: 1rem 0;
		font-size: .7rem;
	}

	.flex-col {
		flex-direction: column;
	}

	.social-list {
		margin: 2rem 0;
		padding: 1rem;
		border-radius: 1.5rem;
		width: 100%;
		box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
		transform: scale(0);
		transition: .5s ease-in-out;
		transition-delay: 1.2s;
	}

	.social-list>div {
		color: var(--white);
		margin: 0 .5rem;
		padding: .7rem;
		cursor: pointer;
		border-radius: .5rem;
		cursor: pointer;
		transform: scale(0);
		transition: .5s ease-in-out;
	}

	.social-list>div:nth-child(1) {
		transition-delay: 1.4s;
	}

	.social-list>div:nth-child(2) {
		transition-delay: 1.6s;
	}

	.social-list>div:nth-child(3) {
		transition-delay: 1.8s;
	}

	.social-list>div:nth-child(4) {
		transition-delay: 2s;
	}

	.social-list>div>i {
		font-size: 1.5rem;
		transition: .4s ease-in-out;
	}

	.social-list>div:hover i {
		transform: scale(1.5);
	}

	.facebook-bg {
		background-color: var(--facebook-color);
	}

	.google-bg {
		background-color: var(--google-color);
	}

	.twitter-bg {
		background-color: var(--twitter-color);
	}

	.insta-bg {
		background-color: var(--insta-color);
	}

	.pointer {
		cursor: pointer;
	}

	.container.sign-in .form.sign-in,
	.container.sign-in .social-list.sign-in,
	.container.sign-in .social-list.sign-in>div,
	.container.sign-up .form.sign-up,
	.container.sign-up .social-list.sign-up,
	.container.sign-up .social-list.sign-up>div {
		transform: scale(1);
	}

	.content-row {
		position: absolute;
		top: 0;
		left: 0;
		pointer-events: none;
		z-index: 6;
		width: 100%;
	}

	.text {
		margin: 4rem;
		color: var(--white);
	}

	.text h2 {
		font-size: 3.5rem;
		font-weight: 800;
		margin: 2rem 0;
		transition: 1s ease-in-out;
	}

	.text p {
		font-weight: 600;
		transition: 1s ease-in-out;
		transition-delay: .2s;
	}

	.img img {
		width: 30vw;
		transition: 1s ease-in-out;
		transition-delay: .4s;
	}

	.text.sign-in h2,
	.text.sign-in p,
	.img.sign-in img {
		transform: translateX(-250%);
	}

	.text.sign-up h2,
	.text.sign-up p,
	.img.sign-up img {
		transform: translateX(250%);
	}

	.container.sign-in .text.sign-in h2,
	.container.sign-in .text.sign-in p,
	.container.sign-in .img.sign-in img,
	.container.sign-up .text.sign-up h2,
	.container.sign-up .text.sign-up p,
	.container.sign-up .img.sign-up img {
		transform: translateX(0);
	}

/* BACKGROUND */

.container::before {
	content: "";
	position: absolute;
	top: 0;
	right: 0;
	height: 100vh;
	width: 300vw;
	transform: translate(35%, 0);
	background-image: linear-gradient(-45deg, var(--primary-color) 0%, var(--secondary-color) 100%);
	transition: 1s ease-in-out;
	z-index: 6;
	box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
	border-bottom-right-radius: max(50vw, 50vh);
	border-top-left-radius: max(50vw, 50vh);
}

.container.sign-in::before {
	transform: translate(0, 0);
	right: 50%;
}

.container.sign-up::before {
	transform: translate(100%, 0);
	right: 50%;
}

/* RESPONSIVE */

@media only screen and (max-width: 425px) {

	.container::before,
	.container.sign-in::before,
	.container.sign-up::before {
		height: 100vh;
		border-bottom-right-radius: 0;
		border-top-left-radius: 0;
		z-index: 0;
		transform: none;
		right: 0;
	}

    /* .container.sign-in .col.sign-up {
        transform: translateY(100%);
    } */

    .container.sign-in .col.sign-in,
    .container.sign-up .col.sign-up {
    	transform: translateY(0);
    }

    .content-row {
    	align-items: flex-start !important;
    }

    .content-row .col {
    	transform: translateY(0);
    	background-color: unset;
    }

    .col {
    	width: 100%;
    	position: absolute;
    	padding: 2rem;
    	background-color: var(--white);
    	border-top-left-radius: 2rem;
    	border-top-right-radius: 2rem;
    	transform: translateY(100%);
    	transition: 1s ease-in-out;
    }

    .row {
    	align-items: flex-end;
    	justify-content: flex-end;
    }

    .form,
    .social-list {
    	box-shadow: none;
    	margin: 0;
    	padding: 0;
    }

    .text {
    	margin: 0;
    }

    .text p {
    	display: none;
    }

    .text h2 {
    	margin: .5rem;
    	font-size: 2rem;
    }
}
</style>

<div id="container" class="container">
	<!-- FORM SECTION -->
	<div class="row">
		<!-- SIGN UP -->
		<div class="col align-items-center flex-col sign-up">
			<div class="form-wrapper align-items-center">
				<div class="form sign-up">
					<form action="{{ route('register') }}" method="POST">
						@csrf

						<div class="input-group">
							<label class="input-label" for="default-06">Account Type</label>
							<div class="input-control-wrap ">
								<div class="input-control-select">
									<select class="input-control" name="account_type" id="account_type">
										<option value="null">Nothing Selected</option>
										<option value="null"></option>
										<option value="Organization">Organization</option>
										<option value="Consultant">Consultant</option>
										<option value="Student">Student</option>
									</select>
								</div>
							</div>
						</div>

						<input type="hidden" name="role" id="role" value="admin">

						<div class="input-group" id="organization">
							<label class="form-label" for="name">Organization Name</label>
							<div class="form-control-wrap">
								<input type="text" name="organization_name" id="name" class="form-control form-control-lg" placeholder="Organization Name">
							</div>
						</div>

						<div class="input-group" id="domainame">
							<label class="form-label" id="domain-name" for="name">Domain Name()</label>
							<div class="form-control-wrap">
								<input type="text" name="domain_name" id="domain" class="form-control form-control-lg" placeholder="Domain Name">
							</div>
						</div>

						<div class="input-group">
							<label class="form-label" for="name">First Name</label>
							<div class="form-control-wrap">
								<input type="text" name="name" class="form-control form-control-lg{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" placeholder="Enter your name" value="{{ old('name') }}" required autofocus>
								@if ($errors->has('name'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="input-group">
							<label class="form-label" for="name">Last Name</label>
							<div class="form-control-wrap">
								<input type="text" name="last_name" class="form-control form-control-lg{{ $errors->has('last_name') ? ' is-invalid' : '' }}" value="{{ old('last_name') }}" id="last_name" placeholder="Enter your Last Name" required autofocus>
								@if ($errors->has('last_name'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('last_name') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="input-group">
							<label class="form-label" for="email">Email or Username</label>
							<div class="form-control-wrap">
								<input type="email" name="email" class="form-control form-control-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" placeholder="Enter your email address" value="{{ old('email') }}" required autofocus>
								@if ($errors->has('email'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
								@endif
							</div>
						</div>


						<div class="input-group">
							<div class="custom-control custom-control-xs custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="checkbox">
								<label class="custom-control-label" for="checkbox">I agree to DevIndicator <a href="#">Privacy Policy</a> &amp; <a href="#"> Terms.</a></label>
							</div>
						</div>

						<!-- {!! NoCaptcha::display() !!} -->

						<div class="form-group">
							<button type="submit" class="btn btn-lg btn-primary btn-block">Register</button>
						</div>



					</form>
				
					<p>
						<span>
							Already have an account?
						</span>
						<b onclick="toggle()" class="pointer">
							Sign in here
						</b>
					</p>
				</div>
			</div>
		</div>
		<!-- END SIGN UP -->
		<!-- SIGN IN -->

		<div class="col align-items-center flex-col sign-in">
			<div class="form-wrapper align-items-center">
				<form action="{{ route('login') }}"  method="POST">
					@csrf
					<div class="form sign-in">
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="email" name="email" placeholder="Enter your email address" required autofocus
							value="{{ old('email') }}">
							@if ($errors->has('email'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
							@endif
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" name="password" placeholder="Enter your Password" required>
							@if ($errors->has('password'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
							@endif
						</div>
						<button type="submit">
							Sign in
						</button>
						<p>
							<b>
								Forgot password?
							</b>
						</p>
						<p>
							<span>
								Don't have an account?
							</span>
							<div class="form-note-s2 text-center pt-4"> New on our platform? <a href="{{ route('register') }}">Get An Account</a>
                                </div>
						</p>
					</div>
				</form>
			</div>
			<div class="form-wrapper">
			</div>
		</div>
		
		<!-- END SIGN IN -->
	</div>
	<!-- END FORM SECTION -->
	<!-- CONTENT SECTION -->
	<div class="row content-row">
		<!-- SIGN IN CONTENT -->
		<div class="col align-items-center flex-col">
			<div class="text sign-in">
				<h2>
					Devindicator
				</h2>

			</div>
			<div class="img sign-in">

			</div>
		</div>
		<!-- END SIGN IN CONTENT -->
		<!-- SIGN UP CONTENT -->
		<div class="col align-items-center flex-col">
			<div class="img sign-up">
				
			</div>
			<div class="text sign-up">
				<h2>
					Join with us
				</h2>

			</div>
		</div>
		<!-- END SIGN UP CONTENT -->
	</div>
	<!-- END CONTENT SECTION -->
</div>

    <script>
     $(document).ready(function(){
        $('#organization').hide();
        $('#domainame').hide();

        $('#account_type').change(function(){
          if($(this).val() == 'Organization'){
            $('#organization').show();
            $('#domainame').show();
        }else if($(this).val() == 'Consultant' || $(this).val() == 'Student'){
            $('#organization').hide();
            $('#domainame').hide();
        }else if($(this).val() == 'null'){
            $('#organization').hide();
            $('#domainame').hide();
        }
        else{
           $('#null').show('');
       }
   });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
                // organisation name
        $('#name').keyup(function(){
            var name = $('#name').val();
            var domain = name.replace(' ', '-').toLowerCase();

            $('#domain').val(domain);
            var domain_set = $('#domain').val().replace(' ', '-');
            $('#domain').val(domain_set);

            if(domain_set.length > 0)
                $('#domain-name').html('(' + domain_set + '.app.devindicators.com)');
            else
                $('#domain-name').html('');
        });

                // domain name
        $('#domain').keyup(function(){
            var domain = $('#domain').val();

            $('#domain').val(domain);
            var domain_set = $('#domain').val().replace(' ', '-');
            $('#domain').val(domain_set);

            if(domain_set.length > 0)
                $('#domain-name').html('(' + domain_set + '.app.devindicators.com)');
            else
                $('#domain-name').html('');
        });

        $("#company_name_div").hide();
        $("#company_domain_div").hide();

                // account type change listener
        $('#account').on('change', function(){
            let account_type = this.value;

            if(account_type == 'Organisation'){
                $("#company_name_div" ).show();
                $("#company_domain_div" ).show();
                $('#name_div').hide();
            }
            else{
                $("#company_name_div" ).hide();
                $("#company_domain_div" ).hide();
                $('#name_div').show();
            }
        });
    });
</script>


<script type="text/javascript">
	let container = document.getElementById('container')

	toggle = () => {
		container.classList.toggle('sign-in')
		container.classList.toggle('sign-up')
	}

	setTimeout(() => {
		container.classList.add('sign-in')
	}, 200)
</script>