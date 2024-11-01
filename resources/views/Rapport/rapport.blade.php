<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-gauge@0.3.0/dist/chartjs-gauge.min.js"></script>
    <title>Rapport</title>
    <script>
        window.onbeforeprint = function() {
            // Supprime les en-têtes et pieds de page du navigateur
            let style = document.createElement('style');
            style.type = 'text/css';
            style.media = 'print';
            style.innerHTML = '@page { size: A4; margin: 0mm !important; }';
            document.head.appendChild(style);
        };
    </script>

    <style>
        /* Styles de base */
        body {
            padding: 1rem;
        }



        /* Variables CSS pour une meilleure maintenance */
        :root {
            --primary-color: #031c96;
            --secondary-color: #f8f9fa;
            --border-color: #dee2e6;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --text-dark: #333;
            --text-light: #fff;
            --gray-bg: #878787;
        }

        /* Styles pour le tableau principal */
        #details-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 25px 0;
            font-size: 14px;
            background-color: var(--text-light);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        /* Style de la légende */
        #details-table caption {
            background-color: var(--primary-color);
            color: var(--text-light);
            font-size: 20px;
            font-weight: 600;
            padding: 15px;
            text-align: center;
            letter-spacing: 0.5px;
        }

        /* Styles des en-têtes */
        #details-table thead {
            background-color: var(--primary-color);
        }

        #details-table th {
            background-color: var(--primary-color);
            color: var(--text-light);
            font-weight: 600;
            padding: 15px;
            text-align: left;
            border: none;
            font-size: 14px;
            white-space: nowrap;
        }

        /* Styles des cellules */
        #details-table td {
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            vertical-align: middle;
            transition: background-color 0.2s ease;
        }

        /* Style pour les titres de section */
        #details-table strong {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 15px;
        }

        /* Styles pour la barre de progression */
        .progress-container {
            width: 100%;
            height: 8px;
            background-color: #f3f3f3;
            border-radius: 4px;
            overflow: hidden;
            margin: 8px 0;
        }

        .progress-bar {
            width: 100%;
            height: 100%;
            background-color: #f3f3f3;
            position: relative;
            border-radius: 4px;
        }

        .colored-bar {
            height: 100%;
            transition: width 0.5s ease-in-out;
            border-radius: 4px;
        }

        /* Style pour le pourcentage */
        .progress-percentage {
            margin-left: 12px;
            font-weight: 600;
            color: var(--text-dark);
            min-width: 60px;
            text-align: right;
        }

        /* Style pour le score global */
        #score-globale {
            background-color: var(--gray-bg);
            color: var(--text-light);
            font-weight: 600;
            font-size: 15px;
        }

        /* Style pour les notes pondérées */
        .Note_pondérée {
            font-weight: 600;
            color: var(--primary-color);
            text-align: center;
        }

        /* Styles pour l'alternance des lignes */
        #details-table tbody tr:nth-child(even):not([id="score-globale"]) {
            background-color: rgba(248, 249, 250, 0.5);
        }

        /* Style au survol des lignes */
        #details-table tbody tr:hover:not([id="score-globale"]) {
            background-color: rgba(3, 28, 150, 0.05);
        }

        /* Style pour les cellules flexibles */
        .flex-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Alignement des cellules */
        #details-table td:nth-child(2),
        #details-table td:nth-child(3),
        #details-table td:nth-child(4),
        #details-table td:nth-child(6) {
            text-align: center;
        }

        /* Conteneur principal */
        .progress-cell {
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding: 8px;
            min-width: 120px;
        }

        /* Conteneur de la barre de progression */
        .progress-container {
            width: 100%;
            height: 6px;
            background-color: #f3f3f3;
            border-radius: 3px;
            overflow: hidden;
        }

        /* Barre de progression */
        .progress-bar {
            width: 100%;
            height: 100%;
            position: relative;
        }

        /* Barre colorée */
        .colored-bar {
            height: 100%;
            transition: width 0.3s ease;
            border-radius: 3px;
        }

        /* Style du pourcentage */
        .progress-percentage {
            font-size: 13px;
            font-weight: 500;
            color: #666;
            text-align: right;
            margin-top: 2px;
        }

        /* Style pour les scores */
        /* .score-cell {
            font-family: 'Roboto Mono', monospace;
            font-weight: 500;
        } */

        /* Animation de la barre de progression */
        @keyframes progressAnimation {
            from {
                transform: translateX(-100%);
            }

            to {
                transform: translateX(0);
            }
        }

        .colored-bar {
            animation: progressAnimation 1s ease-out;
        }

        /* Styles responsives */
        @media screen and (max-width: 768px) {
            #details-table {
                font-size: 12px;
                margin: 15px 0;
            }

            #details-table caption {
                font-size: 16px;
                padding: 12px;
            }

            #details-table th,
            #details-table td {
                padding: 8px;
            }

            .progress-container {
                height: 6px;
            }

            .progress-percentage {
                font-size: 11px;
                min-width: 50px;
            }
        }

        /* Style d'impression */
     


        /* Styles pour les tableaux */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 50px 0;
            font-size: 18px;
            text-align: left;
        }

        caption,
        .caption {
            background-color: #031c96;
            margin: 0;
            caption-side: top;
            font-size: 24px;
            font-weight: bold;
            padding: 10px;
            color: #fff;
        }

        thead td {
            background-color: #031c96;
            color: #fff;
            text-align: center;
        }

        td,
        th {
            padding: 1px;
            height: 3rem !important;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* Styles pour les cartes */
        .card {
            border: 1px solid #031c96;
            border-radius: 5px;
            padding: 1rem;
            margin: 1rem 0;
            background-color: #f9f9f9;
        }

        .card h2 {
            background-color: #031c96;
            color: #fff;
            padding: 0.5rem;
            margin: -1rem -1rem 1rem -1rem;
            border-radius: 5px 5px 0 0;
        }

        .card ul {
            list-style: none;
            padding: 0;
        }

        .card li {
            padding: 8px 0;
        }

        .card strong {
            width: 200px;
            display: inline-block;
            margin-right: 12rem;
            white-space: nowrap;
        }

        /* Styles pour les scores et la progression */
        #score-globale {
            background-color: #878787;
        }

        .progress-container {
            height: 100% !important;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .progress-bar,
        .colored-bar {
            height: 5px;
            background-color: rgba(199, 196, 196, 0.694);
            border: 1px solid #747474;
            border-radius: 2px;
        }

        /* Styles pour la jauge */
        .gauge-container {
            position: relative;
            width: 300px;
            height: 200px;
            margin: auto;
        }

        .gauge-percentage {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -20%);
            text-align: center;
        }

        .percentage-value {
            font-size: 36px;
            font-weight: bold;
            color: #031C96;
        }

        /* Boutons et contrôles */
        .sauvegarder {
            width: 3.5rem;
            height: 3.5rem;
            background-color: #444cb3;
            color: white;
            font-size: 1.5rem;
            border: solid 2px rgb(149, 148, 148);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            cursor: pointer;
            bottom: 1.5rem;
            right: 2rem;
        }

        .action-buttons {
    position: fixed;
    bottom: 20px;
    right: 20px;
    display: flex;
    gap: 10px;
}
@media print {
    /* Initialise le compteur de pages */
    body {
        counter-reset: page;
    }

    .table-wrapper {
        page-break-before: always;
    }
    table, tr, td {
        page-break-inside: avoid !important;
    }

    /* Styles pour chaque page */
    .page-container {
        counter-increment: page;
        page-break-after: always;
        position: relative;
    }

    /* Pied de page avec numérotation */
    .page-footer {
        position: fixed;
        bottom: 15mm;
        left: 0;
        width: 100%;
        text-align: center;
        border-top: 1px solid #ddd;
        padding-top: 5mm;
        background-color: white;
        z-index: 1000;
    }

    .page-number::after {
        content: "Page " counter(page) " sur " counter(pages);
        font-family: Arial, sans-serif;
        font-size: 10pt;
        color: #444;
    }
}

