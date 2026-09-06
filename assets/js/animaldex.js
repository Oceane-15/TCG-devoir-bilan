document.addEventListener("DOMContentLoaded", function () {
  var grille = document.getElementById("dexGrille");
  if (!grille) return;

  var recherche = document.getElementById("dexRecherche");
  var casesRarete = document.querySelectorAll(".dex-rarete");
  var cartes = grille.querySelectorAll(".carte-dex");
  var messageVide = document.getElementById("dexVide");

  function filtrer() {
    var texte = (recherche.value || "").trim().toLowerCase();

    var raretesActives = [];
    casesRarete.forEach(function (c) {
      if (c.checked) {
        raretesActives.push(c.value);
      }
    });

    var visibles = 0;
    cartes.forEach(function (carte) {
      var nom = carte.getAttribute("data-nom") || "";
      var rarete = carte.getAttribute("data-rarete") || "";

      var correspondNom = nom.indexOf(texte) !== -1;
      var correspondRarete =
        raretesActives.length === 0 || raretesActives.indexOf(rarete) !== -1;

      var visible = correspondNom && correspondRarete;

      carte.classList.toggle("carte-dex--masquee", !visible);
      if (visible) {
        visibles++;
      }
    });

    if (messageVide) {
      messageVide.hidden = visibles > 0;
    }
  }

  recherche.addEventListener("input", filtrer);
  casesRarete.forEach(function (c) {
    c.addEventListener("change", filtrer);
  });
  filtrer();
});
