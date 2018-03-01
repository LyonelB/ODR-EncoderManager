<head>
<meta charset='utf-8'>
<meta http-equiv="Pragma" content="no-cache">
<title>title_winmedia 2014</title>
</head>
<body>
<?php

/*
* WINMEDIA (Nicolas Leroux 2014)
* Génération de fichiers contenant le titre en cours de diffusion pour une radio.
* Implementation des titres dans une base de donnée de type MySql.
* Release  du 	31/07/ 2014
*
*/
//
// Code permettant le test d'écriture en créant un fichier texte. Il est utile lors de l'installation ou pour vérifier le bon fonctionnement de la page, veuillez ne pas l'effacer.
//

if (isset($_GET['test'])) {
	if ($_GET['test'] == 'test') {
		$aujourdhui = date("d.m.Y H:i:s");
		echo "Début du test... " . $aujourdhui . "<br><br>Ouverture fichier - Open file<br>";
		$inF = fopen("aeffacer.txt","w");
		echo "Ecriture-Write<br>";
		fputs($inF,"Le test d'écriture a fonctionné.The Test is ok " . $aujourdhui);
		echo "Cl&ocirc;ture<br><br>";
		fclose ($inF);
		echo "...Fin du test-end of the test<br><br><a href='aeffacer.txt'>Cliquez ici pour vérifier que le test d'écriture a fonctionné-click on to check if the write test is ok</a>";
		exit;
	}
}


    // On vérifie que toutes les données ont bien été envoyées


