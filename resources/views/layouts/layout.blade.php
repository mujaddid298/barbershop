<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Men\'s Hair Studio')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('icons/mens.png') }}">

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --gold: #C9A84C;
            --gold-light: #E2C97E;
            --charcoal: #1A1A1A;
            --dark: #111111;
            --surface: #222222;
            --border: #333333;
            --muted: #6B6B6B;
            --text: #FFFFFF;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background-color: var(--gold);
            color: var(--text);
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
        }

        .font-display {
            font-family: 'Playfair Display', serif;
        }

        .font-serif {
            font-family: 'Playfair Display', serif !important;
        }

        .text-gold {
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 50%, var(--gold) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .input-field {
            width: 100%;
            background: #1E1E1E;
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 10px 14px;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .input-field::placeholder {
            color: var(--muted);
        }

        .input-field:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 2px rgba(201, 168, 76, 0.15);
        }

        .input-field.is-error {
            border-color: #E05555;
        }

        /* Primary button */
        .btn-primary {
            width: 100%;
            background: linear-gradient(135deg, #B8942A 0%, var(--gold) 50%, #B8942A 100%);
            background-size: 200% auto;
            color: #111;
            font-family: 'DM Sans', sans-serif;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-position 0.4s, transform 0.15s;
        }

        .btn-primary:hover {
            background-position: right center;
            transform: translateY(-1px);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        /* Divider line */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--muted);
            font-size: 12px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* Barber pole accent */
        .barber-accent {
            width: 4px;
            height: 100%;
            background: repeating-linear-gradient(-45deg,
                    #CC2B2B 0px, #CC2B2B 8px,
                    #ffffff 8px, #ffffff 16px,
                    #1A4FA0 16px, #1A4FA0 24px);
            border-radius: 2px;
            animation: barber-scroll 3s linear infinite;
        }

        @keyframes barber-scroll {
            from {
                background-position: 0 0;
            }

            to {
                background-position: 0 48px;
            }
        }

        /* Fade-up entry */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeUp 0.5s ease forwards;
        }

        .fade-up-2 {
            animation: fadeUp 0.5s 0.1s ease both;
        }

        .fade-up-3 {
            animation: fadeUp 0.5s 0.2s ease both;
        }

        /* Scissors watermark */
        .scissors-bg {
            position: absolute;
            bottom: -20px;
            right: -20px;
            font-size: 140px;
            opacity: 0.04;
            line-height: 1;
            pointer-events: none;
            user-select: none;
        }

        .image-placeholder {
            background: linear-gradient(135deg, #1E1E1E 0%, #2A2A2A 100%);
            border: 1px dashed var(--border);
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: var(--muted);
            font-size: 13px;
        }
    </style>
</head>

<body>
    @yield('content')
</body>

</html>
