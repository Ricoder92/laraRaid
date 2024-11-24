import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                wow: {
                    deathknight: '#C41E3A',  // Todesritter
                    demonhunter: '#A330C9',  // Dämonenjäger
                    druid: '#FF7C0A',        // Druide
                    evoker: '#33937F',       // Rufer
                    hunter: '#AAD372',       // Jäger
                    mage: '#3FC7EB',         // Magier
                    monk: '#00FF96',         // Mönch
                    paladin: '#F48CBA',      // Paladin
                    priest: '#FFFFFF',       // Priester
                    rogue: '#FFF468',        // Schurke
                    shaman: '#0070DD',       // Schamane
                    warlock: '#8788EE',      // Hexenmeister
                    warrior: '#C69B6D',      // Krieger
                },
            },
        },
    },
}
