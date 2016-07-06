<?php
/**
 * Template Name: Cat Management: Scheduler
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

if ( !is_user_logged_in() ) {
	header( 'Status: 302' );
	header( 'HTTP/1.1 302 Found' );
	header( 'Location: ' . home_url( '/reservations/' ) );
}

$errcond = false;
$errmsg = '';

$cat_rsrv['owner_id'] = '';
$cat_rsrv['cats_id'] = '';
$cat_rsrv['datein'] = '';
$cat_rsrv['dateout'] = '';
$cat_rsrv['boarding'] = '';
$cat_rsrv['grooming'] = '';
$cat_rsrv['softpaws'] = '';
$cat_rsrv['shampoo'] = '';
$cat_rsrv['spa'] = '';
$cat_rsrv['groominginst'] = '';
$cat_rsrv['catsit'] = '';
$cat_rsrv['inhome'] = '';
//$cat_rsrv['vaccinate'] = '*';
$cat_rsrv['transport'] = '';

$mode = ( isset( $_GET['action'] ) ? $_GET['action'] : 'list' );

if ( isset( $_POST['datein']) ) {
	global $wpdb;
	$petprefix = "petmgmt_";

	$cats = $_POST['cats'];
	$datein = trim($_POST['datein']);
	$dateout = trim($_POST['dateout']);
	$boarding = trim($_POST['boarding']);
	$grooming = $_POST['grooming'];
	$softpaws = trim($_POST['softpaws']);
	$shampoo = trim($_POST['shampoo']);
	$spa = trim($_POST['spa']);
	$groominginst = trim($_POST['groominginst']);
	$catsit = trim($_POST['catsit']);
	$inhome = trim($_POST['inhome']);
	//$vaccinate = trim($_POST['vaccinate']);
	$transport = trim($_POST['transport']);
	
            $cat_rsrv['owner_id'] = $current_user->ID;
	        $cat_rsrv['cats_id'] = implode( " ", $_POST['cats'] );
	        $cat_rsrv['datein'] = trim( $_POST['datein'] );
	        $cat_rsrv['dateout'] = trim( $_POST['dateout'] );
	        $cat_rsrv['boarding'] = trim( $_POST['boarding'] );
	        $cat_rsrv['grooming'] = implode( ",", $_POST['grooming'] );
	        $cat_rsrv['softpaws'] = trim( $_POST['softpaws'] );
	        $cat_rsrv['shampoo'] = implode( ",", $_POST['shampoo'] );
	        /*$cat_rsrv['spa'] = trim( $_POST['spa'] );*/
	        $cat_rsrv['groominginst'] = trim( $_POST['groominginst'] );
	        $cat_rsrv['catsit'] = trim( $_POST['catsit'] );
	        $cat_rsrv['inhome'] = trim( $_POST['inhome'] );
	        //$cat_rsrv['vaccinate'] = trim( $_POST['vaccinate'] );
	        $cat_rsrv['transport'] = trim( $_POST['transport'] );     	

	if ( !$datein || !$dateout || !$cats ) {
		$errcond = true;
		$errmsg = 'Please complete all required fields.';
	}
	
	//if ($datein > $dateout){
	//	$errcond = true;
	//	$errmsg = 'Your check out date is earilier than check in date';		
	//}  	

	if ( !$errcond ) {
	    if($mode == 'edits'){
            global $current_user, $petprefix;
		    get_currentuserinfo();
		    $user_id = $current_user->ID;
		    //$meta = get_user_meta( $user_id );

            // save to database
            //$cat_rsrv['reserv_id'] = $cata_reserv_id;
            $cata_reserv_id = trim( $_POST['ID'] );
	        $cat_rsrv['reserv_id'] = trim( $_POST['ID'] );
	        $cat_rsrv['owner_id'] = $current_user->ID;
	        $cat_rsrv['cats_id'] = implode( " ", $_POST['cats'] );
	        $cat_rsrv['datein'] = trim( $_POST['datein'] );
	        $cat_rsrv['dateout'] = trim( $_POST['dateout'] );
	        $cat_rsrv['boarding'] = trim( $_POST['boarding'] );
	        $cat_rsrv['grooming'] = implode( ",", $_POST['grooming'] );
	        $cat_rsrv['softpaws'] = trim( $_POST['softpaws'] );
	        $cat_rsrv['shampoo'] = implode( ",", $_POST['shampoo'] );
	        /*$cat_rsrv['spa'] = trim( $_POST['spa'] );*/
	        $cat_rsrv['groominginst'] = trim( $_POST['groominginst'] );
	        $cat_rsrv['catsit'] = trim( $_POST['catsit'] );
	        $cat_rsrv['inhome'] = trim( $_POST['inhome'] );
	        //$cat_rsrv['vaccinate'] = trim( $_POST['vaccinate'] );
	        $cat_rsrv['transport'] = trim( $_POST['transport'] );
        } else {

            global $current_user, $petprefix;
		    get_currentuserinfo();
		    $user_id = $current_user->ID;
		    //$meta = get_user_meta( $user_id );

            // save to database
	        $cat_rsrv['owner_id'] = $current_user->ID;
	        $cat_rsrv['cats_id'] = implode( " ", $_POST['cats'] );
	        $cat_rsrv['datein'] = trim( $_POST['datein'] );
	        $cat_rsrv['dateout'] = trim( $_POST['dateout'] );
	        $cat_rsrv['boarding'] = trim( $_POST['boarding'] );
	        $cat_rsrv['grooming'] = implode( ",", $_POST['grooming'] );
	        $cat_rsrv['softpaws'] = trim( $_POST['softpaws'] );
	        $cat_rsrv['shampoo'] = implode( ",", $_POST['shampoo'] );
	        /*$cat_rsrv['spa'] = trim( $_POST['spa'] );*/
	        $cat_rsrv['groominginst'] = trim( $_POST['groominginst'] );
	        $cat_rsrv['catsit'] = trim( $_POST['catsit'] );
	        $cat_rsrv['inhome'] = trim( $_POST['inhome'] );
	        //$cat_rsrv['vaccinate'] = trim( $_POST['vaccinate'] );
	        $cat_rsrv['transport'] = trim( $_POST['transport'] );
	        
        
        }

	    if($mode == 'edits'){
		    for($i=0; $i < sizeof($_POST['cats']); $i++){ 
			  $cat_info = pm_get_catinfo( $_POST['cats'][$i]);   	    
	          $cat_fvrcp['ID'] = $_POST['cats'][$i];
	          $cat_fvrcp['catname'] = $cat_info['catname'];
	          $cat_fvrcp['catbirthday'] = $cat_info['catbirthday'];
	          $cat_fvrcp['catbreed'] = $cat_info['catbreed'];
	          $cat_fvrcp['catcolor'] = $cat_info['catcolor'];;
	          $cat_fvrcp['catgender'] = $cat_info['catgender'];
	          $cat_fvrcp['catfixed'] =$cat_info['catfixed'];
	          $cat_fvrcp['catvet'] = $cat_info['catvet'];
	          $cat_fvrcp['catvetphone'] = $cat_info['catvetphone'];
	          $cat_fvrcp['catmed'] = $cat_info['catmed'];	          
	          $cat_fvrcp['fvrcpdate'] = $_POST['fvrcpdate'][$i];
              $cat_fvrcp['fvrcprecord'] = $_POST['fvrcprecord'][$i];
	          $cat_fvrcp['innvac'] = $_POST['innvac'][$i];
              $cat_fvrcp['vacreaction'] =  $_POST['vacreaction'][$i];
              $cat_fvrcp['vacillness'] = $_POST['vacillness'][$i];
              $cat_fvrcp['vachealthy'] = $_POST['vachealthy'][$i];
              $cat_fvrcp['cathealth'] = $_POST['cathealth'][$i];
	          $cat_fvrcp['dryfood'] = $cat_info['dryfood'];
	          $cat_fvrcp['wetfood'] = $cat_info['wetfood'];
	          $cat_fvrcp['ownerbrought'] = $cat_info['ownerbrought'];
	          $cat_fvrcp['special'] = $cat_info['special'];             	
              $result = pm_update_cat( $cat_fvrcp );
              
           } 
           
           //echo sizeof($_POST['cats']) ; 
		    
           //echo  "$result1"; 
		    
		   $oldinfo = pm_get_rsrvinfo( $cat_rsrv['reserv_id'] ); 
		   $result = pm_update_cat_rsrv( $cat_rsrv );
	    } else {
		   $result = pm_add_cat_rsrv( $cat_rsrv );
		   //$resv_id = get_max_id();
		   //$cata_reserv_id = $cat_id['reserv_id']; 
		   $sql = "SELECT MAX( reserv_id )AS maxvalue FROM wp_petmgmt_cata_rsrv"; 
		   $errorshow = $wpdb->show_errors();
		   $cats = $wpdb->get_results( $sql );
		   
		   foreach( $cats as $cat ) {
	           $max_id = $cat->maxvalue;
	       }
		   
		   $cata_reserv_id = $max_id;
	    }
	    

		if ( is_wp_error( $result ) ) {
			$errcond = true;
			$errmsg = $result->get_error_message();
		}
    }

	if ( !$errcond ) {
        global $current_user, $petprefix;
		get_currentuserinfo();
		$user_id = $current_user->ID;
		//$meta = get_user_meta( $user_id );
		
		

		// TODO: Beginning of message
		$message .= "\n";
        $message .= "Dear " . $current_user->user_firstname . " " . $current_user->user_lastname . ",\n";
        $message .= "\n";
        $message .= "Your cats' reservation has been submitted to The Cats' Inn.\n";
        if (sizeof($_POST['grooming']) == 0){
           $message .= "This reservation is confirmed.\n";
        }
        else {
	       $message .= "A member of our staff will call within 24 hours to confirm your cat/s grooming appointment only if we are booked for that day. Otherwise this email will serve as your confirmation email for your cat/s reservation.\n"; 
        }
        $message .= "The following is the information that you have submitted:\n";
        $message .= "\n";

		$message .= "******* Online Guest Form  *******\n";
        $message .= "\n";
        $customer =  $message;

        //$pet = $wpdb->get_row(
 		//	"SELECT heardabout FROM wp_petmgmt_heardabout WHERE ID='" .  $meta['leadsource'][0] . "'" );     
        //$message .= "How did you hear about us? " . $pet->heardabout . "\n";
        //$message .= "\n";
        //$message .= "\tName of Person/Vet Clinic: " . $meta['lsother'][0]. "\n";
        $hearfrom ='';
        $user_meta = get_user_meta($user_id);
        $leadsource = $user_meta['leadsource'][0];
        $hearfrom = $user_meta['hearfrom'][0];  
        
        $message .= "  ";
        $message .= "How did you hear about us? ";
        
         if($leadsource ==0)
		       $message .= "Not Selected";
		    elseif($leadsource == 1) 
		       $message .= "Co-worker";
		    elseif($leadsource == 2) 
		       $message .= "Drove By";
		    elseif($leadsource == 3) 
		       $message .= "Facebook";
		    elseif($leadsource == 4) 
		       $message .= "Family";
		    elseif($leadsource == 5) 
		       $message .= "Flickr";
		    elseif($leadsource == 6) 
		       $message .= "Friend";
		    elseif($leadsource == 7) 
		       $message .= "Google";
		    elseif($leadsource == 8) 
		       $message .= "Great Value";
		    elseif($leadsource == 9) 
		       $message .= "Linkedin";
		    elseif($leadsource == 10) 
		       $message .= "Lived Near By";		   		   		   		   		   		   		   		   
		    elseif($leadsource == 11) 
		       $message .= "Mailer";
		    elseif($leadsource == 12) 
		       $message .= "Merchant Circle";
		    elseif($leadsource == 13) 
		       $message .= "Neighbor";
		    elseif($leadsource == 14) 
		       $message .= "Nine Lives";
		    elseif($leadsource == 15) 
		       $message .= "Other Groomer";
		    elseif($leadsource == 16) 
		       $message .= "Petsmart";
		    elseif($leadsource == 17) 
		       $message .= "Pets Store";
		    elseif($leadsource == 18) 
		       $message .= "Referral Program";
		    elseif($leadsource == 19) 
		       $message .= "Twitter";
		    elseif($leadsource == 20) 
		       $message .= "Val. Pak";
		    elseif($leadsource == 21) 
		       $message .= "Van";
		    elseif($leadsource == 22) 
		       $message .= "Veterinarian";
		    elseif($leadsource == 23) 
		       $message .= "Walked By";
		    elseif($leadsource == 24) 
		       $message .= "Website";	
		    elseif($leadsource == 25) 
		       $message .= "Other";	
	
            $message .= "\n";
		if($hearfrom){
			    $message .= "  ";
		        $message .= "Name of Hear From: " . $hearfrom  . "\n";
		        //$customer .= "Name of Hear From: " . $hearfrom  . "\n";
        }    
                
        $message .= "\n";	
        $customer .= "\n";	
        
        $message .= "  Reservation ID: " . $cata_reserv_id . "\n";
        $customer .= "Reservation ID: " . $cata_reserv_id . "\n";
        
        if($mode == 'edits' && ($cat_rsrv['datein'] != date('m/d/Y', strtotime($oldinfo['datein'])))){
			$message  .= "* ";	
		}
		else {
			$message .= "  ";
        }	
        
        if ( !empty( $_POST['datein'] ) ){
	         $message .= "Date In: " . $_POST['datein'] . "\n";
	         $customer .= "Date In: " . $_POST['datein'] . "\n";
        }
 

        if($mode == 'edits' && ($cat_rsrv['dateout'] != date('m/d/Y', strtotime($oldinfo['dateout'])))){
			$message  .= "* ";	
		}
		else{
			$message  .= "  ";			
        }
        
		if ( !empty( $_POST['dateout'] ) ){
			$message  .= "Date Out: " . $_POST['dateout'] . "\n";
			$customer .= "Date Out: " . $_POST['dateout'] . "\n";
        }
        
        $message  .= "\n";
        $customer .= "\n";
        
        if($mode == 'edits' && ($cat_rsrv['boarding'] != $oldinfo['boarding'])){
			$message  .= "* ";
		}
		else{
			$message  .= "  ";		
        }
        
        $message  .= "Boarding: ";
        if ( !empty( $_POST['boarding'] ) ){ 
            $customer .= "Boarding: ";
        }
        
        if($_POST['boarding'] == 1){ 
           $message .= "Single Suite (\$25/night)\n";
           $customer .= "Single Suite (\$25/night)\n";
        }
        elseif($_POST['boarding'] == 2){                         
           $message  .= "Double Suite (\$25/night + \$23/night for each additional cat)\n";
           $customer .= "Double Suite (\$25/night + \$23/night for each additional cat)\n";
        }               
        elseif($_POST['boarding'] == 3){                 
           $message  .= "Board Separate (\$25/night + \$25/night)\n";
           $customer .= "Board Separate (\$25/night + \$25/night)\n";
        }
        elseif($_POST['boarding'] == 4){
           $message  .= "Kitty Cottages (\$32/night)\n";
           $customer .= "Kitty Cottages (\$32/night)\n";
        }   
        elseif($_POST['boarding'] == 5){
           $message  .= "Large Suite (\$36/night)\n";
           $customer .= "Large Suite (\$36/night)\n";
        }
        elseif($_POST['boarding'] == 6){
           $message  .= "Large Villas (\$45 for 1st cat \$15 each add, max 5 cats)\n";
           $customer .= "Large Villas (\$45 for 1st cat \$15 each add, max 5 cats)\n";
        }
        elseif($_POST['boarding'] == 7){
           $message  .= "Adjoining Suites  (\$25 and \$23 second cat)\n";
           $customer .= "Adjoining Suites  (\$25 and \$23 second cat)\n";
        }        
        else{
	       $message  .= "None\n"; 
        }              
        
        if($mode == 'edits' && ($cat_rsrv['grooming'] != $oldinfo['grooming'])){
			        $message  .= "* ";		
		}
		else{
			        $message  .= "  ";		
        }
        if ( !empty( $_POST['grooming'] ) ) {
	        $message  .= "Grooming: " . implode( ', ', $_POST['grooming'] ) . "\n";
	        $customer .= "Grooming: " . implode( ', ', $_POST['grooming'] ) . "\n";
        } 
        else {
            $message  .= "Grooming: None Selected\n";
        }
        
        if($mode == 'edits' && ($cat_rsrv['softpaws'] != $oldinfo['softpaws'])){
			        $message  .= "* ";	
		}
		else{
			        $message  .= "  ";	
        }
        if ( !empty( $_POST['softpaws'] ) ){
            $message .= "Softpaws: " . $_POST['softpaws'] . "\n";
            $customer .= "Softpaws: " . $_POST['softpaws'] . "\n";
        }
        else {
	        $message .= "Softpaws: None Provided\n";
        }
            
        if($mode == 'edits' && ($cat_rsrv['groominginst'] != $oldinfo['groominginst'])){
			        $message  .= "* ";
		}
        else{
			        $message  .= "  ";		
        }		              
          
        if ( !empty( $_POST['groominginst'] ) ){
            $message  .= "Grooming Instructions: " . $_POST['groominginst'] . "\n";
            $customer .= "Grooming Instructions: " . $_POST['groominginst'] . "\n";
        }    
        else {
            $message .= "Grooming Instructions: " . "None Provided " . "\n";

        }
        
        
        if($mode == 'edits' && ($cat_rsrv['shampoo'] != $oldinfo['shampoo'])){
	                $message  .= "* ";
		}
        else{
			        $message  .= "  ";		
        }
         		                               
        if ( !empty( $_POST['shampoo'] ) ) {
             $message  .= "Bath/Shampoo: " . implode( ', ', $_POST['shampoo'] ) . "\n";
             $customer .= "Bath/Shampoo: " . implode( ', ', $_POST['shampoo'] ) . "\n";
        }
        else {
	        $message  .= "Bath/Shampoo: None Selected\n";
        }
             
        if($mode == 'edits' && ($cat_rsrv['spa'] != $oldinfo['spa'])){
	                $message  .= "* ";
		}
        else{
			        $message  .= "  ";			
        }
                 
        
            /*$message  .= "Spa Packages: ";
            
            if ($_POST['spa'] != 0)
               $customer  .= "Spa Packages: ";
            if($_POST['spa'] == 1){
               $message  .= "The Lion King - \$135\n";
               $customer  .= "The Lion King - \$135\n";
	        }
	        elseif($_POST['spa'] == 2){
		       $message  .= "The Cougar - \$125\n"; 
		       $customer  .= "The Cougar - \$125\n"; 
	        }
	        elseif($_POST['spa'] == 3){
		       $message  .= "The Puma - \$115\n";
		       $customer  .= "The Puma - \$115\n"; 
	        }
	        else{
		       $message  .= "None\n"; 
	        }
            
        if ( !empty( $_POST['spa'] ) ) {
	        $message  .= "     " . "\n";
	        $customer .= "     " . "\n";
        }*/     
        
        if($mode == 'edits' && ($cat_rsrv['catsit'] != $oldinfo['catsit'])){
	                $message  .= "* ";	
		}
        else{
			        $message  .= "  ";
        }
        
		if (  $_POST['catsit'] > 0 ){ 
		           $customer  .= "In-Home Cat Sitting: ";
		           $message  .= "In-Home Cat Sitting: ";
		            if ($_POST['catsit'] == 1){
		                $message   .= "One visit a day \n";
		                $customer  .= "One visit a day \n";
	                }
		            elseif ($_POST['catsit'] == 2) {
		                $message  .= "Two visits per day \n";
		                $customer  .= "Two visits per day \n";			            
		            }
		            elseif ($_POST['catsit'] == 3) {
		                $message  .= "One visits per day for 2 cats \n";
		                $customer  .= "One visits per day for 2 cats \n";			            
		            }       
	    }
	    else {
		    $message   .= "In-Home Cat Sitting: None Selected";
	    }
        
	    
	    if($mode == 'edits' && ($cat_rsrv['catsit'] != $oldinfo['catsit'])){
	                $message  .= "* ";	
		}
        else{
			        $message  .= "  ";
        }
        
        if ( !empty( $_POST['inhome'] ) ){
            $message  .= "In-Home Instructions: " . $_POST['inhome'] . "\n";
            $customer .= "In-Home Instructions: " . $_POST['inhome'] . "\n";
        }    
        else{
            $message .= "In-Home Instructions: " . "None" . "\n";
        }    
        
        //if($mode == 'edits' && ($cat_rsrv['vaccinate'] != $oldinfo['vaccinate'])){
        //            $message  .= "* ";	
		//}
        //else{
		//	        $message  .= "  ";		
        //}
        //
        //if ( !empty( $_POST['vaccinate'] ) ) {
        //    $message  .= "Vaccination: " . $_POST['vaccinate'] . "\n";
        //    $customer .= "Vaccination: " . $_POST['vaccinate'] . "\n";
        //}
        
        $message  .= "\n";
        $customer .= "\n";
        if($mode == 'edits' && ($cat_rsrv['transport'] != $oldinfo['transport'])){
                    $message  .= "* ";	
		}
        else{
			        $message  .= "  ";			
        }
        
		//if ( !empty( $_POST['transport'] ) ) {
		$message  .= "Transportation: "; 
		$customer .= "Transportation: "; 
        //}
		if ($_POST['transport'] == 0 ) {
			$message .= "None Required" ;
			$customer .= "None Required" ;
	    }	
		elseif ($_POST['transport'] == 1 ) {
			$message .= "Outside Radus - Email for Rates" ;
			$customer .= "Outside Radus - Email for Rates" ;
		}
		elseif ($_POST['transport'] == 2 ) {
			$message .= "Inside Radus 8 miles - \$35" ;
			$customer .= "Inside Radus 8 miles - \$35" ;
		}
		elseif ($_POST['transport'] == 3 ) {
			$message .= "Sunday/Holiday Within 8 miles- \$45 " ;
			$customer .= "Sunday/Holiday Within 8 miles- \$45 " ;
		}
		
		$message .= "\n";
        $message .= "\n";
 	    $message .= "\n";
 	    $customer .= "\n";
        $customer .= "\n";
 	    $customer .= "\n";
        $message .= "********** Guest Information **********\n";
        $message .= "\n";
        $message .= "Customer Name: " . $current_user->user_firstname . " " . $current_user->user_lastname . "\n";
        $message .= "\n";
		$message .= "Email: " . $current_user->user_email . "\n";
        $message .= "\n";		  
        $message .= "Address: " . $user_meta['address'][0]. "\n";
        $message .= "\n";		
		$message .= "City: " . $user_meta['city'][0] . "\n";
        $message .= "\n";		  
        $message .= "State: " . $user_meta['state'][0] . "\n";
		$message .= "\n";		
        $message .= "Zip: " . $user_meta['zip'][0] . "\n";
        $message .= "\n";		  
        $message .= "Phone: " . $user_meta['phone'][0] . "\n";
        $message .= "\n";
		$message .= "Emergency Contact Name: " . $user_meta['emergency_name'][0] . "\n";
        $message .= "\n";		  
        $message .= "Emergency Contact Phone: " . $user_meta['emergency_phone'][0] . "\n";
	    $message .= "\n";
        $message .= "\n";
        $message .= "************** Cat Info ***************\n";
        $message .= "\n";
        $message .= "Number of Cat(s): " . count($_POST['cats']) . "\n";
      
        $customer .= "************** Cat Info ***************\n";
        $customer .= "\n";
        $customer .= "Number of Cat(s): " . count($_POST['cats']) . "\n";          

	    $table_name = $wpdb->prefix . $petprefix . 'cats';
		$sql = "SELECT ID, catname, catbreed, catcolor, catbirthday, catgender, catfixed, catvet, catvetphone, catmed, fvrcpdate, fvrcprecord, fvrcprecdate, innvac, vacreaction, vacillness, vachealthy, dryfood, wetfood, ownerbrought, special FROM $table_name
		    WHERE owner_id = $user_id AND deleted = 0";
		$cats = $wpdb->get_results( $sql );

        foreach( $cats as $cat ) {
			if ( !in_array( $cat->ID, $_POST['cats'] ) )
				continue;
			$message .= "**************************************\n";	
			$message .= "\n";
			$message .= "Name: " . $cat->catname . "\n";
            $message .= "\n";		
			$message .= "Birthday: " . date('m/d/Y', strtotime( $cat->catbirthday ) ) . "\n";
            $message .= "\n";
			$message .= "Breed: " . $cat->catbreed . "\n";
            $message .= "\n";			
            $message .= "Color: " . $cat->catcolor . "\n";
            $message .= "\n";			
            $message .= "Gender: " . ( $cat->catgender == 1 ? 'M' : 'F' ) . "\n";
			$message .= "\n";
            $message .= "Neutered/Spayed: " . ( $cat->catfixed == 1 ? 'Y' : 'N' ) . "\n";
            $message .= "\n";			
            $message .= " Vet/Clinic Name: " . $cat->catvet . "\n";
            $message .= "\n";			
            $message .= "Vet/Clinic Phone: " . $cat->catvetphone . "\n";
            $message .= "\n";			
            $message .= "Medication and Application: " . $cat->catmed . "\n";
            $message .= "\n";			
            $message .= "FVRCP Vaccinate Date: " . date('m/d/Y', strtotime( $cat->fvrcpdate ) ) . "\n";     
            $message .= "\n";
            $message .= "FVRCP Received Type: " . $cat->fvrcprecord . "\n";
            $message .= "\n";
            $message .= "Cats' Inn to Vacinate? " . ( $cat->innvac == 1 ? 'Y' : 'N' ) . "\n";
            $message .= "\n";	
            $message .= "Has your pet ever had a reaction to a vaccine? " . ( $cat->vacreaction == 1 ? 'Y' : 'N' ) . "\n";
            $message .= "\n";
            $message .= "Any signs of illness? " . ( $cat->vacillness == 1 ? 'Y' : 'N' ) . "\n";
            $message .= "\n";	
            $message .= "Do you believe your pet to be completely healthy? " . ( $cat->vachealthy == 1 ? 'Y' : 'N' ) . "\n";                 
            $message .= "\n";			
            $message .= "Pre-existing health conditions: " . $cat->cathealth . "\n";
            $message .="\n"; 
            $message .= "Dry Food: " . $cat->dryfood . "\n";
            $message .= "\n";			
            $message .= "Wet Food: " . $cat->wetfood . "\n";
            $message .= "\n";			
            $message .= "Owner Brought: " . $cat->ownerbrought . "\n";
            $message .= "\n";			
            $message .= "Special Instructions: " . $cat->special . "\n";
            
			$customer .= "Name: " . $cat->catname . "\n";	
		}
        $message .= "\n";
        $message .= "\n";
        $customer .= "\n";
        $customer .= "\n";        
        

		//$sendto = get_bloginfo('admin_email');
		
        $sendto = 'reservation@thecatsinn.net';
		//$headers = 'From: The Cats\' Inn <reservation@thecatsinn.net>' . "\r\n" .
		$headers = 'From: reservation@thecatsinn.net' . "\r\n" .
			'Reply-To: ' . $sendto .  "\r\n" .
			'Bcc: myee@lyctech.com' . "\r\n" .
			'X-Mailer: CustomCatForm/1.0';
		
			
		mail( $current_user->user_email, 'The Cats\' Inn New Guest Form =^..^=', $customer, $headers );
		mail( $sendto, 'The Cats\' Inn New Guest Form =^..^=', $message, $headers );
        
        header( 'Status: 302' );
        header( 'HTTP/1.1 302 Found' );
        header( 'Location: ' . home_url( '/schedule/confirmed' ) );

         //For debug print out
         //var_dump($_POST);
         //echo sizeof($_POST['fvrcprecord']);
         // echo "$result1;


	}
}

