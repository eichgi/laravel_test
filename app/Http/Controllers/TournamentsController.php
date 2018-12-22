<?php

namespace App\Http\Controllers;

use App\Set;
use App\Team;
use App\Tournament;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Log;


class TournamentsController extends Controller
{

    /*
      Estadisticas de los equipos en un torneo
      las cuales se obtienen solo de las jornadas
      regulares (omiten las jornadas extras), el
      arreglo tiene que estár ordenado del equipo
      que tiene mas puntos(points) al que menos
      [
        {
        {
          "id": 1,                     // id de equipo
          "name": "Leones",            // Nombre de equipo
          "goals": 4,                  // Goles totales del equipo en el torneo
          "received_goals": 5,         // Goles recibidos del equipo en el torneo
          "difference_of_goals": -1,   // Diferencia de goles (goals-received_goals)
          "matches_played": 6,         // El numero total de "matches" con resultado donde participa el equipo en el torneo
          "matches_won": 1,            // El numero total de "matches" con resultado donde participa el equipo en el torneo donde el equipo sea ganador
          "draw_matches": 2,           // El numero total de "matches" con resultado donde participa el equipo en el torneo donde el resultado sea empate
          "matches_lost": 3,           // El numero total de "matches" con resultado donde participa el equipo en el torneo donde el equipo sea el perdedor
          "points": 5,                 // Puntos obtenidos por el equipo en el torneo (3 puntos por partid ganado 1 punto por partido empatado y 0 puntos por partido perdido)
        }
        }
      ]
    */

    public function generalTable(Tournament $tournament)
    {
        $data = [];

        $regularSets = array_pluck(Set::where('type', 'regular')->select('id')->get()->toArray(), 'id');

        foreach ($tournament->teams as $team) {

            $matchesAsA = $team->matchesAsA()->whereIn('set_id', $regularSets)->get();
            $matchesAsB = $team->matchesAsB()->whereIn('set_id', $regularSets)->get();

            $goals = 0;
            $received_goals = 0;
            $matches_won = 0;
            $draw_matches = 0;
            $matches_lost = 0;

            foreach ($matchesAsA as $match) {
                $result = $match->result()->first();
                if (!$result) {
                    continue;
                }

                if ($result->team_a_goals > $result->team_b_goals) {
                    $matches_won++;
                } elseif ($result->team_a_goals == $result->team_b_goals) {
                    $draw_matches++;
                } else {
                    $matches_lost++;
                }

                $goals += $result->team_a_goals;
                $received_goals += $result->team_b_goals;
            }

            foreach ($matchesAsB as $match) {
                $result = $match->result()->first();
                if (!$result) {
                    continue;
                }

                if ($result->team_b_goals > $result->team_a_goals) {
                    $matches_won++;
                } elseif ($result->team_b_goals == $result->team_a_goals) {
                    $draw_matches++;
                } else {
                    $matches_lost++;
                }

                $goals += $result->team_b_goals;
                $received_goals += $result->team_a_goals;
            }

            $data[] = [
                "id" => $team->id,
                "name" => $team->name,
                "goals" => $goals,
                "received_goals" => $received_goals,
                "difference_of_goals" => $goals - $received_goals,
                "matches_played" => $matches_won + $draw_matches + $matches_lost,
                "matches_won" => $matches_won,
                "draw_matches" => $draw_matches,
                "matches_lost" => $matches_lost,
                "points" => ($matches_won * 3) + $draw_matches,
            ];
        }

        return response()->json($data, 200);
    }


}
