<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (app()->getLocale()=="ar") dir="rtl" @endif>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISMO - Stock Management System @yield('title')</title>
    <!-- Intégration de Bootstrap (exemple) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">@lang('Stock Management System')</a>
        </div>
        <select name="selectLocale" id="selectLocale">
                <option @if(app()->getLocale() == 'ar') selected @endif value="ar">ar</option>
                <option @if(app()->getLocale() == 'fr') selected @endif value="fr">fr</option>
                <option @if(app()->getLocale() == 'en') selected @endif value="en">en</option>
                <option @if(app()->getLocale() == 'es') selected @endif value="es">es</option>
            </select>
        <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <li><button class="btn btn-danger" type="submit">Logout</button></li>
                                </form>
    </nav>

    <!-- Contenu principal -->
    <div class="container mt-4">
        @yield('content')
    </div>
    @stack('scripts')
    <!-- Footer -->
    <footer class="mt-5 bg-dark  text-center text-white fixed-bottom ">
        <p>© 2025 Stock Management System Laravel. Tous droits réservés.</p>
    </footer><br><br>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $("#selectLocale").on('change',function(){
            var locale = $(this).val();
            window.location.href = "/changeLocale/"+locale;
        })
    </script>

</body>

</html>