if(($mode == 'edit') || ($mode == 'edits')){
	//$formact = 'edits';
	
    if ( isset( $_GET['rid'] ) ){
       $cat_rsrv['reserv_id'] = $_GET['rid'];
    }
    
    $formact = 'edits&rid='.$_GET['rid'];
    
    //if ($isset (isset( $_POST['datein']))){
	    //do the edit cats
	    
   // }else { 
	if($mode == 'edit') {   
        $rinfo = pm_get_rsrvinfo( $cat_rsrv['reserv_id'] );
        $cat_rsrv = $rinfo;
          if ( is_wp_error( $rinfo ) ) {
        		$errcond = true;
        		$errmsg = $rinfo->get_error_message();
        	} else {
        		$cata_rsrv = $rinfo;
        	}
     }
        	//$rsrv_id =  $_GET['rid'];
        	$hasid = true;
   // } 	
}



get_header(); ?>
		<div id="primary">
			<div id="content" role="main">
<?php get_sidebar( 'banner' ); ?>
<?php if ( !is_front_page() ): ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

<?php
global $current_user;
get_currentuserinfo();
$user_id = $current_user->ID;

$cats = get_cats_by_owner( $user_id );

?>

<?php endif; ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/dates.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/forms.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/usableforms.js"></script>
<script type="text/javascript">
        <?php
        $exp_date = date("m/d/Y");        
        $expiration_date = strtotime($exp_date);
        ?>

        var currentTime = new Date();

        $(function() {
                $( "#datein" ).datepicker({changeMonth:true, changeYear:true, minDate: "<?php echo $exp_date; ?>", beforeShowDay: function(date){if(date.getDay()==0){return [false,''];}var dateStr=$.datepicker.formatDate('mm/dd/yy',date);for(var i=0;i<excludeDates.length;i++){if(dateStr==excludeDates[i]){return [false, ''];}}return [true,''];}});
        });        
        
        $(function() {
                $( "#dateout" ).datepicker({changeMonth:true, changeYear:true, minDate: "<?php echo $exp_date; ?>", beforeShowDay: function(date){if(date.getDay()==0){return [false,''];}var dateStr=$.datepicker.formatDate('mm/dd/yy',date);for(var i=0;i<excludeDates.length;i++){if(dateStr==excludeDates[i]){return [false, ''];}}return [true,''];}});
        });
        
        function changetextbox()
        {
	        if (document.getElementById("boarding").value == "0") {
                document.getElementById("catsit").disabled = false;
                document.getElementById("inhome").disabled = false;
            } else {
                document.getElementById("catsit").selectedIndex =0;
	            document.getElementById("catsit").disabled=true;
	            document.getElementById("inhome").disabled=true;
	            document.getElementById("inhome").value = '';
            }
        }
        
        function changecheckbox()
        {
	        if (document.getElementById("catsit").value == "0") {
                document.getElementById("grooming-1").disabled = false;
                document.getElementById("grooming-2").disabled = false;
                document.getElementById("grooming-3").disabled = false;
                document.getElementById("grooming-4").disabled = false;
                document.getElementById("grooming-5").disabled = false;
                document.getElementById("grooming-6").disabled = false;
                document.getElementById("grooming-8").disabled = false;
                document.getElementById("grooming-9").disabled = false;
                document.getElementById("grooming-10").disabled = false;
                document.getElementById("grooming-11").disabled = false;
                document.getElementById("grooming-12").disabled = false;
                document.getElementById("grooming-13").disabled = false;
                document.getElementById("shampoo-1").disabled = false;
                document.getElementById("shampoo-2").disabled = false;
                document.getElementById("shampoo-3").disabled = false;
                document.getElementById("shampoo-4").disabled = false;
                document.getElementById("shampoo-5").disabled = false;
                document.getElementById("shampoo-6").disabled = false;
                document.getElementById("shampoo-7").disabled = false;
                document.getElementById("shampoo-8").disabled = false;
                document.getElementById("shampoo-9").disabled = false;
                document.getElementById("shampoo-10").disabled = false
                document.getElementById("shampoo-11").disabled = false; 
                document.getElementById("shampoo-12").disabled = false; 
                document.getElementById("shampoo-13").disabled = false;                               
                document.getElementById("boarding").disabled = false;
                document.getElementById("softpaws").disabled = false;
                //document.getElementById("spa").disabled = false;
                document.getElementById("groominginst").disabled = false;                
            } else {
                document.getElementById("boarding").selectedIndex =0;
                document.getElementById("grooming-1").disabled = true;
                document.getElementById("grooming-2").disabled = true;
                document.getElementById("grooming-3").disabled = true;
                document.getElementById("grooming-4").disabled = true;
                document.getElementById("grooming-5").disabled = true;
                document.getElementById("grooming-6").disabled = true;
                document.getElementById("grooming-8").disabled = true;
                document.getElementById("grooming-9").disabled = true;
                document.getElementById("grooming-10").disabled = true;
                document.getElementById("grooming-11").disabled = true;
                document.getElementById("grooming-12").disabled = true;
                document.getElementById("grooming-13").disabled = true;                                
                document.getElementById("grooming-1").checked = false;
                document.getElementById("grooming-2").checked = false;
                document.getElementById("grooming-3").checked = false;
                document.getElementById("grooming-4").checked = false;
                document.getElementById("grooming-5").checked = false;
                document.getElementById("grooming-6").checked = false;
                document.getElementById("grooming-8").checked = false;
                document.getElementById("grooming-9").checked = false;
                document.getElementById("grooming-10").checked = false;
                document.getElementById("grooming-11").checked = false;
                document.getElementById("grooming-12").checked = false;
                document.getElementById("grooming-13").checked = false;                                
                document.getElementById("shampoo-1").disabled = true;
                document.getElementById("shampoo-2").disabled = true;
                document.getElementById("shampoo-3").disabled = true;
                document.getElementById("shampoo-4").disabled = true;
                document.getElementById("shampoo-5").disabled = true;
                document.getElementById("shampoo-6").disabled = true;
                document.getElementById("shampoo-7").disabled = true;
                document.getElementById("shampoo-8").disabled = true;
                document.getElementById("shampoo-9").disabled = true;
                document.getElementById("shampoo-10").disabled = true;
                document.getElementById("shampoo-11").disabled = true;
                document.getElementById("shampoo-12").disabled = true;
                document.getElementById("shampoo-13").disabled = true;
                document.getElementById("shampoo-1").checked = false;
                document.getElementById("shampoo-2").checked = false;
                document.getElementById("shampoo-3").checked = false;
                document.getElementById("shampoo-4").checked = false;
                document.getElementById("shampoo-5").checked = false;
                document.getElementById("shampoo-6").checked = false;
                document.getElementById("shampoo-7").checked = false;
                document.getElementById("shampoo-8").checked = false;
                document.getElementById("shampoo-9").checked = false;
                document.getElementById("shampoo-10").checked = false;
                document.getElementById("shampoo-11").checked = false;
                document.getElementById("shampoo-12").checked = false;
                document.getElementById("shampoo-13").checked = false;                 
                document.getElementById("boarding").disabled = true;
                document.getElementById("softpaws").disabled = true;
                document.getElementById("softpaws").value = '';
                //document.getElementById("spa").disabled = true;
                document.getElementById("spa").selectedIndex = 0;
                document.getElementById("groominginst").disabled = true;
                document.getElementById("groominginst").value = '';
            }
        }

