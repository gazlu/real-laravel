<!DOCTYPE html>
<!--[if lt IE 7]>
    <html class="no-js lt-ie9 lt-ie8 lt-ie7">
    <![endif]-->
    <!--[if IE 7]>
        <html class="no-js lt-ie9 lt-ie8">
        <![endif]-->
        <!--[if IE 8]>
            <html class="no-js lt-ie9">
            <![endif]-->
            <!--[if gt IE 8]>
                <!-->
                <html class="no-js">
                <!--<![endif]-->
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
                    <title>
                        Login - livelight
                    </title>
                    <meta name="description" content="">
                    <meta name="viewport" content="width=device-width">
                    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
                    <!--base css styles-->
                    <link rel="stylesheet" href="/assets/bootstrap/bootstrap.min.css">
                    <link rel="stylesheet" href="/assets/bootstrap/bootstrap-responsive.min.css">
                    <link rel="stylesheet" href="/assets/font-awesome/css/font-awesome.min.css">
                    <link rel="stylesheet" href="/assets/normalize/normalize.css">
                    <!--page specific css styles-->
                    <link rel="shortcut icon" href="img/favicon.html">
                    <script src="/assets/modernizr/modernizr-2.6.2.min.js">
                    </script>
                    <style type="text/css">
                        .login-page { padding: 80px 0 } .login-page:before { content: ""; position: fixed;
                        top: 0; bottom: 0; width: 100%; z-index: 1 } .login-page .login-wrapper { position:
                        relative; z-index: 2 } .login-page .login-wrapper form { background-color: #fff;
                        padding: 20px; width: 300px; margin: 0 auto } .login-page form h3 { font-size: 25px;
                        font-weight: 300 } .login-page form input { border: 0; background-color: #f5f6f7
                        } .login-page form input[type=text],.login-page form input[type=password],.login-page
                        form button { padding: 15px 10px!important; height: auto!important; font-size: 16px
                        } .login-page form button { margin-top: 25px }
                    </style>
                </head>
                <body class="login-page">
                    <!--[if lt IE 7]>
                        <p class="chromeframe">
                            You are using an
                            <strong>
                                outdated
                            </strong>
                            browser. Please
                            <a href="http://browsehappy.com/">upgrade your browser</a>
                            or
                            <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a>
                            to improve your experience.
                        </p>
                    <![endif]-->
                    <!-- BEGIN Main Content -->
                    <div class="login-wrapper">
                        @yield('main')
                    </div>
                    <!-- END Main Content -->
                    <!--basic scripts-->
                    <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->
                    <script>
                    window.jQuery || document.write('<script src="/assets/jquery/jquery-1.10.1.min.js"><\/script>')
                    </script>
                    <script src="/assets/bootstrap/bootstrap.min.js">
                    </script>
                    <script type="text/javascript">
                                function goToForm(form) {
                $('.login-wrapper > form:visible').fadeOut(500, function() {
                    $('#form-' + form).fadeIn(500);
                });
            }
            $(function() {
                $('.goto-login').click(function() {
                    goToForm('login');
                });
                $('.goto-forgot').click(function() {
                    goToForm('forgot');
                });
                $('.goto-register').click(function() {
                    goToForm('register');
                });
            });
                    </script>
                </body>
                
                </html>