/* Styles spécifiques pour Firefox */
@-moz-document url-prefix() {
    @page {
        size: A4;
        margin: 0;
    }
    
    body {
        margin: 0 !important;
    }
}

/* Styles spécifiques pour Chrome */
@media print and (-webkit-min-device-pixel-ratio:0) {
    @page {
        margin: 6mm;
    }
    
    body {
        margin: 0 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
}
      
           
            

        
    </style>
</head>

<body>


    <form action="{{ route('visites.store') }}" method="POST">
        @csrf
        <input type="hidden" name="score"
            value="{{ intval($scoresGlobale->total_score_globale) == 0 ? 0 : number_format((intval($scoresGlobale->total_score_conforme_globale) / intval($scoresGlobale->total_score_globale)) * 100, 2) }}">
        <input type="hidden" name="mission_id" value="{{ $ID_Mission }}">
        <input type="hidden" name="user_id" value="{{ $auditor->id }}">
        <button type="submit" class="sauvegarder"><img
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAArpJREFUWEftlzloVFEUhr+4RlwgIBoUQSs7QVxwjQQriSniAtaKIGJAjYWC2ogLggpBi4iFpWBCColNwA0FcSmS0kIQQQURIZiocb2/nIHH881790xmIIEcGGaYd8+9//vP9t86xpnVjTM8THhAc4AmYBOwEVgDzEqx/BV4Djy2z0NgJDYSsQzp4GPADmBa7Oa27gdwG7gIDBT5FgGabhsdLtoo4vkf4AJwEvhdbn0eoNkhJH3AlojDPEvuBqbagNEspzxA14H9npMca88aU/+55AH6CMx3HOJZ+gZY6mVIMa+lZZKRx9AkIIUjj6EPwMIaxew9sMibQ51Ae40AXQY6vIA0EtSHmqsMSn1IHf+7F1BjYOgTcM7GxlhxqUjOhy59GlgAKGyuPnQo9KGr5qFZdhTYDUx1IlNHvgVcCswMmu8R4IoXkCb09jDd7yUc59oo2WzTflWYT/WpjYeBZ8ATm/aPACmAkrUAPRl+/54X9aGfIdYn7O3G2pemAMcDw2cA/XY3RlGtaS+TvhHFkhEC6bGZwB4L+Qpz1N7635VDArE65TGUEF1PLTTfUmsk4tYCG0zM6VvKIWnyXe8FJGV43+j1MFK0VuxI0giUi6EZ5tgNzCs6JfL5Z6DVUsCth1RBL4ElQBewLfLQcst6gYOARpJCqkp0MfQA2Ar8Mq/lwF77b2VEKJX8L0J76A/a5ybw2vZRMisVlFsuQCpzbbYrVIiSOWlK3HWAWEzfOr7Y24uBdMI3BJ871sPcZV/qO28DzQcCzZpBlZoOl46+BmgkydyA0vLjFXADUCiVW2VvDnagrkvKFQ3nfcCyxNu8AxZ7Q5YnP0rjISsspT4kMJnNzzq/7nmuHKqV/JCk2VmJ/BB6jY5qy49TlV4Uk3RWW36ULY6iq3TasRryI7dSvYAqLftov0lARVT9BcWQhCUh13ZAAAAAAElFTkSuQmCC" /></button>

    </form>

    <div style="page-break-after: always;">
        <img style="width: 100%; height: auto;" src="{{ asset('images/Page__de_garde__(1)[1]_page-0001.jpg') }}"
            alt="Rapport Cover Page">
    </div>

    <div style="display: flex; justify-content: space-between">
        <img style="width: 5rem" src="{{ asset('images/logo FNIH.png') }}" alt="Mag management groupe logo">
        <img style="height: 5rem;border-radius: .5rem" src="{{ asset('storage/' . $hotelLogo) }}" alt="hotel Logo"
            class="h-10 w-10 rounded-full">
    </div>
    <div class="card">
        <h2>Conditions de visites et profil du client mystère</h2>
        <ul style="list-style-type: none; padding: 0;">
            <li style="padding: 8px 0;"><strong>Auditeur</strong>: {{ $missionActulle->user->Nom }}
                {{ $missionActulle->user->Prenom }}
            </li>
            <li style="padding: 8px 0;"><strong>Sexe</strong>: {{ $missionActulle->user->Sexe }}</li>
            <li style="padding: 8px 0;"><strong>Âge</strong>: {{ $missionActulle->user->Age }}</li>
            <li style="padding: 8px 0;"><strong>Profession</strong>: {{ $missionActulle->user->Profession }}</li>
            <li style="padding: 8px 0;"><strong>En couple ou seul</strong>: {{ $missionActulle->user->EnCouple }}</li>
            <li style="padding: 8px 0;"><strong>Visite professionnelle ou personnelle</strong>:
                {{ $missionActulle->user->TypeVisite }}
            </li>
            <li style="padding: 8px 0;"><strong>N° de chambre occupée</strong>: {{ $missionActulle->user->Chambre }}
            </li>
            <li style="padding: 8px 0;"><strong>Réservation effectuée le (date et heure)</strong>:
                {{ $missionActulle->user->ReservationEffectuee }}
            </li>
            <li style="padding: 8px 0;"><strong>Canal de réservation (site web ou tél)</strong>:
                {{ $missionActulle->user->CanalReservation }}
            </li>
        </ul>
    </div>



    <!-- <div class="card">
        <h2 style="text-align: center;">Critères d’évaluation</h2>
        <p>
            Chaque item est noté &laquo; oui &raquo; ou &laquo; non &raquo; ou &laquo; non applicable (NA) &raquo;<br>
            Si l’item n’a pu être mesuré ou observé, &laquo; NA &raquo; sera choisi et n'impactera donc pas votre
            résultat<br>
            Les cases commentaires renseignées, que l’item soit validé ou non, ont pour but de clarifier le critère
            et/ou d’apporter des préconisations pour l'amélioration de votre prestation.<br>
            Le client mystère note avec le plus d’objectivité possible (Il ne juge pas l’aspect esthétique de la
            décoration par exemple).<br>
            Vous trouverez, ci-après, la synthèse de notre passage au sein de votre établissement.<br>
            Vous trouverez un résumé fait par le client mystère ainsi que les scores des différentes sections.<br>
            Vous trouverez également les scores par départements. Ensuite, vous trouverez la grille complète par section
            avec les notes et commentaires.
        </p>
    </div> -->


    <div class="card">
        <h2 style="text-align: center;">Résumé de la visite</h2>

        <p>
            {{ $resume }}
        </p>
    </div>




    <div style="width: 100%; text-align: center; font-family: Arial, sans-serif;">
        <div class="gauge-container">
            <canvas id="gaugeChart"></canvas>
            <div class="gauge-percentage">
                <span
                    class="percentage-value">{{ number_format(intval($scoresGlobale->total_score_conforme_globale) / intval($scoresGlobale->total_score_globale), 2) * 100 }}%</span>
            </div>
        </div>
    </div>





    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('gaugeChart').getContext('2d');
            const globalScore = {{ number_format(intval($scoresGlobale->total_score_conforme_globale) / intval($scoresGlobale->total_score_globale), 2) * 100 }};

            // Fonction pour déterminer la couleur selon le score
            const getScoreColor = (score) => {
                if (score >= 70) return '#28a745'; // Vert
                if (score >= 50) return '#ffc107'; // Orange
                return '#dc3545'; // Rouge
            };

            // Configuration du gradient
            const gradientSegment = ctx.createLinearGradient(0, 0, 300, 0);
            gradientSegment.addColorStop(0, getScoreColor(globalScore));
            gradientSegment.addColorStop(1, getScoreColor(globalScore));

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [globalScore, 100 - globalScore],
                        backgroundColor: [
                            gradientSegment,
                            '#f0f0f0' // Gris clair pour le fond
                        ],
                        borderWidth: 0,
                        circumference: 180,
                        rotation: 270,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        tooltip: {
                            enabled: false
                        },
                        legend: {
                            display: false
                        }
                    },
                    layout: {
                        padding: {
                            top: 20
                        }
                    }
                },
                plugins: [{
                    id: 'gaugeTitle',
                    afterDraw: (chart) => {
                        const { ctx, chartArea: { top, bottom, left, right, width, height } } = chart;

                        ctx.save();

                        // Affichage du titre en dessous
                        ctx.font = 'bold 16px Arial';
                        ctx.fillStyle = '#1e4c78';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.fillText(
                            'Moyenne générale de la visite',
                            width / 2,
                            height + 30
                        );

                        ctx.restore();
                    }
                }]
            });
        });
    </script>

    <!-- <div class="caption">Rappel visites précédentes</div>

    <div class="squares-container" style="display: flex;">
        @foreach ($visites as $index => $visite)
                @php
                    $score = intval($visite->score);
                    $color = 'green';
                    if ($score < 50) {
                        $color = 'red';
                    } elseif ($score < 70) {
                        $color = 'orange';
                    } else {
                        $color = 'green';
                    }
                @endphp
                <div class="square">
                    {{ intval($visite->score) }}%
                    <div class="colored-bars" style="height: {{ $score }}%; background-color: {{ $color }};"></div>
                </div>
                <div class="visit-number" style="margin-top: 1rem">
                    visite T{{ $index + 1 }} <br><br>
                    @if ($visite->created_at)
                        {{ $visite->created_at->diffForHumans() }}
                    @else
                        N/A
                    @endif
                </div>
        @endforeach
    </div>



