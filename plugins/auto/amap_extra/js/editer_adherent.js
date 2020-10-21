// spip fix: la valeur par défaut du mode de paiement n'est pas prise en compte
var m = $('#champ_mode_paiement');
if (!m.val()) m.val('cheque')

// empecher validation du formulaire quand on appuie sur entrer
$('#champ_nb_cheques').on('keydown', function(e){
    if (event.keyCode == 13) {e.preventDefault(); this.blur()}
})

// vider le "taille du panier" si coadhérent est précisé
$('#champ_coadherent').on('change', function(e){
    if ($(this).val() != '') $('#champ_taille_panier').val(" ")
    else $('#champ_taille_panier').val("")
})

$('.editer_montant_cheque').each(function(i){
    if (i==11) return
    var btn = $('<div class="duplicate-value" title="Dupliquer sur les champs suivants">↓</div>'),
        _this = $(this)
    _this.append(btn)
    btn.click(function(e){
        $('.editer_montant_cheque input').slice(i, $('#champ_nb_cheques').val()).val(_this.find('input').val())
    })
})

function verifier_afficher_si(form, saisie, chargement) {
    // spip override
    var condition = saisie.attr('data-afficher_si');
    condition = eval(condition);
    if (condition) {
        afficher_si_show(saisie);
        saisie.removeClass('afficher_si_masque').addClass('afficher_si_visible');
        saisie.find('[data-afficher-si-required]').attr('required', true).attr('data-afficher-si-required',false);
    } else {
        if (chargement) {
            // spip fix: on annule le masquage/affichage au démarrage pour éviter le flash
            // -> l'affichage initial est géré en css statique
            // afficher_si_hide(saisie);
            // saisie.css('display','none');
        } else {
            afficher_si_hide(saisie);
        }
        saisie.addClass('afficher_si_masque').removeClass('afficher_si_visible');
        saisie.find('[required]').attr('required', false).attr('data-afficher-si-required', null);
    }
}
