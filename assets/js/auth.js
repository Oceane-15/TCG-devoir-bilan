document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form[data-auth="inscription"]');
    if (!form) return;

    const mdp  = form.querySelector('#mdp');
    const mdp2 = form.querySelector('#mdp2');
    const cgv  = form.querySelector('#cgv');

    function regleMotDePasse(v) {
        return v.length >= 12
            && /[A-Z]/.test(v)
            && /[0-9]/.test(v)
            && /[^A-Za-z0-9]/.test(v);
    }

    function afficherErreur(champ, message) {
        const field = champ.closest('.field') || champ.parentElement;
        let span = field.querySelector('.js-erreur');
        if (!span) {
            span = document.createElement('span');
            span.className = 'erreur js-erreur';
            field.appendChild(span);
        }
        span.textContent = message;
    }

    form.addEventListener('submit', function (e) {
        let ok = true;
        form.querySelectorAll('.js-erreur').forEach(function (el) { el.textContent = ''; });

        if (!regleMotDePasse(mdp.value)) {
            afficherErreur(mdp, "12 caractères min., une majuscule, un chiffre et un caractère spécial.");
            ok = false;
        } else if (mdp.value !== mdp2.value) {
            afficherErreur(mdp2, "Les deux mots de passe ne correspondent pas.");
            ok = false;
        }

        if (cgv && !cgv.checked) {
            afficherErreur(cgv, "Vous devez accepter les CGV.");
            ok = false;
        }

        if (!ok) {
            e.preventDefault(); 
        }
    });
});