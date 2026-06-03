<!DOCTYPE html>
<html lang="id">
<head>
    
</head>
<body>
    <div class="layout">
        
        <div class="main-container">

            <!-- Main Content -->
            <main class="content">
                @yield('content')

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </main>
        </div>
    </div>

</body>
</html>
