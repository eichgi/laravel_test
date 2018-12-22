<?php

use Illuminate\Database\Seeder;
use App\Match;
use App\Player;
use App\PlayerInfo;
use App\Result;
use App\Set;
use App\Team;
use App\Tournament;


class SampleTournamentDataSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {

    /* Creo el torneo */
    $tournament = Tournament::create([
      "name" => "Torneo de felinos"
    ]);

    /* Creo los equipos */
    $team1 = $this->createTeam($tournament,"Tigres","Jugador Tigre","el tigre");
    $team2 = $this->createTeam($tournament,"Leones","Jugador Leon","el leon");
    $team3 = $this->createTeam($tournament,"Pumas","Jugador Puma","el puma");
    $team4 = $this->createTeam($tournament,"Linces","Jugador Lince","el lince");
    $team5 = $this->createTeam($tournament,"Panteras","Jugador Pantera","el pantera");
    $team6 = $this->createTeam($tournament,"Jaguares","Jugado Jaguar","el jaguar");

    /* Creo las jornadas (Set´s) */
    $set1 = $this->createSet($tournament,1, "regular");
    $set2 = $this->createSet($tournament,2, "regular");
    $set3 = $this->createSet($tournament,3, "regular");
    $set4 = $this->createSet($tournament,4, "extra");
    $set5 = $this->createSet($tournament,5, "extra");


    /* Creo partidos */
    $match1 = $this->createMatch($set1,$team1->id, $team2->id);
    $match2 = $this->createMatch($set1,$team1->id, $team3->id);
    $match3 = $this->createMatch($set1,$team1->id, $team4->id);
    $match4 = $this->createMatch($set1,$team1->id, $team5->id);
    $match5 = $this->createMatch($set1,$team1->id, $team6->id);
    $match6 = $this->createMatch($set2,$team2->id, $team3->id);
    $match7 = $this->createMatch($set2,$team2->id, $team4->id);
    $match8 = $this->createMatch($set2,$team2->id, $team5->id);
    $match9 = $this->createMatch($set2,$team2->id, $team6->id);
    $match10 = $this->createMatch($set2,$team3->id, $team4->id);
    $match11 = $this->createMatch($set3,$team3->id, $team5->id);
    $match12 = $this->createMatch($set3,$team3->id, $team6->id);
    $match13 = $this->createMatch($set3,$team4->id, $team5->id);
    $match14 = $this->createMatch($set3,$team4->id, $team6->id);
    $match15 = $this->createMatch($set3,$team5->id, $team6->id);

    $match16 = $this->createMatch($set4,$team1->id, $team2->id);
    $match17 = $this->createMatch($set4,$team2->id, $team3->id);
    $match18 = $this->createMatch($set4,$team3->id, $team5->id);

    $match19 = $this->createMatch($set5,$team5->id, $team6->id);
    $match20 = $this->createMatch($set5,$team3->id, $team4->id);
    $match21 = $this->createMatch($set5,$team1->id, $team6->id);


    /* Creo resultados */
    $this->addResult($match1,0, 1);
    $this->addResult($match2,2, 1);
    $this->addResult($match3,3, 4);
    $this->addResult($match5,1, 0);
    $this->addResult($match7,0, 0);
    $this->addResult($match8,0, 0);
    $this->addResult($match11,2, 1);
    $this->addResult($match12,1, 1);
    $this->addResult($match14,2, 3);
    $this->addResult($match15,3, 0);
    $this->addResult($match16,4, 3);
    $this->addResult($match17,2, 1);
    $this->addResult($match18,2, 0);

    $this->addResult($match20,2, 0);
    $this->addResult($match21,0, 3);










  }

  public function createTeam($tournament,$team_name,$generic_player_name,$generic_player_alias){
    $team = Team::create([
      "name" => $team_name
    ]);

    $player1 = $team->players()->create([
      "name" => "$generic_player_name 1",
    ]);
    $player1->playerInfo()->create([
      "number" => 10,
      "alias" => "$generic_player_alias 1"
    ]);

    $player2 = $team->players()->create([
      "name" => "$generic_player_name 2"
    ]);

    $player2->playerInfo()->create([
      "number" => 11,
      "alias" => "$generic_player_alias 2"
    ]);

    $team->players()->save($player1);
    $team->players()->save($player2);

    $tournament->teams()->save($team);
    return $team;
  }

  public function createSet($tournament,$number, $type){
    return $tournament->sets()->create([
      "number" => $number,
      "type" => $type
    ]);
  }

  public function createMatch($set,$team_a_id, $team_b_id){
    return $set->matches()->create([
      "team_a_id" => $team_a_id,
      "team_b_id" => $team_b_id,
      "tournament_id" => $set->tournament_id
    ]);
  }

  public function addResult($match,$team_a_goals, $team_b_goals){
    $match->result()->create([
        "team_a_goals" => $team_a_goals,
        "team_b_goals" => $team_b_goals
    ]);
  }

}
