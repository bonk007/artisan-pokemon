<?php

namespace Pokemon;

use Illuminate\Console\Command;
use Pokemon\Objects\Generation;

class Game
{
    /**
     * Indicates the game is over
     *
     * @var bool
     */
    protected bool $gameOver = false;

    /**
     * The current Pokémon generation
     *
     * @var \Pokemon\Objects\Generation
     */
    protected Generation $generation;

    /**
     * Game constructor
     *
     * @param \Illuminate\Console\Command $console
     * @param mixed $generation
     */
    public function __construct(protected Command $console, mixed $generation = 1)
    {
        $this->setGeneration($generation);
    }

    public function start(): void
    {
        $this->console->info("Let's play a game!");
        $this->restartPrompt();
    }

    public function restart(): void
    {
        $genId = $this->console->ask('What is the Pokémon Generation you want to play? [1...8]');
        $this->setGeneration($genId);
        $this->start();
    }

    protected function setGeneration(mixed $genId): void
    {
        $genId = (int) $genId;

        if ($genId < 1 || $genId > 8) {
            $this->console->error("Generation must be between 1 and 8");
            $this->gameOver = true;
        }

        $this->generation = new Generation($genId);
    }

    protected function restartPrompt(): void
    {
        $confirmed = $this->console->confirm("Do you want to play again?");
        if (!$confirmed) {
            $this->gameOver();
            return;
        }
        $this->restart();
    }

    protected function gameOver(): void
    {
        $this->console->info("Thank you for playing!");
        $this->gameOver = true;
    }

    public function __destruct()
    {
        $this->console->info("Game over!");
    }
}