</script>
			<form action="/schedule/?action=<?php echo $formact; ?>" method="post" id="newguest-form">
				<div id="formtab1">
					<ul class="formlist">
<?php
	if ( $errcond ) {
?>
						<li class="formpart-header"><p class="error"><?php echo $errmsg; ?></p></li>
<?
	}
?>

						<li class="formpart-header">Make a Reservation<span class="legend"><span class="required">*</span> required input</span></li>
						<li><strong>Instructions:</strong> Please make a reservation by filling out the form below. You will receive <strong>an email confirming your reservation</strong> after submitting the form. If your cat is 18 years or older we strongly recommend that your cat board at a vet for their safety and well being. Due to this, we will not be able to accept them here for boarding at The Cats' Inn. If a cat is 18 years or younger and has multiple health issues, we reserve the right to decline service.</br></br>
						If all cats are receiving the exact same services at the same dates then you may check all at once and submit 1 reservation request.  If your cats are receiving different services e.g. different grooming services but same boarding dates then please click on 1 cat at a time and submit a separate reservation per cat.</li>
                                          <li class="minihead">Kitties</li>      
                                          <li><label>Select one per reservation<span class="required"> *</span></label>  
							<ul class="chkboxgroup">
<?php 
	$icat=1;
	foreach( $cats as $ic => $cat ) {
		       $cat_checked = 0;
		       $cats_array = explode(" ", $cat_rsrv['cats_id']);
		       foreach ($cats_array as $cat_id){
			       if($cat_id == $ic)
			        $cat_checked = 1;
		       }
?>
               
				<li><input type="checkbox" name="cats[]" id="cats-<?php echo $icat; ?>" value="<?php echo htmlentities( $ic ); ?>" rel="<?php echo htmlentities( $cat['catname'] ); ?>" <?php echo ( $cat_checked == 1 ? 'checked' : '' ); ?> /> <label class="cb" for="cats-<?php echo $icat; ?>"><?php echo htmlentities( $cat['catname'] ); ?></label></li>
<?
		$icat++;
	}
