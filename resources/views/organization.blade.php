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
    <title>Organization || DevIndicator</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('public/main/assets/css/dashlite.css?ver=3.1.2') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('public/main/assets/css/theme.css?ver=3.1.2') }}">
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
                            <a href="html/index.html" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg" src="{{ asset('public/main/img/devlogo.png') }}" srcset="./images/logo2x.png 2x" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="{{ asset('public/main/img/devlogo.png') }}" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Organization Access Selection</h4>
                                        <div class="nk-block-des">
                                            <p>Load or Add Organization/Structure you need access to:</p>
                                        </div>
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('organization-assign')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label" for="name">Access Number</label>
                                        <div class="form-control-wrap">
                                            <input type="text" name="access_number" class="form-control form-control-lg" id="access_number" placeholder="Enter your access number" required>
                                        </div>
                                    </div>

                                    <input type="hidden" name="user_id" class="form-control form-control-lg" id="access_number" required>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Add</button>
                                    </div>

                                </form>

                                <div class="form-note-s2 text-center pt-4"> You can always switch or add access by going to My Profile > Organization & Structure Accessibility
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
                                        <p class="text-soft">&copy; 2022 CryptoLite. All Rights Reserved.</p>
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
    <!-- select region modal -->
  

</html>