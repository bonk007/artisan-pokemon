<?php

namespace Pokemon;

use Illuminate\Support\ServiceProvider;

class ArtisanPokemonServiceProvider extends ServiceProvider
{
    /** @inheritdoc */
    public function register(): void
    {
        $this->commands([
            GameCommand::class
        ]);
    }
}
