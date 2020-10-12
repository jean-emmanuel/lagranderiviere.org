<?php
/**
 * Utilisation de l'action supprimer pour l'objet amap
 *
 * @plugin     Amap
 * @copyright  2020
 * @author     Jean-Emmanuel Doucet
 * @licence    GNU/GPL v3
 * @package    SPIP\Amap\Action
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}



/**
 * Action pour supprimer un·e amap
 *
 * Vérifier l'autorisation avant d'appeler l'action.
 *
 * @param null|int $arg
 *     Identifiant à supprimer.
 *     En absence de id utilise l'argument de l'action sécurisée.
**/
function action_supprimer_amap_dist($arg=null) {
	if (is_null($arg)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}
	$arg = intval($arg);

	// cas suppression
	if ($arg) {
		sql_delete('spip_amaps',  'id_amap=' . sql_quote($arg));
	}
	else {
		spip_log("action_supprimer_amap_dist $arg pas compris");
	}
}
