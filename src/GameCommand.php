<?php

namespace Pokemon;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class GameCommand extends Command
{
    /** @inheritdoc */
    protected $name = "pokemon:start";

    /** @inheritdoc */
    protected $description = "Do you get a bad day at coding? Let's play a game!";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        (new Game($this, $this->option('generation')))->start();
        return 0;
    }

    /** @inheritdoc */
    public function getOptions(): array
    {
        return [
            ['generation', 'G', InputOption::VALUE_OPTIONAL, 'Choose Pokémon generation. 1-8', 1],
        ];
    }
}
