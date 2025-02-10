@extends(backpack_view('blank'))

@php
    $widgets['before_content'][] = [
        'type'        => 'jumbotron',
        'heading'     => 'Bienvenu !',
        'content'     => 'Utiliser la sidebar pour créer, éditer ou supprimer du contenu',
        'button_link' => backpack_url('logout'),
        'button_text' => 'Se Déconnecter',
    ];
@endphp

@section('content')
    <p>Bienvenue sur l'Espace Client MetaluPlast'</p>

    <div class="row">
        <div class="col-md-8">
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
                                y: { beginAtZero: true }
                            }
                        }
                    });
                });
        });
    </script>
@endsection


