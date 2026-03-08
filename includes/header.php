<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="<?php echo isset($pageDescription) ? $pageDescription : 'Flash Fix Technologies - Professional IT infrastructure, networking, and hardware solutions provider in Dubai, UAE'; ?>">
    <meta name="keywords"
        content="IT solutions Dubai, networking experts, IT infrastructure, Flash Fix Technologies, Hiba Computer Group, IT services UAE, server installation, structured cabling, CCTV systems, IT support">
    <meta name="author" content="Flash Fix Technologies">
    <meta name="robots" content="index, follow">

    <!-- Open Graph -->
    <meta property="og:title"
        content="<?php echo isset($pageTitle) ? $pageTitle : 'Flash Fix Technologies | IT Solutions & Networking Experts Dubai'; ?>">
    <meta property="og:description"
        content="<?php echo isset($pageDescription) ? $pageDescription : 'Professional IT infrastructure, networking, and hardware solutions provider in Dubai.'; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:site_name" content="Flash Fix Technologies">

    <title>
        <?php echo isset($pageTitle) ? $pageTitle : 'Flash Fix Technologies | IT Solutions & Networking Experts Dubai'; ?>
    </title>

    <link rel="icon" type="image/x-icon" href="/assets/icons/favicon.ico">

    <!-- Google Fonts: Poppins + Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Swiper.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Tailwind CSS v4 Play CDN -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        @variant dark (&:where(.dark, .dark *));

        :root {
            /* Vibrant Light Theme */
            --theme-page: #FFFFFF;
            --theme-gray-50: #F8FAFC;
            
            --theme-primary: #2563EB;
            --theme-secondary: #3B82F6;
            --theme-accent: #06B6D4;
            
            --theme-text-main: #0F172A;
            --theme-text-muted: #475569;
            --theme-text-soft: #64748B;
            
            --theme-border-100: #E2E8F0;
            --theme-border-200: #CBD5E1;
            
            --theme-base: #FFFFFF;
            --theme-surface: #FFFFFF;
        }

        .dark {
            /* Vibrant Dark Theme */
            --theme-page: #0B1120;
            --theme-gray-50: #0B1120;
            
            --theme-primary: #3B82F6;
            --theme-secondary: #60A5FA;
            --theme-accent: #22D3EE;
            
            --theme-text-main: #F8FAFC;
            --theme-text-muted: #94A3B8;
            --theme-text-soft: #64748B;
            
            --theme-border-100: #1E293B;
            --theme-border-200: #334155;
            
            --theme-base: #0B1120; 
            --theme-surface: #1E293B;
            --color-white: #FFFFFF;
        }

        @theme {
            --color-base: var(--theme-base);
            --color-surface: var(--theme-surface);
            
            --color-blue-500: var(--theme-secondary);
            --color-blue-600: var(--theme-primary);
            --color-cyan-400: var(--theme-accent);
            --color-cyan-500: var(--theme-accent);
            
            --color-gray-50: var(--theme-gray-50);
            --color-gray-100: var(--theme-border-100);
            --color-gray-200: var(--theme-border-200);
            
            --color-gray-900: var(--theme-text-main);
            --color-gray-600: var(--theme-text-muted);
            --color-gray-500: var(--theme-text-soft);
            
            --color-slate-200: var(--theme-text-main);
            --color-slate-300: var(--theme-text-muted);
            --color-slate-400: var(--theme-text-soft);
            --color-slate-600: var(--theme-border-100);

            /* Scaled up Typography for bolder titles */
            --text-lg: 1.25rem;
            --text-xl: 1.5rem;
            --text-2xl: 1.875rem;
            --text-3xl: 2.25rem;
            --text-4xl: 2.75rem;
            --text-5xl: 3.5rem;
            --text-6xl: 4.25rem;
        }

        @layer base {
            body {
                font-family: 'Poppins', 'Inter', sans-serif;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
                letter-spacing: 0.01em;
                line-height: 1.6;
            }
            h1, h2, h3, h4, h5, h6 {
                font-family: 'Poppins', sans-serif;
                letter-spacing: -0.01em;
                line-height: 1.25;
            }
        }

        @layer utilities {
            .text-gradient-accent {
                background-image: linear-gradient(to right, var(--theme-primary), var(--theme-accent));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .btn-primary {
                @apply bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full px-6 py-2.5 font-semibold text-sm text-white transition-all duration-300;
            }
            .btn-primary:hover {
                box-shadow: 0 0 20px var(--theme-primary);
                opacity: 0.9;
            }

            .btn-ghost {
                @apply border border-blue-500 text-blue-600 dark:text-blue-400 rounded-full px-6 py-2.5 font-semibold text-sm transition-all duration-300;
            }
            .btn-ghost:hover {
                @apply bg-blue-600 text-white border-blue-600;
            }

            .bg-hero-gradient {
                background-image: linear-gradient(135deg, #0153FD, #3A9FFB);
            }
            :is(.dark .bg-hero-gradient) {
                background-image: linear-gradient(135deg, #0B1F3A, #0E3AA8);
            }
            .card-accent {
                @apply bg-gradient-to-r from-blue-500 to-cyan-400 h-[2px] w-10 rounded-full mb-3;
            }

            .animate-fade-in-up { animation: fade-in-up 0.7s ease-out forwards; }
            .animate-fade-in-left { animation: fade-in-left 0.7s ease-out forwards; }
            .animate-fade-in-right { animation: fade-in-right 0.7s ease-out forwards; }
            .animate-logo-carousel { animation: logo-carousel 35s linear infinite; }
        }
    </style>

    <style>
        /* SaaS UI Card */
        .glass-card {
            background: var(--theme-surface);
            border: 1px solid var(--theme-border-100);
            border-radius: 1rem;
            box-shadow: 0 4px 24px -6px rgba(15, 23, 42, 0.08);
            /* Clean modern shadow */
        }

        .dark .glass-card {
            background: var(--theme-surface);
            border-color: var(--theme-border-100);
            box-shadow: 0 8px 32px -8px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.05);
        }

        /* Page Loader */
        .page-loader {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: var(--theme-page);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.6s ease;
        }

        .spinner {
            width: 3em;
            height: 3em;
            border-radius: 50%;
            border: 2px solid #ddd;
            box-shadow: -10px -10px 10px #6359f8, 0px -10px 10px 0px #9c32e2, 10px -10px 10px #f36896, 10px 0 10px #ff0b0b, 10px 10px 10px 0px #ff5500, 0 10px 10px 0px #ff9500, -10px 10px 10px 0px #ffb700;
            animation: rot55 0.7s linear infinite;
            position: relative;
        }

        .dark .spinner {
            border-color: #1e293b;
        }

        .spinnerin {
            border: 2px solid #ddd;
            width: 1.5em;
            height: 1.5em;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .dark .spinnerin {
            border-color: #1e293b;
        }

        /* Dot Pattern */
        .dot-pattern {
            background-image: radial-gradient(rgba(0, 0, 0, 0.04) 1px, transparent 1px);
            background-size: 24px 24px;
        }

        .dark .dot-pattern {
            background-image: radial-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        }

        @keyframes rot55 {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in-left {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fade-in-right {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes logo-carousel {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }
    </style>

    <!-- Theme Script (runs before paint to prevent flash) -->
    <script>
        (function () {
            var theme = localStorage.getItem('theme') || 'light';
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <!-- Schema.org -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "Flash Fix Technologies",
        "description": "Professional IT infrastructure, networking, and hardware solutions provider in Dubai, UAE",
        "url": "https://flashfix.ae",
        "telephone": "+9714XXXXXXX",
        "email": "info@flashfix.ae",
        "address": {"@type":"PostalAddress","addressLocality":"Dubai","addressCountry":"AE","addressRegion":"Dubai"},
        "geo": {"@type":"GeoCoordinates","latitude":25.2048,"longitude":55.2708},
        "openingHoursSpecification": {"@type":"OpeningHoursSpecification","dayOfWeek":["Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday"],"opens":"09:00","closes":"18:00"},
        "sameAs": ["https://www.linkedin.com/company/flash-fix-technologies"]
    }
    </script>

    <!-- SEO -->
    <meta name="copyright" content="Flash Fix Technologies">
    <meta name="distribution" content="global">
    <meta name="revisit-after" content="7 days">
    <meta name="language" content="EN">
    <meta name="geo.region" content="AE-DU">
    <meta name="geo.placename" content="Dubai">
    <meta name="geo.position" content="25.2048;55.2708">
    <meta name="ICBM" content="25.2048, 55.2708">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title"
        content="<?php echo isset($pageTitle) ? $pageTitle : 'Flash Fix Technologies | IT Solutions & Networking Experts Dubai'; ?>">
    <meta name="twitter:description"
        content="<?php echo isset($pageDescription) ? $pageDescription : 'Professional IT infrastructure, networking, and hardware solutions provider in Dubai.'; ?>">
    <link rel="canonical" href="<?php echo 'https://flashfix.ae' . $_SERVER['REQUEST_URI']; ?>">
    <link rel="alternate" hreflang="en-ae" href="https://flashfix.ae<?php echo $_SERVER['REQUEST_URI']; ?>">
    <link rel="alternate" hreflang="x-default" href="https://flashfix.ae<?php echo $_SERVER['REQUEST_URI']; ?>">
</head>

<body
    class="bg-gray-50 text-gray-800 dark:bg-base dark:text-text-primary overflow-x-hidden transition-colors duration-300">
    <!-- GTM -->
    <script>(function (w, d, s, l, i) { w[l] = w[l] || []; w[l].push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' }); var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f); })(window, document, 'script', 'dataLayer', 'GTM-XXXXXXX');</script>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-XXXXXXX" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>

    <!-- Page Loader -->
    <div id="page-loader" class="page-loader">
        <div class="spinner">
            <div class="spinnerin"></div>
        </div>
    </div>
    <script>
        window.addEventListener('load', function () {
            var loader = document.getElementById('page-loader');
            if (loader) {
                setTimeout(function () {
                    loader.style.opacity = '0';
                    setTimeout(function () { loader.style.display = 'none'; }, 200);
                }, 300);
            }
        });
    </script>