<?php
/**
 * Plugin Name: Zverejniť.sk
 * Plugin URI: https://www.zverejnit.sk
 * Description: Zverejňovanie zmlúv, faktúr a objednávok.
 * Version: 1.0
 * Author: Pinf s.r.o.
 * Author URI: https://www.pinf.sk
 * License: GPL2
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
add_action( 'admin_menu', 'pinf_zverejnit_menu' );
//add menu item
function pinf_zverejnit_menu() {
	add_menu_page( 'Zverejniť.sk', 'Zverejniť.sk', 'manage_options', 'zverejnit-sk', function() { pinf_zverejnit_options(""); }, 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgd2lkdGg9IjExMC4zIiBoZWlnaHQ9IjEzNy44Ij48cGF0aCBkPSJNOC4zIDEzMi41YTkgOSAwIDAgMS0xLjgtMS40Yy0xLTEtMS4xLTEuMS0xLjMtNC43QzUgMTI0LjQgNSA5NyA1IDY1LjdjLjEtNTMuNy4yLTU3IC44LTU4IDEtMS41IDIuMy0yLjEgNC44LTIuNEMxMiA1IDI0LjMgNSAzOC4yIDVjMjAgMCAyNS41IDAgMjYuOC41IDEuNC40IDMuOCAyLjcgMjAuMyAxOS4yIDE0LjcgMTQuNyAxOC44IDE5IDE5LjIgMjAuMS40IDEuMi41IDYuOC43IDM1LjcuMiAzOC4zIDAgNDgtMS4zIDUwLTEuNSAyLjMgMi40IDIuMi00OC42IDIuMi0yNi4yIDAtNDYuNSAwLTQ3LS4yem04My0xNGMuMi0uMi40LTEuNC40LTIuNXYtMmgtNmMtMjEuNy0uMS0zNS00LjQtNDUuNC0xNC43QTMzIDMzIDAgMCAxIDMxIDg0LjdjLTEtMy0xLjYtMy44LTIuOC0zLjVsLTMuMi4zYy0yLjcgMC0zLjYtLjQtMy42LTEuNiAwLTEuMiA5LjctMTggMTEuNS0yMCAxLjgtMS45IDIuMi0xLjcgMTIuOSA4IDYuNSA1LjkgNy43IDcuMyA3LjcgOC44IDAgMS4yLTEuNSAyLTQgMi4zbC0yLjMuNGMtLjQuNCAxLjggNC4yIDMuMyA2IDMgMy44IDcuOSA2LjggMTQuMiA4LjggNiAyIDkuMSAyLjQgMTguMiAyLjQgNC41IDAgOC4yLS4yIDguNC0uMy4xLS4yLjMtOS41LjQtMjAuOGwuMS0yMC40LTMuNS0uM2MtMi0uMS03LjgtLjItMTMuMiAwLTEwLjQuMS0xNi4yLS4yLTE3LjYtMS4xYTUuOCA1LjggMCAwIDEtMS41LTIuMWMtLjctMS41LS43LTIuNi0uOC0xNy4xIDAtOC41LS4yLTE1LjctLjQtMTUuOC0uMS0uMi04LjMtLjQtMTgtLjRMMTkgMTggMTguOCAzM2MtLjIgOC4xLS4zIDMwLjgtLjMgNTAuNHYzNS42aDM2LjJjMjcuNyAwIDM2LjMgMCAzNi42LS40ek04MCA0MC4zYzAtLjQtMTAuOC0xMS40LTExLjItMTEuNC0uMiAwLS4zIDIuNy0uMyA2djUuOGg1LjdjNCAwIDUuOC0uMSA1LjgtLjR6IiBmaWxsPSIjZjFjODAwIiBmaWxsLW9wYWNpdHk9IjEiLz48L3N2Zz4=');	
}

function pinf_zverejnit_init(){
	$time=time()."-".md5(time().mt_rand().uniqid().rand());
	if ( !current_user_can( 'manage_options' ))  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
?>
	<div class="wrap zverejnit-wrap">
<h1 class="zverejnit-title">Zverejniť.sk - správa dokumentov</h1>
<a class="button button-primary" style="width:100%;text-align:center;" target="_blank" href="https://secure.zverejnit.sk/wp-admin-login.php?uid=<?php echo htmlspecialchars(get_option('pinf_zverejnit_uid')); ?>&amp;sig=<?php echo md5($time.get_option('pinf_zverejnit_secret')); ?>&amp;stamp=<?php echo $time; ?>">Vložiť alebo upraviť dokument (otvorí administráciu Zverejniť.sk)</a>
	<?php
	return "";
}

function pinf_zverejnit_options($opt="") {
	pinf_zverejnit_init();
?>
<h2>Technické informácie, podmienky používania a ochrana osobných údajov</h2>
	<p>Plugin Zverejniť.sk nekomunikuje so serverom zverejnit.sk bez vedomia užívateľa. K priamej komunikácií medzi systémom WordPress a serverom www.zverejnit.sk nikdy nedochádza - komunikácia môže prebiehať len pomocou odkazov (napr. Vložiť dokument, Test konfigurácie...) - tieto odkazy sú načítané len prostredníctvom webového prehliadača. 
	Plugin Zverejniť.sk nevytvára žiadne Cookies bez výslovného súhlasu užívateľa a/alebo návštevníka tejto webovej stránky.
	Plugin Zverejniť.sk nezasiela a nezhromažďuje žiadne osobné údaje.
	Plugin Zverejniť.sk po vložení shortcode vloží do webstránky vlastný script uložený na serveri zverejnit.sk, ktorý vykreslí dáta v tabuľke, záložné zobrazenie v prípade nepovolených scriptov a záložné zobrazenie v prípade nepovolenia rámov.
	<p><a href="https://www.zverejnit.sk/ochrana-sukromia/" target="_blank">Zásady ochrany osobných údajov</a> a <a href="https://www.zverejnit.sk/podmienky.pdf">Podmienky používania služby Zverejniť.sk</a></p>

<h2>Konfigurácia pluginu</h2>
	<form method="post" action="options.php">
		<?php settings_fields('pinf_zverejnit_options_group'); ?>
		<p>Konfigurácia pluginu Zverejniť.sk. Všetky potrebné údaje nájdete v systéme Zverejniť.sk, časť Subjekt - <a href="https://www.zverejnit.sk/panel/subjekt" target="_blank">https://www.zverejnit.sk/panel/subjekt</a></p>
		<table style="width:100%">
			<tr valign="top">
				<th scope="row" width="120"><label for="pinf_zverejnit_uid">UID:</label></th>
				<td><input type="text" id="pinf_zverejnit_uid" required="" class="pinf-test-config" name="pinf_zverejnit_uid" style="width:100%" value="<?php echo get_option('pinf_zverejnit_uid'); ?>" /></td>
			</tr>

			<tr valign="top">
				<th scope="row" width="120"><label for="pinf_zverejnit_secret">Privátny kľúč:</label></th>
				<td><textarea id="pinf_zverejnit_secret" required="" name="pinf_zverejnit_secret" class="pinf-test-config" rows="4"  style="width:100%"><?php echo get_option('pinf_zverejnit_secret'); ?></textarea></td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>

<?php if(!empty(get_option('pinf_zverejnit_uid')) && !empty(get_option('pinf_zverejnit_secret'))){
	$rand=md5(mt_rand());
	?>
	<a class="button button-primary zverejnit-test-config" target="_blank" onclick="if(savedPinfConf){ window.open(this.href+'&autoclose=1'); } return false;" href="https://secure.zverejnit.sk/wp-test.php?uid=<?php echo htmlspecialchars(get_option('pinf_zverejnit_uid')); ?>&amp;sig=<?php echo md5($rand.get_option('pinf_zverejnit_secret')); ?>&amp;rand=<?php echo $rand; ?>">Vyskúšať konfiguráciu (otvorí Zverejniť.sk v novom okne)</a>
	<script>
	var savedPinfConf=1;
	jQuery(".pinf-test-config").on('change keydown paste input', function() {
		savedPinfConf=0;
		jQuery(".zverejnit-test-config").text("Konfiguráciu je možné vyskúšať až po uložení");
		jQuery(".zverejnit-test-config").attr("href","#");
		jQuery(".zverejnit-test-config").attr("target","");
		jQuery(".zverejnit-test-config").addClass("disabled");
	});
	</script>
	<?php
}else{
	?>
	<div class="notice notice-error is-dismissible">
        <p>Pozor! Nie je zadané UID a/alebo privátny kľúč - plugin nebude správne fungovať.</p>
    </div>
	<?php
}	?>	

	
	
<h2>Vloženie skratky (shortcode) do stránky - zobrazenie tabuľky s dokumentami</h2>
	<code>[zverejnit dokumenty=faktury]</code> - vloží do stránky tabuľku s faktúrami<br>
	<code>[zverejnit dokumenty=zmluvy]</code> - vloží do stránky tabuľku so zmluvami<br>
	<code>[zverejnit dokumenty=objednavky]</code> - vloží do stránky tabuľku s objednávkami<br>
	<br>
	<p>Shortcode stačí skopírovať a vložiť do stránky alebo do článku.</p>
<?php }

function pinf_zverejnit_register_settings() {
	add_option( 'pinf_zverejnit_uid', '');
	add_option( 'pinf_zverejnit_secret', '');
	register_setting( 'pinf_zverejnit_options_group', 'pinf_zverejnit_uid', 'pinf_zverejnit_uid' );
	register_setting( 'pinf_zverejnit_options_group', 'pinf_zverejnit_secret', 'pinf_zverejnit_secret' );
}
add_action( 'admin_init', 'pinf_zverejnit_register_settings' );

function pinf_zverejnit_shortcode($atts = array()){
	$atts = array_change_key_case((array)$atts, CASE_LOWER);
	if(!isset($atts["dokumenty"]) || empty($atts["dokumenty"])){
		return "<strong style='color:red;background-color:yellow;'>Zverejniť.sk - CHYBA: nesprávne vložený shortcode.</strong>";
	}
	$uid=get_option('pinf_zverejnit_uid');
	$type=htmlspecialchars($atts["dokumenty"]);
	$id="zverejnit-".md5(mt_rand().time().uniqid().rand().microtime());
	$code = '<div id="'.$id.'" class="zverejnitsk zverejnitsk-'.$type.'"><noscript><iframe src="https://embed.zverejnit.sk/'.$uid.'/'.$type.'/fallback" width="100%" height="500" frameborder="0"><a href="https://dokumenty.zverejnit.sk/'.$uid.'/'.$type.'">https://dokumenty.zverejnit.sk/'.$uid.'/'.$type.'</a></iframe></noscript></div><script src="https://data.zverejnit.sk/'.$type.'/'.$uid.'.js?id='.$id.'"></script>';
	return $code;

}

add_action( 'init', 'pinf_zverejnit_register_shortcodes');

function pinf_zverejnit_register_shortcodes(){
	 add_shortcode('zverejnit', 'pinf_zverejnit_shortcode');
}