<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Scribe IA</title>
    <meta name="description" content="Transcrivez, résumez et dictez vos contenus audio et vidéo en français.">
    <meta name="theme-color" content="#1F3A5F">
    <link rel="manifest" href="/manifest.webmanifest">
    <link rel="icon" href="/icons/icon-192.png" type="image/png">
    <link rel="apple-touch-icon" href="/icons/icon-192.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 font-sans text-slate-800 antialiased">
    <header class="bg-nuit px-6 pb-10 pt-12 text-center text-white">
        <h1 class="text-4xl font-bold tracking-tight">Scribe IA</h1>
        <p class="mx-auto mt-3 max-w-xs text-base text-blue-100">
            Vos réunions et vos cours, transcrits et résumés en quelques instants.
        </p>
    </header>

    <main class="mx-auto -mt-6 max-w-md space-y-3 px-4 pb-24">
        @php
            $cartes = [
                ['🎧', 'Transcrire un fichier', 'Importez un audio ou une vidéo et obtenez le texte.'],
                ['📝', 'Résumer', 'Obtenez l’essentiel d’un texte ou d’une transcription.'],
                ['🎙️', 'Dicter', 'Parlez, Scribe IA écrit pour vous.'],
                ['🔴', 'Dictaphone', 'Enregistrez une séance avec un indicateur bien visible.'],
                ['📹', 'Réunion Google Meet', 'Un robot rejoint la réunion et rédige le rapport.'],
            ];
        @endphp

        @foreach ($cartes as [$icone, $titre, $texte])
            <button type="button" data-soon
                class="flex w-full items-center gap-4 rounded-2xl bg-white p-4 text-left shadow-md ring-1 ring-slate-200 transition active:scale-95 active:bg-slate-100">
                <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-nuit/10 text-3xl" aria-hidden="true">{{ $icone }}</span>
                <span>
                    <span class="block text-lg font-semibold text-nuit">{{ $titre }}</span>
                    <span class="block text-sm text-slate-500">{{ $texte }}</span>
                </span>
            </button>
        @endforeach
    </main>

    <div id="toast" role="status" aria-live="polite"
        class="pointer-events-none fixed inset-x-0 bottom-8 mx-auto w-fit translate-y-4 rounded-full bg-nuit px-6 py-3 text-sm font-medium text-white opacity-0 shadow-lg transition duration-300"></div>
</body>
</html>
