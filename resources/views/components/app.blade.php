<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Monster Battle</title>

   <link rel="stylesheet" href="{{ asset('/app.css') }}">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <nav class="tavern-nav" aria-label="Navegación principal">
        <div class="tavern-nav__plank">
            <ul class="tavern-nav__list">
                <li><a class="tavern-nav__link @if(request()->is('monster')) is-active @endif"
                        href="/monster">Monsters</a></li>
                <li><a class="tavern-nav__link @if(request()->is('combat')) is-active @endif" href="/combat">Combat</a>
                </li>
                <li><a class="tavern-nav__link @if(request()->is('combat')) is-active @endif"
                        href="/combat">Historial</a></li>

            </ul>
        </div>
    </nav>


    @if (session('success'))
        <div class="parchment-flash parchment-flash--success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="parchment-flash parchment-flash--error">
            {{ session('error') }}
        </div>
    @endif

    <div class="sheet">
        <div class="stain s1"></div>
        <div class="stain s2"></div>
        <div class="stain s3"></div>
        <div class="stain s4"></div>

        <!-- floral corner ornaments -->
        <div class="corner tl">
            <svg viewBox="0 0 110 110" xmlns="http://www.w3.org/2000/svg">
                <path d="M6,6 C6,40 6,70 6,104" />
                <path d="M6,6 C40,6 70,6 104,6" />
                <path d="M6,20 C30,20 34,10 30,4" />
                <path d="M20,6 C20,30 10,34 4,30" />
                <path d="M6,45 C26,45 40,38 34,22 C30,12 16,14 14,26 C12,38 24,44 34,36" />
                <path d="M45,6 C45,26 38,40 22,34 C12,30 14,16 26,14 C38,12 44,24 36,34" />
                <circle class="bloom" cx="16" cy="16" r="3.2" />
                <circle class="bloom" cx="34" cy="8" r="2" />
                <circle class="bloom" cx="8" cy="34" r="2" />
                <ellipse cx="24" cy="24" rx="5" ry="3" transform="rotate(45 24 24)" />
            </svg>
        </div>
        <div class="corner tr">
            <svg viewBox="0 0 110 110" xmlns="http://www.w3.org/2000/svg">
                <path d="M6,6 C6,40 6,70 6,104" />
                <path d="M6,6 C40,6 70,6 104,6" />
                <path d="M6,20 C30,20 34,10 30,4" />
                <path d="M20,6 C20,30 10,34 4,30" />
                <path d="M6,45 C26,45 40,38 34,22 C30,12 16,14 14,26 C12,38 24,44 34,36" />
                <path d="M45,6 C45,26 38,40 22,34 C12,30 14,16 26,14 C38,12 44,24 36,34" />
                <circle class="bloom" cx="16" cy="16" r="3.2" />
                <circle class="bloom" cx="34" cy="8" r="2" />
                <circle class="bloom" cx="8" cy="34" r="2" />
                <ellipse cx="24" cy="24" rx="5" ry="3" transform="rotate(45 24 24)" />
            </svg>
        </div>
        <div class="corner bl">
            <svg viewBox="0 0 110 110" xmlns="http://www.w3.org/2000/svg">
                <path d="M6,6 C6,40 6,70 6,104" />
                <path d="M6,6 C40,6 70,6 104,6" />
                <path d="M6,20 C30,20 34,10 30,4" />
                <path d="M20,6 C20,30 10,34 4,30" />
                <path d="M6,45 C26,45 40,38 34,22 C30,12 16,14 14,26 C12,38 24,44 34,36" />
                <path d="M45,6 C45,26 38,40 22,34 C12,30 14,16 26,14 C38,12 44,24 36,34" />
                <circle class="bloom" cx="16" cy="16" r="3.2" />
                <circle class="bloom" cx="34" cy="8" r="2" />
                <circle class="bloom" cx="8" cy="34" r="2" />
                <ellipse cx="24" cy="24" rx="5" ry="3" transform="rotate(45 24 24)" />
            </svg>
        </div>
        <div class="corner br">
            <svg viewBox="0 0 110 110" xmlns="http://www.w3.org/2000/svg">
                <path d="M6,6 C6,40 6,70 6,104" />
                <path d="M6,6 C40,6 70,6 104,6" />
                <path d="M6,20 C30,20 34,10 30,4" />
                <path d="M20,6 C20,30 10,34 4,30" />
                <path d="M6,45 C26,45 40,38 34,22 C30,12 16,14 14,26 C12,38 24,44 34,36" />
                <path d="M45,6 C45,26 38,40 22,34 C12,30 14,16 26,14 C38,12 44,24 36,34" />
                <circle class="bloom" cx="16" cy="16" r="3.2" />
                <circle class="bloom" cx="34" cy="8" r="2" />
                <circle class="bloom" cx="8" cy="34" r="2" />
                <ellipse cx="24" cy="24" rx="5" ry="3" transform="rotate(45 24 24)" />
            </svg>
        </div>

        <header>
            <svg class="flourish" viewBox="0 0 300 30" xmlns="http://www.w3.org/2000/svg">
                <path d="M10,15 C60,-5 120,35 150,15 C180,-5 240,35 290,15" fill="none" stroke="#4a3626"
                    stroke-width="1.5" />
                <circle cx="150" cy="15" r="3" fill="#4a3626" />
            </svg>
            <h1>{{ $title ?? 'Monster Battle' }}</h1>
            <hr class="subrule">
        </header>

        <main>
            {{ $slot }}
        </main>

    </div>

</body>

</html>