?>
						<br /><br /> </ul>
                               <span class="ttw"><p class="tooltip">
                               Don't see all your cats? <a href="/cats/?action=list">Manage Your Kitties</a><br />  </p></span>
						</li>
			    <!-- <li class="formpart-header">Don't see all your cats? <a href="/cats/?action=list">Manage Your Cats</a></li>
						<li class="formpart-header">Dates and Services</li> -->

                                            <li class="minihead">Service Dates</li>

						<li><label for="datein">Date In</label> <span class="required">*</span> <input type="text" id="datein" name="datein" readonly="true" value="<?php echo ($cat_rsrv['datein'] == '') ? '' : date('m/d/Y', strtotime($cat_rsrv['datein'])); ?>" />
<span class="ttw"><p class="tooltip">
                               Review our <a href="/holiday-calendar/" target="_blank">calendar</a> for holiday hours. <br />  </p></span>
                              
                                                      </li>
						<li><label for="dateout">Date Out</label> <span class="required">*</span> <input type="text" id="dateout" name="dateout" readonly="true" value="<?php echo ($cat_rsrv['dateout'] == '') ? '' : date('m/d/Y', strtotime($cat_rsrv['dateout'])); ?>" />
						<span class="ttw"><p class="tooltip">Major holiday reservations require a <strong><u>5 night stay minimum</u></strong>.  This includes, Thanksgiving, Christmas, New Years, and 4th of July.
