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

    .switch-mode button {
    background: #1f1d24 !important; 
    border-radius: 8px; 
    padding: 16px; 
    transition: background 0.3s ease-in-out;
}

a {
    color: var(--tblr-primary); /* Couleur principale de votre site */
    text-decoration: none; /* Supprimer le soulignement par défaut */
    transition: color 0.3s ease-in-out, background-color 0.3s ease-in-out; /* Transition douce pour les effets de survol */
    background-color:rgb(253, 253, 255);
    padding: 6px 12px; 
    border-radius: 4px; 
    display: inline-block; 
    transition: all 0.3s ease-in-out; 
}

a:hover {
    color:#6354BF !important; 
    background: rgba(164, 160, 172, 0.45) !important; 
    box-shadow: 0px 5px 12px rgba(0, 0, 0, 0.7); 
    text-decoration: none;
}


.switch-mode button:hover {a {
    color:rgb(255, 255, 255) !important; 
    text-decoration: none; 
    background: rgba(103, 102, 104, 0.65) ; 
    padding: 6px 12px; 
    border-radius: 4px; 
    display: inline-block; 
    transition: all 0.3s ease-in-out; 
}
    background: rgba(31, 29, 36, 0.8) !important; 
}

.switch-mode i {
    color: #7bb485 !important; 
    font-size: 1.5rem; 
    font-size: 2rem !important;
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
