<?php
class Game
{
    protected int $game_id;
    protected int $max_red_cubes;
    protected int $max_green_cubes;
    protected int $max_blue_cubes;

    public function __construct(string $line)
    {
        $line_parts = explode(": ", $line);
        $this->game_id = intval(explode(" ", $line_parts[0])[1]);

        $this->max_red_cubes = 0;
        $this->max_green_cubes = 0;
        $this->max_blue_cubes = 0;
        foreach (explode("; ", $line_parts[1]) as $draw) {
            $draw_parts = explode(", ", $draw);
            foreach ($draw_parts as $cubes) {
                // print_r($cubes . "\n");
                $cubes_parts = explode(" ", $cubes);
                $num_cubes = intval($cubes_parts[0]);
                $color = $cubes_parts[1];
                switch ($color) {
                    case "red":
                        if ($num_cubes > $this->max_red_cubes) {
                            $this->max_red_cubes = $num_cubes;
                        }
                        break;
                    case "green":
                        if ($num_cubes > $this->max_green_cubes) {
                            $this->max_green_cubes = $num_cubes;
                        }
                        break;
                    case "blue":
                        if ($num_cubes > $this->max_blue_cubes) {
                            $this->max_blue_cubes = $num_cubes;
                        }
                        break;
                }
            }
        }
    }

    public function __toString()
    {
        return "Game ID: $this->game_id\nMax Red Cubes: $this->max_red_cubes\nMax Green Cubes: $this->max_green_cubes\nMax Blue Cubes: $this->max_blue_cubes\n";
    }

    public function isGamePossible($red_cubes, $green_cubes, $blue_cubes) {
        if (
            $red_cubes >= $this->max_red_cubes && 
            $green_cubes >= $this->max_green_cubes && 
            $blue_cubes >= $this->max_blue_cubes
            ) return true;
        return false;
    }

    public function getID() {
        return $this->game_id;
    }

    public function getPower() {
        return $this->max_red_cubes * $this->max_green_cubes * $this->max_blue_cubes;
    }
}