<br />  </p></span></li>
						<!--<span class="ttw"><p class="tooltip">We are at capacity and can no longer accommodate any additional cats on 12/24 - 1/2.  If your reservation runs past through these dates please call our Inn directly at 650-508-9878.  So we may assist you.<br />  </p></span></li>-->
						<!-- <li><label>Service Needed</label> <span class="notrequired">*</span>
							<ul class="chkboxgroup">
								<li><input type="checkbox" name="service[]" id="service-1" value="Boarding" /> <label class="cb" for="service-1">Boarding</label></li>
								<li><input type="checkbox" name="service[]" id="service-2" value="Grooming" /> <label class="cb" for="service-2">Grooming</label></li>
								<li><input type="checkbox" name="service[]" id="service-3" value="In-Home Cat Sitting" /> <label class="cb" for="service-3">In-Home Cat Sitting</label></li>
								<li><input type="checkbox" name="service[]" id="service-4" value="Transportation" /> <label class="cb" for="service-4">Transportation</label></li>
							</ul>
						</li> -->
						<!--<li><p>&nbsp</p></li>-->
						<li><p>&nbsp</p></li>
						<li><p>&nbsp</p></li>
						<li class="minihead">Boarding</li>
						<li><label for="boarding">Boarding Options</label> <span class="notrequired">*</span> <select id="boarding" name="boarding" onChange="changetextbox();">
							<option value="0">None Needed</option>
							<option value="1"<?php echo ( $cat_rsrv['boarding']==1 ? 'selected="selected"' : '' ); ?>>Single Suite ($25/night)</option>
							<option value="2"<?php echo ( $cat_rsrv['boarding']==2 ? 'selected="selected"' : '' ); ?>>Double Suite ($25/night + $23/night for second cat)</option>
							<option value="3"<?php echo ( $cat_rsrv['boarding']==3 ? 'selected="selected"' : '' ); ?>>Board Separate ($25/night + $25/night)</option>
							<option value="4"<?php echo ( $cat_rsrv['boarding']==4 ? 'selected="selected"' : '' ); ?>>Kitty Cottages ($32/night)</option>
							<option value="5"<?php echo ( $cat_rsrv['boarding']==5 ? 'selected="selected"' : '' ); ?>>Large Suite ($36/night)</option>
							<option value="6"<?php echo ( $cat_rsrv['boarding']==6 ? 'selected="selected"' : '' ); ?>>Large Villas ($45 for 1st cat $15 each add, max 4 cats)</option>
							<option value="7"<?php echo ( $cat_rsrv['boarding']==7 ? 'selected="selected"' : '' ); ?>>Adjoining Suites ($25 and $23 second cat)</option>					
						</select>
                        <span class="ttw"><p class="tooltip">Cats of the same family that board separately are $25 each.</p></span>
						</li>
						<li></br></li>
						<li class="minihead">In-Home Cat Sitting</li>
						<li><label for="catsit">In-Home Cat Sitting Options</label> <span class="notrequired">*</span> <select id="catsit" name="catsit" onChange="changecheckbox();">
							<option rel="none" value="0">None Needed</option>
							<option rel="catsitnote1" value="1" <?php echo ( $cat_rsrv['catsit']==1 ? 'selected="selected"' : '' ); ?>>1 Visit a Day ($38/day for one visit)</option>
							<option rel="catsitnote3" value="3" <?php echo ( $cat_rsrv['catsit']==3 ? 'selected="selected"' : '' ); ?>>1 Visit a Day for 2 cats ($44/day for one visit)</option>
							<option rel="catsitnote2"value="2" <?php echo ( $cat_rsrv['catsit']==2 ? 'selected="selected"' : '' ); ?>>2 Visits Per Day ($58/day for 2 visits)</option>
						</select>
						<span class="ttw"><p class="tooltip">For more information on key pick up/drop off or visits and rates please refer to our  <a href="/in-home-cat-sitting/" target="_blank">cat sitting</a> page.</p></span>
						<table width="100%" border="0">
                        <tr rel="catsitnote1"><td><span class="ttw"><p class="tooltip">Please specify the time you would like your first and last visit and your preference of time for the visits in between. There is no guarantee that we can visit on the time you specifically want however we will take note of your time preference and do our very best to accommodate you and your kitties. -Prices vary depending on radius.</p></span></td></tr>
                        <tr rel="catsitnote3"><td><span class="ttw"><p class="tooltip">Please specify the time you would like your first and last visit and your preference of time for the visits in between. There is no guarantee that we can visit on the time you specifically want however we will take note of your time preference and do our very best to accommodate you and your kitties. -Prices vary depending on radius.</p></span></td></tr>
                        <tr rel="catsitnote2"><td><span class="ttw"><p class="tooltip">Please specify a whether you need two visits on your first and last dates of cat sitting. Unless specified every visit will be one morning visit and one evening visit a day.
