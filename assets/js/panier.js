document.addEventListener('DOMContentLoaded', function () {

    document.addEventListener('submit', function (e) {
        var form = e.target.closest('form[data-ajax-panier]');
        if (!form) return;

        e.preventDefault();
        var action = form.getAttribute('data-ajax-panier'); 

        fetch(form.getAttribute('action'), {
            method: 'POST',
            body: new FormData(form),
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function (reponse) { return reponse.json(); })
        .then(function (data) {
            majPanier(data);
            if (action === 'ajouter') {
                var el = document.getElementById('panierOffcanvas');
                if (el && window.bootstrap) {
                    bootstrap.Offcanvas.getOrCreateInstance(el).show();
                }
            }
        })
        .catch(function () {
            form.submit();
        });
    });

    function majPanier(data) {
        var contenu = document.getElementById('panierContenu');
        if (contenu && typeof data.html === 'string') {
            contenu.innerHTML = data.html;
        }

        var compteur = document.getElementById('panierCount');
        if (compteur) {
            compteur.textContent = data.nb;
        }

        var toggle = document.querySelector('.panier-toggle');
        if (toggle) {
            var pastille = toggle.querySelector('.panier-badge');
            if (data.nb > 0) {
                if (!pastille) {
                    pastille = document.createElement('span');
                    pastille.className = 'panier-badge';
                    toggle.appendChild(pastille);
                }
                pastille.textContent = data.nb;
            } else if (pastille) {
                pastille.remove();
            }
        }
    }
});