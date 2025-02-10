<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\Commandes;

class CommandesChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        // Récupérer les commandes des 6 derniers mois
        $commandesParMois = [];
        $labels = [];

        for ($i = 5; $i >= 0; $i--) {
            $mois = now()->subMonths($i)->format('Y-m');
            $commandes = Commandes::whereRaw("DATE_FORMAT(dateCreation, '%Y-%m') = ?", [$mois])->count();

            $commandesParMois[] = $commandes;
            $labels[] = now()->subMonths($i)->format('M Y');
        }

        $this->labels($labels);
        $this->dataset('Commandes', 'bar', $commandesParMois)
            ->color('rgb(77, 189, 116)')
            ->backgroundColor('rgba(77, 189, 116, 0.4)');
    }
}