-Prices vary depending on radius.
</p></span></td></tr>
                        </table>
						</li>
						<li><label for="inhome">Additional In-Home Cat Sitting Instructions</label> <span class="notrequired">*</span> <textarea id="inhome" name="inhome"><? echo $cat_rsrv['inhome'] ?></textarea></li>
						<li class="minihead">Grooming</li>
						<li><label for="grooming">Grooming Options</label> <span class="notrequired">*</span>
							<ul class="chkboxgroup">
								<li><input type="checkbox" name="grooming[]" id="grooming-1" value="Bath" <?php echo ((strpos($cat_rsrv['grooming'],'Bath') !== false) ? 'checked' : '' ); ?>><label class="cb" for="grooming-1">Bath <span style="font-size:13px"> --- $50 and up ~ short hair</span><br />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span style="font-size:13px">$55 and up ~ medium hair</span><br />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span style="font-size:13px">$60 and up ~ long hair</span><br /><span style="font-size:13px"> (ALL baths include: 2 shampoos, blow dry, brush out, ear cleaning and nail trim)</span><br /><span style="font-size:13px">*Special Shampoos --- Add $5</span><br /><span style="font-size:13px"> (De-shedding, Oatmeal, Hotspot/Acne, Microtech (dander control), Flea & Tick, Whitening, Oxy-Med, Hypoallergenic)</span></label></li>
								<li><input type="checkbox" name="grooming[]" id="grooming-12" value="Hot Oil treatment" <?php echo ((strpos($cat_rsrv['grooming'],'Hot Oil treatment') !== false) ? 'checked' : '' ); ?>><label class="cb" for="grooming-12">Hot Oil treatment<span style="font-size:13px"> --- Add $25 to any bath</span></label></li>
								<li><input type="checkbox" name="grooming[]" id="grooming-4" value="Tummy Shave" <?php echo ((strpos($cat_rsrv['grooming'],'Tummy Shave') !== false) ? 'checked' : '' ); ?>> <label class="cb" for="grooming-4">Tummy Shave<span style="font-size:13px"> --- $30 and up</span></label></li>
								<li><input type="checkbox" name="grooming[]" id="grooming-9" value="Panty Shave" <?php echo ((strpos($cat_rsrv['grooming'],'Panty Shave') !== false) ? 'checked' : '' ); ?>> <label class="cb" for="grooming-9">Panty Shave<span style="font-size:13px"> --- $20 and up</span></label></li>
								<li><input type="checkbox" name="grooming[]" id="grooming-13" value="Defluff Me combo" <?php echo ((strpos($cat_rsrv['grooming'],'Defluff Me combo') !== false) ? 'checked' : '' ); ?>> <label class="cb" for="grooming-13">Defluff Me combo<span style="font-size:13px"> --- $45</span><br /><span style="font-size:13px">(Panty shave and Tummy shave)</span></label></li>								
								<li><input type="checkbox" name="grooming[]" id="grooming-3" value="Lion Cut" <?php echo ((strpos($cat_rsrv['grooming'],'Lion Cut') !== false) ? 'checked' : '' ); ?>> <label class="cb" for="grooming-3">Lion Cut<span style="font-size:13px"> --- $85 and up without pom pom tail, add $5 with pom pom tail</span><br /><span style="font-size:13px">(Bath, brush out, ear cleaning and nail trim included)</span></label></li>
								<li><input type="checkbox" name="grooming[]" id="grooming-10" value="Body Shave" <?php echo ((strpos($cat_rsrv['grooming'],'Body Shave') !== false) ? 'checked' : '' ); ?>> <label class="cb" for="grooming-10">Body Shave<span style="font-size:13px"> --- $85 and up</span><br /><span style="font-size:13px">(Bath, brush out, ear cleaning and nail trim included)</span></label></li>
								<li><input type="checkbox" name="grooming[]" id="grooming-5" value="Full or Partial Mohawk" <?php echo ((strpos($cat_rsrv['grooming'],'Full or Partial Mohawk') !== false) ? 'checked' : '' ); ?>> <label class="cb" for="grooming-5">Full or Partial Mohawk<span style="font-size:13px"> --- $85 and up</span><br /><span style="font-size:13px">(Bath, brush out, ear cleaning and nail trim included)</span></label></li>
								<li><input type="checkbox" name="grooming[]" id="grooming-11" value="Trim Fur/Modified Lion cut" <?php echo ((strpos($cat_rsrv['grooming'],'Trim Fur/Modified Lion cut') !== false) ? 'checked' : '' ); ?>> <label class="cb" for="grooming-11">Trim Fur/Modified Lion cut<span style="font-size:13px"> --- $95 and up</span><br /><span style="font-size:13px">(Bath, brush out, ear cleaning and nail trim included)</span></label></li>
								<li><input type="checkbox" name="grooming[]" id="grooming-2" value="Brush Out" <?php echo ((strpos($cat_rsrv['grooming'],'Brush Out') !== false) ? 'checked' : '' ); ?>><label class="cb" for="grooming-2">Brush Out<span style="font-size:13px"> --- $10 and up</span></label></li>
								<li><input type="checkbox" name="grooming[]" id="grooming-6" value="Nail Trim" <?php echo ((strpos($cat_rsrv['grooming'],'Nail Trim') !== false) ? 'checked' : '' ); ?>> <label class="cb" for="grooming-6">Nail Trim<span style="font-size:13px"> --- $10</span></label></li>
								<li><input type="checkbox" name="grooming[]" id="grooming-8" value="Soft Paws" <?php echo ((strpos($cat_rsrv['grooming'],'Soft Paws') !== false) ? 'checked' : '' ); ?>> <label class="cb" for="grooming-8">Soft Paws<span style="font-size:13px"> --- Front nails only $32</span><br />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span style="font-size:13px"> --- Front & back nails $42</span><br /><span style="font-size:13px">(Please specify color choice and front and back or front only nails)</span></label></li>

							</ul>
							<span class="ttw"><p class="tooltip">For grooming appointments a member of our staff will call within 24 hours if our grooming schedule is full for the day you selected. We will work with you on rescheduling for a different date.</p></span>
						</li>
						<li><label for="softpaws">For soft paws, please specify a primary color and secondary color, front, or rear paws or both.</label> <span class="notrequired">*</span> <input type="text" id="softpaws" name="softpaws" value="<?php echo htmlentities( $cat_rsrv['softpaws'] ); ?>" /></li>
						<li><strong>Note:</strong> Soft paws colors are available in: clear, pink, purple, blue, red, green, black, orange, and glittery pink, glittery blue, gold, and silver. Holiday colors for Halloween and Christmas are also available. Please choose a primary color and secondary color just in case we do not currently have your first choice available.</li>
						
						<li><label for="shampoo">Bath Shampoo Add-Ons</label> <span class="notrequired">*</span>
							<ul class="chkboxgroup">
								<li><input type="checkbox" name="shampoo[]" id="shampoo-1" value="Flea/Tick" <?php echo ((strpos($cat_rsrv['shampoo'],'Flea/Tick') !== false) ? 'checked' : '' ); ?>/> <label class="cb" for="shampoo-1">Flea &amp; Tick <span style="font-size:13px">+ $5</span></label></li>
								<li><input type="checkbox" name="shampoo[]" id="shampoo-2" value="Oatmeal/Aloe" <?php echo ((strpos($cat_rsrv['shampoo'],'Oatmeal/Aloe') !== false) ? 'checked' : '' ); ?>/> <label class="cb" for="shampoo-2">Oatmeal &amp; Aloe <span style="font-size:13px">+ $5</span></label></li>
			                    <li><input type="checkbox" name="shampoo[]" id="shampoo-3" value="Oatmeal/Aloe Conditioner" <?php echo ((strpos($cat_rsrv['shampoo'],'Oatmeal/Aloe Conditioner') !== false) ? 'checked' : '' ); ?>/> <label class="cb" for="shampoo-3">Oatmeal &amp; Aloe w/C <span style="font-size:13px">+ $8</span></label></li>
			                    <li><input type="checkbox" name="shampoo[]" id="shampoo-4" value="Microtek (dander control)" <?php echo ((strpos($cat_rsrv['shampoo'],'Microtek (dander control)') !== false) ? 'checked' : '' ); ?>/> <label class="cb" for="shampoo-4">Microtek (dander control)<span style="font-size:13px">+ $5</span></label></li>
			                    <li><input type="checkbox" name="shampoo[]" id="shampoo-12" value="Hypoallergenic" <?php echo ((strpos($cat_rsrv['shampoo'],'Hypoallergenic') !== false) ? 'checked' : '' ); ?>/> <label class="cb" for="shampoo-12">Hypoallergenic<span style="font-size:13px">+ $5</span></label></li>
			                    <li><input type="checkbox" name="shampoo[]" id="shampoo-13" value="Hotspot/Acne" <?php echo ((strpos($cat_rsrv['shampoo'],'Hotspot/Acne') !== false) ? 'checked' : '' ); ?>/> <label class="cb" for="shampoo-13">Hotspot/Acne<span style="font-size:13px">+ $5</span></label></li>
								<li><input type="checkbox" name="shampoo[]" id="shampoo-5" value="Tropiclean Oxy Med Treatment" <?php echo ((strpos($cat_rsrv['shampoo'],'Tropiclean Oxy Med Treatment') !== false) ? 'checked' : '' ); ?>/> <label class="cb" for="shampoo-5">Tropiclean Oxy Med Treatment <span style="font-size:13px">+ $5</span></label></li>
								<li><input type="checkbox" name="shampoo[]" id="shampoo-6" value="Whitening" <?php echo ((strpos($cat_rsrv['shampoo'],'Whitening') !== false) ? 'checked' : '' ); ?>/> <label class="cb" for="shampoo-6">Whitening<span style="font-size:13px">+ $5</span></label></li>
								<li><input type="checkbox" name="shampoo[]" id="shampoo-7" value="FURminator deShedding" <?php echo ((strpos($cat_rsrv['shampoo'],'FURminator deShedding') !== false) ? 'checked' : '' ); ?>/> <label class="cb" for="shampoo-7">FURminator deShedding <span style="font-size:13px">+ $5</span></label></li>
								<li><input type="checkbox" name="shampoo[]" id="shampoo-9" value="Hot Oil Treatment" <?php echo ((strpos($cat_rsrv['shampoo'],'Hot Oil Treatment') !== false) ? 'checked' : '' ); ?>/> <label class="cb" for="shampoo-9">Hot Oil Treatment <span style="font-size:13px">+ $25</a></label></li>
								<li><input type="checkbox" name="shampoo[]" id="shampoo-10" value="Flea & Tick-Advocate" <?php echo ((strpos($cat_rsrv['shampoo'],'Flea & Tick-Advantage') !== false) ? 'checked' : '' ); ?>/> <label class="cb" for="shampoo-10">Flea & Tick-Advantage &reg; <span style="font-size:13px">+ $16</span></label></li>
                                <li><input type="checkbox" name="shampoo[]" id="shampoo-11" value="Flea & Tick-Frontline" <?php echo ((strpos($cat_rsrv['shampoo'],'Flea & Tick-Frontline') !== false) ? 'checked' : '' ); ?>/> <label class="cb" for="shampoo-11">Flea & Tick-Frontline &reg; <span style="font-size:13px">+ $17</span></label></li>
                                <li><input type="checkbox" name="shampoo[]" id="shampoo-8" value="Flea & Tick-Capstar pill" <?php echo ((strpos($cat_rsrv['shampoo'],'Flea & Tick-Capstar pill') !== false) ? 'checked' : '' ); ?>/> <label class="cb" for="shampoo-8">Flea & Tick-Capstar pill/dose &reg<span style="font-size:13px">+ $12</span></label></li>

