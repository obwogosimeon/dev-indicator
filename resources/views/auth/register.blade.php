<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>Register | DevIndicator</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('public/main/assets/css/dashlite.css?ver=3.1.2') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('public/main/assets/css/theme.css?ver=3.1.2') }}">
    <!-- {!! NoCaptcha::renderJs() !!} -->
</head>

<body class="nk-body bg-white npc-default pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                        <div class="brand-logo pb-4 text-center">
                                    <a href="{{ url('/')}}" class="logo-link">
                                        <img class="logo-light logo-img logo-img-lg" src="{{ asset('public/main/img/devlogo.png') }}" srcset="{{ asset('public/main/img/devlogo.png') }}" alt="logo">
                                        <img class="logo-dark logo-img logo-img-lg" src="{{ asset('public/main/img/devlogo.png') }}" srcset="{{ asset('public/main/img/devlogo.png') }}" alt="logo-dark">
                                    </a>
                                </div>
                        <div class="card">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Register</h4>
                                        <div class="nk-block-des">
                                            <p>Create New Dev Account</p>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label class="form-label" for="default-06">Account Type</label>
                                        <div class="form-control-wrap ">
                                            <div class="form-control-select">
                                                <select class="form-control" name="account_type" id="account_type">
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

                                    <div class="form-group" id="organization">
                                        <label class="form-label" for="name">Organization Name</label>
                                        <div class="form-control-wrap">
                                            <input type="text" name="organization_name" id="name" class="form-control form-control-lg" placeholder="Organization Name">
                                        </div>
                                    </div>

                                    <div class="form-group" id="domainame">
                                        <label class="form-label" id="domain-name" for="name">Domain Name()</label>
                                        <div class="form-control-wrap">
                                            <input type="text" name="domain_name" id="domain" class="form-control form-control-lg" placeholder="Domain Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
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

                                    <div class="form-group">
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

                                    <div class="form-group">
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

                                    
                                    <div class="form-group">
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

                                <div class="form-note-s2 text-center pt-4"> Already have an account? <a href="{{ route('login')}}"><strong>Sign in instead</strong></a>
                                </div>
                                <div class="text-center pt-4 pb-3">
                                    <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6 order-lg-last">
                                    <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Terms & Condition</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Privacy Policy</a>
                                        </li>
                                        
                                        
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-left">
                                        <p class="text-soft">&copy; 2023 Devindicator. All Rights Reserved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ asset('public/main/assets/js/bundle.js?ver=3.1.2') }}"></script>
    <script src="{{ asset('public/main/assets/js/scripts.js?ver=3.1.2') }}"></script>
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
<!-- select region modal -->


</html>