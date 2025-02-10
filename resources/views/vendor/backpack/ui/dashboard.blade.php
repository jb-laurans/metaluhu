@extends(backpack_view('blank'))
<?php

$registeredUsers = \App\Models\User::count();



$commands = \App\Models\Commandes::count();

?>





@php


    $widgets['before_content'][] = [
        'type'        => 'jumbotron',
        'heading'     => 'Bienvenu !',
        'content'     => 'Utiliser la sidebar pour créer, éditer ou supprimer du contenu',
        'button_link' => backpack_url('logout'),
        'button_text' => 'Se Déconnecter',
    ];
@endphp

@php
$widgets['before_content'][] = [
    'type'    => 'div',
    'class'   => 'row justify-content-start', // Utiliser les classes Bootstrap pour la mise en page
    'content' => [ // widgets
        [
            'type'        => 'progress',
            'class'       => 'card text-white bg-primary mb-2 text-center', // Définir la largeur de chaque widget
            'value'       => $registeredUsers,
            'description' => 'Registered users.',
        ],
        [
            'type'        => 'progress',
            'class'       => 'card text-white bg-danger mb-2 text-center', // Définir la largeur de chaque widget
            'value'       => $commands,
            'description' => 'Nombres de Commandes.',
        ],
    ],
];
@endphp

@section('content')
    

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Évolution des commandes</div>
                <div class="card-body">
                    <canvas id="commandesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("{{ route('dashboard.commandes.chart') }}") // Appel AJAX vers l’API
                .then(response => response.json())
                .then(data => {
                    var ctx = document.getElementById("commandesChart").getContext("2d");
                    new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: "Nombre de commandes",
                                data: data.commandes,
                                backgroundColor: "rgba(77, 189, 116, 0.4)",
                                borderColor: "rgb(77, 189, 116)",
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: { beginAtZero: true,
                                                ticks: {
                              stepSize: 1, // Définir le stepSize à 1
                              precision: 0, // Assurer qu'il n'y a pas de décimales
                              callback: function (value) {
                                  return value.toFixed(0); // Formatter comme entier
                              }
                          }
                                 }
                            }
                        }
                    });
                });
        });
    </script>
@endsection