</ul>
							<span class="ttw"><p class="tooltip">
								Please specify any Bath Shampoo add-ons such as Flea &amp; Tick, Ikaria, Enlighten (for white cats), Oatmeal &amp; Aloe (for cats with dander with flaky skin),
								FURminator deShedding (for dander and shedding control), Soothing Suds (hypoallergenic), Tropiclean Oxy Med treatment (soothes dry, irritated skin), or Hot Oil
								treatment (nourishes dry skin and controls fleas and body odors). w/C = shampoo and leave in conditioner.
                                                        </p></span>
						</li>
						<!--<li><label for="spa">Spa Packages</label> <span class="notrequired">*</span> <select id="spa" name="spa">
							<option rel="none" value="0">None Needed</option>
							<option rel="note"value="1" <?php echo ( $cat_rsrv['spa']==1 ? 'selected="selected"' : '' ); ?>>The Lion King - $135</option>
							<option rel="note"value="2" <?php echo ( $cat_rsrv['spa']==2 ? 'selected="selected"' : '' ); ?>>The Cougar - $125</option>
							<option rel="note"value="3" <?php echo ( $cat_rsrv['sap']==3 ? 'selected="selected"' : '' ); ?>>The Puma - $115</option>
						</select>
						<span class="ttw"><p class="tooltip">For more information on what each spa package includes please refer to  <a href="/spa-packages/" target="_blank">spa packages</a>.</p></span>
						<table width="100%" border="0">
                        <tr rel="note"><td><span class="ttw"><p class="tooltip">We will contact you to set up the transportation times.</p></br></span></td></tr>
                        </table>
						</li>-->
						
						<li><label for="groominginst">Additional Grooming Instructions</label> <span class="notrequired">*</span> <textarea id="groominginst" name="groominginst"><? echo $cat_rsrv['groominginst'] ?></textarea></li>
						<li><strong>Note that:</strong> Your kitty will be picked up from your home between 9:00am-11:00am and dropped off before 5:00pm. The employee doing the transportation will call you ahead of time to let you know that they are on their way. Please note if you are outside our radius the spa package with transportation services can only be reserved with additional transportation fee.</li>
						

						<!--<li class="minihead">Vaccination</li>
						<li><label for="vaccinate">Cats' Inn to vaccinate</label> <span class="notrequired">*</span> <select id="vaccinate" name="vaccinate">
							<option value="No">No</option>
							<option value="Yes" <?php echo ( $cat_rsrv['vaccinate']=="Yes" ? ' selected="selected"' : '' ); ?>>Yes -- $20 per shot</option>
						</select>
						<span class="ttw"><p class="tooltip">Although the FVRCP protects your cat against a URI there is still a risk and the FVRCP vaccine is best given 2 weeks in advance of boarding.</p></span>
						</li>
