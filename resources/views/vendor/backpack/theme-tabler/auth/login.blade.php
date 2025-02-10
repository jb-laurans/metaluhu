@include(backpack_view('auth.login.' . backpack_theme_config('auth_layout')))


<!-- Dans votre HTML -->
<style>
    .auth-logo-container {
        display: none;
    }
    body {
        background-size: cover;
        background-position: center;
        position: relative;
        overflow: hidden;
    }
    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-size: cover;
        background-position: center;
        filter: blur(5px); /* Réglez le flou ici (plus grand = plus flou) */
        z-index: -1; /* Mettre l'image derrière le contenu de la page */
    }
    /* Ajouter une superposition sombre pour assombrir l'image */
    body::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.4); /* Ajustez l'opacité pour obtenir l'effet souhaité */
        z-index: -1; /* Assurez-vous que la superposition est derrière le contenu */
    }
    
</style>

<script>
    // Liste des images
    
    const images = [
        'https://client.metalu-plast.fr/uploads/backgrounds/3.jpg',
        'https://client.metalu-plast.fr/uploads/backgrounds/4.jpg',
        'https://client.metalu-plast.fr/uploads/backgrounds/5.jpg',
        // Ajoutez plus d'images ici
    ];

    // Définir l'image initiale
    document.body.style.backgroundImage = `url('${images[0]}')`;
    document.body.style.backgroundSize = 'cover';
    document.body.style.backgroundPosition = 'center';

    // Utiliser une variable CSS pour l'image floue
    document.body.style.setProperty('--blur-image', `url('${images[0]}')`);

    // Ajouter le style pour l'image floue
    const style = document.createElement('style');
    style.innerHTML = `
        body::before {
            background-image: var(--blur-image);
        }
    `;
    document.head.appendChild(style);

    // Fonction pour changer l'image de fond
    function changeBackground() {
        const randomIndex = Math.floor(Math.random() * images.length);
        document.body.style.backgroundImage = `url('${images[randomIndex]}')`;
        document.body.style.backgroundSize = 'cover';
        document.body.style.backgroundPosition = 'center';

        // Mettre à jour l'image floue
        document.body.style.setProperty('--blur-image', `url('${images[randomIndex]}')`);
    }

    // Appeler la fonction toutes les 10 secondes
    setInterval(changeBackground, 10000);

    // Appeler la fonction une première fois après un court délai pour éviter de répéter l'image initiale
    setTimeout(changeBackground, 1000);
</script>