-->


    <table id="details-table">
        <caption>Détails des Normes</caption>
        <thead>
            <tr>
                <th style="width: 17.5rem;">Section</th>
                <th>Pondération</th>
                <th>Note section</th>
                <th>Note pondérée</th>
                <th>Progression</th>
                <th>Note par section</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scores->groupBy('item.category.id') as $category_id => $category_scores)
                        @php
                            $category = $category_scores->first()->item->category;
                            $category_ponderation = $category->ponderation;
                            $category_total_score_conforme = $category_scores->sum('total_score_conforme');
                            $category_total_score = $category_scores->sum('total_score');

                            $category_percentage = $category_total_score > 0 ? ($category_total_score_conforme / $category_total_score) * 100 : 0;
                            $category_weighted_score = ($category_percentage * $category_ponderation) / 100;
                            $formatted_category_weighted_score = number_format($category_weighted_score, 2);

                            $progressColor = $category_percentage >= 70 ? 'var(--success-color)' :
                                ($category_percentage >= 50 ? 'var(--warning-color)' : 'var(--danger-color)');
                        @endphp
                        <tr>
                            <td><strong>{{ $category->libele }}</strong></td>
                            <td>{{ $category_ponderation }}%</td>
                            <td></td>
                            <td class="Note_pondérée">{{ $formatted_category_weighted_score }}</td>
                            <td class="progress-cell">
                                <div class="progress-container">
                                    <div class="progress-bar">
                                        <div class="colored-bar" style="width: {{ number_format($category_percentage, 2) }}%; 
                                                                        background-color: {{ $category_percentage >= 70 ? '#28a745' :
                    ($category_percentage >= 50 ? '#ffc107' : '#dc3545') }};">
                                        </div>
                                    </div>
                                </div>
                                <span class="progress-percentage">{{ number_format($category_percentage, 2) }}%</span>
                            </td>
                            <td class="score-cell">
                                @php
                                    $total_conforme = $category_scores->sum('total_conforme');
                                    $total_non_conforme = $category_scores->sum('total_non_conforme');
                                    $total = $total_conforme + $total_non_conforme;
                                @endphp
                                {{ $total > 0 ? number_format(($total_conforme / $total) * 100, 2) : 0 }}%
                            </td>
                        </tr>

                        @foreach ($category_scores as $score)
                                @php
                                    $item_percentage = $score->total_score > 0 ? ($score->total_score_conforme / $score->total_score) * 100 : 0;
                                    $item_weighted_score = ($item_percentage * $category_ponderation) / 100;
                                    $formatted_item_weighted_score = number_format($item_weighted_score, 2);
                                @endphp
                                <tr>
                                    <td>{{ $score->item->libelle }}</td>
                                    <td></td>
                                    <td class="score-cell">{{ intval($score->total_score_conforme) }} / {{ intval($score->total_score) }}
                                    </td>
                                    <td class="score-cell">{{ $formatted_item_weighted_score }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                        @endforeach
            @endforeach

            <tr id="score-globale">
                <td>Score Globale</td>
                <td>_</td>
                <td>{{ intval($scoresGlobale->total_score_conforme_globale) }} /
                    {{ intval($scoresGlobale->total_score_globale) }}
                </td>
                <td class="totale_note_pondere">
                    @php
                        $total_score_globale = $scoresGlobale->total_score_globale;
                        $total_score_conforme_globale = $scoresGlobale->total_score_conforme_globale;
                    @endphp
                    {{ $total_score_globale > 0 ? number_format(($total_score_conforme_globale / $total_score_globale) * 100, 2) : 0 }}%
                </td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <i class="fa fa-server" aria-hidden="true"></i>

    @foreach ($normes->groupBy('item.category.libele') as $category => $groupedNormes)
        <table id="details-table">
            {{-- <caption>Détails des Normes - {{ $category }}</caption> --}}
            <thead>
                <tr style="background-color: #1e39c2">
                    <th style="background-color: #1e39c2; color:#ccc">{{ $category }}</th>
                    <th style="background-color: #1e39c2; color:#ccc">Réponse</th>
                    <th style="background-color: #1e39c2; color:#ccc">Score</th>
                    <th style="background-color: #1e39c2; color:#ccc">Commentaire</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groupedNormes->groupBy('item.libelle') as $item => $itemNormes)
                    <tr>
                        <td colspan="4" style="font-weight: bold; background-color: #5480b1; color:#000000">
                            {{ $item }}
                        </td>
                    </tr>
                    @foreach ($itemNormes as $norme)
                        <tr>
                            <td>{{ $norme->norm->Normes }}</td>
                            <td>
                                @if ($norme->verifie == 'conforme')
                                    *Oui
                                @elseif($norme->verifie == 'non_conforme')
                                    *Non
                                @else
                                    *N/A
                                @endif
                            </td>
                            <td>
                                @if ($norme->verifie == 'conforme')
                                    {{ $norme->score }}/{{ $norme->score }}
                                @elseif($norme->verifie == 'non_conforme')
                                    0.00/{{ $norme->score }}
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            <td style="color:#0653fa">{{ $norme->remarques }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endforeach



    {{-- <button id="printButton"
        style="position: fixed; bottom: 1.5rem; right: 6rem; width: 3.5rem; height: 3.5rem; background-color: #444cb3; color: white; font-size: 1.5rem; border: solid 2px rgb(149, 148, 148); border-radius: 50%; display: flex; justify-content: center; align-items: center; cursor: pointer;">🖨️</button>
    --}}

    <!-- <button id="downloadButton" onclick="downloadPdf()" style="position: fixed; bottom: 1.5rem; right: 6rem; width: 3.5rem; height: 3.5rem; background-color: #444cb3; color: white; font-size: 1.5rem; border: solid 2px rgb(149, 148, 148); border-radius: 50%; display: flex; justify-content: center; align-items: center; cursor: pointer;">⬇️</button> -->
    <div class="no-print">
        <button onclick="window.print()"
            style="position: fixed; bottom: 1.5rem; right: 6rem; width: 3.5rem; height: 3.5rem; background-color: #444cb3; color: white; font-size: 1.5rem; border: solid 2px rgb(149, 148, 148); border-radius: 50%; display: flex; justify-content: center; align-items: center; cursor: pointer;">⬇️</button>

    </div>

    <div class="page-footer">
        <div class="page-number"></div>
    </div>

    
 <script>
document.addEventListener('DOMContentLoaded', function() {

    function updatePageNumbers() {
        const pages = document.querySelectorAll('.page');
        const totalPages = pages.length;

        pages.forEach((page, index) => {
            let pageNumber = page.querySelector('.page-number');
            if (!pageNumber) {
                // Create page number element if not present
                pageNumber = document.createElement('div');
                pageNumber.classList.add('page-number');
                pageNumber.style.position = 'absolute';
                pageNumber.style.bottom = '10px';
                pageNumber.style.width = '100%';
                pageNumber.style.textAlign = 'center';
                page.appendChild(pageNumber);
            }
            pageNumber.textContent = `Page ${index + 1} sur ${totalPages}`;
        });
    }

    window.onbeforeprint = function() {
        updatePageNumbers();
    };

    const style = document.createElement('style');
    style.textContent = `
        @media print {
            .page {
                page-break-after: always;
                position: relative;
                counter-increment: page;
            }
            .page:last-child {
                page-break-after: auto;
            }
            .page-footer {
                position: fixed;
                bottom: 20mm;
                width: 100%;
                text-align: center;
            }
            body {
                counter-reset: page;
            }
        }
    `;
    document.head.appendChild(style);
});
</script>



    <script>
        const ctx = document.getElementById('gaugeChart').getContext('2d');
        const globalScore = {{ number_format(intval($scoresGlobale->total_score_conforme_globale) / intval($scoresGlobale->total_score_globale), 2) * 100 }};

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [globalScore, 100 - globalScore],
                    backgroundColor: [
                        globalScore >= 70 ? 'green' : globalScore >= 50 ? 'orange' : 'red',
                        'lightgray'
                    ],
                    circumference: 180,
                    rotation: 270,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    tooltip: { enabled: false },
                    legend: { display: false },
                    datalabels: {
                        formatter: (value, ctx) => {
                            if (ctx.dataIndex === 0) return globalScore + '%';
                            return null;
                        },
                        color: 'black',
                        font: { size: 24, weight: 'bold' },
                        anchor: 'end',
                        align: 'start',
                    }
                },
            },
        });
    </script>
    <!-- <script>