<li> </br></br></li>-->

<?php 
	$icat=1;
	foreach( $cats as $ic => $cat ) {
		       $cats_array = explode(" ", $cat_rsrv['cats_id']);
		       foreach ($cats_array as $cat_id){
			   //    //if($cat_id == $ic)
			   //     //$cat_checked = 1;
			        $cinfo  = pm_get_catinfo( $ic);
		       }
		       /*
			//Willy testing
			var_dump($cinfo['fvrcpdate']);
		
		       if(isset($cinfo['fvrcpdate']))
		       {
		       $vdate = new DateTime($cinfo['fvrcpdate']);
			//$vdate = DateTime::createFromFormat('Y-m-d',$vdate);
		       echo $vdate->format('m-d-Y');		       
		       }*/
		       echo '<script type="text/javascript">';
		       echo '$(function() {$( "#fvrcpdate';
		       echo $icat;
		       echo '"';
		       echo " ).datepicker({changeMonth:true, changeYear:true, minDate: new Date(currentTime.getFullYear()-3, 1 - 1, 1)});});";
		       echo "</script>";
?>

                   <table width="100%" border="0">
                   <tr rel="<?php echo htmlentities( $cinfo['catname'] ); ?>"><td>   
                     <li class="minihead">FVRCP Vaccination For <?php echo htmlentities( $cinfo['catname'] ); ?></li>
                     <li><label for="fvrcpdate">FVRCP Vaccination Date</label> <span class="required">*</span> <input type="text" id="fvrcpdate<?php echo $icat ?>" name="fvrcpdate[]" readonly="true" value="<?php 


if (strlen($cinfo['fvrcpdate']) > 0)
{
  $vdate = new DateTime($cinfo['fvrcpdate']);
  $newDate = $vdate->format('m-d-Y');	
  echo $newDate;
  //echo date('m/d/Y', strtotime($cat['fvrcpdate']));
} 



?>" /></li>
			

                     <li><label for="fvrcprecord">Record Delivery Method</label> <span class="required">*</span>
			
                          <select id="fvrcprecord" name="fvrcprecord[]">
                                <option value="0">Select One</option>
                                <option value="Bringing In"<?php echo ( $cinfo['fvrcprecord']== "Bringing In" ? 'selected="selected"' : '' ); ?>>Bringing In</option>
                                <option value="Emailing"<?php echo ( $cinfo['fvrcprecord']== "Emailing" ? 'selected="selected"' : '' ); ?>>Emailing info@thecatsinn.net</option>
                                <option value="Faxing"<?php echo ( $cinfo['fvrcprecord']== "Faxing" ? 'selected="selected"' : '' ); ?>>Faxing 650-508-1498</option>
                                <option value="Cats Inn to vaccinate"<?php echo ( $cinfo['fvrcprecord']== "Cats Inn to vaccinate" ? 'selected="selected"' : '' ); ?>>Cats' Inn to vaccinate</option>
                                <option value="Pre-existing client/cat current on FVRCP"<?php echo ( $cat['fvrcprecord']== "Pre-existing client/cat current on FVRCP" ? 'selected="selected"' : '' ); ?>>Pre-existing client/cat current on FVRCP</option>
                                <option value="Cat exempt per vet letter"<?php echo ( $cinfo['fvrcprecord']== "Cat exempt per vet letter" ? 'selected="selected"' : '' ); ?>>Cat exempt per vet letter</option>
                                
                          </select>
                        <span class="ttw"><p class="tooltip">Fax, email, or bring in on day of arrival</p></span>
</li>


                     <li><label for="innvac">The Cats&#039; Inn to Vaccinate?</label> <span class="required">*</span> <select id="innvac" name="innvac[]">
				<option value="0">Select One</option>
				<option value="1"<?php echo ( $cinfo['innvac']==1 ? 'selected="selected"' : '' ); ?>>Yes</option>
				<option value="2"<?php echo ( $cinfo['innvac']==2 ? 'selected="selected"' : '' ); ?>>No</option>
			</select>
                     <span class="ttw"><p class="tooltip" style="font-size:11px;">FVRCP vaccinations - $20/shot<br /><br /></p></span>
                     </li>


                     <li><label for="vacreaction">Has your pet ever had a reaction to a vaccine?</label> <span class="required">*</span> <select id="vacreaction" name="vacreaction[]">
				<option value="0">Select One</option>
				<option value="1"<?php echo ( $cinfo['vacreaction']==1 ? 'selected="selected"' : '' ); ?>>Yes</option>
				<option value="2"<?php echo ( $cinfo['vacreaction']==2 ? 'selected="selected"' : '' ); ?>>No</option>
			</select>
			         <span class="ttw"><p class="tooltip" style="font-size:11px;">Has your cat ever had a reaction to a vaccine" that says "If yes, please explain below<br /></p></span>
			         </li>

                     <li><label for="vacillness">Any signs of illness?</label> <span class="required">*</span> <select id="vacillness" name="vacillness[]">
				<option value="0">Select One</option>
				<option value="1"<?php echo ( $cinfo['vacillness']==1 ? 'selected="selected"' : '' ); ?>>Yes</option>
				<option value="2"<?php echo ( $cinfo['vacillness']==2 ? 'selected="selected"' : '' ); ?>>No</option>
			</select></li>

                     <li><label for="vachealthy">Do you believe your pet to be completely healthy?</label> <span class="required">*</span> <select id="vachealthy" name="vachealthy[]">
				<option value="0">Select One</option>
				<option value="1"<?php echo ( $cinfo['vachealthy']==1 ? 'selected="selected"' : '' ); ?>>Yes</option>
				<option value="2"<?php echo ( $cinfo['vachealthy']==2 ? 'selected="selected"' : '' ); ?>>No</option>
			</select></li>
 <li><label for="cathealth">Please explain and pre-existing health issues or types of reactions to the vaccine</label> <span class="notrequired">*</span> <textarea id="cathealth" name="cathealth[]"><?php echo htmlentities( $cat['cathealth'] ); ?></textarea>

                        </li>
                        </td></tr></table>
<?
		$icat++;
	}
?>                        


						<li class="minihead">Transportation</li>
                                          <li><label for="transport">Transportation</label> <span class="notrequired">*</span> <select id="nottransport" name="transport">
							<option value="0">None Required</option>
							<option value="1"<?php echo ( $cat_rsrv['transport']==1 ? ' selected="selected"' : '' ); ?>>Outside Radius - Email for Rates</option>
							<option value="2"<?php echo ( $cat_rsrv['transport']==2 ? ' selected="selected"' : '' ); ?>>Inside Radius 8 miles - $35</option>
							<option value="3"<?php echo ( $cat_rsrv['transport']==3 ? ' selected="selected"' : '' ); ?>>Sunday/Holiday Within 8 miles - $45</option>
						</select>
						<span class="ttw"><p class="tooltip">Please refer to our <a href="/in-home-cat-sitting/#visit" target="_blank">services page</a>  for further information on our radius and rates.</p></span>
						</li>
						<li> </br></li>
						<li ><strong>Note that: </strong>We require an hour time frame that you would like your kitty transported to your home. This time frame must fall between 9:00am-6:00pm. There is no guarantee that this transportation can be done until you have received a call to confirm it with you from The Cats' Inn. </li>
						<li class="buttons"><input type="hidden" name="formtype" id="formtype" value="newclient" /><?php echo ( $hasid ? '<input type="hidden" name="ID" id="ID" value="' . $_GET['rid'] . '" />' : '' ); ?><button class="back" onclick="switchFormTab(2);return false;">Back</button> <button class="cancel" onclick="history.back(-1);return false;">Cancel</button> <button class="submit" onclick="this.form.submit();">Submit</button></li>
					</ul>
				</div>
			</form>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