if (isset($_POST['starttime']) && isset($_POST['image']) && isset($_POST['radio']) && isset($_POST['title']) && isset($_POST['artist']) && isset($_POST['runtime']) && isset($_POST['runtimeSM'])&& isset($_POST['categorie'])) {
	    //
	    // On vérifie que les données ne sont pas vides
	    // 
	if ($_POST['starttime'] <> "" && $_POST['title'] <> "" && $_POST['artist'] <> "" && $_POST['runtime'] <> "") {
		
		// on remplace certains caractères spéciaux par soucis de compatibilité
        // We change letters if they are not  utf-8

		$_POST['artist'] = stripslashes($_POST['artist']);
		$_POST['title'] = stripslashes($_POST['title']);
		
		$_POST['artist'] = str_replace('"', "''", $_POST['artist']);
		$_POST['artist'] = str_replace('[', "(", $_POST['artist']);
		$_POST['artist'] = str_replace(']', ")", $_POST['artist']);
		$_POST['artist'] = str_replace('…', "...", $_POST['artist']);
		$_POST['artist'] = str_replace('<', "(", $_POST['artist']);
		$_POST['artist'] = str_replace('>', ")", $_POST['artist']);
		$_POST['artist'] = str_replace('&', "&", $_POST['artist']);
		$_POST['artist'] = str_replace('Ã©', "é", $_POST['artist']);				
		$_POST['artist'] = str_replace('Ã¨', "è", $_POST['artist']);		
		$_POST['artist'] = str_replace('Ã', "à", $_POST['artist']);	
	    $_POST['artist'] = str_replace('_', " ", $_POST['artist']);
		$_POST['artist'] = str_replace("'", "'", $_POST['artist']);
		$_POST['artist'] = str_replace("à¯", "ï", $_POST['artist']);
		$_POST['artist'] = str_replace("Ãª", "ê", $_POST['artist']);
		$_POST['artist'] = str_replace("à´", "ô", $_POST['artist']);
		
		
		$_POST['artistnext'] = str_replace('"', "''", $_POST['artistnext']);
		$_POST['artistnext'] = str_replace('[', "(", $_POST['artistnext']);
		$_POST['artistnext'] = str_replace(']', ")", $_POST['artistnext']);
		$_POST['artistnext'] = str_replace('…', "...", $_POST['artistnext']);
		$_POST['artistnext'] = str_replace('<', "(", $_POST['artistnext']);
		$_POST['artistnext'] = str_replace('>', ")", $_POST['artistnext']);
		$_POST['artistnext'] = str_replace('&', "&", $_POST['artistnext']);
		$_POST['artistnext'] = str_replace('Ã©', "é", $_POST['artistnext']);				
		$_POST['artistnext'] = str_replace('Ã¨', "è", $_POST['artistnext']);		
		$_POST['artistnext'] = str_replace('Ã', "à", $_POST['artistnext']);			
	    $_POST['artistnext'] = str_replace('_', " ", $_POST['artistnext']);
		$_POST['artistnext'] = str_replace("'", "'", $_POST['artistnext']);
		$_POST['artistnext'] = str_replace("à¯", "ï", $_POST['artistnext']);
		$_POST['artistnext'] = str_replace("Ãª", "ê", $_POST['artistnext']);
		$_POST['artistnext'] = str_replace("à´", "ô", $_POST['artistnext']);

		$_POST['artistbefore'] = str_replace('"', "''", $_POST['artistbefore']);
		$_POST['artistbefore'] = str_replace('[', "(", $_POST['artistbefore']);
		$_POST['artistbefore'] = str_replace(']', ")", $_POST['artistbefore']);
		$_POST['artistbefore'] = str_replace('…', "...", $_POST['artistbefore']);
		$_POST['artistbefore'] = str_replace('<', "(", $_POST['artistbefore']);
		$_POST['artistbefore'] = str_replace('>', ")", $_POST['artistbefore']);
		$_POST['artistbefore'] = str_replace('&', "&", $_POST['artistbefore']);
		$_POST['artistbefore'] = str_replace('Ã©', "é", $_POST['artistbefore']);				
		$_POST['artistbefore'] = str_replace('Ã¨', "è", $_POST['artistbefore']);		
		$_POST['artistbefore'] = str_replace('Ã', "à", $_POST['artistbefore']);			
	    $_POST['artistbefore'] = str_replace('_', " ", $_POST['artistbefore']);
		$_POST['artistbefore'] = str_replace("'", "'", $_POST['artistbefore']);
	    $_POST['artistbefore'] = str_replace('à¯', "ï", $_POST['artistbefore']);
	    $_POST['artistbefore'] = str_replace('Ãª', "ê", $_POST['artistbefore']);
		$_POST['artistbefore'] = str_replace("à´", "ô", $_POST['artistbefore']);
		
		$_POST['title'] = str_replace('"', "''", $_POST['title']);
		$_POST['title'] = str_replace('[', "(", $_POST['title']);
		$_POST['title'] = str_replace(']', ")", $_POST['title']);
		$_POST['title'] = str_replace('…', "...", $_POST['title']);
		$_POST['title'] = str_replace('<', "(", $_POST['title']);
		$_POST['title'] = str_replace('>', ")", $_POST['title']);
		$_POST['title'] = str_replace('&', "&", $_POST['title']);
		$_POST['title'] = str_replace('ç', "c", $_POST['title']);		
		$_POST['title'] = str_replace('Ã©', "é", $_POST['title']);				
		$_POST['title'] = str_replace('Ã¨', "è", $_POST['title']);		
		$_POST['title'] = str_replace('Ã', "à", $_POST['title']);			
	    $_POST['title'] = str_replace('_', " ", $_POST['title']);
        $_POST['title'] = str_replace("'", "'", $_POST['title']);
        $_POST['title'] = str_replace("à¯", "ï", $_POST['title']);		
        $_POST['title'] = str_replace("Ãª", "ê", $_POST['title']);
		
		
		$_POST['titlenext'] = str_replace('"', "''", $_POST['titlenext']);
		$_POST['titlenext'] = str_replace('[', "(", $_POST['titlenext']);
		$_POST['titlenext'] = str_replace(']', ")", $_POST['titlenext']);
		$_POST['titlenext'] = str_replace('…', "...", $_POST['titlenext']);
		$_POST['titlenext'] = str_replace('<', "(", $_POST['titlenext']);
		$_POST['titlenext'] = str_replace('>', ")", $_POST['titlenext']);
		$_POST['titlenext'] = str_replace('&', "&", $_POST['titlenext']);
		$_POST['titlenext'] = str_replace('Ã©', "é", $_POST['titlenext']);				
		$_POST['titlenext'] = str_replace('Ã¨', "è", $_POST['titlenext']);		
		$_POST['titlenext'] = str_replace('Ã', "à", $_POST['titlenext']);			
	    $_POST['titlenext'] = str_replace('_', " ", $_POST['titlenext']);	
        $_POST['titlenext'] = str_replace("'", "'", $_POST['titlenext']);
        $_POST['titlenext'] = str_replace("à¯", "ï", $_POST['titlenext']);	
        $_POST['titlenext'] = str_replace("Ãª", "ê", $_POST['titlenext']);	
		
		
		$_POST['titlebefore'] = str_replace('"', "''", $_POST['titlebefore']);
		$_POST['titlebefore'] = str_replace('[', "(", $_POST['titlebefore']);
		$_POST['titlebefore'] = str_replace(']', ")", $_POST['titlebefore']);
		$_POST['titlebefore'] = str_replace('…', "...", $_POST['titlebefore']);
		$_POST['titlebefore'] = str_replace('<', "(", $_POST['titlebefore']);
		$_POST['titlebefore'] = str_replace('>', ")", $_POST['titlebefore']);
		$_POST['titlebefore'] = str_replace('&', "&", $_POST['titlebefore']);
		$_POST['titlebefore'] = str_replace('Ã©', "é", $_POST['titlebefore']);				
		$_POST['titlebefore'] = str_replace('Ã¨', "è", $_POST['titlebefore']);		
		$_POST['titlebefore'] = str_replace('Ã', "à", $_POST['titlebefore']);			
	    $_POST['titlebefore'] = str_replace('_', " ", $_POST['titlebefore']);	
		$_POST['titlebefore'] = str_replace("'", "'", $_POST['titlebefore']);	
		$_POST['titlebefore'] = str_replace("à¯", "ï", $_POST['titlebefore']);	
		$_POST['titlebefore'] = str_replace("Ãª", "ê", $_POST['titlebefore']);			

		///////////////////////////////////////////////////
		//    GESTION DES FICHIERS TITRE XML HTML TXT   ///
		//    all format for exportation                ///
		///////////////////////////////////////////////////
			
		    // si le type est "song"

		if ($_POST['eventtype'] == "song") {
			
			
			// génération des fichiers pour afficher le titre en cours à l'antenne

			// FILE XML

			$fichier2 = "title_winmedia.xml";
			$inF = fopen($fichier2,"w");
				//  
				fputs($inF,"<live>
<radio_id>" . stripslashes($_POST['radio']) . "</radio_id>
<Next_song>
<artist><![CDATA[" .utf8_encode(stripslashes($_POST['artistnext'])). "]]></artist>
<title><![CDATA[" .utf8_encode(stripslashes($_POST['titlenext'])). "]]></title>
<duration>" . stripslashes($_POST['runtimenext']) . "</duration>
<cover_url>" . stripslashes($_POST['imagenext']) . "</cover_url>
</Next_song>
<current_song> 	
<Startime>" . stripslashes($_POST['starttime']) . "</Startime>		
<artist><![CDATA[" .utf8_encode(stripslashes($_POST['artist'])). "]]></artist>
<title><![CDATA[" .utf8_encode(stripslashes($_POST['title'])). "]]></title>
<duration>" . stripslashes($_POST['runtimeSM']) . "</duration>
<cover_url>" . stripslashes($_POST['image']) . "</cover_url>
<categorie>" . stripslashes($_POST['categorie']) . "</categorie>
</current_song>
<last_song>
<Startime>" . stripslashes($_POST['starttimebefore']) . "</Startime>
<artist><![CDATA[" .utf8_encode(stripslashes($_POST['artistbefore'])). "]]></artist>
<title><![CDATA[" .utf8_encode(stripslashes($_POST['titlebefore'])). "]]></title>
<duration>" . stripslashes($_POST['runtimebefore']) . "</duration>
<cover_url>" . stripslashes($_POST['imagebefore']) . "</cover_url>
<categorie>" . stripslashes($_POST['categoriebefore']) . "</categorie>
</last_song>
</live>");
echo "<i><font size='-1'>XML file is generated and update<br>";
  
            ////////////////////
			// FILE XML SIMPLE
			////////////////////
			$fichier3 = "title_winmedia_simple.xml";
			$inF = fopen($fichier3,"w");
				//  
				fputs($inF,"<live>
<radio_id>" . stripslashes($_POST['radio']) . "</radio_id>
<current_song> 	
<Startime>" . stripslashes($_POST['starttime']) . "</Startime>		
<artist><![CDATA[" .utf8_encode(stripslashes($_POST['artist'])). "]]></artist>
<title><![CDATA[" .utf8_encode(stripslashes($_POST['title'])). "]]></title>
<duration>" . stripslashes($_POST['runtimeSM']) . "</duration>
<cover_url>" . stripslashes($_POST['image']) . "</cover_url>
<categorie>" . stripslashes($_POST['categorie']) . "</categorie>
</current_song>
</live>");
echo "<i><font size='-1'>XML simple file is generated and update<br>";


			/////////////
			// FILE HTML
			/////////////
			$fichier4 = "title_winmedia.html";
			$inF = fopen($fichier4,"w");
				//  
				fputs($inF,"" .utf8_encode(stripslashes($_POST['artist'])). " - " .utf8_encode(stripslashes($_POST['title'])). "
             ");
echo "<i><font size='-1'>HTLM file is generated and update<br>";

			 
			 ////////////
			 //FILE TXT
			 ////////////
			$fichier5 = "title_winmedia.txt";
			$inF = fopen($fichier5,"w");
				//  
				fputs($inF," " .utf8_encode(stripslashes($_POST['artist'])). " - " .utf8_encode(stripslashes($_POST['title'])). "
             ");
echo "<i><font size='-1'>TXT file is generated and update<br>";	

			 
			 ///////////////////
			 // FILE HTML COVER
			 ///////////////////
             $fichier6 = "cover_winmedia.html";
// Si le champ IMAGE n'est pas vide, on prépare une variable contenant l'affichage de l'image
// if cover is not empty, we prepair a value with the link of the cover

if (isset($_POST['image']) && $_POST['image'] <> "") {
$image_display = "<img src='" . htmlspecialchars($_POST['image']) . "' border='0' height='100' width='100'>";
}
else {
// variable vide, pas d'image
// $image_display = "";
// variable contenant une image type par défaut
$image_display = "<img src='http://upload.wikimedia.org/wikipedia/commons/b/b9/No_Cover.jpg' border='0' height='100' width='100'>";
}
$inF = fopen($fichier6,"w");
// SI LE FICHIER CONTIENT UNE PAGE WEB A AFFICHER DANS UNE IFRAME QUI SE RAFRAICHIT AUTOMATIQUEMENT :
fputs($inF,"<html><head>
<meta http-equiv='refresh' content='20'>
<style type='TEXT/CSS'>
<!-- body { font-family: arial; margin: 0px } //-->
</style>
</head><body text='#aeaeae'>
<table border='0' width='202' height='164'>
<tr><td align='left' height='116' valign='bottom'>" . $image_display . "</td></tr> <tr><td align='top' valign='left' height='40'><span style='text-transform: uppercase; font-size:7pt;color:#aeaeae;'><br /><br><i></i></span></td></tr>
</table>
</body>
</html>");	
echo "<i><font size='-1'>Cover file is generated and update<br>";


			////////////////////////////////////////////////////////
			//    GESTION DE LA CONNEXION A LA BASE DE DONNEES    //
			////////////////////////////////////////////////////////
						
						
			// SI VOUS AJOUTEZ LES INFORMATIONS DANS UNE BASE DE DONNEES, INDIQUEZ LE CODE ICI (adaptez les noms des champs à votre base !)
			/*
			* On vérifie les données ont bien été envoyées ET ne sont pas vides dans un seul statement (IF) 
			* et on definie des variable pour chaque variable post (car on ne modifie JAMAIS les variables reçues par post) 
            * ex : $artist = $_POST['artist'] 
            */ 
			            // Pour utiliser cette partie, supprimer les /* et */"
                        
 $artist = $_POST['artist'];
 $title = $_POST['title'];
 $event_type = $_POST['eventtype'];
 $start_time = $_POST['starttime'];
 $run_time = $_POST['runtime'];
 $radio = $_POST['radio'];
 if(!empty($_POST['server_time']))
	$server_time = $_POST['server_time'];
 else 
	$server_time = $_POST['time'];
  
 $log_array['vars']['artist']['raw'] = $artist;
 $log_array['vars']['title']['raw'] = $title;
 $log_array['vars']['event_type']['raw'] = $event_type;
 $log_array['vars']['start_time']['raw'] = $start_time;
 $log_array['vars']['run_time']['raw'] = $run_time;
 $log_array['vars']['radio']['raw'] = $radio;
 $log_array['vars']['server_time']['raw'] = $server_time;
 $log_array['vars']['server_time']['clean'] = date("d/m/Y H:i:s",$server_time);
 
 
if(isset($start_time) && $start_time != NULL &&
	 isset($event_type) && $event_type != NULL && $event_type == 'song' &&
	 isset($title) && $title != NULL &&
	 isset($artist) && $artist != NULL &&
	 isset($run_time) && $run_time != NULL &&
	 isset($radio) && $radio != NULL) {
	
	 foreach($log_array['vars'] as $variable) {
	 	 $variable['not null'] = true;
		 $variable['isset'] = true;
	 }
		
	/* on remplace certains caractères par souci de compatibilité :
	 * 1: supprimer les slashes
	 */
	 
	$artist = stripslashes($_POST['artist']);
	$title = stripslashes($_POST['title']);

	/*
	 * 2: supprimer certains caractères :
	 * liste caractères à remplacer (array) : $search = array('"','[',']','&#8230;','<','>','&')
	 * par (array) : $replace = array("''",'(',')','...','(',')','&amp;')
	 */
	
	$search = array('"','[',']','&#8230;','<','>','&','_','Ã©','Ã¨','Ã');
	$replace = array("''",'(',')','...','(',')','&',' ','e','e','a');
	
	$artist = strtoupper(str_replace($search, $replace, $artist));
	$title = (str_replace($search, $replace, $title));
	
	$log_array['vars']['artist']['clean'] = $artist;
 	$log_array['vars']['title']['clean'] = $title;


	/*
	 *  convert date string into unix timestamp
	 */
	 
	$timestamp = explode(' ',$start_time);
	$d = explode('/',$timestamp[0]);
	$h = explode(':',$timestamp[1]);
	$time = mktime($h[0],$h[1],$h[2],$d[1],$d[0],$d[2]);
	
	$log_array['vars']['start_time']['timestamp'] = $time;

	/*
	 *  si $_POST['image'] est vide assigner l'image par defaut
	 */
	$img = $_POST['image'] == NULL ? "http://upload.wikimedia.org/wikipedia/commons/b/b9/No_Cover.jpg" : $_POST['image'];
	
					
	/* 
	 * GESTION DE LA CONNEXION A LA BASE DE DONNEES //
	 *
	 * SI VOUS AJOUTEZ LES INFORMATIONS DANS UNE BASE DE DONNEES, INDIQUEZ LE CODE ICI (adaptez les noms des champs à votre base !)
	 *
	 * Les données existent ne sont pas vides et on été nettoyées la date convertie en timestamp : on les insère en bdd
	 */
	 
	$host = "*****.******.net";
	$user = "*********";
	$passwd = "********";
	$database = "*********";
	$query = "INSERT INTO titrage (
	    					ID,
								artist,
								title,
								cover,
								heure_diff,
								duree
							) 
							VALUES (
								'',
								'".$artist."',
								'".$title."',
								'".$img."',
								'".$time."',
								'".$run_time."'
							)";	
	
	$result_host_connect = mysql_connect($host, $user, $passwd);
	$result_bdd_select = mysql_select_db($database);
	$result_bdd_query = mysql_query($query);

	//$log_array['bdd']['host'] = $host;
	//$log_array['bdd']['user'] = $user;
	//$log_array['bdd']['passwd'] = $passwd;
	//$log_array['bdd']['$query'] = $query;
	$log_array['bdd']['connect'] = $result_host_connect;
	$log_array['bdd']['select'] = $result_bdd_select;
	$log_array['bdd']['result'] = $result_bdd_query;
	
	/*
	 * Purger la base des anciens titres si le nombre enregistré en base est > au nombre de pochettes à afficher
	 */
	
	if($result_bdd_query) {
		$nb_items_to_display = 2700; 
		$query = "SELECT heure_diff
							FROM titrage
							ORDER BY heure_diff DESC";							
		$raw_data = mysql_query($query);
		while($res = mysql_fetch_array($raw_data)) {
			if($i==$nb_items_to_display-1) {
				$lower_than = $res['heure_diff'];
			}
			$i++;
		}
					
		$query = "DELETE
							FROM titrage
							WHERE heure_diff < ".$lower_than
						 ;
		$res_purge = mysql_query($query);
		
		$log_array['purge']['lower_than'] = $lower_than;
		$log_array['purge']['query executed'] = $res_purge;
		$log_array['purge']['nb_deleted'] = mysql_affected_rows();		
	}	
}
else {
	
	foreach($log_array['vars'] as $variable) {
	 	 $variable['not null'] = "false (maybe)";
		 $variable['isset'] = "false (maybe)";
	 }

}	
	
	
// Afficher Le contenu du fichier de log	

 print "<pre>".print_r($log_array,1)."</pre>";
				
				
  
						


		} // fin du if "si le type est SONG"		
	} 
	
} // fin du if : si toutes les données ont bien été envoyées
else {
	echo "<i>ATTENTION : Certaines informations requises sont <b>inexistantes</b>. Le titre n'a pas été ajouté à l'historique.</i><br><br>
	Veuillez vérifier les données envoyées et la fiche de l'élément en cours.<font size=-2><br><br>Informations de débogage :<br>
	CAUTION: Some required information is not <b>exist</b>.the title was not added to history.
 Please check the data.Debugging information:1.2";	
	
	if (!isset($_POST['starttime'])) { echo "STARTTIME."; }
	if (!isset($_POST['eventtype'])) { echo "EVENTTYPE."; }
	if (!isset($_POST['title'])) { echo "TITLE."; }
	if (!isset($_POST['artist'])) { echo "ARTIST."; }
	if (!isset($_POST['runtime'])) { echo "RUNTIME."; }
	if (!isset($_POST['radio'])) { echo "RADIO."; }
	echo "</font>";
}

?>
<br>
</body>
</html>