function downloadPdf() {
    window.location.href = "{{ route('generate_pdf', ['hotel_id' => $hotel_id, 'legende_id' => $legende_id, 'ID_Mission' => $ID_Mission]) }}";
}
</script> -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Iterate over each category and item to update the colored bars
            @foreach ($scores->groupBy('item.category.id') as $category_id => $category_scores)
                @foreach ($category_scores as $score)
                    const categoryPonderation = {{ $score->item->category->ponderation }};
                    const itemPercentage = {{ $score->total_score != 0 ? number_format($score->total_score_conforme / $score->total_score, 2) * 100 : 0 }};
                    const itemWeightedScore = ((itemPercentage * categoryPonderation) / 100).toFixed(2);
                    const coloredBar = document.getElementById('coloredBar_{{ $loop->parent->index }}_{{ $loop->index }}');
                    coloredBar.style.width = itemPercentage + '%';
                    coloredBar.style.backgroundColor = itemPercentage >= 70 ? 'green' :
                        itemPercentage >= 50 ? 'orange' : 'red';
                    // Update the weighted score display
                    const weightedScoreElement = document.getElementById('itemWeightedScore_{{ $loop->parent->index }}_{{ $loop->index }}');
                    if (weightedScoreElement) {
                        weightedScoreElement.textContent = itemWeightedScore;
                    }
                @endforeach
            @endforeach
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get all elements with the class 'Note_pondérée'
            let notePondereeElements = document.querySelectorAll('.Note_pondérée');
            let totalNotePonderee = 0;

            // Iterate over each element and add its value to the total
            notePondereeElements.forEach(function (element) {
                let value = parseFloat(element.innerText);
                if (!isNaN(value)) {
                    totalNotePonderee += value;
                }
            });

            // Format the total to two decimal places
            totalNotePonderee = totalNotePonderee.toFixed(2);

            // Set the total value in the element with class 'totale_note_pondere'
            document.querySelector('.totale_note_pondere').innerText = totalNotePonderee;
        });
    </script>



</body>



</html>