<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*Get Current User Info*/
function service_finder_getCurrentUserInfo(){
			global $wpdb, $service_finder_Tables;
			$currUser = wp_get_current_user(); 
			$fname = get_user_meta($currUser->ID,'first_name',true);
			$lname = get_user_meta($currUser->ID,'last_name',true);	
			
			if(service_finder_getUserRole($currUser->ID) == 'Provider'){
			
				/* Get Provider info */
				$sedateProvider = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' where wp_user_id = %d',$currUser->ID));
				
				$address = (!empty($sedateProvider->address)) ? $sedateProvider->address : '';
				$city = (!empty($sedateProvider->city)) ? $sedateProvider->city: '';
				$state = (!empty($sedateProvider->state)) ? $sedateProvider->state : '';
				$country = (!empty($sedateProvider->country)) ? $sedateProvider->country : '';
				
				$state = (!empty($state)) ? ', '.esc_html($state) : '';
						
				$fulladdress = $address.', '.$city.$state.', '.$country;
				
				$service_perform = get_user_meta($currUser->ID,'service_perform',true);
				$my_location = get_user_meta($currUser->ID,'my_location',true);
				$providerlat = get_user_meta($currUser->ID,'providerlat',true);
				$providerlng = get_user_meta($currUser->ID,'providerlng',true);	
				
				$userinfo = array(
							$currUser,
							'company_name' => (!empty($sedateProvider->company_name)) ? $sedateProvider->company_name : '',
							'fname' => $fname,
							'lname' => $lname,
							'email' => (!empty($sedateProvider->email)) ? $sedateProvider->email : '',
							'avatar_id' => (!empty($sedateProvider->avatar_id)) ? $sedateProvider->avatar_id : '',
							'provider_id' => (!empty($sedateProvider->id)) ? $sedateProvider->id : '',
							'identity' => (!empty($sedateProvider->identity)) ? $sedateProvider->identity : '',
							'phone' => (!empty($sedateProvider->phone)) ? $sedateProvider->phone : '',
							'category' => (!empty($sedateProvider->category_id)) ? $sedateProvider->category_id : '',
							'categoryname' => service_finder_getCategoryName(get_user_meta($currUser->ID,'primary_category',true)),
							'tagline' => (!empty($sedateProvider->tagline)) ? $sedateProvider->tagline : '',
							'bio' => (!empty($sedateProvider->bio)) ? $sedateProvider->bio : '',
							'booking_description' => (!empty($sedateProvider->booking_description)) ? $sedateProvider->booking_description : '',
							'embeded_code' => (!empty($sedateProvider->embeded_code)) ? $sedateProvider->embeded_code : '',
							'mobile' => (!empty($sedateProvider->mobile)) ? $sedateProvider->mobile : '',
							'fax' => (!empty($sedateProvider->fax)) ? $sedateProvider->fax : '',
							'lat' => (!empty($sedateProvider->lat)) ? $sedateProvider->lat : '',
							'long' => (!empty($sedateProvider->long)) ? $sedateProvider->long : '',
							'facebook' => (!empty($sedateProvider->facebook)) ? $sedateProvider->facebook : '',
							'twitter' => (!empty($sedateProvider->twitter)) ? $sedateProvider->twitter : '',
							'linkedin' => (!empty($sedateProvider->linkedin)) ? $sedateProvider->linkedin : '',
							'pinterest' => (!empty($sedateProvider->pinterest)) ? $sedateProvider->pinterest : '',
							'digg' => (!empty($sedateProvider->digg)) ? $sedateProvider->digg : '',
							'google_plus' => (!empty($sedateProvider->google_plus)) ? $sedateProvider->google_plus : '',
							'instagram' => (!empty($sedateProvider->instagram)) ? $sedateProvider->instagram : '',
							'skypeid' => (!empty($sedateProvider->skypeid)) ? $sedateProvider->skypeid : '',
							'website' => (!empty($sedateProvider->website)) ? $sedateProvider->website : '',
							'address' => (!empty($address)) ? $address : '',
							'apt' => (!empty($sedateProvider->apt)) ? $sedateProvider->apt : '',
							'city' => (!empty($sedateProvider->city)) ? $sedateProvider->city : '',
							'state' => (!empty($sedateProvider->state)) ? $sedateProvider->state : '',
							'zipcode' => (!empty($sedateProvider->zipcode)) ? $sedateProvider->zipcode : '',
							'country' => (!empty($sedateProvider->country)) ? $sedateProvider->country : '',
							'service_perform' => $service_perform,
							'my_location' => $my_location,
							'providerlat' => $providerlat,
							'providerlng' => $providerlng,
							'amenities' => (!empty($sedateProvider->amenities)) ? $sedateProvider->amenities : '',
							'languages' => (!empty($sedateProvider->languages)) ? $sedateProvider->languages : '',
							);
				return $userinfo;	
			
			}else{
				
				/* Get Customer info */
				$sedateCustomer = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers_data.' where wp_user_id = %d',$currUser->ID));
				
				$userinfo = array(
							$currUser,
							'fname' => $fname,
							'lname' => $lname,
							'phone' => (!empty($sedateCustomer->phone)) ? $sedateCustomer->phone : '',
							'phone2' => (!empty($sedateCustomer->phone2)) ? $sedateCustomer->phone2 : '',
							'address' =>(!empty($sedateCustomer->address)) ? $sedateCustomer->address : '',
							'apt' => (!empty($sedateCustomer->apt)) ? $sedateCustomer->apt : '',
							'city' => (!empty($sedateCustomer->city)) ? $sedateCustomer->city : '',
							'state' => (!empty($sedateCustomer->state)) ? $sedateCustomer->state : '',
							'zipcode' => (!empty($sedateCustomer->zipcode)) ? $sedateCustomer->zipcode : '',
							'country' => (!empty($sedateCustomer->country)) ? $sedateCustomer->country : '',
							'avatar_id' => (!empty($sedateCustomer->avatar_id)) ? $sedateCustomer->avatar_id : '',
							);
				return $userinfo;
				
			}		
	}
	
/*Get User Info by ID*/
function service_finder_getUserInfo($userid = 0){
			global $wpdb, $service_finder_Tables;
			if($userid > 0){
			$fname = get_user_meta($userid,'first_name',true);
			$lname = get_user_meta($userid,'last_name',true);	
			}else{
			$fname = '';
			$lname = '';	
			}
			
			if(service_finder_getUserRole($userid) == 'Provider'){
			
				/* Get Provider info */
				$sedateProvider = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' where wp_user_id = %d',$userid));
				
				$address = (!empty($sedateProvider->address)) ? $sedateProvider->address : '';
				$city = (!empty($sedateProvider->city)) ? $sedateProvider->city: '';
				$state = (!empty($sedateProvider->state)) ? $sedateProvider->state : '';
				$country = (!empty($sedateProvider->country)) ? $sedateProvider->country : '';
				
				$state = (!empty($state)) ? ', '.esc_html($state) : '';
						
				$fulladdress = $address.', '.$city.$state.', '.$country;
				
				$service_perform = get_user_meta($userid,'service_perform',true);
				$my_location = get_user_meta($userid,'my_location',true);
				$providerlat = get_user_meta($userid,'providerlat',true);
				$providerlng = get_user_meta($userid,'providerlng',true);	
				
				$userinfo = array(
							'company_name' => (!empty($sedateProvider->company_name)) ? $sedateProvider->company_name : '',
							'fname' => (!empty($fname)) ? $fname : '',
							'lname' => (!empty($lname)) ? $lname : '',
							'email' => (!empty($sedateProvider->email)) ? $sedateProvider->email : '',
							'avatar_id' => (!empty($sedateProvider->avatar_id)) ? $sedateProvider->avatar_id : '',
							'provider_id' => (!empty($sedateProvider->id)) ? $sedateProvider->id : '',
							'identity' => (!empty($sedateProvider->identity)) ? $sedateProvider->identity : '',
							'phone' => (!empty($sedateProvider->phone)) ? $sedateProvider->phone : '',
							'category' => (!empty($sedateProvider->category_id)) ? $sedateProvider->category_id : '',
							'categoryname' => service_finder_getCategoryName(get_user_meta($userid,'primary_category',true)),
							'tagline' => (!empty($sedateProvider->tagline)) ? $sedateProvider->tagline : '',
							'bio' => (!empty($sedateProvider->bio)) ? $sedateProvider->bio : '',
							'booking_description' => (!empty($sedateProvider->booking_description)) ? $sedateProvider->booking_description : '',
							'embeded_code' => (!empty($sedateProvider->embeded_code)) ? $sedateProvider->embeded_code : '',
							'mobile' => (!empty($sedateProvider->mobile)) ? $sedateProvider->mobile : '',
							'fax' => (!empty($sedateProvider->fax)) ? $sedateProvider->fax : '',
							'lat' => (!empty($sedateProvider->lat)) ? $sedateProvider->lat : '',
							'long' => (!empty($sedateProvider->long)) ? $sedateProvider->long : '',
							'facebook' => (!empty($sedateProvider->facebook)) ? $sedateProvider->facebook : '',
							'twitter' => (!empty($sedateProvider->twitter)) ? $sedateProvider->twitter : '',
							'linkedin' => (!empty($sedateProvider->linkedin)) ? $sedateProvider->linkedin : '',
							'pinterest' => (!empty($sedateProvider->pinterest)) ? $sedateProvider->pinterest : '',
							'digg' => (!empty($sedateProvider->digg)) ? $sedateProvider->digg : '',
							'google_plus' => (!empty($sedateProvider->google_plus)) ? $sedateProvider->google_plus : '',
							'instagram' => (!empty($sedateProvider->instagram)) ? $sedateProvider->instagram : '',
							'skypeid' => (!empty($sedateProvider->skypeid)) ? $sedateProvider->skypeid : '',
							'website' => (!empty($sedateProvider->website)) ? $sedateProvider->website : '',
							'simpleaddress' => (!empty($sedateProvider->address)) ? $sedateProvider->address : '',
							'address' => $address,
							'apt' => (!empty($sedateProvider->apt)) ? $sedateProvider->apt : '',
							'city' => (!empty($sedateProvider->city)) ? $sedateProvider->city : '',
							'state' => (!empty($sedateProvider->state)) ? $sedateProvider->state : '',
							'zipcode' => (!empty($sedateProvider->zipcode)) ? $sedateProvider->zipcode : '',
							'country' => (!empty($sedateProvider->country)) ? $sedateProvider->country : '',
							'service_perform' => $service_perform,
							'my_location' => $my_location,
							'providerlat' => $providerlat,
							'providerlng' => $providerlng,
							'amenities' => (!empty($sedateProvider->amenities)) ? $sedateProvider->amenities : '',
							'languages' => (!empty($sedateProvider->languages)) ? $sedateProvider->languages : '',
							);
				return $userinfo;	
			
			}else{
				
				/* Get Customer info */
				$sedateCustomer = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers_data.' where wp_user_id = %d',$userid));
				$customerinfo =  get_userdata($userid);
				
				$userinfo = array(
							'fname' => $fname,
							'lname' => $lname,
							'email' => (!empty($customerinfo->user_email)) ? $customerinfo->user_email : '',
							'phone' => (!empty($sedateCustomer->phone)) ? $sedateCustomer->phone : '',
							'phone2' => (!empty($sedateCustomer->phone2)) ? $sedateCustomer->phone2 : '',
							'address' => (!empty($sedateCustomer->address)) ? $sedateCustomer->address : '',
							'apt' => (!empty($sedateCustomer->apt)) ? $sedateCustomer->apt : '',
							'city' => (!empty($sedateCustomer->city)) ? $sedateCustomer->city : '',
							'state' => (!empty($sedateCustomer->state)) ? $sedateCustomer->state : '',
							'zipcode' => (!empty($sedateCustomer->zipcode)) ? $sedateCustomer->zipcode : '',
							'country' => (!empty($sedateCustomer->country)) ? $sedateCustomer->country : '',
							'avatar_id' => (!empty($sedateCustomer->avatar_id)) ? $sedateCustomer->avatar_id: '',
							);
				return $userinfo;
				
			}		
	}	

/*Get Providers Settings*/
function service_finder_getProviderSettings($uid){
		global $wpdb, $service_finder_Tables;

		$options = unserialize(get_option( 'provider_settings'));
		if($uid > 0){
		$settings = array(
							'booking_process' => (!empty($options[$uid]['booking_process'])) ? $options[$uid]['booking_process'] : '',
							'availability_based_on' => (!empty($options[$uid]['availability_based_on'])) ? $options[$uid]['availability_based_on'] : '',
							'slot_interval' => (!empty($options[$uid]['slot_interval'])) ? $options[$uid]['slot_interval'] : '',
							'offers_based_on' => (!empty($options[$uid]['offers_based_on'])) ? $options[$uid]['offers_based_on'] : '',
							'booking_date_based_on' => (!empty($options[$uid]['booking_date_based_on'])) ? $options[$uid]['booking_date_based_on'] : '',
							'booking_basedon' => (!empty($options[$uid]['booking_basedon'])) ? $options[$uid]['booking_basedon'] : '',
							'booking_charge_on_service' => (!empty($options[$uid]['booking_charge_on_service'])) ? $options[$uid]['booking_charge_on_service'] : '',
							'booking_option' => (!empty($options[$uid]['booking_option'])) ? $options[$uid]['booking_option'] : '',
							'mincost' => (!empty($options[$uid]['mincost'])) ? $options[$uid]['mincost'] : '',
							'future_bookings_availability' => (!empty($options[$uid]['future_bookings_availability'])) ? $options[$uid]['future_bookings_availability'] : '',
							'booking_assignment' => (!empty($options[$uid]['booking_assignment'])) ? $options[$uid]['booking_assignment'] : '',
							'members_available' => (!empty($options[$uid]['members_available'])) ? $options[$uid]['members_available'] : '',
							'paymentoption' => (!empty($options[$uid]['paymentoption'])) ? $options[$uid]['paymentoption'] : '',
							'paypalusername' => (!empty($options[$uid]['paypalusername'])) ? $options[$uid]['paypalusername'] : '',
							'paypalpassword' => (!empty($options[$uid]['paypalpassword'])) ? $options[$uid]['paypalpassword'] : '',
							'paypalsignatue' => (!empty($options[$uid]['paypalsignatue'])) ? $options[$uid]['paypalsignatue'] : '',
							'stripesecretkey' => (!empty($options[$uid]['stripesecretkey'])) ? $options[$uid]['stripesecretkey'] : '',
							'stripepublickey' => (!empty($options[$uid]['stripepublickey'])) ? $options[$uid]['stripepublickey'] : '',
							'wired_description' => (!empty($options[$uid]['wired_description'])) ? $options[$uid]['wired_description'] : '',
							'wired_instructions' => (!empty($options[$uid]['wired_instructions'])) ? $options[$uid]['wired_instructions'] : '',
							'twocheckoutaccountid' => (!empty($options[$uid]['twocheckoutaccountid'])) ? $options[$uid]['twocheckoutaccountid'] : '',
							'twocheckoutpublishkey' => (!empty($options[$uid]['twocheckoutpublishkey'])) ? $options[$uid]['twocheckoutpublishkey'] : '',
							'twocheckoutprivatekey' => (!empty($options[$uid]['twocheckoutprivatekey'])) ? $options[$uid]['twocheckoutprivatekey'] : '',
							'payumoneymid' => (!empty($options[$uid]['payumoneymid'])) ? $options[$uid]['payumoneymid'] : '',
							'payumoneykey' => (!empty($options[$uid]['payumoneykey'])) ? $options[$uid]['payumoneykey'] : '',
							'payumoneysalt' => (!empty($options[$uid]['payumoneysalt'])) ? $options[$uid]['payumoneysalt'] : '',
							'payulatammerchantid' => (!empty($options[$uid]['payulatammerchantid'])) ? $options[$uid]['payulatammerchantid'] : '',
							'payulatamapilogin' => (!empty($options[$uid]['payulatamapilogin'])) ? $options[$uid]['payulatamapilogin'] : '',
							'payulatamapikey' => (!empty($options[$uid]['payulatamapikey'])) ? $options[$uid]['payulatamapikey'] : '',
							'payulatamaccountid' => (!empty($options[$uid]['payulatamaccountid'])) ? $options[$uid]['payulatamaccountid'] : '',
							'google_calendar' => (!empty($options[$uid]['google_calendar'])) ? $options[$uid]['google_calendar'] : '',
							);
		return $settings;
		}
}

/*Get User Role By ID*/
function service_finder_getUserRole($userid){
if($userid > 0){
	$user = new WP_User( $userid );
	return (!empty($user->roles[0])) ? $user->roles[0] : '';
}	
}

/*Fetch Category List Array*/
function service_finder_getCategoryList($limit = '',$child=false,$texonomy = 'providers-category'){
	global $wpdb, $service_finder_Tables;
	
	if($child == 'true'){
		$parent = '';
	}else{
		$parent = 0;
	}
	$args = array(
		'orderby'           => 'name',
		'order'             => 'ASC',
		'number'            => $limit,
		'parent'            => $parent,
		'hide_empty'        => false, 
	); 
	return $categories = get_terms( $texonomy,$args );
}

/*Fetch Amenity List Array*/
function service_finder_getAmenityList($limit = '',$child=false){
	global $wpdb, $service_finder_Tables;
	
	if($child == 'true'){
		$parent = '';
	}else{
		$parent = 0;
	}
	$args = array(
		'orderby'           => 'name',
		'order'             => 'ASC',
		'number'            => $limit,
		'parent'            => $parent,
		'hide_empty'        => false, 
	); 
	return $categories = get_terms( 'sf-amenities',$args );
}

/*Fetch Language List Array*/
function service_finder_getLanguageList($limit = '',$child=false){
	global $wpdb, $service_finder_Tables;
	
	if($child == 'true'){
		$parent = '';
	}else{
		$parent = 0;
	}
	$args = array(
		'orderby'           => 'name',
		'order'             => 'ASC',
		'number'            => $limit,
		'parent'            => $parent,
		'hide_empty'        => false, 
	); 
	return $categories = get_terms( 'sf-languages',$args );
}


/*Fetch Category List Array*/
function service_finder_get_child_category($parentid){
	global $wpdb, $service_finder_Tables;
	
	$args = array(
		'orderby'           => 'name',
		'order'             => 'ASC',
		'number'            => 0,
		'child_of'          => $parentid,
		'hide_empty'        => false, 
	); 
	return $categories = get_terms( 'providers-category',$args );
}

/*Fetch Category List Array*/
function service_finder_getCategoryListwithOffest($limit = '',$child=false,$offset = 0){
	global $wpdb, $service_finder_Tables;
	
	if($child == 'true'){
		$parent = '';
	}else{
		$parent = 0;
	}
	$args = array(
		'orderby'           => 'name',
		'order'             => 'ASC',
		'offset'            => $offset,
		'number'            => $limit,
		'parent'            => $parent,
		'hide_empty'        => false, 
	); 

	return $categories = get_terms( 'providers-category',$args );
}

/*Get Category Link*/
function service_finder_getCategoryLink($catid){
	global $wpdb, $service_finder_Tables;
	
	if($catid > 0){
	$catdetails = get_term_by('id', $catid, 'providers-category');
	if(!empty($catdetails)){
	$link = get_term_link( $catdetails );
	return $link;
	}else{
	return '';
	}
	}else{
	return '';
	}
}

/*Get Provider Services*/
function service_finder_getServices($uid,$status = '',$groupid = 0){
	global $wpdb, $service_finder_Tables;
	
	if($status == 'active'){
	$services = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->services.' WHERE `status` = "active" AND `wp_user_id` = %d',$uid));
	}else{
	if($groupid != '' && $groupid > 0){
	$services = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->services.' WHERE group_id = %d AND `wp_user_id` = %d',$groupid,$uid));
	}else{
	$services = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->services.' WHERE group_id = 0 AND `wp_user_id` = %d',$uid));
	}
	}
	
	return $services;
}

/*Get Provider Services*/
function service_finder_getAllServices($uid,$status = ''){
	global $wpdb, $service_finder_Tables;
	
	if($status == 'active'){
	$services = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->services.' WHERE `status` = "active" AND `wp_user_id` = %d',$uid));
	}else{
	$services = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->services.' WHERE `wp_user_id` = %d',$uid));
	}
	
	return $services;
}

/*Get Provider Service Data*/
function service_finder_getServiceData($sid){
	global $wpdb, $service_finder_Tables;
	
	$servicedata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->services.' WHERE `id` = %d',$sid));
	
	return $servicedata;
}

/*Get Provider Service Data*/
function service_finder_getServiceName($sid){
	global $wpdb, $service_finder_Tables;
	
	$row = $wpdb->get_row($wpdb->prepare('SELECT service_name FROM '.$service_finder_Tables->services.' WHERE `id` = %d',$sid));
	
	return $row->service_name;
}

/*Get Provider Documents*/
function service_finder_getDocuments($uid){
	global $wpdb, $service_finder_Tables;
	
	$attachmentsIDs = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->attachments.' WHERE `type` = "file" AND `wp_user_id` = %d',$uid));
	
	return $attachmentsIDs;
}

/*Get Provider Identity*/
function service_finder_get_identity($uid){
	global $wpdb, $service_finder_Tables;
	
	$attachmentsIDs = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->attachments.' WHERE `type` = "identity" AND `wp_user_id` = %d',$uid));
	
	return $attachmentsIDs;
}

function service_finder_get_proviers_allcategories($uid){
	global $wpdb, $service_finder_Tables, $service_finder_options;
	$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$uid));
	if(!empty($row)){
		return $row->category_id;
	}else{
		return '';
	}
	
}

/*Fetch Related Providers List Array*/
function service_finder_getRelatedProviders($uid,$catid,$limit=5){
	global $wpdb, $service_finder_Tables, $service_finder_options, $current_user;
	
	$identitycheck = (isset($service_finder_options['identity-check'])) ? esc_attr($service_finder_options['identity-check']) : '';
	$restrictuserarea = (isset($service_finder_options['restrict-user-area'])) ? esc_attr($service_finder_options['restrict-user-area']) : '';
	
	$allcats = service_finder_get_proviers_allcategories($uid);
	$sql = '';
	
	
	if(is_user_logged_in() && service_finder_getUserRole($current_user->ID) != 'Customer'){
	$userInfo = service_finder_getCurrentUserInfo();
	$customercity = $userInfo['city'];	
	
	if($allcats != ""){
		$allcats = explode(',',$allcats);
		if(!empty($allcats)){
			$sql .= ' (';
			foreach($allcats as $allcatid){
				$sql .= ' FIND_IN_SET("'.$allcatid.'", category_id) OR ';
			}
			$sql .= ' `city` = %s ';	
			$sql .= ' )';
		}
	}
	
	if($restrictuserarea && $identitycheck){
	$providers = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE admin_moderation = "approved" AND identity = "approved" AND account_blocked != "yes" AND '.$sql.' AND `wp_user_id` != %d ORDER BY RAND() LIMIT %d',$customercity,$uid,$limit));
	}else{
	$providers = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE admin_moderation = "approved" AND account_blocked != "yes" AND '.$sql.' AND `wp_user_id` != %d ORDER BY RAND() LIMIT %d',$customercity,$uid,$limit));
	}
	}else{
	
	if($allcats != ""){
		$allcats = explode(',',$allcats);
		if(!empty($allcats)){
			$sql .= ' (';
			foreach($allcats as $allcatid){
				$sql .= ' FIND_IN_SET("'.$allcatid.'", category_id) OR ';
			}
			$sql .= ' FIND_IN_SET("'.$catid.'", category_id) ';	
			$sql .= ' )';
		}
	}
	
	if($restrictuserarea && $identitycheck){
	$providers = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE admin_moderation = "approved" AND identity = "approved" AND account_blocked != "yes" AND '.$sql.' AND `wp_user_id` != %d ORDER BY RAND() LIMIT %d',$uid,$limit));
	}else{
	$providers = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE admin_moderation = "approved" AND account_blocked != "yes" AND '.$sql.' AND `wp_user_id` != %d ORDER BY RAND() LIMIT %d',$uid,$limit));
	}
	}
	
	return $providers;
}

/*Fetch Provider Attachments*/
function service_finder_getProviderAttachments($uid,$type){
	global $wpdb, $service_finder_Tables;
	$attachments = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->attachments.' WHERE `type` = "%s" AND `wp_user_id` = %d',$type,$uid));
	
	return $attachments;
}

/*Fetch Service Area*/
function service_finder_getServiceArea($uid){
	global $wpdb, $service_finder_Tables;
	$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->service_area.' WHERE `provider_id` = %d AND `status` = "active"',$uid));
	
	return $results;
}

/*Fetch All Service Area*/
function service_finder_getAllServiceArea($uid){
	global $wpdb, $service_finder_Tables;
	$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->service_area.' WHERE `provider_id` = %d',$uid));
	
	return $results;
}

/*Fetch Service Regions*/
function service_finder_getServiceRegions($uid){
	global $wpdb, $service_finder_Tables;
	$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->regions.' WHERE `status` = "active" AND `provider_id` = %d',$uid));
	
	return $results;
}

/*Fetch All Service Regions*/
function service_finder_getAllServiceRegions($uid){
	global $wpdb, $service_finder_Tables;
	$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->regions.' WHERE `provider_id` = %d',$uid));
	
	return $results;
}

/*Fetch Staff Members*/
function service_finder_getStaffMembers($uid,$zipcode='',$date,$slot ='',$memberid = 0,$editbooking = '',$region=''){
	global $wpdb, $service_finder_Tables;
	
	$settings = service_finder_getProviderSettings($uid);
	
	$dayname = date('l', strtotime( $date ));
	$tem = explode('-',$slot);
	$start_time = (!empty($tem[0])) ? $tem[0] : '';
	$end_time = (!empty($tem[1])) ? $tem[1] : '';
	
	if($memberid > 0){
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`start_time` = "'.$start_time.'" AND `bookings`.`end_time` = "'.$end_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`start_time` = "'.$start_time.'" AND `bookings`.`end_time` = "'.$end_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`start_time` = "'.$start_time.'" AND `bookings`.`end_time` = "'.$end_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}elseif($slot == ''){
		
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
		
	}else{
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`start_time` = "'.$start_time.'" AND `bookings`.`end_time` = "'.$end_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`start_time` = "'.$start_time.'" AND `bookings`.`end_time` = "'.$end_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`start_time` = "'.$start_time.'" AND `bookings`.`end_time` = "'.$end_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}

	return $members;
}

function service_finder_getStaffMembersList($uid,$sid,$zipcode='',$region=''){
	global $wpdb, $service_finder_Tables;
	
	$settings = service_finder_getProviderSettings($uid);
	
	if($settings['booking_basedon'] == 'zipcode'){
	$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE `is_admin` = "no" AND FIND_IN_SET("'.$sid.'",services) AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
	}elseif($settings['booking_basedon'] == 'region'){
	$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE `is_admin` = "no" AND FIND_IN_SET("'.$sid.'",services) AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
	}elseif($settings['booking_basedon'] == 'open'){
	$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE `is_admin` = "no" AND FIND_IN_SET("'.$sid.'",services) AND `admin_wp_id` = '.$uid);
	}
	
	return $members;
}

/*Fetch Staff Members*/
function service_finder_getStaffMembersStartTime($uid,$zipcode='',$date,$slot ='',$memberid = 0,$editbooking = '',$region=''){
	global $wpdb, $service_finder_Tables;
	
	$settings = service_finder_getProviderSettings($uid);
	
	$dayname = date('l', strtotime( $date ));
	$tem = explode('-',$slot);
	$start_time = (!empty($tem[0])) ? $tem[0] : '';
	$end_time = (!empty($tem[1])) ? $tem[1] : '';
	
	if($memberid > 0){
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}elseif($slot == ''){
		
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
		
	}else{
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}

	return $members;
}

/*Fetch Staff Members Edit*/
function service_finder_getStaffMembersStartTimeEdit($uid,$zipcode='',$date,$slot ='',$memberid = 0,$editbooking = '',$region='',$bookingid = 0){
	global $wpdb, $service_finder_Tables;
	
	$settings = service_finder_getProviderSettings($uid);
	
	$dayname = date('l', strtotime( $date ));
	$tem = explode('-',$slot);
	$start_time = (!empty($tem[0])) ? $tem[0] : '';
	$end_time = (!empty($tem[1])) ? $tem[1] : '';
	
	if($memberid > 0){
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}elseif($slot == ''){
		
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
		
	}else{
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}

	return $members;
}

/*Fetch Staff Members no hours*/
function service_finder_getStaffMembersStartTime_nohours($uid,$zipcode='',$date,$start_time ='',$memberid = 0,$editbooking = '',$region=''){
	global $wpdb, $service_finder_Tables;
	
	$settings = service_finder_getProviderSettings($uid);
	
	$dayname = date('l', strtotime( $date ));
	
	if($memberid > 0){
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND start_time = "'.$start_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND start_time = "'.$start_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND start_time = "'.$start_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}elseif($start_time == ''){
		
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
		
	}else{
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND start_time = "'.$start_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND start_time = "'.$start_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND start_time = "'.$start_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}

	return $members;
}

/*Fetch Staff Members no hours Edit*/
function service_finder_getStaffMembersStartTimeEdit_nohours($uid,$zipcode='',$date,$start_time ='',$memberid = 0,$editbooking = '',$region='',$bookingid = 0){
	global $wpdb, $service_finder_Tables;
	
	$settings = service_finder_getProviderSettings($uid);
	
	$dayname = date('l', strtotime( $date ));
	
	if($memberid > 0){
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND start_time = "'.$start_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND start_time = "'.$start_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND start_time = "'.$start_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}elseif($start_time == ''){
		
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
		
	}else{
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND start_time = "'.$start_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND start_time = "'.$start_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND start_time = "'.$start_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}

	return $members;
}


/*Get Members for Schedule Calendar*/
function service_finder_getMembers($uid){
global $wpdb, $service_finder_Tables;
		
		$members = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->team_members.' WHERE `is_admin` = "no" AND `admin_wp_id` = %d',$uid));
		return $members;
		
}

/*Get Members for Schedule Calendar*/
function service_finder_getMemberName($mid){
global $wpdb, $service_finder_Tables;
		
		$member = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->team_members.' WHERE `id` = %d',$mid));
		return $member->member_name;
		
}

/*Get Members for Schedule Calendar*/
function service_finder_getMemberEmail($mid){
global $wpdb, $service_finder_Tables;
		
		$member = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->team_members.' WHERE `id` = %d',$mid));
		return $member->email;
		
}

/*Get Members for Schedule Calendar*/
function service_finder_getMemberAvatar($mid){
global $wpdb, $service_finder_Tables, $service_finder_Params;
		
		$member = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->team_members.' WHERE `id` = %d',$mid));
		
		$src  = wp_get_attachment_image_src( $member->avatar_id, 'service_finder-staff-member' );
		$src  = $src[0];
		$src = ($src != '') ? $src : '';
		
		return $src;
		
}

/*Get Category Image*/
function service_finder_getCategoryImage($cid,$imagesize = 'medium'){
global $wpdb, $service_finder_Tables;
		
		if($cid > 0){
		$term_meta_image = get_option( "providers-category_image_".$cid );
		$providerimage = (!empty($term_meta_image)) ? esc_attr( $term_meta_image ) : '';
		if($providerimage != ""){
			$imageid = service_finder_get_image_id_by_link($providerimage);
			$image_attributes = wp_get_attachment_image_src( $imageid, $imagesize );
			return $image_attributes[0];
		}else{
			return '';		
		}
		}else{
			return '';
		}
												
}

/** Get Category name by catgory id*/
function service_finder_getCategoryName($cid,$taxonomy = 'providers-category'){
		if($cid > 0){
		$term = get_term( $cid, $taxonomy );
		if(!empty($term)){
		return (!empty($term->name)) ? $term->name : '';
		}else{
		return '';
		}
		}else{
		return '';
		}
}

/** Get Category description by catgory id*/
function service_finder_getCategoryDescription($cid,$taxonomy = 'providers-category'){
		if($cid > 0){
		$term = get_term( $cid, $taxonomy );
		if(!empty($term)){
		return (!empty($term->description)) ? $term->description : '';
		}else{
		return '';
		}
		}else{
		return '';
		}
}

/** Get Category name by catgory id via sql query*/
function service_finder_getCategoryNameviaSql($cid){
		global $wpdb;
		$term = $wpdb->get_row($wpdb->prepare('SELECT * FROM `'.$wpdb->prefix.'terms` WHERE `term_id` = %d',$cid));
		return $term->name;
}

/*Get Category Icon*/
function service_finder_getCategoryIcon($cid, $size = 'service_finder-marker-icon'){
global $wpdb, $service_finder_Tables, $service_finder_options;
		
		if($cid > 0){
		$term_meta_icon = get_option( "providers-category_icon_".$cid );
		$providerimage = esc_attr( $term_meta_icon ) ? esc_attr( $term_meta_icon ) : '';
		$icon = (!empty($service_finder_options['default-map-marker-icon']['url'])) ? $service_finder_options['default-map-marker-icon']['url'] : '';
		
		$imgid = service_finder_get_image_id_by_link($providerimage);
		$src = wp_get_attachment_image_src( $imgid, $size );
		
		if($src[0] != ""){
			return $src[0];
		}else{
			$term = get_term( $cid, "providers-category" );
			$term_parent = '';
			if(!empty($term)){
				$term_parent = (isset($term->parent)) ? $term->parent : '';
			}
			if($term_parent > 0){
				$termid = $term->parent;
				$term_meta_icon = get_option( "providers-category_icon_".$termid );
				$providerimage = esc_attr( $term_meta_icon ) ? esc_attr( $term_meta_icon ) : '';
				
				$imgid = service_finder_get_image_id_by_link($providerimage);
				$src = wp_get_attachment_image_src( $imgid, $size );
				
				if($size == 'service_finder-marker-icon'){
					if($src[0] != ""){
						return $src[0];
					}elseif($icon != ''){
						return $icon;
					}else{
						return '';
					}
				}else{
					if($src[0] != ""){
						return $src[0];
					}else{
						return '';
					}
				}
				
			}else{
				if($size == 'service_finder-marker-icon'){
					if($icon != ''){
						return $icon;
					}else{
						return '';
					}
				}else{
					return '';
				}
				
			}
		}
		}else{
			return '';
		}
												
}

/*Get Category Icon*/
function service_finder_getTermIcon($cid, $size = 'service_finder-amenity-icon'){
global $wpdb, $service_finder_Tables, $service_finder_options;
		
		if($cid > 0){
		$term_meta_icon = get_option( "cat_icon_".$cid );
		$providerimage = esc_attr( $term_meta_icon ) ? esc_attr( $term_meta_icon ) : '';
		$icon = (!empty($service_finder_options['default-map-marker-icon']['url'])) ? $service_finder_options['default-map-marker-icon']['url'] : '';
		
		$imgid = service_finder_get_image_id_by_link($providerimage);
		$src = wp_get_attachment_image_src( $imgid, $size );
		
		if($src[0] != ""){
			return $src[0];
		}else{
			return '';
		}
			
		}											
}

/*Get Category Icon*/
function service_finder_getCategoryColor($cid){
global $wpdb, $service_finder_Tables, $service_finder_options;
		
		if($cid > 0){
		$categorycolor = get_term_meta( $cid, 'provider_category_color', true );
		
		if($categorycolor != ""){
			return $categorycolor;
		}else{
			$term = get_term( $cid, "providers-category" );
			$term_parent = '';
			if(!empty($term)){
				$term_parent = (isset($term->parent)) ? $term->parent : '';
			}
			if($term_parent > 0){
				$termid = $term->parent;
				$categorycolor = get_term_meta( $termid, 'provider_category_color', true );
				if($categorycolor != ""){
					return $categorycolor;
				}
			}else{
				return '';
			}
		}
		}else{
			return '';
		}
												
}

/*Get brache address*/
function service_finder_getBranches($bid){
global $wpdb,$service_finder_Tables;

$res = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->branches.' WHERE id = %d',$bid));
if(!empty($res)){
$address = $res->address;
$city = $res->city;
$state = $res->state;
$country = $res->country;

$state = (!empty($res->state)) ? ', '.esc_html($res->state) : '';
		
$fulladdress = $address.', '.$city.$state.', '.$country;

return $fulladdress;
}else{
return '';
}

}


/*Get Cities*/
function service_finder_getCities($country){
global $wpdb, $service_finder_Tables, $service_finder_options;

$identitycheck = (isset($service_finder_options['identity-check'])) ? esc_attr($service_finder_options['identity-check']) : '';
$restrictuserarea = (isset($service_finder_options['restrict-user-area'])) ? esc_attr($service_finder_options['restrict-user-area']) : '';
if($restrictuserarea && $identitycheck){
	$maincities = $wpdb->get_results($wpdb->prepare('SELECT DISTINCT city FROM '.$service_finder_Tables->providers.' WHERE admin_moderation = "approved" AND identity = "approved" AND account_blocked != "yes" AND `country` LIKE "%s" ORDER BY `city`',$country));
}else{
	$maincities = $wpdb->get_results($wpdb->prepare('SELECT DISTINCT city FROM '.$service_finder_Tables->providers.' WHERE admin_moderation = "approved" AND account_blocked != "yes" AND `country` LIKE "%s" ORDER BY `city`',$country));
}	

$branchcities = $wpdb->get_results($wpdb->prepare("select DISTINCT city from ".$service_finder_Tables->branches." WHERE country = '%s' ORDER BY `city`",$country));
				
$allcities = array();

if(!empty($maincities)){
foreach($maincities as $city){
	$allcities[] = $city->city;
}
}

if(!empty($branchcities)){
foreach($branchcities as $city){
	$allcities[] = $city->city;
}
}

$allcities = array_unique($allcities);
sort($allcities);
	
			$html = '<option value="">'.esc_html__('Select City', 'service-finder').'</option>';
			if(!empty($allcities)){
			foreach($allcities as $city){
				$html .= '<option value="'.esc_attr($city).'">'.$city.'</option>';
			}
			}else{
				$html .= '<option value="">'.esc_html__('No city available', 'service-finder').'</option>';
			}
		
	$success = array(
			'status' => 'success',
			'html' => $html,
			);
	$service_finder_Success = json_encode($success);
	return $service_finder_Success;
}

/*Get Packages for provider signup*/
function service_finder_getPackages($selectedpackage = ''){
global $wpdb, $service_finder_Tables, $service_finder_options;
$html = '';
$currency = service_finder_currencycode();
for ($i=0; $i <= 3; $i++) {
					if (isset($service_finder_options['payment-type']) && ($service_finder_options['payment-type'] == 'recurring') && $i > 0) {
						$billingPeriod = esc_html__('year','service-finder');
						$packagebillingperiod = (!empty($service_finder_options['package'.$i.'-billing-period'])) ? $service_finder_options['package'.$i.'-billing-period'] : '';
						switch ($packagebillingperiod) {
							case 'Year':
								$billingPeriod = esc_html__('year','service-finder');
								break;
							case 'Month':
								$billingPeriod = esc_html__('month','service-finder');
								break;
							case 'Week':
								$billingPeriod = esc_html__('week','service-finder');
								break;
							case 'Day':
								$billingPeriod = esc_html__('day','service-finder');
								break;
						}
					}
					$packageprice = (isset($service_finder_options['package'.$i.'-price']) && $i > 0) ? $service_finder_options['package'.$i.'-price'] : '';
					$enablepackage = (!empty($service_finder_options['enable-package'.$i])) ? $service_finder_options['enable-package'.$i] : '';
					$paymenttype = (!empty($service_finder_options['payment-type'])) ? $service_finder_options['payment-type'] : '';
					$packagename = (!empty($service_finder_options['package'.$i.'-name'])) ? $service_finder_options['package'.$i.'-name'] : '';
					
					$free = (trim($packageprice) == '0' || $i == 0) ? true : false;
					if(isset($service_finder_options['enable-package'.$i]) && $enablepackage > 0){
					
					if($selectedpackage == 'package_'.esc_attr($i)){
					$select = 'selected="selected"';
					}else{
					$select = '';
					}
					
						$html .= '<option '.$select.' value="package_'.esc_attr($i).'"'; 
						if($free) { $html .= ' class="free"'; } $html .= '>'.$packagename;
						$html .= '</option>';
					}
				}		

return $html;
}

/*Check is there only free package or not*/
function service_finder_check_only_free_package(){
global $service_finder_options;
$result = array();
$k = 0;
$flag = 0;
for ($i=0; $i <= 3; $i++) {
$packageprice = (isset($service_finder_options['package'.$i.'-price']) && $i > 0) ? $service_finder_options['package'.$i.'-price'] : 0;
$enablepackage = (!empty($service_finder_options['enable-package'.$i])) ? $service_finder_options['enable-package'.$i] : '';

if(isset($service_finder_options['enable-package'.$i]) && $enablepackage > 0){
if(intval($packageprice) == 0){
$packageid = $i;
$flag++;
}
$k++;
}
}		

if($k == 1 && $flag == 1){
$result = array(
	'freepackage' => 'yes',
	'packageid' => $packageid,
	);
return $result;
}else{
return $result;
}
}

/*Get Packages for claim business*/
function service_finder_claimed_getPackages($selectedpackage = ''){
global $wpdb, $service_finder_Tables, $service_finder_options;
$html = '';
$currency = service_finder_currencycode();
for ($i=1; $i <= 3; $i++) {
					if (isset($service_finder_options['payment-type']) && ($service_finder_options['payment-type'] == 'recurring')) {
						$billingPeriod = esc_html__('year','service-finder');
						$packagebillingperiod = (!empty($service_finder_options['package'.$i.'-billing-period'])) ? $service_finder_options['package'.$i.'-billing-period'] : '';
						switch ($packagebillingperiod) {
							case 'Year':
								$billingPeriod = esc_html__('year','service-finder');
								break;
							case 'Month':
								$billingPeriod = esc_html__('month','service-finder');
								break;
							case 'Week':
								$billingPeriod = esc_html__('week','service-finder');
								break;
							case 'Day':
								$billingPeriod = esc_html__('day','service-finder');
								break;
						}
					}
					$packageprice = (isset($service_finder_options['package'.$i.'-price']) && $i > 0) ? $service_finder_options['package'.$i.'-price'] : '';
					$enablepackage = (!empty($service_finder_options['enable-package'.$i])) ? $service_finder_options['enable-package'.$i] : '';
					$paymenttype = (!empty($service_finder_options['payment-type'])) ? $service_finder_options['payment-type'] : '';
					$packagename = (!empty($service_finder_options['package'.$i.'-name'])) ? $service_finder_options['package'.$i.'-name'] : '';
					
					$free = (trim($packageprice) == '0') ? true : false;
					if(isset($service_finder_options['enable-package'.$i])){
					
					if($selectedpackage == 'package_'.esc_attr($i)){
					$select = 'selected="selected"';
					}else{
					$select = '';
					}
					
						$html .= '<option '.$select.' value="package_'.esc_attr($i).'"'; 
						if($free) { $html .= ' class="free"'; } $html .= '>'.$packagename;
						if(!$free) {
							if (isset($service_finder_options['payment-type']) && ($paymenttype == 'recurring')) {
								$html .= ' - '.trim($packageprice).' '.$currency.' '.esc_html__('per','service-finder').' '.$billingPeriod;
							} else {
								$html .= ' ('.$packageprice.' '.service_finder_currencysymbol().')';
							}
						} 
						$html .= '</option>';
					}
				}		

return $html;
}

/*Check Provider Capability by package*/
function service_finder_get_capability($uid){
global $wpdb, $service_finder_options;
$package = get_user_meta($uid,'provider_role',true);
$userCap = array();
$packageNum = intval(substr($package, 8));
if($package != ''){
$cap = (!empty($service_finder_options['package'.$packageNum.'-capabilities'])) ? $service_finder_options['package'.$packageNum.'-capabilities'] : '';
$subcap = (!empty($service_finder_options['package'.$packageNum.'-subcapabilities'])) ? $service_finder_options['package'.$packageNum.'-subcapabilities'] : '';
	if(!empty($cap['booking'])){
	if($cap['booking']){
		$userCap[] = 'bookings';	
	}
	}
	if(!empty($cap['cover-image'])){
	if($cap['cover-image']){
		$userCap[] = 'cover-image';	
	}
	}
	if(!empty($cap['gallery-images'])){
	if($cap['gallery-images']){
		$userCap[] = 'gallery-images';	
	}
	}
	if(!empty($cap['multiple-categories'])){
	if($cap['multiple-categories']){
		$userCap[] = 'multiple-categories';	
	}
	}
	if(!empty($cap['apply-for-job'])){
	if($cap['apply-for-job']){
		$userCap[] = 'apply-for-job';	
	}
	}
	if(!empty($cap['job-alerts'])){
	if($cap['job-alerts']){
		$userCap[] = 'job-alerts';	
	}
	}
	if(!empty($cap['branches'])){
	if($cap['branches']){
		$userCap[] = 'branches';	
	}
	}
	if(!empty($cap['google-calendar'])){
	if($cap['google-calendar']){
		$userCap[] = 'google-calendar';	
	}
	}
	if(!empty($cap['message-system'])){
	if($cap['message-system']){
		$userCap[] = 'message-system';	
	}
	}
	if(!empty($subcap)){
		foreach($subcap as $key => $val){
			if($val){
				$userCap[] = $key;	
			}
		}
	}
}	

return $userCap;
}

/*Delete Provider's Data when delete user*/
function service_finder_deleteProvidersData($user_id){
global $wpdb, $service_finder_Tables;
/*Delete Providers*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->providers.' WHERE wp_user_id = %d',$user_id));

$commentpostid = get_user_meta($user_id, 'comment_post', true);

wp_delete_post( $commentpostid, true );

/*Delete User Attchments*/
$galleryattchments = service_finder_getProviderAttachments($user_id,'gallery');
foreach($galleryattchments as $galleryattchment){
wp_delete_attachment( $galleryattchment->attachmentid, true );
}
$galleryattchments = service_finder_getProviderAttachments($user_id,'file');
foreach($galleryattchments as $galleryattchment){
wp_delete_attachment( $galleryattchment->attachmentid, true );
}
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->attachments.' WHERE wp_user_id = %d',$user_id));

/*Delete providers bookings*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->bookings.' WHERE provider_id = %d',$user_id));

/*If user is customer then delete customer data from customer table*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->customers_data.' WHERE wp_user_id = %d',$user_id));
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->customers.' WHERE wp_user_id = %d',$user_id));

/*Delete Providers Feedback*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->feedback.' WHERE provider_id = %d',$user_id));

/*Delete Providers Invoice Generated*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->invoice.' WHERE provider_id = %d',$user_id));

/*Delete Providers Services*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->services.' WHERE wp_user_id = %d',$user_id));

/*Delete Providers Service Area*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->service_area.' WHERE provider_id = %d',$user_id));

/*Delete Providers Team Members*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->team_members.' WHERE admin_wp_id = %d',$user_id));

/*Delete Providers Timeslot*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->timeslots.' WHERE provider_id = %d',$user_id));

/*Delete Providers UnAvailability*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->unavailability.' WHERE provider_id = %d',$user_id));

/*Delete Feature Providers*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->feature.' WHERE provider_id = %d',$user_id));

/*Delete Providers from favorite*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->favorites.' WHERE provider_id = %d',$user_id));

}

/*Get Author's Link by Author ID*/
function service_finder_get_author_url($author_id, $author_nicename = '') {

	$link = get_author_posts_url($author_id);

	$link = apply_filters('author_link', $link, $author_id, $author_nicename);

	return $link;
}

/*Get Author's Link For Invoce Payment*/
function service_finder_get_invoice_author_url($author_id, $author_nicename = '',$invoice_id) {

	if(get_option('permalink_structure')){
		$link = get_author_posts_url($author_id).'?invoiceid='.service_finder_encrypt($invoice_id, 'Developer#@)!%').'#invoiceview';
	}else{
		$link = get_author_posts_url($author_id).'&invoiceid='.service_finder_encrypt($invoice_id, 'Developer#@)!%').'#invoiceview';
	}

	$link = apply_filters('author_link', $link, $author_id, $author_nicename);

	return $link;
}

// To Get attachment image ID By Image Link
function service_finder_get_image_id_by_link($link)
{
    global $wpdb;

    $newlink = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $link);

    $imageid = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE guid='%s'",$newlink));
 if(empty($imageid)){$imageid = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE guid='%s'",$link));}
 return $imageid;
}

/*Encrypt Qyery String*/
function service_finder_encrypt($id, $key)
{
    $id = base_convert($id, 10, 36); // Save some space
    $data = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $id, 'ecb');
    $data = bin2hex($data);

    return $data;
}

/*Decrypt Qyery String*/
function service_finder_decrypt($encrypted_id, $key)
{
    $data = pack('H*', $encrypted_id); // Translate back to binary
    $data = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $data, 'ecb');
    $data = base_convert($data, 36, 10);

    return $data;
}

/*Mailing Function*/
function service_finder_wpmailer($to,$subject,$message){
global $service_finder_options, $wp_filesystem;
	if ( empty( $wp_filesystem ) ) {
          require_once ABSPATH . '/wp-admin/includes/file.php';
          WP_Filesystem();
    }
	add_filter('wp_mail_content_type', 'service_finder_set_html_content_type');

	$emaillogo = (!empty($service_finder_options['email-logo']['url'])) ? $service_finder_options['email-logo']['url'] : '';
	
	$sitelogo = (!empty($service_finder_options['site-logo']['url'])) ? $service_finder_options['site-logo']['url'] : '';
	
	if($emaillogo != ""){
		$logo = '<img src="'.$emaillogo.'" style="max-width:100%; height:auto; display:block; margin:10px 0 20px;">';
	}elseif($sitelogo != ""){
		$logo = '<img src="'.$sitelogo.'" style="max-width:100%; height:auto; display:block; margin:10px 0 20px;">';
	}else{ 
		$logo = '';
	}

	$link_color = (!empty($service_finder_options['link-color'])) ? $service_finder_options['link-color'] : '#56C477';

	$template = $wp_filesystem->get_contents(SERVICE_FINDER_BOOKING_TEMPLATES_DIR.'/default.html', true);
	
	if(is_rtl()){  
	$dir = 'rtl';
	}else{
	$dir = 'ltr';
	}
	
	$filter = array('%SITELOGO%','%MAILBODY%','%LINKCOLOR%','%CHARSET%','%DIRECTION%');
	$replace = array($logo,wpautop($message),$link_color,get_bloginfo( 'charset' ),$dir);
	$headers = array('Content-Type: text/html; charset='.get_bloginfo( 'charset' ));
	$message = str_replace($filter, $replace, $template);

	if(wp_mail($to,$subject,$message,$headers)){
	return true;
	}else{
	return false;
	}
	
	remove_filter('wp_mail_content_type','service_finder_set_html_content_type');

}

/*Set content type for mail function*/
function service_finder_set_html_content_type() {
	return 'text/html';
}

/*Get page url by shortcode call withing that page*/
function service_finder_get_url_by_shortcode($shortcode) {
	global $wpdb;

	$url = '';

	$sql = 'SELECT ID FROM ' . $wpdb->posts . ' WHERE post_type = "page" AND post_status="publish" AND post_content LIKE "%'.$shortcode.'%"';

	if ($id = $wpdb->get_var($sql)) {
		$url = get_permalink($id);
	}

	return $url;
}

/*Get page id by shortcode call withing that page*/
function service_finder_get_page_id_by_shortcode($shortcode) {
	global $wpdb;

	$pageid = '';

	$sql = 'SELECT ID FROM ' . $wpdb->posts . ' WHERE post_type = "page" AND post_status="publish" AND post_content LIKE "%'.$shortcode.'%"';

	if ($id = $wpdb->get_var($sql)) {
		$pageid = $id;
	}

	return $pageid;
}

/*Get page id by shortcode call withing that page*/
function service_finder_get_id_by_shortcode($shortcode) {
	global $wpdb;

	$url = '';
	$pageids = array();

	$sql = 'SELECT ID FROM ' . $wpdb->posts . ' WHERE post_type = "page" AND post_status="publish" AND post_content LIKE "%'.$shortcode.'%"';

	if ($results = $wpdb->get_results($sql)) {
		foreach($results as $res){
			$pageids[] = $res->ID;
		}
	}
	return $pageids;

	
}

/*Get User avatar id by its user id*/
function service_finder_getUserAvatarID($userid){
global $wpdb,$service_finder_Tables;
$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' where wp_user_id = %d',$userid));
if(!empty($row)){
return $row->avatar_id;
}else{
return '';
}
}

/*Get User avatar id by its user id*/
function service_finder_getCustomerAvatarID($userid){
global $wpdb,$service_finder_Tables;
$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers_data.' where wp_user_id = %d',$userid));
if(!empty($row)){
return $row->avatar_id;
}else{
return '';
}
}

/*Get User avatar id by its user id*/
function service_finder_get_avatar_by_userid($userid){
global $wpdb,$service_finder_Tables;

if(service_finder_getUserRole($userid) == 'Customer'){
	$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers_data.' where wp_user_id = %d',$userid));
	if(!empty($row)){
	if($row->avatar_id > 0){
	return service_finder_get_user_profile_image($row->avatar_id);
	}else{
	return service_finder_get_default_avatar();
	}
	}else{
	return service_finder_get_default_avatar();
	}
	service_finder_get_user_profile_image($avatar_id);
}elseif(service_finder_getUserRole($userid) == 'Provider'){
	$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' where wp_user_id = %d',$userid));
	if(!empty($row)){
	if($row->avatar_id > 0){
	return service_finder_get_user_profile_image($row->avatar_id);
	}else{
	return service_finder_get_default_avatar();
	}
	}else{
	return service_finder_get_default_avatar();
	}
}else{
	return service_finder_get_default_avatar();
}
}

/*Get Total number of providers*/
function service_finder_totalProviders(){
global $wpdb,$service_finder_Tables, $service_finder_options;
$identitycheck = (isset($service_finder_options['identity-check'])) ? esc_attr($service_finder_options['identity-check']) : '';
$restrictuserarea = (isset($service_finder_options['restrict-user-area'])) ? esc_attr($service_finder_options['restrict-user-area']) : '';
if($restrictuserarea && $identitycheck){
$res = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->providers.' WHERE admin_moderation = "approved" AND identity = "approved" AND account_blocked != "yes"');
}else{
$res = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->providers.' WHERE admin_moderation = "approved" AND account_blocked != "yes"');
}
if(!empty($res)){
	return count($res);
}else{
	return 0;
}
}

/*Get Total number of customers*/
function service_finder_totalCustomers(){
global $wpdb,$service_finder_Tables;

$res = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->customers_data);

if(!empty($res)){
	return count($res);
}else{
	return 0;
}
}

/*Get feature providers*/
function service_finder_getFeaturedProviders($limit = 3,$categoryid = 0){
global $wpdb,$service_finder_Tables, $service_finder_options;
$identitycheck = (isset($service_finder_options['identity-check'])) ? esc_attr($service_finder_options['identity-check']) : '';
$restrictuserarea = (isset($service_finder_options['restrict-user-area'])) ? esc_attr($service_finder_options['restrict-user-area']) : '';

if($restrictuserarea && $identitycheck){
if($categoryid > 0){
$providers = $wpdb->get_results($wpdb->prepare('SELECT featured.id, provider.full_name, provider.phone, provider.mobile, provider.avatar_id, provider.bio, provider.category_id, featured.provider_id, featured.amount, featured.days, featured.status FROM '.$service_finder_Tables->feature.' as featured INNER JOIN '.$service_finder_Tables->providers.' as provider on featured.provider_id = provider.wp_user_id WHERE FIND_IN_SET("'.$categoryid.'", provider.category_id) AND identity = "approved" AND featured.feature_status = "active" AND (featured.status = "Paid" OR featured.status = "Free") ORDER BY RAND() limit 0,%d',$limit));
}else{
$providers = $wpdb->get_results($wpdb->prepare('SELECT featured.id, provider.full_name, provider.phone, provider.mobile, provider.avatar_id, provider.bio, provider.category_id, featured.provider_id, featured.amount, featured.days, featured.status FROM '.$service_finder_Tables->feature.' as featured INNER JOIN '.$service_finder_Tables->providers.' as provider on featured.provider_id = provider.wp_user_id WHERE identity = "approved" AND featured.feature_status = "active" AND (featured.status = "Paid" OR featured.status = "Free") ORDER BY RAND() limit 0,%d',$limit));
}
}else{
if($categoryid > 0){
$providers = $wpdb->get_results($wpdb->prepare('SELECT featured.id, provider.full_name, provider.phone, provider.mobile, provider.avatar_id, provider.bio, provider.category_id, featured.provider_id, featured.amount, featured.days, featured.status FROM '.$service_finder_Tables->feature.' as featured INNER JOIN '.$service_finder_Tables->providers.' as provider on featured.provider_id = provider.wp_user_id WHERE FIND_IN_SET("'.$categoryid.'", provider.category_id) AND featured.feature_status = "active" AND (featured.status = "Paid" OR featured.status = "Free") ORDER BY RAND() limit 0,%d',$limit));
}else{
$providers = $wpdb->get_results($wpdb->prepare('SELECT featured.id, provider.full_name, provider.phone, provider.mobile, provider.avatar_id, provider.bio, provider.category_id, featured.provider_id, featured.amount, featured.days, featured.status FROM '.$service_finder_Tables->feature.' as featured INNER JOIN '.$service_finder_Tables->providers.' as provider on featured.provider_id = provider.wp_user_id WHERE featured.feature_status = "active" AND (featured.status = "Paid" OR featured.status = "Free") ORDER BY RAND() limit 0,%d',$limit));
}
}

return $providers;

}

/*Get currecy code*/
if ( !function_exists( 'service_finder_currencycode' ) ){
function service_finder_currencycode(){
global $service_finder_options;
$currency = (!empty($service_finder_options['currency-code'])) ? $service_finder_options['currency-code'] : 'USD';
return $currency;
}
}

/* Currecy List */
function service_finder_get_currency_list(){
	$currency = array(
    'AED' => esc_html__( 'United Arab Emirates Dirham', 'service-finder' ),
    'AUD' => esc_html__( 'Australian Dollars (&#36;)', 'service-finder' ),
	'ARS' => esc_html__( 'Argentina (&#36;)', 'service-finder' ),
    'BDT' => esc_html__( 'Bangladeshi Taka (&#2547;&nbsp;)', 'service-finder' ),
    'BRL' => esc_html__( 'Brazilian Real (&#82;&#36;)', 'service-finder' ),
    'BGN' => esc_html__( 'Bulgarian Lev (&#1083;&#1074;.)', 'service-finder' ),
    'CAD' => esc_html__( 'Canadian Dollars (&#36;)', 'service-finder' ),
    'CLP' => esc_html__( 'Chilean Peso (&#36;)', 'service-finder' ),
    'CNY' => esc_html__( 'Chinese Yuan (&yen;)', 'service-finder' ),
    'COP' => esc_html__( 'Colombian Peso (&#36;)', 'service-finder' ),
    'CZK' => esc_html__( 'Czech Koruna (&#75;&#269;)', 'service-finder' ),
    'DKK' => esc_html__( 'Danish Krone (kr.)', 'service-finder' ),
    'DOP' => esc_html__( 'Dominican Peso (RD&#36;)', 'service-finder' ),
    'EUR' => esc_html__( 'Euros (&euro;)', 'service-finder' ),
    'HKD' => esc_html__( 'Hong Kong Dollar (&#36;)', 'service-finder' ),
    'HRK' => esc_html__( 'Croatia kuna (Kn)', 'service-finder' ),
    'HUF' => esc_html__( 'Hungarian Forint (&#70;&#116;)', 'service-finder' ),
    'ISK' => esc_html__( 'Icelandic krona (Kr.)', 'service-finder' ),
    'IDR' => esc_html__( 'Indonesia Rupiah (Rp)', 'service-finder' ),
    'INR' => esc_html__( 'Indian Rupee (Rs.)', 'service-finder' ),
    'NPR' => esc_html__( 'Nepali Rupee (Rs.)', 'service-finder' ),
    'ILS' => esc_html__( 'Israeli Shekel (&#8362;)', 'service-finder' ),
    'JPY' => esc_html__( 'Japanese Yen (&yen;)', 'service-finder' ),
    'KIP' => esc_html__( 'Lao Kip (&#8365;)', 'service-finder' ),
    'KRW' => esc_html__( 'South Korean Won (&#8361;)', 'service-finder' ),
    'MAD' => esc_html__( 'Moroccan Dirham (&#x2e;&#x62f;&#x2e;&#x645;)', 'service-finder' ),
	'MYR' => esc_html__( 'Malaysian Ringgits (&#82;&#77;)', 'service-finder' ),
	'MVR' => esc_html__( 'Maldivian Rufiyaa (Rf)', 'service-finder' ),
    'MXN' => esc_html__( 'Mexican Peso (&#36;)', 'service-finder' ),
    'NGN' => esc_html__( 'Nigerian Naira (&#8358;)', 'service-finder' ),
    'NOK' => esc_html__( 'Norwegian Krone (&#107;&#114;)', 'service-finder' ),
    'NZD' => esc_html__( 'New Zealand Dollar (&#36;)', 'service-finder' ),
    'PEN' => esc_html__( 'Peru (Sol)', 'service-finder' ),
	'PYG' => esc_html__( 'Paraguayan Guaran&&iuml; (&#8370;)', 'service-finder' ),
    'PHP' => esc_html__( 'Philippine Pesos (&#8369;)', 'service-finder' ),
    'PLN' => esc_html__( 'Polish Zloty (&#122;&#322;)', 'service-finder' ),
    'GBP' => esc_html__( 'Pounds Sterling (&pound;)', 'service-finder' ),
    'RON' => esc_html__( 'Romanian Leu (lei)', 'service-finder' ),
    'RUB' => esc_html__( 'Russian Ruble (&#1088;&#1091;&#1073;.)', 'service-finder' ),
	'UAH' => esc_html__( 'Ukranian Hrivna (&#8372;)', 'service-finder' ),
    'SGD' => esc_html__( 'Singapore Dollar (&#36;)', 'service-finder' ),
	'LKR' => esc_html__( 'Sri Lankan Rupee (Rs)', 'service-finder' ),
    'ZAR' => esc_html__( 'South African rand (&#82;)', 'service-finder' ),
    'SEK' => esc_html__( 'Swedish Krona (&#107;&#114;)', 'service-finder' ),
    'CHF' => esc_html__( 'Swiss Franc (&#67;&#72;&#70;)', 'service-finder' ),
    'TWD' => esc_html__( 'Taiwan New Dollars (&#78;&#84;&#36;)', 'service-finder' ),
    'THB' => esc_html__( 'Thai Baht (&#3647;)', 'service-finder' ),
    'TRY' => esc_html__( 'Turkish Lira (&#8378;)', 'service-finder' ),
    'USD' => esc_html__( 'US Dollars (&#36;)', 'service-finder' ),
    'VND' => esc_html__( 'Vietnamese Dong (&#8363;)', 'service-finder' ),
    'EGP' => esc_html__( 'Egyptian Pound (EGP)', 'service-finder' ),
	'XOF' => esc_html__( 'West African Franc (FCFA)', 'service-finder' ),
	'SAR' => esc_html__( 'Saudi Riyal', 'service-finder' ),
	'KSH' => esc_html__( 'Kenyan Shilling', 'service-finder' ),
	'HNL' => esc_html__( 'Honduran Lempira', 'service-finder' ),
	'TZS' => esc_html__( 'Tanzanian Shilling', 'service-finder' ),
	'XPF' => esc_html__( 'CFP Franc', 'service-finder' ),
	'UGX' => esc_html__( 'Uganda Shillings', 'service-finder' ),
	'TZS' => esc_html__( 'Tanzania Shillings', 'service-finder' ),
	'RWF' => esc_html__( 'Rwandan Franc', 'service-finder' ),
	'BIF' => esc_html__( 'Burundi Franc', 'service-finder' ),
	'colones' => esc_html__( 'Costa Rica Colones', 'service-finder' ),
	'BAM' => esc_html__( 'Bosnia and Herzegovina', 'service-finder' ),
	'KZT' => esc_html__( 'Kazakhstan', 'service-finder' ),
    );
	
	return $currency;
}

/* Country List */
function service_finder_get_country_list(){
	$currency = array(
    'US' => esc_html__( 'United States', 'service-finder' ),
    );
	
	return $currency;
}

/*Get currecy symbol*/
if ( !function_exists( 'service_finder_currencysymbol' ) ){
function service_finder_currencysymbol(){
global $service_finder_options;
$currency = (!empty($service_finder_options['currency-code'])) ? $service_finder_options['currency-code'] : 'USD';

switch ( $currency ) {
		case 'ARS' :
			$currency_symbol = '&#36;';
			break;
		case 'PEN' :
			$currency_symbol = 'Sol';
			break;	
		case 'AED' :
			$currency_symbol = '';
			break;
		case 'BDT':
			$currency_symbol = '&#2547;&nbsp;';
			break;
		case 'BRL' :
			$currency_symbol = '&#82;&#36;';
			break;
		case 'BGN' :
			$currency_symbol = '&#1083;&#1074;.';
			break;
		case 'AUD' :
		case 'CAD' :
		case 'CLP' :
		case 'COP' :
		case 'MXN' :
		case 'NZD' :
		case 'HKD' :
		case 'SGD' :
		case 'USD' :
			$currency_symbol = '&#36;';
			break;
		case 'EUR' :
			$currency_symbol = '&euro;';
			break;
		case 'CNY' :
		case 'RMB' :
		case 'JPY' :
			$currency_symbol = '&yen;';
			break;
		case 'RUB' :
			$currency_symbol = '&#1088;&#1091;&#1073;.';
			break;
		case 'KRW' : $currency_symbol = '&#8361;'; break;
        case 'PYG' : $currency_symbol = '&#8370;'; break;
		case 'TRY' : $currency_symbol = '&#8378;'; break;
		case 'NOK' : $currency_symbol = '&#107;&#114;'; break;
		case 'ZAR' : $currency_symbol = '&#82;'; break;
		case 'CZK' : $currency_symbol = '&#75;&#269;'; break;
		case 'MYR' : $currency_symbol = '&#82;&#77;'; break;
		case 'DKK' : $currency_symbol = 'kr.'; break;
		case 'HUF' : $currency_symbol = '&#70;&#116;'; break;
		case 'IDR' : $currency_symbol = 'Rp'; break;
		case 'INR' : $currency_symbol = 'Rs.'; break;
		case 'NPR' : $currency_symbol = 'Rs.'; break;
		case 'ISK' : $currency_symbol = 'Kr.'; break;
		case 'ILS' : $currency_symbol = '&#8362;'; break;
		case 'PHP' : $currency_symbol = '&#8369;'; break;
		case 'PLN' : $currency_symbol = '&#122;&#322;'; break;
		case 'SEK' : $currency_symbol = '&#107;&#114;'; break;
		case 'CHF' : $currency_symbol = '&#67;&#72;&#70;'; break;
		case 'TWD' : $currency_symbol = '&#78;&#84;&#36;'; break;
		case 'THB' : $currency_symbol = '&#3647;'; break;
		case 'GBP' : $currency_symbol = '&pound;'; break;
		case 'RON' : $currency_symbol = 'lei'; break;
		case 'VND' : $currency_symbol = '&#8363;'; break;
		case 'NGN' : $currency_symbol = '&#8358;'; break;
		case 'HRK' : $currency_symbol = 'Kn'; break;
		case 'EGP' : $currency_symbol = 'EGP'; break;
		case 'DOP' : $currency_symbol = 'RD&#36;'; break;
		case 'KIP' : $currency_symbol = '&#8365;'; break;
		case 'MAD' : $currency_symbol = '&#x2e;&#x62f;&#x2e;&#x645;'; break;
		case 'XOF' : $currency_symbol = 'FCFA'; break;
		case 'MVR' : $currency_symbol = 'Rf'; break;
		case 'SAR' : $currency_symbol = 'SAR'; break;
		case 'KSH' : $currency_symbol = 'Ksh'; break;
		case 'HNL' : $currency_symbol = 'L'; break;
		case 'TZS' : $currency_symbol = 'TSh'; break;
		case 'XPF' : $currency_symbol = 'F'; break;
		case 'UGX' : $currency_symbol = 'USh'; break;
		case 'RWF' : $currency_symbol = 'FRw'; break;
		case 'BIF' : $currency_symbol = 'BIF'; break;
		case 'colones' : $currency_symbol = 'colones'; break;
		case 'BAM' : $currency_symbol = 'KM'; break;
		case 'NE' : $currency_symbol = 'KM'; break;
		case 'KZT' : $currency_symbol = 'KZT'; break;
		case 'UAH' : $currency_symbol = '&#8372;'; break;
		default    : $currency_symbol = ''; break;
	}


return $currency_symbol;
}
}

/*Display rating*/
function service_finder_displayRating($rating){
global $service_finder_options;
if($rating > 0){
$rating = $rating;
}else{
$rating = 0;
}
	if($service_finder_options['review-system']){
	return '<div class="sf-show-rating default-hidden"><input class="display-ratings" value="'.esc_attr($rating).'" type="number" min=0 max=5 step=0.5 data-size="sm" disabled="disabled"></div>';
	}else{
	return '';
	}
}

/*Get average rating*/
function service_finder_getAverageRating($providerid){
global $wpdb,$service_finder_Tables,$service_finder_options;

	if($service_finder_options['review-style'] == 'booking-review'){
		$res = $wpdb->get_row($wpdb->prepare('SELECT rating FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$providerid));
		return $res->rating;
	}elseif($service_finder_options['review-style'] == 'open-review'){
		$comment_postid = get_user_meta($providerid,'comment_post',true);
		$comment_rating = 0;
		$avg_rating = 0;
		
		$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'comments WHERE `comment_approved` = 1 AND `comment_post_ID` = %d',$comment_postid));
		$total_comments = count($results);
		if(!empty($results)){
			foreach($results as $result){
			$comment_id = $result->comment_ID;
				$row = $wpdb->get_row($wpdb->prepare('SELECT `meta_value` FROM '.$wpdb->prefix.'commentmeta WHERE `comment_id` = %d AND `meta_key` = "pixrating"',$comment_id));
				if(!empty($row)){
					$comment_rating = $comment_rating + $row->meta_value;
				}
				$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM `'.$service_finder_Tables->custom_rating.'` where `comment_id` = %d',$comment_id));
				if(!empty($row)){
					$comment_rating = $comment_rating + $row->avgrating;
				}
			}
			$avg_rating = $comment_rating/$total_comments;
		}
		
		return $avg_rating;
	}

}

/*Get average rating*/
function service_finder_number_of_stars($providerid){
global $wpdb,$service_finder_Tables,$service_finder_options;
	$onestar = 0;
	$twostar = 0;
	$threestar = 0;
	$fourstar = 0;
	$fivestar = 0;
	if($service_finder_options['review-style'] == 'booking-review'){
		$allreviews = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->feedback.' where provider_id = %d',$providerid));
		if(!empty($allreviews)){
			foreach($allreviews as $rev){
				if(floatval($rev->rating) > 0 && floatval($rev->rating) < 1.5){
					$onestar = $onestar + 1;
				}elseif(floatval($rev->rating) >= 1.5 && floatval($rev->rating) < 2.5){
					$twostar = $twostar + 1;
				}elseif(floatval($rev->rating) >= 2.5 && floatval($rev->rating) < 3.5){
					$threestar = $threestar + 1;
				}elseif(floatval($rev->rating) >= 3.5 && floatval($rev->rating) < 4.5){
					$fourstar = $fourstar + 1;
				}elseif(floatval($rev->rating) >= 4.5 && floatval($rev->rating) <= 5){
					$fivestar = $fivestar + 1;
				}
			}
		}
	}elseif($service_finder_options['review-style'] == 'open-review'){
		$comment_postid = get_user_meta($providerid,'comment_post',true);
		$comment_rating = 0;
		$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'comments WHERE `comment_approved` = 1 AND `comment_post_ID` = %d',$comment_postid));
		$total_comments = count($results);
		if(!empty($results)){
			foreach($results as $result){
			$comment_id = $result->comment_ID;
				$row = $wpdb->get_row($wpdb->prepare('SELECT `meta_value` FROM '.$wpdb->prefix.'commentmeta WHERE `comment_id` = %d AND `meta_key` = "pixrating"',$comment_id));
				if(!empty($row)){
					if(floatval($row->meta_value) > 0 && floatval($row->meta_value) < 1.5){
						$onestar = $onestar + 1;
					}elseif(floatval($row->meta_value) >= 1.5 && floatval($row->meta_value) < 2.5){
						$twostar = $twostar + 1;
					}elseif(floatval($row->meta_value) >= 2.5 && floatval($row->meta_value) < 3.5){
						$threestar = $threestar + 1;
					}elseif(floatval($row->meta_value) >= 3.5 && floatval($row->meta_value) < 4.5){
						$fourstar = $fourstar + 1;
					}elseif(floatval($row->meta_value) >= 4.5 && floatval($row->meta_value) <= 5){
						$fivestar = $fivestar + 1;
					}
				}
				
				$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM `'.$service_finder_Tables->custom_rating.'` where `comment_id` = %d',$comment_id));
				if(!empty($row)){
					if(floatval($row->avgrating) > 0 && floatval($row->avgrating) < 1.5){
						$onestar = $onestar + 1;
					}elseif(floatval($row->avgrating) >= 1.5 && floatval($row->avgrating) < 2.5){
						$twostar = $twostar + 1;
					}elseif(floatval($row->avgrating) >= 2.5 && floatval($row->avgrating) < 3.5){
						$threestar = $threestar + 1;
					}elseif(floatval($row->avgrating) >= 3.5 && floatval($row->avgrating) < 4.5){
						$fourstar = $fourstar + 1;
					}elseif(floatval($row->avgrating) >= 4.5 && floatval($row->avgrating) <= 5){
						$fivestar = $fivestar + 1;
					}
				}
			}
		}
	}
	
	return array(
			'1' => $onestar,
			'2' => $twostar,
			'3' => $threestar,
			'4' => $fourstar,
			'5' => $fivestar,
		);

}

/*Get member average rating*/
function service_finder_getMemberAverageRating($memberid){
global $wpdb,$service_finder_Tables;

$res = $wpdb->get_row($wpdb->prepare('SELECT rating FROM '.$service_finder_Tables->team_members.' WHERE `id` = %d',$memberid));

return $res->rating;
}

/*Get provider name by id*/
function service_finder_getProviderName($providerid){
global $wpdb,$service_finder_Tables;

$sedateProvider = $wpdb->get_row($wpdb->prepare('SELECT company_name,full_name FROM '.$service_finder_Tables->providers.' where wp_user_id = %d',$providerid));

if(!empty($sedateProvider)){
if($sedateProvider->company_name != ""){
$providername = $sedateProvider->company_name;
}else{
$providername = $sedateProvider->full_name;
}
return $providername;
}else{
return '';
}
}

/*Get booking cutomer name by booking cutomer id*/
function service_finder_getBookingCustomerName($bookingcustomerid){
global $wpdb,$service_finder_Tables;

$row = $wpdb->get_row($wpdb->prepare('SELECT name FROM '.$service_finder_Tables->customers.' where id = %d',$bookingcustomerid));

if(!empty($row)){
if(!empty($row->name)){
return $row->name;
}else{
return $row->email;
}
}else{
return '';
}
}


/*Get provider name by id*/
function service_finder_getProviderFullName($providerid){

$fullname = get_user_meta($providerid,'first_name',true).' '.get_user_meta($providerid,'last_name',true);

return $fullname;
}

/*Get customer name by id*/
function service_finder_getCustomerName($customerid){

$fullname = get_user_meta($customerid,'first_name',true).' '.get_user_meta($customerid,'last_name',true);

return $fullname;

}

/*Get customer email by id*/
function service_finder_getCustomerEmail($userId){

$userinfo = get_user_by( 'ID', $userId );

return $userinfo->user_email;

}

/*Get provider name by id*/
function service_finder_getCompanyName($providerid){
global $wpdb,$service_finder_Tables;

$sedateProvider = $wpdb->get_row($wpdb->prepare('SELECT company_name FROM '.$service_finder_Tables->providers.' where wp_user_id = %d',$providerid));
if(!empty($sedateProvider)){
return $sedateProvider->company_name;
}

}

/*Get provider category by user id*/
function service_finder_getProviderCategory($providerid){
global $wpdb,$service_finder_Tables;

if($providerid > 0){
$res = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' where wp_user_id = %d',$providerid));
return $res->category_id;
}else{
return '';
}

}

/*Get Total Number of Providers in Particular Category*/
function service_finder_getTotalProvidersByCategory($catid){
global $wpdb, $service_finder_Tables, $service_finder_options;
$identitycheck = (isset($service_finder_options['identity-check'])) ? esc_attr($service_finder_options['identity-check']) : '';
$restrictuserarea = (isset($service_finder_options['restrict-user-area'])) ? esc_attr($service_finder_options['restrict-user-area']) : '';
if($restrictuserarea && $identitycheck){
$sql = 'SELECT count(*) as total FROM '.$service_finder_Tables->providers.' where admin_moderation = "approved" AND identity = "approved" AND account_blocked != "yes" AND';
}else{
$sql = 'SELECT count(*) as total FROM '.$service_finder_Tables->providers.' where admin_moderation = "approved" AND account_blocked != "yes" AND';
}



$texonomy = 'providers-category';
$term_children = get_term_children($catid,$texonomy);

if(!empty($term_children)){
$sql .= ' (';
	foreach($term_children as $term_child_id) {
		
		$sql .= ' FIND_IN_SET("'.$term_child_id.'", category_id) OR ';
		
	}
$sql .= ' FIND_IN_SET("'.$catid.'", category_id) ';	
$sql .= ' )';	
	
}else{

$sql .= ' FIND_IN_SET("'.$catid.'", category_id)';

}

$res = $wpdb->get_row($sql);

return $res->total;

}

function service_finder_check_business_hours_status($pid){
$business_hours_active_inactive = get_user_meta($pid,'business_hours_active_inactive',true); 
if($business_hours_active_inactive == 'active'){
return true;
}else{
return false;
}
}

function service_finder_showBusinessHours($pid){
global $wpdb,$service_finder_Tables,$service_finder_options;
$currUser = wp_get_current_user();
$time_format = (!empty($service_finder_options['time-format'])) ? $service_finder_options['time-format'] : '';
$days = array('monday','tuesday','wednesday','thursday','friday','saturday','sunday');
$shortdays = array('MON','TUE','WED','THU','FRI','SAT','SUN');
$timeslots = get_user_meta($pid,'timeslots',true);
$breaktimes = get_user_meta($pid,'breaktime',true);
$flag = 0;
if(!empty($timeslots)){
$flag = 1;
}
$html = '';
$html .= '<table class="sf-business-hours table table-bordered">
    <thead>
        <tr>';
            foreach($shortdays as $day){
			
			switch($day){
			case 'MON':
				$dayname = esc_html__('Mon','service-finder');
				break;
			case 'TUE':
				$dayname = esc_html__('Tue','service-finder');
				break;
			case 'WED':
				$dayname = esc_html__('Wed','service-finder');
				break;
			case 'THU':
				$dayname = esc_html__('Thu','service-finder');
				break;
			case 'FRI':
				$dayname = esc_html__('Fri','service-finder');
				break;
			case 'SAT':
				$dayname = esc_html__('Sat','service-finder');
				break;
			case 'SUN':
				$dayname = esc_html__('Sun','service-finder');
				break;						
			}
			
			$html .= '<th>'.strtoupper($dayname).'</th>';
			}
$html .= '</tr>
    </thead>
    <tbody>
        <tr>';
			$i = 0;
            foreach($days as $day){
				$timeslot = (!empty($timeslots)) ? $timeslots[$i] : '';	
				$item = explode('-',$timeslot);
				
				if($item[0] != ""){
				if($timeslot == 'off'){
					$html .= '<td class="sf-closed-day">'.esc_html__('Closed','service-finder').'</td>';
				}else{
					
					if($time_format){
						$starttime = date('H:i',strtotime(esc_html($item[0])));
						$endtime = date('H:i',strtotime(esc_html($item[1])));
					}else{
						$starttime = date('h:i a',strtotime(esc_html($item[0])));
						$endtime = date('h:i a',strtotime(esc_html($item[1])));
					}
					
					$breakhtml = '';
					
					if(!empty($breaktimes[$i])){
					$breaktime = $breaktimes[$i];	
					
					if(!empty($breaktime)){
						foreach($breaktime as $bktime){
							$bkitem = explode('-',$bktime);	
							
							if($time_format){
								$bhstarttime = date('H:i',strtotime(esc_html($bkitem[0])));
								$bhendtime = date('H:i',strtotime(esc_html($bkitem[1])));
							}else{
								$bhstarttime = date('h:i a',strtotime(esc_html($bkitem[0])));
								$bhendtime = date('h:i a',strtotime(esc_html($bkitem[1])));
							}
							
							$breakhtml .= '<li>'.$bhstarttime.' <b>'.esc_html__('to','service-finder').'</b> '.$bhendtime.'</li>';
						}
					}else{
						$breakhtml .= '<li>-</li>';
					}
					}
					
					
					
					
					$html .= '<td class="other-day">
							<span class="from">'.$starttime.'</span>
							<span class="sf-to">'.esc_html__('to','service-finder').'</span>
							<span class="to">'.$endtime.'</span>
							<div class="sf-break-timing">
								<strong><i class="fa fa-coffee"></i> '.esc_html__('Break Time','service-finder').'</strong>
								<ul>
									'.$breakhtml.'
								</ul>
							</div>
						</td>';
				}
				}
				
				$i++;
			}
$html .= '</tr>
    </tbody>
</table>';

if($flag == 1){
return $html; 	
}else{
return false;
}
}

/*Get Stripe Public Key via AJax for Provider*/
add_action('wp_ajax_get_stripekey', 'service_finder_get_stripekey');
add_action('wp_ajax_nopriv_get_stripekey', 'service_finder_get_stripekey');

function service_finder_get_stripekey(){
global $service_finder_options;

$settings = service_finder_getProviderSettings($_POST['provider_id']);

$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? esc_html($service_finder_options['pay_booking_amount_to']) : '';
if($pay_booking_amount_to == 'admin'){
	$stripetype = (!empty($service_finder_options['stripe-type'])) ? esc_html($service_finder_options['stripe-type']) : '';
	if($stripetype == 'live'){
		$stripepublickey = (!empty($service_finder_options['stripe-live-public-key'])) ? esc_html($service_finder_options['stripe-live-public-key']) : '';
	}else{
		$stripepublickey = (!empty($service_finder_options['stripe-test-public-key'])) ? esc_html($service_finder_options['stripe-test-public-key']) : '';
	}
}elseif($pay_booking_amount_to == 'provider'){
	$stripepublickey = esc_html($settings['stripepublickey']);
}

echo esc_html($stripepublickey);
exit;
}

/*Get Stripe Public Key via AJax for Admin*/
add_action('wp_ajax_get_adminstripekey', 'service_finder_get_adminstripekey');
add_action('wp_ajax_nopriv_get_adminstripekey', 'service_finder_get_adminstripekey');

function service_finder_get_adminstripekey(){
global $service_finder_options;
if( isset($service_finder_options['stripe-type']) && $service_finder_options['stripe-type'] == 'test' ){
	$secret_key = (!empty($service_finder_options['stripe-test-secret-key'])) ? $service_finder_options['stripe-test-secret-key'] : '';
	$public_key = (!empty($service_finder_options['stripe-test-public-key'])) ? $service_finder_options['stripe-test-public-key'] : '';
}else{
	$secret_key = (!empty($service_finder_options['stripe-live-secret-key'])) ? $service_finder_options['stripe-live-secret-key'] : '';
	$public_key = (!empty($service_finder_options['stripe-live-public-key'])) ? $service_finder_options['stripe-live-public-key'] : '';
}


$success = array(
			'status' => 'success',
			'secret_key' => $secret_key,
			'public_key' => $public_key,
			);
echo json_encode($success);	

exit;
}

function service_finder_getExcerpts($str,$start,$end){
if(strlen($str) > $end) {
	$s = substr(strip_tags(wpautop($str)), $start, $end);
	$result = substr($s, 0, strrpos($s, ' '));
	if($result != ""){
	return stripcslashes(strip_shortcodes($result)).' [...]';
	}else{
	return stripcslashes(strip_shortcodes($result));
	}
}else{
	return stripcslashes(strip_shortcodes($str));
}	
}

function service_finder_getHours($val){
global $service_finder_options;
for($i = 0; $i < 24; $i++):

$tem = ''; 
if($val != ""){
$tem = explode(':',$val);
}
$time_format = (!empty($service_finder_options['time-format'])) ? $service_finder_options['time-format'] : '';
if($time_format){ 
if(!empty($tem)){
?>
	<option <?php echo ($tem[0] == $i && $tem[1] == 00) ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr($i); ?>:00"><?php echo esc_attr($i); ?>:00</option>
    <option <?php echo ($tem[0] == $i && $tem[1] == 30) ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr($i); ?>:30"><?php echo esc_attr($i); ?>:30</option>
    
<?php    
}else{
?>
	<option value="<?php echo esc_attr($i); ?>:00"><?php echo esc_attr($i); ?>:00</option>
    <option value="<?php echo esc_attr($i); ?>:30"><?php echo esc_attr($i); ?>:30</option>
<?php
}
}else{ 
if(!empty($tem)){
?>
<option <?php echo ($tem[0] == $i && $tem[1] == 00) ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr($i); ?>:00"><?php echo ($i % 12) ? esc_attr($i) % 12 : 12 ?>:00 <?php echo ($i >= 12) ? 'PM' : 'AM' ?></option>
<option <?php echo ($tem[0] == $i && $tem[1] == 30) ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr($i); ?>:30"><?php echo ($i % 12) ? esc_attr($i) % 12 : 12 ?>:30 <?php echo ($i >= 12) ? 'PM' : 'AM' ?></option>
<?php
}else{
?>
<option value="<?php echo esc_attr($i); ?>:00"><?php echo ($i % 12) ? esc_attr($i) % 12 : 12 ?>:00 <?php echo ($i >= 12) ? 'PM' : 'AM' ?></option>
<option value="<?php echo esc_attr($i); ?>:30"><?php echo ($i % 12) ? esc_attr($i) % 12 : 12 ?>:30 <?php echo ($i >= 12) ? 'PM' : 'AM' ?></option>
<?php
}
}
endfor;
}

function service_finder_getAddress($userid){

global $wpdb,$service_finder_Tables;
$res = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE wp_user_id = %d',$userid));
if(!empty($res)){
$address = $res->address;
$city = $res->city;
$state = $res->state;
$country = $res->country;

$state = (!empty($res->state)) ? ', '.esc_html($res->state) : '';
		
$fulladdress = $address.', '.$city.$state.', '.$country;

return $fulladdress;
}else{
return '';
}

}

function service_finder_getBranchAddress($branchid){

global $wpdb,$service_finder_Tables;
$res = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->branches.' WHERE id = %d',$branchid));

if(!empty($res)){
$address = $res->address;
$city = $res->city;
$state = $res->state;
$country = $res->country;

$state = (!empty($res->state)) ? ', '.esc_html($res->state) : '';
		
$fulladdress = $address.', '.$city.$state.', '.$country;

return $fulladdress;
}else{
return '';
}

}

/*Get provider short address*/
function service_finder_getshortAddress($userid){
global $wpdb,$service_finder_Tables;
$res = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE wp_user_id = %d',$userid));
if(!empty($res)){
$address = '';
$address .= ' '.$res->city.',';
$address .= ' '.$res->country;
return $address;
}else{
return '';
}
}

/*Get avatar id by user id*/
function service_finder_getAvatarID($userid){
global $wpdb,$service_finder_Tables;
$res = $wpdb->get_row($wpdb->prepare('SELECT avatar_id FROM '.$service_finder_Tables->providers.' WHERE wp_user_id = %d',$userid));
if(!empty($res)){
return $res->avatar_id;
}else{
return 0;
}
}

/*Get provider email*/
function service_finder_getProviderEmail($userid){
global $wpdb,$service_finder_Tables;
$res = $wpdb->get_row($wpdb->prepare('SELECT email FROM '.$service_finder_Tables->providers.' WHERE wp_user_id = %d',$userid));
if(!empty($res)){
return $res->email;
}else{
return '';
}
}

/*Check if provider is featured*/
function service_finder_is_featured($pid){
global $wpdb,$service_finder_Tables;
$res = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->feature.' WHERE (`feature_status` = "active" AND (`status` = "Paid" OR `status` = "Free")) AND `provider_id` = %d',$pid));
if(!empty($res)){
return true;
}else{
return false;
}
}

/*Get total number of featured provider*/
function service_finder_total_featured_providers(){
global $wpdb,$service_finder_Tables;
$row = $wpdb->get_row('SELECT count(id) as total FROM '.$service_finder_Tables->providers.' WHERE admin_moderation = "approved" AND account_blocked != "yes" AND `featured` = 1');
return $row->total;
}

/*Get total number of paid providers*/
function service_finder_total_paid_providers(){
global $wpdb,$service_finder_Tables;
$row = $wpdb->get_row('SELECT count(user_id) as total FROM `'.$wpdb->prefix.'usermeta` WHERE `meta_key` = "provider_role" AND `meta_value` IN ("package_1","package_2","package_3")');
return $row->total;
}


/*Check provider is blocked or not*/
function service_finder_is_blocked($userid){
global $wpdb,$service_finder_Tables;
$res = $wpdb->get_row($wpdb->prepare('SELECT account_blocked FROM '.$service_finder_Tables->providers.' WHERE wp_user_id = %d',$userid));
if(!empty($res)){
return $res->account_blocked;
}else{
return '';
}
}

/*Ajax Pagination for load search results*/	
add_action( 'wp_ajax_load-search-result', 'service_finder_load_search_result' );
add_action( 'wp_ajax_nopriv_load-search-result', 'service_finder_load_search_result' );

function service_finder_load_search_result() {
   
   global $service_finder_ThemeParams, $wpdb, $service_finder_options, $service_finder_Tables;

    if($_POST['page'] != ""){
	$page = sanitize_text_field($_POST['page']);
	}else{
	$page = 1;
	}
	$cur_page = $page;
	$page -= 1;
	if($_POST['numberofpages'] != ""){
	$per_page = $_POST['numberofpages'];
	}else{
	$srhperpage = (!empty($service_finder_options['srh-per-page'])) ? $service_finder_options['srh-per-page'] : '';
	$per_page = ($srhperpage > 0) ? $service_finder_options['srh-per-page'] : 12;
	}
	
	if($_POST['setorderby'] != ""){
	$orderby = $_POST['setorderby'];
	}else{
	$orderby = 'id';
	}
	
	if($_POST['setorder'] != ""){
	$order = $_POST['setorder'];
	}else{
	$order = 'desc';
	}
	
	$previous_btn = true;
	$next_btn = true;
	$first_btn = true;
	$last_btn = true;
	$start = $page * $per_page;
	
	$keyword = (isset($_POST['keyword'])) ? $_POST['keyword'] : '';
	$address = (isset($_POST['address'])) ? $_POST['address'] : '';
	$city = (isset($_POST['city'])) ? $_POST['city'] : '';
	$catid = (isset($_POST['catid'])) ? $_POST['catid'] : '';
	$country = (isset($_POST['country'])) ? $_POST['country'] : '';
	$minprice = (isset($_POST['minprice'])) ? esc_html($_POST['minprice']) : '';
	$maxprice = (isset($_POST['maxprice'])) ? esc_html($_POST['maxprice']) : '';
	$distance = (isset($_POST['distance'])) ? $_POST['distance'] : '';
	
	$srhbybooking = (isset($_POST['srhbybooking'])) ? esc_html($_POST['srhbybooking']) : '';
	
	$srhdate = (isset($_POST['srhdate'])) ? esc_html($_POST['srhdate']) : '';
	$srhperiod = (isset($_POST['srhperiod'])) ? esc_html($_POST['srhperiod']) : '';
	$srhtime = (isset($_POST['srhtime'])) ? esc_html($_POST['srhtime']) : '';
	
	$searchdata = array(
		'srhbybooking' => $srhbybooking,
		'srhdate' => $srhdate,
		'srhperiod' => $srhperiod,
		'srhtime' => $srhtime,
	);
   
   $getProviders = new SERVICE_FINDER_searchProviders();
	
   $providersInfoArr = $getProviders->service_finder_getSearchedProviders($searchdata,$distance,$minprice,$maxprice,esc_attr($keyword),esc_attr($address),esc_attr($city),esc_attr($catid),esc_attr($country),$start,$per_page,$orderby,$order);
   
   $providersavailability = array();
   
   $providersInfo = $providersInfoArr['srhResult'];
   $count = $providersInfoArr['count'];
   if(!empty($providersInfoArr['sortresult'])){
   $providersavailability = $providersInfoArr['sortresult'];
   }
   $msg = '';
	
	$markers = '';
	$flag = 0;
	if(!empty($providersInfo)){ 
		if($service_finder_options['search-template'] == 'style-1'){
			if($_POST['viewtype'] == 'listview'){
			$msg .= '<div class="listing-box row">';
			}elseif($_POST['viewtype'] == 'grid-4'){
			$msg .= '<div class="listing-grid-box sf-listing-grid-4 equal-col-outer">
							<div class="row">';
			}elseif($_POST['viewtype'] == 'grid-3'){
			$msg .= '<div class="listing-grid-box sf-listing-grid-3 equal-col-outer">
							<div class="row">';
			}else{
			$msg .= '<div class="listing-grid-box sf-listing-grid-4 equal-col-outer">
							<div class="row">';
			}
		}elseif($service_finder_options['search-template'] == 'style-2'){
			if($_POST['viewtype'] == 'listview'){
			$msg .= '<div class="listing-box row">';
			}else{
			$msg .= '<div class="listing-grid-box sf-listing-grid-2 equal-col-outer">
							<div class="row">';
			}
		}
	foreach($providersInfo as $provider){

	$userLink = service_finder_get_author_url($provider->wp_user_id);
	
	$services = '';
	if($keyword != "" || ($minprice != "" && $maxprice != "" && $maxprice > 0)){
	$services = service_finder_get_searched_services($provider->wp_user_id,$keyword,$minprice,$maxprice);

    $searchedservices = '';
	if(!empty($services)){
		$searchedservices .= '<ul class="sf-service-price-list">';
		foreach($services as $service){
			$searchedservices .= '<li><span>'.service_finder_money_format(esc_html($service->cost)).'</span> '.esc_html($service->service_name).'</li>';
		}
		$searchedservices .= '</ul>';
	}
	
	}

	if(!empty($provider->avatar_id) && $provider->avatar_id > 0){
		$src  = wp_get_attachment_image_src( $provider->avatar_id, 'service_finder-provider-thumb' );
		$src  = $src[0];
	}else{
		$src  = service_finder_get_default_avatar();
	}
	
	$procatid = get_user_meta($provider->wp_user_id,'primary_category',true);
	
	$icon = service_finder_getCategoryIcon($procatid);
	
	if($icon == ""){
	$imagepath = SERVICE_FINDER_BOOKING_IMAGE_URL.'/markers';
	$icon = (!empty($service_finder_options['default-map-marker-icon']['url'])) ? $service_finder_options['default-map-marker-icon']['url'] : '';
	}
	
	$markeraddress = service_finder_getAddress($provider->wp_user_id);
	
	$companyname = service_finder_getCompanyName($provider->wp_user_id);
	$companyname = str_replace(array("\n", "\r", '"', "'"), ' ', $companyname);
	$companyname = preg_replace('/\t+/', '', $companyname);
	
	$full_name = str_replace(array("\n", "\r", '"', "'"), ' ', $provider->full_name);
	$full_name = preg_replace('/\t+/', '', $full_name);
	
	$markeraddress = str_replace(array("\n", "\r", '"', "'"), ' ', $markeraddress);
	$markeraddress = str_replace('\t', '', $markeraddress);
	
	$categorycolor = service_finder_getCategoryColor(get_user_meta($provider->wp_user_id,'primary_category',true));
	
	$catname = service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true));
	
	$catname = str_replace(array("\n", "\r", '"', "'"), ' ', $catname);

	$catname = str_replace('\t', '', $catname);
	
	//Create the markers	
	$markers .= '["'.stripcslashes($full_name).'","'.$provider->lat.'","'.$provider->long.'","'.$src.'","'.$icon.'","'.$userLink.'","'.$provider->wp_user_id.'","'.$catname.'","'.stripcslashes($markeraddress).'","'.stripcslashes($companyname).'","'.$categorycolor.'"],';
	
	if($city != "" && $country != ""){
		$branches = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->branches.' WHERE wp_user_id = %d AND `city` = "%s" AND `country` = "%s"',$provider->wp_user_id,$city,$country));		
	}elseif($city == "" && $country != ""){
		$branches = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->branches.' WHERE wp_user_id = %d AND `country` = "%s"',$provider->wp_user_id,$country));
	}elseif($city != "" && $country == ""){
		$branches = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->branches.' WHERE wp_user_id = %d AND `city` = "%s"',$provider->wp_user_id,$city));		
	}else{
		$branches = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->branches.' WHERE wp_user_id = %d',$provider->wp_user_id));
	}
	
	if(!empty($branches)){
		foreach($branches as $branch){
			$branchaddress = service_finder_getBranchAddress($branch->id);
			
			$markers .= '["'.stripcslashes($full_name).'","'.$branch->lat.'","'.$branch->long.'","'.$src.'","'.$icon.'","'.$userLink.'","'.$provider->wp_user_id.'","'.$catname.'","'.stripcslashes($branchaddress).'","'.stripcslashes($companyname).'","'.$categorycolor.'"],';
		}
	}
	
	$link = $userLink;
    $current_user = wp_get_current_user();         
	$addtofavorite = '';
	if($service_finder_options['add-to-fav']){
	if(is_user_logged_in()){
		$myfav = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->favorites.' where user_id = %d AND provider_id = %d',$current_user->ID,$provider->wp_user_id));
		
		if(!empty($myfav)){
		if(service_finder_themestyle() == 'style-2'){
		$addtofavorite = '<a href="javascript:;" class="remove-favorite sf-featured-item" data-proid="'.esc_attr($provider->wp_user_id).'" data-userid="'.esc_attr($current_user->ID).'"><i class="fa fa-heart"></i></a>';
		}else{
		$addtofavorite = '<a href="javascript:;" class="remove-favorite btn btn-primary" data-proid="'.esc_attr($provider->wp_user_id).'" data-userid="'.esc_attr($current_user->ID).'">'.esc_html__( 'My Favorite', 'service-finder' ).'<i class="fa fa-heart"></i></a>';
		}
		}else{
		if(service_finder_themestyle() == 'style-2'){
		$addtofavorite = '<a href="javascript:;" class="add-favorite sf-featured-item" data-proid="'.esc_attr($provider->wp_user_id).'" data-userid="'.esc_attr($current_user->ID).'"><i class="fa fa-heart-o"></i></a>';
		}else{
		$addtofavorite = '<a href="javascript:;" class="add-favorite btn btn-primary" data-proid="'.esc_attr($provider->wp_user_id).'" data-userid="'.esc_attr($current_user->ID).'">'.esc_html__( 'Add to Fav', 'service-finder' ).'<i class="fa fa-heart"></i></a>';
		}
		}
	}else{
		if(service_finder_themestyle() == 'style-2'){
		$addtofavorite = '<a class="sf-featured-item" href="javascript:;" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><i class="fa fa-heart-o"></i></a>';
		}else{
		$addtofavorite = '<a class="btn btn-primary" href="javascript:;" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal">'.esc_html__( 'Add to Fav', 'service-finder' ).'<i class="fa fa-heart"></i></a>';
		}
	}  
	}

	if(service_finder_is_featured($provider->wp_user_id)){
	if(service_finder_themestyle() == 'style-2'){
	$featured = '<div  class="sf-featured-sign">'.esc_html__( 'Featured', 'service-finder' ).'</div>';
	}else{
	$featured = '<strong class="sf-featured-label"><span>'.esc_html__( 'Featured', 'service-finder' ).'</span></strong>';
	}
	}else{
	$featured = '';
	}
	
	if($service_finder_options['search-template'] == 'style-1'){
	$addressbox = '';
	$showaddressinfo = (isset($service_finder_options['show-address-info'])) ? esc_attr($service_finder_options['show-address-info']) : '';
	  if($showaddressinfo && $service_finder_options['show-postal-address'] && service_finder_check_address_info_access()){
			if(service_finder_themestyle() == 'style-2'){
			$addressbox = service_finder_getshortAddress($provider->wp_user_id);			
			}else{
			$addressbox = '<div class="overlay-text">
									<div class="sf-address-bx">
										<i class="fa fa-map-marker"></i>
										'.service_finder_getshortAddress($provider->wp_user_id).'
									</div>
								</div>';
			}					
		}
		
			/*Start Search Style 1*/
			if($_POST['viewtype'] == 'grid-4'){
			/*4 grid layout*/
			if(service_finder_themestyle() == 'style-2'){
			$msg .= '<div class="col-md-3 col-sm-6 equal-col">
			<div class="sf-search-result-girds" id="proid-'.$provider->wp_user_id.'">
                            
                                <div class="sf-featured-top">
                                    <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
                                    <div class="sf-overlay-box"></div>
                                    <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
									'.service_finder_availability_label($provider->wp_user_id,$providersavailability).'
                                    '.service_finder_check_varified_icon($provider->wp_user_id).'
									'.$addtofavorite.'
                                    
                                    <div class="sf-featured-info">
                                        '.$featured.'
                                        <div  class="sf-featured-provider">'.service_finder_getExcerpts($provider->full_name,0,35).'</div>
                                        <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                    </div>
									<a href="'.esc_url($link).'" class="sf-profile-link"></a>
                                </div>
                                
                                <div class="sf-featured-bot">
                                    <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</div>
                                    <div class="sf-featured-text">'.service_finder_getExcerpts(nl2br(stripcslashes($provider->bio)),0,75).'</div>
                                    '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                                </div>
                                
                            </div>
							 </div>';
			}else{
				// baze edited
			$msg .= '<div class="col-md-3 col-sm-6 col-xs-6 equal-col">

                <div class="sf-provider-bx item">
                    <div class="sf-element-bx">
                    
                        <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                            
                           <div class="overlay-bx">
								'.$addressbox.'
						   </div>
                            
                           <strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
						   '.service_finder_availability_label($provider->wp_user_id,$providersavailability).'
						   '.$featured.'
                            
                        </div>
                        
                        <div class="padding-20 bg-white '.service_finder_check_varified($provider->wp_user_id).'">
                            <h4 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</h4>
                            <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
							'.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
							'.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
							'.service_finder_check_varified_icon($provider->wp_user_id).'
                        </div>
                        
                        <div class="btn-group-justified" id="proid-'.$provider->wp_user_id.'">
                          <a href="'.esc_url($link).'" class="btn btn-custom">'.esc_html__('Full View','service-finder').' <i class="fa fa-arrow-circle-o-right"></i></a>
                          '.$addtofavorite.'
                        </div>
                        
                    </div>
                </div>

            </div>';	
			}
            
			}elseif($_POST['viewtype'] == 'listview'){
			/*listview layout*/
			if(service_finder_themestyle() == 'style-2'){
			$msg .= '<div class="sf-featured-listing clearfix">
                            
                            <div class="sf-featured-left" id="proid-'.$provider->wp_user_id.'">
                                <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
								<a href="'.esc_url($link).'" class="sf-listing-link"></a>
                                <div class="sf-overlay-box"></div>
                                <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
								'.service_finder_availability_label($provider->wp_user_id,$providersavailability).'
                                '.service_finder_check_varified_icon($provider->wp_user_id).'
                                '.$addtofavorite.'
                                
                                <div class="sf-featured-info">
                                    '.$featured.'
                                </div>
                            </div>
                            
                            <div class="sf-featured-right">
                                <div  class="sf-featured-provider"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></div>
                                <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
								'.service_finder_getDistance($provider->distance).'
                                '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,30).'</div>
                                <div class="sf-featured-text">'.service_finder_getExcerpts($provider->bio,0,300).'</div>
                                '.$searchedservices.'
                                '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                            </div>
                            
                        </div>';
			}else{
			$msg .= '<div class="col-md-12">
                                <div class="sf-element-bx result-listing clearfix">
                                
                                    <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                                        
                                        <div class="overlay-bx">
											'.$addressbox.'
										</div>
										
										<strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
										'.service_finder_availability_label($provider->wp_user_id,$providersavailability).'
										'.$featured.'
                                        '.service_finder_check_varified_icon($provider->wp_user_id).'
                                    </div>
                                    
                                    <div class="result-text '.service_finder_check_varified($provider->wp_user_id).'" id="proid-'.$provider->wp_user_id.'">
                                    	<h5 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,30).'</h5>
										<strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
										'.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
										
                                        <div class="sf-address2-bx">
											<i class="fa fa-map-marker"></i>
											'.service_finder_getshortAddress($provider->wp_user_id).'
										</div>
										'.service_finder_getDistance($provider->distance).'
										<p>'.service_finder_getExcerpts($provider->bio,0,300).'</p>
                                        '.$addtofavorite.'
                                    </div>
                                    
                                </div>
                            </div>';
			}				
			}elseif($_POST['viewtype'] == 'grid-3'){
			
			if(service_finder_themestyle() == 'style-2'){
			$msg .= '<div class="col-md-4 col-sm-6 equal-col">
                                <div class="sf-search-result-girds" id="proid-'.$provider->wp_user_id.'">
                            
                                <div class="sf-featured-top">
                                    <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
                                    <div class="sf-overlay-box"></div>
                                    <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
									'.service_finder_availability_label($provider->wp_user_id,$providersavailability).'
                                    '.service_finder_check_varified_icon($provider->wp_user_id).'
									'.$addtofavorite.'
                                    
                                    <div class="sf-featured-info">
                                        '.$featured.'
                                        <div  class="sf-featured-provider">'.service_finder_getExcerpts($provider->full_name,0,35).'</div>
                                        <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                    </div>
									<a href="'.esc_url($link).'" class="sf-profile-link"></a>
                                </div>
                                
                                <div class="sf-featured-bot">
                                    <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,30).'</div>
                                    <div class="sf-featured-text">'.service_finder_getExcerpts(nl2br(stripcslashes($provider->bio)),0,75).'</div>
                                    '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                                </div>
                                
                            </div>
                            </div>';
			}else{
			/*3 grid layout*/            
		    $msg .= '<div class="col-md-4 col-sm-6 equal-col">
                                <div class="sf-provider-bx item">
                    <div class="sf-element-bx">
                    
                        <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                            
							<div class="overlay-bx">
								'.$addressbox.'
							</div>
                            
                            <strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
							'.service_finder_availability_label($provider->wp_user_id,$providersavailability).'
							'.$featured.'
                            
                        </div>
                        
                        <div class="padding-20 bg-white '.service_finder_check_varified($provider->wp_user_id).'">
                            <h4 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,30).'</h4>
                            <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
							'.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
							'.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
							'.service_finder_check_varified_icon($provider->wp_user_id).'
                        </div>
                        
                        <div class="btn-group-justified" id="proid-'.$provider->wp_user_id.'">
                          <a href="'.esc_url($link).'" class="btn btn-custom">'.esc_html__('Full View','service-finder').' <i class="fa fa-arrow-circle-o-right"></i></a>
                          '.$addtofavorite.'
                        </div>
                        
                    </div>
                </div>
                            </div>';
				}			
			}else{
			/*4 grid layout*/
			if(service_finder_themestyle() == 'style-2'){
			$msg .= '<div class="col-md-3 col-sm-6 equal-col">
			<div class="sf-search-result-girds" id="proid-'.$provider->wp_user_id.'">
                            
                                <div class="sf-featured-top">
                                    <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
                                    <div class="sf-overlay-box"></div>
                                    <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
									'.service_finder_availability_label($provider->wp_user_id,$providersavailability).'
                                    '.service_finder_check_varified_icon($provider->wp_user_id).'
									'.$addtofavorite.'
                                    
                                    <div class="sf-featured-info">
                                        '.$featured.'
                                        <div  class="sf-featured-provider">'.service_finder_getExcerpts($provider->full_name,0,35).'</div>
                                        <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                    </div>
									<a href="'.esc_url($link).'" class="sf-profile-link"></a>
                                </div>
                                
                                <div class="sf-featured-bot">
                                    <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</div>
                                    <div class="sf-featured-text">'.service_finder_getExcerpts(nl2br(stripcslashes($provider->bio)),0,75).'</div>
                                    '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                                </div>
                                
                            </div>
							 </div>';
			}else{
				// baze edited
			$msg .= '<div class="col-md-3 col-sm-6 col-xs-6 equal-col">

                <div class="sf-provider-bx item">
                    <div class="sf-element-bx">
                    
                        <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                            
                           <div class="overlay-bx">
								'.$addressbox.'
						   </div>
                            
                           <strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
						   '.service_finder_availability_label($provider->wp_user_id,$providersavailability).'
						   '.$featured.'
                            
                        </div>
                        
                        <div class="padding-20 bg-white '.service_finder_check_varified($provider->wp_user_id).'">
                            <h4 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</h4>
                            <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
							'.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
							'.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
							'.service_finder_check_varified_icon($provider->wp_user_id).'
                        </div>
                        
                        <div class="btn-group-justified" id="proid-'.$provider->wp_user_id.'">
                          <a href="'.esc_url($link).'" class="btn btn-custom">'.esc_html__('Full View','service-finder').' <i class="fa fa-arrow-circle-o-right"></i></a>
                          '.$addtofavorite.'
                        </div>
                        
                    </div>
                </div>

            </div>';	
			}
            
			}
			/*End Search Style 1*/
	}elseif($service_finder_options['search-template'] == 'style-2'){
	/*Start Search Style 2*/
	
	$showaddressinfo = (isset($service_finder_options['show-address-info'])) ? esc_attr($service_finder_options['show-address-info']) : '';
	$addressbox = '';
	  if($showaddressinfo && $service_finder_options['show-postal-address'] && service_finder_check_address_info_access()){
			if(service_finder_themestyle() == 'style-2'){
			$addressbox = service_finder_getshortAddress($provider->wp_user_id);			
			}else{
			$addressbox = '<div class="overlay-text">
									<div class="sf-address-bx">
										<i class="fa fa-map-marker"></i>
										'.service_finder_getshortAddress($provider->wp_user_id).'
									</div>
								</div>';
			}					
		}
			if($_POST['viewtype'] == 'grid-2'){
			/*Grid 2 Layout*/
			if(service_finder_themestyle() == 'style-2'){
			$msg .= '<div class="col-md-6 col-sm-6 equal-col maphover" data-id="'.esc_attr($provider->wp_user_id).'">
                                <div class="sf-search-result-girds" id="proid-'.$provider->wp_user_id.'">
                            
                                <div class="sf-featured-top">
                                    <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
                                    <div class="sf-overlay-box"></div>
                                    <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
									'.service_finder_availability_label($provider->wp_user_id,$providersavailability).'
                                    '.service_finder_check_varified_icon($provider->wp_user_id).'
									'.$addtofavorite.'
                                    
                                    <div class="sf-featured-info">
                                        '.$featured.'
                                        <div  class="sf-featured-provider">'.service_finder_getExcerpts($provider->full_name,0,35).'</div>
                                        <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                    </div>
									<a href="'.esc_url($link).'" class="sf-profile-link"></a>
                                </div>
                                
                                <div class="sf-featured-bot">
                                    <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</div>
                                    <div class="sf-featured-text">'.service_finder_getExcerpts(nl2br(stripcslashes($provider->bio)),0,60).'</div>
                                    '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                                </div>
                                
                            </div>
                            </div>';
			}else{
            $msg .= '<div class="col-md-6 col-sm-6 equal-col maphover" data-id="'.esc_attr($provider->wp_user_id).'">
                                <div class="sf-provider-bx item">
                    <div class="sf-element-bx">
                    
                        <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                            
							<div class="overlay-bx">
								'.$addressbox.'
							</div>
                            
                            <strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
							'.service_finder_availability_label($provider->wp_user_id,$providersavailability).'
							'.$featured.'
                            
                        </div>
                        
                        <div class="padding-20 bg-white '.service_finder_check_varified($provider->wp_user_id).'">
                            <h4 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</h4>
                            <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
							'.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
							'.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
							'.service_finder_check_varified_icon($provider->wp_user_id).'
                        </div>
                        
                        <div class="btn-group-justified" id="proid-'.$provider->wp_user_id.'">
                          <a href="'.esc_url($link).'" class="btn btn-custom">'.esc_html__('Full View','service-finder').' <i class="fa fa-arrow-circle-o-right"></i></a>
                          '.$addtofavorite.'
                        </div>
                        
                    </div>
                </div>
                            </div>';
				}			
			}elseif($_POST['viewtype'] == 'listview'){
			/*Listview layout*/
			if(service_finder_themestyle() == 'style-2'){
			$msg .= '<div class="sf-featured-listing clearfix">
                            
                            <div class="sf-featured-left" id="proid-'.$provider->wp_user_id.'">
                                <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
								<a href="'.esc_url($link).'" class="sf-listing-link"></a>
                                <div class="sf-overlay-box"></div>
                                <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
								'.service_finder_availability_label($provider->wp_user_id,$providersavailability).'
                                '.service_finder_check_varified_icon($provider->wp_user_id).'
                                '.$addtofavorite.'
                                
                                <div class="sf-featured-info">
                                    '.$featured.'
                                </div>
                            </div>
                            
                            <div class="sf-featured-right">
                                <div  class="sf-featured-provider"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></div>
                                <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
								'.service_finder_getDistance($provider->distance).'
                                '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,30).'</div>
                                <div class="sf-featured-text">'.service_finder_getExcerpts($provider->bio,0,300).'</div>
                                '.$searchedservices.'
                                '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                            </div>
                            
                        </div>';
			}else{
			$msg .= '<div class="col-md-12"><div class="sf-element-bx result-listing clearfix">
                        
                            <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                                
								<div class="overlay-bx maphover" data-id="'.esc_attr($provider->wp_user_id).'">
									'.$addressbox.'
								</div>
								
								<strong class="sf-category-tag"><a href="'.service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true)).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
								'.service_finder_availability_label($provider->wp_user_id,$providersavailability).'
								'.$featured.'
                                '.service_finder_check_varified_icon($provider->wp_user_id).'
                            </div>
                            
                            <div class="result-text '.service_finder_check_varified($provider->wp_user_id).'" id="proid-'.$provider->wp_user_id.'">
                                <h5 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,30).'</h5>
                                <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
								'.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
							    '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
								
                                <div class="sf-address2-bx">
									<i class="fa fa-map-marker"></i>
									'.service_finder_getshortAddress($provider->wp_user_id).'
								</div>
								'.service_finder_getDistance($provider->distance).'
								<p>'.service_finder_getExcerpts($provider->bio,0,150).'</p>
                                '.$addtofavorite.'
								
                            </div>
                            
                        </div></div>';
			}			
			}else{
			/*Grid 2 Layout*/
			if(service_finder_themestyle() == 'style-2'){
			$msg .= '<div class="col-md-6 col-sm-6 equal-col maphover" data-id="'.esc_attr($provider->wp_user_id).'">
                                <div class="sf-search-result-girds" id="proid-'.$provider->wp_user_id.'">
                            
                                <div class="sf-featured-top">
                                    <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
                                    <div class="sf-overlay-box"></div>
                                    <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
									'.service_finder_availability_label($provider->wp_user_id,$providersavailability).'
                                    '.service_finder_check_varified_icon($provider->wp_user_id).'
									'.$addtofavorite.'
                                    
                                    <div class="sf-featured-info">
                                        '.$featured.'
                                        <div  class="sf-featured-provider">'.service_finder_getExcerpts($provider->full_name,0,35).'</div>
                                        <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                    </div>
									<a href="'.esc_url($link).'" class="sf-profile-link"></a>
                                </div>
                                
                                <div class="sf-featured-bot">
                                    <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</div>
                                    <div class="sf-featured-text">'.service_finder_getExcerpts(nl2br(stripcslashes($provider->bio)),0,60).'</div>
                                    '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                                </div>
                                
                            </div>
                            </div>';
			}else{
            $msg .= '<div class="col-md-6 col-sm-6 equal-col maphover" data-id="'.esc_attr($provider->wp_user_id).'">
                                <div class="sf-provider-bx item">
                    <div class="sf-element-bx">
                    
                        <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                            
							<div class="overlay-bx">
								'.$addressbox.'
							</div>
                            
                            <strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
							'.service_finder_availability_label($provider->wp_user_id,$providersavailability).'
							'.$featured.'
                            
                        </div>
                        
                        <div class="padding-20 bg-white '.service_finder_check_varified($provider->wp_user_id).'">
                            <h4 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</h4>
                            <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
							'.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
							'.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
							'.service_finder_check_varified_icon($provider->wp_user_id).'
                        </div>
                        
                        <div class="btn-group-justified" id="proid-'.$provider->wp_user_id.'">
                          <a href="'.esc_url($link).'" class="btn btn-custom">'.esc_html__('Full View','service-finder').' <i class="fa fa-arrow-circle-o-right"></i></a>
                          '.$addtofavorite.'
                        </div>
                        
                    </div>
                </div>
                            </div>';
				}			
			}
	}		

     }
	 	if($_POST['viewtype'] == 'listview'){
		$msg .= '</div>';
		}else{
		$msg .= '</div>
                        </div>';
		}

	}else{
		/*No Result Found*/
		$msg .= '<div class="sf-nothing-found">
				<strong class="sf-tilte">'.esc_html__('Nothing Found', 'service-finder').'</strong>
					  <p>'.esc_html__('Apologies, but no results were found for the request.', 'service-finder').'</p>
				</div>';
		$flag = 1;
	}
	
	 // Optional, wrap the output into a container
        $msg = "<div class='cvf-universal-content'>" . $msg . "</div><br class = 'clear' />";
       
        // Ajax Pagination
        $no_of_paginations = ceil($count / $per_page);

        if ($cur_page >= 7) {
            $start_loop = $cur_page - 3;
            if ($no_of_paginations > $cur_page + 3)
                $end_loop = $cur_page + 3;
            else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
                $start_loop = $no_of_paginations - 6;
                $end_loop = $no_of_paginations;
            } else {
                $end_loop = $no_of_paginations;
            }
        } else {
            $start_loop = 1;
            if ($no_of_paginations > 7)
                $end_loop = 7;
            else
                $end_loop = $no_of_paginations;
        }
       
        // Pagination Buttons logic    
        $pag_container = "";
		$pag_container .= "
        <div class='cvf-universal-pagination pagination clearfix'>
            <ul class='pagination'>";

        if ($first_btn && $cur_page > 1) {
            $pag_container .= "<li data-pnum='1' class='activelink'><a href='javascript:;'><i class='fa fa-angle-double-left'></i></a></li>";
        } else if ($first_btn) {
            $pag_container .= "<li data-pnum='1' class='inactive'><a href='javascript:;'><i class='fa fa-angle-double-left'></i></a></li>";
        }

        if ($previous_btn && $cur_page > 1) {
            $pre = $cur_page - 1;
            $pag_container .= "<li data-pnum='$pre' class='activelink'><a href='javascript:;'><i class='fa fa-angle-left'></i></a></li>";
        } else if ($previous_btn) {
            $pag_container .= "<li class='inactive'><a href='javascript:;'><i class='fa fa-angle-left'></i></a></li>";
        }
        for ($i = $start_loop; $i <= $end_loop; $i++) {

            if ($cur_page == $i)
                $pag_container .= "<li data-pnum='$i' class = 'selected active' ><a href='javascript:;'>{$i}</a></li>";
            else
                $pag_container .= "<li data-pnum='$i' class='activelink'><a href='javascript:;'>{$i}</a></li>";
        }
       
        if ($next_btn && $cur_page < $no_of_paginations) {
            $nex = $cur_page + 1;
            $pag_container .= "<li data-pnum='$nex' class='activelink'><a href='javascript:;'><i class='fa fa-angle-right'></i></a></li>";
        } else if ($next_btn) {
            $pag_container .= "<li class='inactive'><a href='javascript:;'><i class='fa fa-angle-right'></i></a></li>";
        }

        if ($last_btn && $cur_page < $no_of_paginations) {
            $pag_container .= "<li data-pnum='$no_of_paginations' class='activelink'><a href='javascript:;'><i class='fa fa-angle-double-right'></i></a></li>";
        } else if ($last_btn) {
            $pag_container .= "<li data-pnum='$no_of_paginations' class='inactive'><a href='javascript:;'><i class='fa fa-angle-double-right'></i></a></li>";
        }

        $pag_container = $pag_container . "
            </ul>
        </div>";
       
	    if($flag == 1){
			$result = '<div class = "cvf-pagination-content">' . $msg . '</div>';
		}else{
	        $result = '<div class = "cvf-pagination-content">' . $msg . '</div>' .
    	    '<div class = "cvf-pagination-nav">' . $pag_container . '</div>';
		}
        
		
		
		
		$markers = rtrim($markers,',');
		$markers = '[ '.$markers.' ]';
		$resarr = array(
					'result' => $result,
					'markers' => $markers
				);
		
		echo json_encode($resarr);		
		
	
    exit();
}

/*Create plans for stripe*/
function service_finder_createPlans($service_finder_options){
global $wpdb, $service_finder_Errors;

/*Start Stripe Plans*/
require_once(SERVICE_FINDER_PAYMENT_GATEWAY_DIR.'/stripe/init.php');

if( isset($service_finder_options['stripe-type']) && $service_finder_options['stripe-type'] == 'test' ){
	$secret_key = (!empty($service_finder_options['stripe-test-secret-key'])) ? $service_finder_options['stripe-test-secret-key'] : '';
	$public_key = (!empty($service_finder_options['stripe-test-public-key'])) ? $service_finder_options['stripe-test-public-key'] : '';
}else{
	$secret_key = (!empty($service_finder_options['stripe-live-secret-key'])) ? $service_finder_options['stripe-live-secret-key'] : '';
	$public_key = (!empty($service_finder_options['stripe-live-public-key'])) ? $service_finder_options['stripe-live-public-key'] : '';
}

if($secret_key != ""){
try {
\Stripe\Stripe::setApiKey($secret_key);

$products_data = \Stripe\Product::all();

$products = array();
$k = 0;
if($products_data) {
	foreach($products_data['data'] as $product) {
		// store the plan ID as the array key and the plan name as the value
		$products[$k]['id'] = $product['id'];
		$products[$k]['name'] = $product['name'];
		$k++;
	}
}

$productexist = false;
$productid = '';
if(!empty($products)){
	foreach($products as $product){
		if($product['name'] == 'Service Finder'){
			$productexist = true;
			$productid = $product['id'];
		}
	}
}

if($productexist == false){
$newproduct = \Stripe\Product::create(array(
  "name" => 'Service Finder',
  "type" => "service")
);
$productid = $newproduct['id'];
}

// retrieve all plans from stripe
$plans_data = \Stripe\Plan::all(array("product" => $productid));

// setup a blank array
$plans = array();
if($plans_data) {
	foreach($plans_data['data'] as $plan) {
		// store the plan ID as the array key and the plan name as the value
		$plans[] = $plan['id'];
	}
}

try {
		for ($i=1; $i <= 3; $i++) {
		$enablepackage = (!empty($service_finder_options['enable-package'.$i])) ? $service_finder_options['enable-package'.$i] : '';
		if(isset($service_finder_options['enable-package'.$i]) && $enablepackage > 0){
		
		if (isset($service_finder_options['payment-type']) && ($service_finder_options['payment-type'] == 'recurring')) {
						$billingPeriod = esc_html__('year','service-finder');
						$packagebillingperiod = (!empty($service_finder_options['package'.$i.'-billing-period'])) ? $service_finder_options['package'.$i.'-billing-period'] : '';
						switch ($packagebillingperiod) {
							case 'Year':
								$billingPeriod = 'year';
								break;
							case 'Month':
								$billingPeriod = 'month';
								break;
							case 'Week':
								$billingPeriod = 'week';
								break;
							case 'Day':
								$billingPeriod = 'day';
								break;
						}
					
		
		$billingPrice = $service_finder_options['package'.$i.'-price'] * 100;
		$packageName = $service_finder_options['package'.$i.'-name'];
		$currencyCode = strtolower(service_finder_currencycode());
		$planID = 'package_'.$i;
		
		
		$free = (trim($service_finder_options['package'.$i.'-price']) == '0') ? true : false;
		
			if(!$free) {
			
			if(in_array($planID,$plans)){
			
			$p = \Stripe\Plan::retrieve($planID);
				if($p->nickname != $packageName && $p->amount == $billingPrice && $p->interval == $billingPeriod && $p->currency == $currencyCode){
					$p->nickname = $packageName;
					$p->save();
				}elseif($p->amount != $billingPrice || $p->interval != $billingPeriod || $p->currency != $currencyCode){
					$p->delete();
					\Stripe\Plan::create(array(
					  'product' => $productid,
					  "amount" => $billingPrice,
					  "interval" => $billingPeriod,
					  "nickname" => $packageName,
					  "currency" => $currencyCode,
					  "id" => $planID)
					);
				}
			}else{
				$a = \Stripe\Plan::create(array(
					  'product' => $productid,
					  "amount" => $billingPrice,
					  "interval" => $billingPeriod,
					  "nickname" => $packageName,
					  "currency" => $currencyCode,
					  "id" => $planID)
					);
					
			}	
			
			}
		}
		}
		}
		
		


} catch (Exception $e) {
	$body = $e->getJsonBody();
	$err  = $body['error'];

	$error = array(
			'status' => 'error',
			'err_message' => sprintf( esc_html__('%s', 'service-finder'), $err['message'] )
			);
	echo $service_finder_Errors = json_encode($error);
}

} catch (Exception $e) {
	$body = $e->getJsonBody();
	$err  = $body['error'];

	$error = array(
			'status' => 'error',
			'err_message' => sprintf( esc_html__('%s', 'service-finder'), $err['message'] )
			);
	echo $err['message'];
}

}
/*End Stripe Plans*/

/*Start PayU Latam Plans*/
require_once(SERVICE_FINDER_PAYMENT_GATEWAY_DIR.'/payulatam/lib/PayU.php');
					
if( isset($service_finder_options['payulatam-type']) && $service_finder_options['payulatam-type'] == 'test' ){
	$testmode = true;
	$payulatammerchantid = (isset($service_finder_options['payulatam-merchantid-test'])) ? $service_finder_options['payulatam-merchantid-test'] : '';
	$payulatamapilogin = (isset($service_finder_options['payulatam-apilogin-test'])) ? $service_finder_options['payulatam-apilogin-test'] : '';
	$payulatamapikey = (isset($service_finder_options['payulatam-apikey-test'])) ? $service_finder_options['payulatam-apikey-test'] : '';
	$payulatamaccountid = (isset($service_finder_options['payulatam-accountid-test'])) ? $service_finder_options['payulatam-accountid-test'] : '';
	
	$paymenturl = "https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi";
	$reportsurl = "https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi";
	$subscriptionurl = "https://sandbox.api.payulatam.com/payments-api/rest/v4.3/";
	
	$fullname = 'APPROVED';
	
}else{
	$testmode = false;
	$payulatammerchantid = (isset($service_finder_options['payulatam-merchantid-live'])) ? $service_finder_options['payulatam-merchantid-live'] : '';
	$payulatamapilogin = (isset($service_finder_options['payulatam-apilogin-live'])) ? $service_finder_options['payulatam-apilogin-live'] : '';
	$payulatamapikey = (isset($service_finder_options['payulatam-apikey-live'])) ? $service_finder_options['payulatam-apikey-live'] : '';
	$payulatamaccountid = (isset($service_finder_options['payulatam-accountid-live'])) ? $service_finder_options['payulatam-accountid-live'] : '';
	
	$paymenturl = "https://api.payulatam.com/payments-api/4.0/service.cgi";
	$reportsurl = "https://api.payulatam.com/reports-api/4.0/service.cgi";
	$subscriptionurl = "https://api.payulatam.com/payments-api/rest/v4.3/";
	
	$fullname = $userdata->user_login;
}

$country = (isset($service_finder_options['payulatam-country'])) ? $service_finder_options['payulatam-country'] : '';

PayU::$apiKey = $payulatamapikey; //Enter your own apiKey here.
PayU::$apiLogin = $payulatamapilogin; //Enter your own apiLogin here.
PayU::$merchantId = $payulatammerchantid; //Enter your commerce Id here.
PayU::$language = SupportedLanguages::EN; //Select the language.
PayU::$isTest = $testmode; //Leave it True when testing.

// Payments URL
Environment::setPaymentsCustomUrl($paymenturl);
// Queries URL
Environment::setReportsCustomUrl($reportsurl);
// Subscriptions for recurring payments URL
Environment::setSubscriptionsCustomUrl($subscriptionurl);

if($payulatamapikey != "" && $payulatamapilogin != "" && $payulatammerchantid != "" && $payulatamaccountid != ""){

try {
	
	for ($i=1; $i <= 3; $i++) {
		$enablepackage = (!empty($service_finder_options['enable-package'.$i])) ? $service_finder_options['enable-package'.$i] : '';
		if(isset($service_finder_options['enable-package'.$i]) && $enablepackage > 0){
		
		if (isset($service_finder_options['payment-type']) && ($service_finder_options['payment-type'] == 'recurring')) {
						$billingPeriod = esc_html__('year','service-finder');
						$packagebillingperiod = (!empty($service_finder_options['package'.$i.'-billing-period'])) ? $service_finder_options['package'.$i.'-billing-period'] : '';
						switch ($packagebillingperiod) {
							case 'Year':
								$billingPeriod = esc_html__('YEAR','service-finder');
								break;
							case 'Month':
								$billingPeriod = esc_html__('MONTH','service-finder');
								break;
							case 'Week':
								$billingPeriod = esc_html__('WEEK','service-finder');
								break;
							case 'Day':
								$billingPeriod = esc_html__('DAY','service-finder');
								break;
						}
					
		
		$billingPrice = $service_finder_options['package'.$i.'-price'] * 100;
		$packageName = $service_finder_options['package'.$i.'-name'];
		$currencyCode = strtoupper(service_finder_currencycode());
		$planID = 'package_'.$i;
		
		
		$free = (trim($service_finder_options['package'.$i.'-price']) == '0') ? true : false;
		
			if(!$free) {
			
			$parameters = array(
				// Enter the plan�s description here.
				PayUParameters::PLAN_DESCRIPTION => $packageName,
				// Enter the identification code of the plan here.
				PayUParameters::PLAN_CODE => $planID,
				// Enter the interval of the plan here.
				//DAY||WEEK||MONTH||YEAR
				PayUParameters::PLAN_INTERVAL => $billingPeriod,
				// Enter the number of intervals here.
				PayUParameters::PLAN_INTERVAL_COUNT => "1",
				// Enter the currency of the plan here.
				PayUParameters::PLAN_CURRENCY => $currencyCode,
				// Enter the value of the plan here.
				PayUParameters::PLAN_VALUE => $billingPrice,
				// Enter the account ID of the plan here.
				PayUParameters::ACCOUNT_ID => $payulatamaccountid,
				// Enter the amount of charges that make up the plan here
				PayUParameters::PLAN_MAX_PAYMENTS => "12",
				// Enter the retry interval here
				PayUParameters::PLAN_ATTEMPTS_DELAY => "1",
			);
			
			$response = PayUSubscriptionPlans::create($parameters);

			}
		}
		}
		}
	
} catch (Exception $e) {

	$error = array(
			'status' => 'error',
			'err_message' => $e->getMessage()
			);
	$service_finder_Errors = json_encode($error);
	
}	

}

/*End PayU Latam Plans*/

}

/*Get Page ID By Its Slug*/
function service_finder_get_id_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

/*Get Lat Long By Address*/
function service_finder_getLatLong($address){
	global $wp_filesystem, $service_finder_options;
	if ( empty( $wp_filesystem ) ) {
          require_once ABSPATH . '/wp-admin/includes/file.php';
          WP_Filesystem();
    }
	
	$apikey = (!empty($service_finder_options['server-api-key'])) ? $service_finder_options['server-api-key'] : '';
	if($apikey != ""){			
		$geocode_stats = $wp_filesystem->get_contents("https://maps.googleapis.com/maps/api/geocode/json?key=".$apikey."&address=".$address);
	}else{
		$geocode_stats = $wp_filesystem->get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=".$address);
	}
	
	$output_deals = json_decode($geocode_stats);
	
	$latLng = (!empty($output_deals->results[0]->geometry->location)) ? $output_deals->results[0]->geometry->location : '';
	
	
	$res = array(
			'lat' => (!empty($latLng->lat)) ? $latLng->lat : '',
			'lng' => (!empty($latLng->lng)) ? $latLng->lng : '',
	);
	
	return $res;
}

/*Call the function to delete providers data when delete the provider from admin*/
function service_finder_custom_remove_user( $user_id ) {
service_finder_deleteProvidersData($user_id);
}
add_action( 'delete_user', 'service_finder_custom_remove_user', 10 );

/*Manage Redirect after login*/
function service_finder_redirect_afterlogin( $redirect_to, $request, $user ) {
	global $user;
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		if ( in_array( 'administrator', $user->roles ) ) {
			return $redirect_to;
		} elseif(in_array( 'Provider', $user->roles ) || in_array( 'Customer', $user->roles )){
			return service_finder_get_url_by_shortcode('[service_finder_my_account]');
		} else{
			return home_url('/');
		}
	} else {
		return $redirect_to;
	}
}
/*Filter to Manage Redirect after login*/
add_filter( 'login_redirect', 'service_finder_redirect_afterlogin', 10, 3 );

/*Manage authentication user for block and moderation purpose*/
add_filter('wp_authenticate_user', 'service_finder_user_authentication',10,2);
function service_finder_user_authentication ($user, $password) {
	 global $service_finder_Errors, $service_finder_options, $service_finder_Tables, $wpdb;
	 
	 $allowaccess = (isset($service_finder_options['allow-access-untill-admin-approves'])) ? esc_attr($service_finder_options['allow-access-untill-admin-approves']) : '';

	 $role = service_finder_getUserRole($user->ID);
	 if($role == "Provider"){
		 $service_finder_Errors = new WP_Error();
		 $providerinfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE wp_user_id = %d',$user->ID));
		 
		 if($providerinfo->admin_moderation != "approved" && $allowaccess == 'no'){
			$service_finder_Errors->add( 'admin_moderation', esc_html__( 'ERROR: Your account is not approved' , 'service-finder') );
			return $service_finder_Errors;
		 }elseif($providerinfo->account_blocked == "yes"){
			$service_finder_Errors->add( 'account_block', esc_html__( 'ERROR: Your account has been blocked. Please contact administrator' , 'service-finder') );
			return $service_finder_Errors;
		 }else{
			return $user;
		 }
	 }else{
	 	return $user;
	 }
}

/*Encode url for use in javascript files*/
function service_finder_encodeURIComponent(){
$url = '';
		$unescaped = array(
        '%2D'=>'-','%5F'=>'_','%2E'=>'.','%21'=>'!', '%7E'=>'~',
        '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')'
    );
    $reserved = array(
        '%3B'=>';','%2C'=>',','%2F'=>'/','%3F'=>'?','%3A'=>':',
        '%40'=>'@','%26'=>'&','%3D'=>'=','%2B'=>'+','%24'=>'$'
    );
    $score = array(
        '%23'=>'#'
    );
    return strtr(rawurlencode($url), array_merge($reserved,$unescaped,$score));
}

//function to check permalinks
function service_finder_using_permalink(){
return get_option('permalink_structure');
}

//Sub header
function service_finder_sub_header_pl(){
global $service_finder_globals;
$service_finder_options = $service_finder_globals;

$subheader = (!empty($service_finder_options['sub-header'])) ? $service_finder_options['sub-header'] : '';
return $subheader;
}

//Inner page banner image
function service_finder_innerpage_banner_pl(){
global $service_finder_globals;
$service_finder_options = $service_finder_globals;

$bannerimg = (!empty($service_finder_options['inner-sub-header-bg-image']['url'])) ? $service_finder_options['inner-sub-header-bg-image']['url'] : '';
return $bannerimg;
}

//Provider sub header bg image
function service_finder_provider_coverbanner_pl(){
global $service_finder_globals;
$service_finder_options = $service_finder_globals;

$coverbanner = (!empty($service_finder_options['provider-sub-header-bg-image']['url'])) ? $service_finder_options['provider-sub-header-bg-image']['url'] : '';
return $coverbanner;
}

//Breadcrumb
function service_finder_breadcrumb_pl(){
global $service_finder_globals;
$service_finder_options = $service_finder_globals;

$breadcrumbs = (!empty($service_finder_options['breadcrumbs'])) ? $service_finder_options['breadcrumbs'] : '';
return $breadcrumbs;
}

//Get services
function service_finder_get_booking_services($bookingid){
global $wpdb, $service_finder_Tables;
$html = '';
$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$bookingid));
	if(!empty($row)){
		if($row->multi_date != 'yes'){
		$services = esc_html($row->services);
		$services = rtrim($services,'%%');
		$servicearr = explode('%%',$services);
		if(!empty($servicearr)){
		$html = '<ul class="sf-booking-services">';
			if(!empty($servicearr)){
			foreach($servicearr as $service){
				$tem = explode('-',$service);
				if(!empty($tem)){
				$serviceid = $tem[0];
				$servicehours = (!empty($tem[1])) ? $tem[1] : '';
				$servicedata = service_finder_get_service_by_id($serviceid);
				if(!empty($servicedata)){
					if($servicedata->cost_type == 'hourly'){
					$html .= '<li>'.esc_html($servicedata->service_name).' ('.esc_html__( 'Hourly', 'service-finder' ).') - '.esc_html($servicehours).' '.esc_html__( 'hrs', 'service-finder' ).'</li>';
					}elseif($servicedata->cost_type == 'perperson'){
					$html .= '<li>'.esc_html($servicedata->service_name).' ('.esc_html__( 'Per Person', 'service-finder' ).') - '.esc_html($servicehours).' '.esc_html__( 'persons', 'service-finder' ).'</li>';
					}else{
					$html .= '<li>'.esc_html($servicedata->service_name).'</li>';
					}
				}	
				}
			}
			}
		$html .= '</ul>';	
		}
		}else{
		$results = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$service_finder_Tables->booked_services." WHERE `booking_id` = %d GROUP BY `service_id`",$bookingid));
		if(!empty($results)){
			$html = '<div class="table-responsive" id="small-divice-tables">          
					  <table class="table sf-responsive-table">
						<thead>
						  <tr>
							<th>'.esc_html__( 'Service Name', 'service-finder' ).'</th>
							<th>'.esc_html__( 'Date', 'service-finder' ).'</th>
							<th>'.esc_html__( 'Start Time', 'service-finder' ).'</th>
							<th>'.esc_html__( 'End Time', 'service-finder' ).'</th>
							<th>'.esc_html__( 'Full Day', 'service-finder' ).'</th>
							<th>'.esc_html__( 'Status', 'service-finder' ).'</th>
							<th>'.esc_html__( 'Member Name', 'service-finder' ).'</th>
							<th>'.esc_html__( 'Coupon Code', 'service-finder' ).'</th>
							<th>'.esc_html__( 'Discount', 'service-finder' ).'</th>
						  </tr>
						</thead>
						<tbody>';
			foreach($results as $result){
				$starttime = ($result->without_padding_start_time != NULL) ? $result->without_padding_start_time : $result->start_time;
				$endtime = ($result->without_padding_end_time != NULL) ? $result->without_padding_end_time : $result->end_time;
				
				$starttime = ($starttime != NULL) ? $starttime : '-';
				$endtime = ($endtime != NULL) ? $endtime : '-';
				
				$fullday = ($result->fullday != "") ? $result->fullday : '-';
				$member = ($result->member_id > 0) ? service_finder_getMemberName($result->member_id) : '-';
				
				$couponcode = ($result->couponcode != "") ? esc_attr($result->couponcode) : 'NA';
				$discount = ($result->discount > 0 && $result->discount != "") ? service_finder_money_format($result->discount) : 'NA';
				$changestatus = '<button type="button" class="btn btn-warning btn-xs change_service_status" data-currentstatus="'.esc_attr($result->status).'" data-bsid="'.esc_attr($result->id).'" title="'.esc_html__( 'Change Status', 'service-finder' ).'"><i class="fa fa-battery-half"></i></button>';
				if($result->status == 'pending'){
				$status = 'incomplete';
				}else{
				$status = $result->status;
				}
				$html .= '<tr id="service-'.$result->id.'">
							<td data-title="'.esc_html__( 'Service Name', 'service-finder' ).'">'.service_finder_get_service_name($result->service_id).'</td>
							<td data-title="'.esc_html__( 'Date', 'service-finder' ).'">'.date('d-m-Y',strtotime($result->date)).'</td>
							<td data-title="'.esc_html__( 'Start Time', 'service-finder' ).'">'.$starttime.'</td>
							<td data-title="'.esc_html__( 'End Time', 'service-finder' ).'">'.$endtime.'</td>
							<td data-title="'.esc_html__( 'Full Day', 'service-finder' ).'">'.$fullday.'</td>
							<td data-title="'.esc_html__( 'Status', 'service-finder' ).'"><span class="servicestatus">'.service_finder_translate_static_status_string($status).'</span> '.$changestatus.'</td>
							<td data-title="'.esc_html__( 'Member Name', 'service-finder' ).'">'.$member.'</td>
							<td data-title="'.esc_html__( 'Coupon Code', 'service-finder' ).'">'.$couponcode.'</td>
							<td data-title="'.esc_html__( 'Discount', 'service-finder' ).'">'.$discount.'</td>
						  </tr>';
			}
			$html .= '</tbody>
					  </table>
					  </div>';	
		}
		
		}
	}
	return $html;
}

//Get services summary
function service_finder_get_booking_services_summary($bookingid){
global $wpdb, $service_finder_Tables;
$html = '';
$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$bookingid));
	if(!empty($row)){
		if($row->multi_date == 'yes'){
		$results = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$service_finder_Tables->booked_services." WHERE `booking_id` = %d GROUP BY `service_id`",$bookingid));
		if(!empty($results)){
			$html = '<div class="table-responsive">          
					  <table class="table">
						<thead>
						  <tr>
							<th>'.esc_html__( 'Service Name', 'service-finder' ).'</th>
							<th>'.esc_html__( 'Date', 'service-finder' ).'</th>
							<th>'.esc_html__( 'Start Time', 'service-finder' ).'</th>
							<th>'.esc_html__( 'End Time', 'service-finder' ).'</th>
						  </tr>
						</thead>
						<tbody>';
			foreach($results as $result){
				$starttime = ($result->without_padding_start_time != NULL) ? $result->without_padding_start_time : $result->start_time;
				$endtime = ($result->without_padding_end_time != NULL) ? $result->without_padding_end_time : $result->end_time;
				
				$starttime = ($starttime != NULL) ? $starttime : '-';
				$endtime = ($endtime != NULL) ? $endtime : '-';

				$html .= '<tr id="service-'.$result->id.'">
							<td>'.service_finder_get_service_name($result->service_id).'</td>
							<td>'.date('d-m-Y',strtotime($result->date)).'</td>
							<td>'.$starttime.'</td>
							<td>'.$endtime.'</td>
						  </tr>';
			}
			$html .= '</tbody>
					  </table>
					  </div>';	
		}
		
		}
	}
	return $html;
}

//Get service by id
function service_finder_get_service_by_id($serviceid){
global $wpdb, $service_finder_Tables;
$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->services.' WHERE `id` = %d',$serviceid));
return $row;	
}

add_action( 'post_submitbox_misc_actions', 'service_finder_check_display_banner' );

function service_finder_check_display_banner()
{
    $post_id = get_the_ID();
  
    if (get_post_type($post_id) != 'page') {
        return;
    }
  
  	$value = get_post_meta($post_id, '_display_banner', true);
    wp_nonce_field('my_custom_nonce_'.$post_id, 'my_custom_nonce');
	
	if (service_finder_is_edit_page('new')){
	    $checked = 'checked="checked"';
	}else{
		$checked = checked($value, true, false);
	}
    ?>
    <div class="misc-pub-section misc-pub-section-last">
        <label><input type="checkbox" value="1" <?php echo esc_attr($checked); ?> name="_display_banner" /><?php esc_html_e('Display Banner', 'service-finder'); ?></label>
    </div>

    <?php
	$value = get_post_meta($post_id, '_display_title', true);
    if (service_finder_is_edit_page('new')){
	    $checked = 'checked="checked"';
	}else{
		$checked = checked($value, true, false);
	}
	?>
    
    <div class="misc-pub-section misc-pub-section-last">
        <label><input type="checkbox" value="1" <?php echo esc_attr($checked); ?> name="_display_title" /><?php esc_html_e('Display Title', 'service-finder'); ?></label>
    </div>
    
    <?php
	$value = get_post_meta($post_id, '_display_sidebar', true);
    if (service_finder_is_edit_page('new')){
	    $checked = 'checked="checked"';
	}else{
		$checked = checked($value, true, false);
	}
	?>
    
    <div class="misc-pub-section misc-pub-section-last">
        <label><input type="checkbox" value="1" <?php echo esc_attr($checked); ?> name="_display_sidebar" /><?php esc_html_e('Display Sidebar', 'service-finder'); ?></label>
    </div>
    
    <?php
	$value = get_post_meta($post_id, '_display_comment', true);
    if (service_finder_is_edit_page('new')){
	    $checked = 'checked="checked"';
	}else{
		$checked = checked($value, true, false);
	}
	?>
    
    <div class="misc-pub-section misc-pub-section-last">
        <label><input type="checkbox" value="1" <?php echo esc_attr($checked); ?> name="_display_comment" /><?php esc_html_e('Display Comment', 'service-finder'); ?></label>
    </div>
    <?php
}

add_action('save_post', 'service_finder_save_display_banner');

function service_finder_save_display_banner($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
	$my_custom_nonce = (!empty($_POST['my_custom_nonce'])) ? esc_html($_POST['my_custom_nonce']) : '';
	$display_banner = (!empty($_POST['_display_banner'])) ? esc_html($_POST['_display_banner']) : '';
	$display_title = (!empty($_POST['_display_title'])) ? esc_html($_POST['_display_title']) : '';
	$display_sidebar = (!empty($_POST['_display_sidebar'])) ? esc_html($_POST['_display_sidebar']) : '';
	$display_comment = (!empty($_POST['_display_comment'])) ? esc_html($_POST['_display_comment']) : '';
	
	if (!isset($my_custom_nonce) || !wp_verify_nonce($my_custom_nonce, 'my_custom_nonce_'.$post_id)) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($display_banner)) {
        update_post_meta($post_id, '_display_banner', $display_banner);
    } else {
        delete_post_meta($post_id, '_display_banner');
    }
	if (isset($display_title)) {
        update_post_meta($post_id, '_display_title', $display_title);
    } else {
        delete_post_meta($post_id, '_display_title');
    }
	if (isset($display_sidebar)) {
        update_post_meta($post_id, '_display_sidebar', $display_sidebar);
    } else {
        delete_post_meta($post_id, '_display_sidebar');
    }
	if (isset($display_comment)) {
        update_post_meta($post_id, '_display_comment', $display_comment);
    } else {
        delete_post_meta($post_id, '_display_comment');
    }
}

function service_finder_is_edit_page($new_edit = null){
    global $pagenow;
    //make sure we are on the backend
    if (!is_admin()) return false;


    if($new_edit == "edit")
        return in_array( $pagenow, array( 'post.php',  ) );
    elseif($new_edit == "new") //check for new post page
        return in_array( $pagenow, array( 'post-new.php' ) );
    else //check for either new or edit
        return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
}

//To Check if job booking is authorized or not
function service_finder_is_job_author($jobid,$jobauthor){
global $wpdb, $current_user; 

	if(is_user_logged_in() && service_finder_getUserRole($current_user->ID) == 'Customer' && $jobid > 0 && $jobauthor == $current_user->ID){
	  return true;
	}else{
	  return false;
	}
}

//To Check if job booking is authorized or not
function service_finder_is_quotation_author($quoteid,$quoteauthor){
global $wpdb, $current_user; 

	if(is_user_logged_in() && service_finder_getUserRole($current_user->ID) == 'Customer' && $quoteid > 0 && $quoteauthor == $current_user->ID){
	  return true;
	}else{
	  return false;
	}
}

//To Check if job booking is authorized or not
function service_finder_check_account_authorization($manageaccountby,$manageproviderid){
global $wpdb, $current_user; 

	if(is_user_logged_in() && $manageaccountby == 'admin' && service_finder_getUserRole($manageproviderid) == 'Provider' && service_finder_getUserRole($current_user->ID) == 'administrator'){
	  return true;
	}else{
	  return false;
	}
}

function service_finder_get_countries(){
	$countries = array(
    "AF" =>  'Afghanistan',
    "AX" =>  'Aland Islands',
    "AL" =>  'Albania',
    "DZ" =>  'Algeria',
    "AS" =>  'American Samoa',
    "AD" =>  'Andorra',
    "AO" =>  'Angola',
    "AI" =>  'Anguilla',
    "AQ" =>  'Antarctica',
    "AG" =>  'Antigua and Barbuda',
    "AR" =>  'Argentina',
    "AM" =>  'Armenia',
    "AW" =>  'Aruba',
    "AU" =>  'Australia',
    "AT" =>  'Austria',
    "AZ" =>  'Azerbaijan',
    "BS" =>  'Bahamas',
    "BH" =>  'Bahrain',
    "BD" =>  'Bangladesh',
    "BB" =>  'Barbados',
    "BY" =>  'Belarus',
    "BE" =>  'Belgium',
    "BZ" =>  'Belize',
    "BJ" =>  'Benin',
    "BM" =>  'Bermuda',
    "BT" =>  'Bhutan',
    "BO" =>  'Bolivia',
    "BA" =>  'Bosnia and Herzegovina',
    "BW" =>  'Botswana',
    "BV" =>  'Bouvet Island',
    "BR" =>  'Brazil',
    "IO" =>  'British Indian Ocean Territory',
    "BN" =>  'Brunei Darussalam',
    "BG" =>  'Bulgaria',
    "BF" =>  'Burkina Faso',
    "BI" =>  'Burundi',
    "KH" =>  'Cambodia',
    "CM" =>  'Cameroon',
    "CA" =>  'Canada',
    "CV" =>  'Cape Verde',
    "KY" =>  'Cayman Islands',
    "CF" =>  'Central African Republic',
    "TD" =>  'Chad',
    "CL" =>  'Chile',
    "CN" =>  'China',
    "CX" =>  'Christmas Island',
    "CC" =>  'Cocos (Keeling) Islands',
    "CO" =>  'Colombia',
    "KM" =>  'Comoros',
    "CG" =>  'Congo',
    "CD" =>  'Congo, The Democratic Republic of The',
    "CK" =>  'Cook Islands',
    "CR" =>  'Costa Rica',
    "CI" =>  'Cote D\'ivoire',
    "HR" =>  'Croatia',
    "CU" =>  'Cuba',
    "CY" =>  'Cyprus',
    "CZ" =>  'Czech Republic',
    "DK" =>  'Denmark',
    "DJ" =>  'Djibouti',
    "DM" =>  'Dominica',
    "DO" =>  'Dominican Republic',
    "EC" =>  'Ecuador',
    "EG" =>  'Egypt',
    "SV" =>  'El Salvador',
    "GQ" =>  'Equatorial Guinea',
    "ER" =>  'Eritrea',
    "EE" =>  'Estonia',
    "ET" =>  'Ethiopia',
    "FK" =>  'Falkland Islands (Malvinas)',
    "FO" =>  'Faroe Islands',
    "FJ" =>  'Fiji',
    "FI" =>  'Finland',
    "FR" =>  'France',
    "GF" =>  'French Guiana',
    "PF" =>  'French Polynesia',
    "TF" =>  'French Southern Territories',
    "GA" =>  'Gabon',
    "GM" =>  'Gambia',
    "GE" =>  'Georgia',
    "DE" =>  'Germany',
    "GH" =>  'Ghana',
    "GI" =>  'Gibraltar',
    "GR" =>  'Greece',
    "GL" =>  'Greenland',
    "GD" =>  'Grenada',
    "GP" =>  'Guadeloupe',
    "GU" =>  'Guam',
    "GT" =>  'Guatemala',
    "GG" =>  'Guernsey',
    "GN" =>  'Guinea',
    "GW" =>  'Guinea-bissau',
    "GY" =>  'Guyana',
    "HT" =>  'Haiti',
    "HM" =>  'Heard Island and Mcdonald Islands',
    "VA" =>  'Holy See (Vatican City State)',
    "HN" =>  'Honduras',
    "HK" =>  'Hong Kong',
    "HU" =>  'Hungary',
    "IS" =>  'Iceland',
    "IN" =>  'India',
    "ID" =>  'Indonesia',
    "IR" =>  'Iran, Islamic Republic of',
    "IQ" =>  'Iraq',
    "IE" =>  'Ireland',
    "IM" =>  'Isle of Man',
    "IL" =>  'Israel',
    "IT" =>  'Italy',
    "JM" =>  'Jamaica',
    "JP" =>  'Japan',
    "JE" =>  'Jersey',
    "JO" =>  'Jordan',
    "KZ" =>  'Kazakhstan',
    "KE" =>  'Kenya',
    "KI" =>  'Kiribati',
    "KP" =>  'Korea, Democratic People\'s Republic of',
    "KR" =>  'Korea, Republic of',
    "KW" =>  'Kuwait',
    "KG" =>  'Kyrgyzstan',
    "LA" =>  'Lao People\'s Democratic Republic',
    "LV" =>  'Latvia',
    "LB" =>  'Lebanon',
    "LS" =>  'Lesotho',
    "LR" =>  'Liberia',
    "LY" =>  'Libyan Arab Jamahiriya',
    "LI" =>  'Liechtenstein',
    "LT" =>  'Lithuania',
    "LU" =>  'Luxembourg',
    "MO" =>  'Macao',
    "MK" =>  'Macedonia, The Former Yugoslav Republic of',
    "MG" =>  'Madagascar',
	"HU" =>  'Magyar',
    "MW" =>  'Malawi',
    "MY" =>  'Malaysia',
    "MV" =>  'Maldives',
    "ML" =>  'Mali',
    "MT" =>  'Malta',
    "MH" =>  'Marshall Islands',
    "MQ" =>  'Martinique',
    "MR" =>  'Mauritania',
    "MU" =>  'Mauritius',
    "YT" =>  'Mayotte',
    "MX" =>  'Mexico',
    "FM" =>  'Micronesia, Federated States of',
    "MD" =>  'Moldova, Republic of',
    "MC" =>  'Monaco',
    "MN" =>  'Mongolia',
    "ME" =>  'Montenegro',
    "MS" =>  'Montserrat',
    "MA" =>  'Morocco',
    "MZ" =>  'Mozambique',
    "MM" =>  'Myanmar',
    "NA" =>  'Namibia',
    "NR" =>  'Nauru',
    "NP" =>  'Nepal',
    "NL" =>  'Netherlands',
    "AN" =>  'Netherlands Antilles',
    "NC" =>  'New Caledonia',
    "NZ" =>  'New Zealand',
    "NI" =>  'Nicaragua',
    "NE" =>  'Nicaragua',
    "NG" =>  'Nigeria',
	"NE" =>  'Niger',
    "NU" =>  'Niue',
    "NF" =>  'Norfolk Island',
    "MP" =>  'Northern Mariana Islands',
    "NO" =>  'Norway',
    "OM" =>  'Oman',
    "PK" =>  'Pakistan',
    "PW" =>  'Palau',
    "PS" =>  'Palestinian Territory, Occupied',
    "PA" =>  'Panama',
    "PG" =>  'Papua New Guinea',
    "PY" =>  'Paraguay',
    "PE" =>  'Peru',
    "PH" =>  'Philippines',
    "PN" =>  'Pitcairn',
    "PL" =>  'Poland',
    "PT" =>  'Portugal',
    "PR" =>  'Puerto Rico',
    "QA" =>  'Qatar',
    "RE" =>  'Reunion',
    "RO" =>  'Romania',
    "RU" =>  'Russian Federation',
    "RW" =>  'Rwanda',
    "SH" =>  'Saint Helena',
    "KN" =>  'Saint Kitts and Nevis',
    "LC" =>  'Saint Lucia',
    "PM" =>  'Saint Pierre and Miquelon',
    "VC" =>  'Saint Vincent and The Grenadines',
    "WS" =>  'Samoa',
    "SM" =>  'San Marino',
    "ST" =>  'Sao Tome and Principe',
    "SA" =>  'Saudi Arabia',
    "SN" =>  'Senegal',
    "RS" =>  'Serbia',
    "SC" =>  'Seychelles',
    "SL" =>  'Sierra Leone',
    "SG" =>  'Singapore',
    "SK" =>  'Slovakia',
    "SI" =>  'Slovenia',
    "SB" =>  'Solomon Islands',
    "SO" =>  'Somalia',
    "ZA" =>  'South Africa',
    "GS" =>  'South Georgia and The South Sandwich Islands',
    "ES" =>  'Spain',
    "LK" =>  'Sri Lanka',
    "SD" =>  'Sudan',
    "SR" =>  'Suriname',
    "SJ" =>  'Svalbard and Jan Mayen',
    "SZ" =>  'Swaziland',
    "SE" =>  'Sweden',
    "CH" =>  'Switzerland',
    "SY" =>  'Syrian Arab Republic',
    "TW" =>  'Taiwan, Province of China',
    "TJ" =>  'Tajikistan',
    "TZ" =>  'Tanzania, United Republic of',
    "TH" =>  'Thailand',
    "TL" =>  'Timor-leste',
    "TG" =>  'Togo',
    "TK" =>  'Tokelau',
    "TO" =>  'Tonga',
    "TT" =>  'Trinidad and Tobago',
    "TN" =>  'Tunisia',
    "TR" =>  'Turkey',
    "TM" =>  'Turkmenistan',
    "TC" =>  'Turks and Caicos Islands',
    "TV" =>  'Tuvalu',
    "UG" =>  'Uganda',
    "UA" =>  'Ukraine',
    "AE" =>  'United Arab Emirates',
    "GB" =>  'United Kingdom',
    "US" =>  'United States',
    "UM" =>  'United States Minor Outlying Islands',
    "UY" =>  'Uruguay',
    "UZ" =>  'Uzbekistan',
    "VU" =>  'Vanuatu',
    "VE" =>  'Venezuela',
    "VN" =>  'Viet Nam',
    "VG" =>  'Virgin Islands, British',
    "VI" =>  'Virgin Islands, U.S.',
    "WF" =>  'Wallis and Futuna',
    "EH" =>  'Western Sahara',
    "YE" =>  'Yemen',
    "ZM" =>  'Zambia',
    "ZW" =>  'Zimbabwe');
	return $countries;
}

function service_finder_convert_to_csv($input_array, $output_file_name, $delimiter)
{
    /** open raw memory as file, no need for temp files */
    $temp_memory = fopen('php://memory', 'w');
    /** loop through array  */
    foreach ($input_array as $line) {
        /** default php csv handler **/
        fputcsv($temp_memory, $line, $delimiter);
    }
    /** rewrind the "file" with the csv lines **/
    fseek($temp_memory, 0);
    /** modify header to be downloadable csv file **/
    header('Content-Type: application/csv');
    header('Content-Disposition: attachement; filename="' . $output_file_name . '";');
    /** Send file to browser for download */
    fpassthru($temp_memory);
}

/*Reset provider package*/
function service_finder_resetProviderPackage($userId) {
	global $wpdb, $service_finder_options, $service_finder_Tables;
	for ($i=1; $i <= 3; $i++) {
		$freepackage = (trim($service_finder_options['package'.$i.'-price']) == '0') ? true : false;
		if((trim($service_finder_options['package'.$i.'-price']) == '0')){
			$freepackage = 'package_'.$i;
			break;
		}else{
			$freepackage = '';
		}
	}
	
	if($freepackage != ""){
	update_user_meta( $userId, 'provider_role', $freepackage );
	}else{
	update_user_meta( $userId, 'current_provider_status', 'expire' );
	delete_user_meta($userId,'provider_role' );
	}
	
	delete_user_meta($userId, 'recurring_profile_id');
	delete_user_meta($userId, 'recurring_profile_amt');
	delete_user_meta($userId, 'recurring_profile_period');
	delete_user_meta($userId, 'recurring_profile_desc_full'); 
	delete_user_meta($userId, 'recurring_profile_desc'); 
	delete_user_meta($userId, 'recurring_profile_type');
	delete_user_meta($userId, 'paypal_token');
	delete_user_meta($userId, 'reg_paypal_role');

	delete_user_meta($userId, 'expire_limit');
	delete_user_meta($userId, 'profile_amt');
	delete_user_meta($userId, 'stripe_customer_id');
	delete_user_meta($userId, 'stripe_token');
	delete_user_meta($userId, 'subscription_id');
	delete_user_meta($userId, 'payment_mode');
	delete_user_meta($userId, 'pay_type');
	
	delete_user_meta($userId, 'expire_limit');
	delete_user_meta($userId, 'provider_activation_time');
	
	$primarycategory = get_user_meta($userId, 'primary_category',true);
	
	/*Update Primary category*/
	$data = array(
			'category_id' => $primarycategory,
			);
	
	$where = array(
			'wp_user_id' => $userId,
			);
	$wpdb->update($service_finder_Tables->providers,wp_unslash($data),$where);
}

/*Scan Directory for css/js*/
if(!function_exists('service_finder_booking_scan_dir')){
	function service_finder_booking_scan_dir($folder) {
	  $dircontent = scandir($folder);
	  $ret='';
	  foreach($dircontent as $filename) {
	    if ($filename != '.' && $filename != '..') {
	      if (filemtime($folder.$filename) === false) return false;
	      $ret.=date("YmdHis", filemtime($folder.$filename)).$filename;
	    }
	  }
	  return md5($ret);
	}
}

/*Delete Old Cache*/
if(!function_exists('service_finder_booking_delete_old_cache')){
	function service_finder_booking_delete_old_cache($folder) {
	  $olddate=time()-60;
	  $dircontent = scandir($folder);
	  foreach($dircontent as $filename) {
	    if (strlen($filename)==32 && filemtime($folder.$filename) && filemtime($folder.$filename)<$olddate) unlink($folder.$filename);
	  }
	}
}

/*Get contact info*/
if(!function_exists('service_finder_get_contact_info')){
	function service_finder_get_contact_info($phone,$mobile){
		$contactnumber = '';
		if($phone != "" && $mobile != ""){
		$contactnumber = '<a href="tel:'.$phone.'">'.$phone.'</a>, <a href="tel:'.$mobile.'">'.$mobile.'</a>';
		}elseif($phone != ""){
		$contactnumber = '<a href="tel:'.$phone.'">'.$phone.'</a>';
		}elseif($mobile != ""){
		$contactnumber = '<a href="tel:'.$mobile.'">'.$mobile.'</a>';
		}
		return $contactnumber;  
	}
}

/*Get contact info*/
if(!function_exists('service_finder_get_contact_info_with_text')){
	function service_finder_get_contact_info_with_text($phone,$mobile){
		$contactnumber = '';
		if($phone != "" && $mobile != ""){
		$contactnumber = '<b>'.esc_html__('Tel', 'service-finder').': </b><a href="tel:'.$phone.'">'.$phone.'</a><br/> <b>'.esc_html__('Mob', 'service-finder').': </b><a href="tel:'.$mobile.'">'.$mobile.'</a><br/>';
		}elseif($phone != ""){
		$contactnumber = '<b>'.esc_html__('Tel', 'service-finder').': </b><a href="tel:'.$phone.'">'.$phone.'</a>';
		}elseif($mobile != ""){
		$contactnumber = '<b>'.esc_html__('Mob', 'service-finder').': </b><a href="tel:'.$mobile.'">'.$mobile.'</a>';
		}
		return $contactnumber;  
	}
}

/*Get contact info*/
if(!function_exists('service_finder_get_contact_info_for_toltip')){
	function service_finder_get_contact_info_for_toltip($phone,$mobile){
		$contactnumber = '';
		if($phone != "" && $mobile != ""){
		$contactnumber = 'Tel: '.$phone.' Mob: '.$mobile;
		}elseif($phone != ""){
		$contactnumber = 'Tel: '.$phone;
		}elseif($mobile != ""){
		$contactnumber = 'Mob: '.$mobile;
		}
		return $contactnumber;  
	}
}


/*Get contact info*/
if(!function_exists('service_finder_cancel_subscription')){
function service_finder_cancel_subscription($userId,$by) {
	global $wpdb, $service_finder_options, $service_finder_Tables;
	service_finder_SendSubscriptionNotificationMail($userId,0,$by);
	
	update_user_meta( $userId, 'current_provider_status', 'cancel' );
	delete_user_meta($userId,'provider_role' );
	
	delete_user_meta($userId, 'payulatam_planid');
	delete_user_meta($userId, 'payulatam_customer_id');
									
	delete_user_meta($userId, 'recurring_profile_id');
	delete_user_meta($userId, 'recurring_profile_amt');
	delete_user_meta($userId, 'recurring_profile_period');
	delete_user_meta($userId, 'recurring_profile_desc_full'); 
	delete_user_meta($userId, 'recurring_profile_desc'); 
	delete_user_meta($userId, 'recurring_profile_type');
	delete_user_meta($userId, 'paypal_token');
	delete_user_meta($userId, 'reg_paypal_role');

	delete_user_meta($userId, 'expire_limit');
	delete_user_meta($userId, 'profile_amt');
	delete_user_meta($userId, 'stripe_customer_id');
	delete_user_meta($userId, 'stripe_token');
	delete_user_meta($userId, 'subscription_id');
	delete_user_meta($userId, 'payment_mode');
	delete_user_meta($userId, 'pay_type');
	delete_user_meta($userId, 'orderNumber');
	
	delete_user_meta($userId, 'expire_limit');
	delete_user_meta($userId, 'provider_activation_time');
	
	$primarycategory = get_user_meta($userId, 'primary_category',true);
	
	/*Update Primary category*/
	$data = array(
			'category_id' => $primarycategory,
			);
	
	$where = array(
			'wp_user_id' => $userId,
			);
	$wpdb->update($service_finder_Tables->providers,wp_unslash($data),$where);
	
	$data = array(
			'free_limits' => 0,
			'available_limits' => 0,
			'paid_limits' => 0,
			);
	$where = array(
			'provider_id' => $userId,

			);		
	
	$wpdb->update($service_finder_Tables->job_limits,wp_unslash($data),$where);
}
}

/*Redirect after comment submit on author*/
function service_finder_comment_redirect( $location ) {
	global $service_finder_options;
	$postid = (isset($_POST['comment_post_ID'])) ? $_POST['comment_post_ID'] : '';
	$post_type = get_post_type($postid);
	
	if($post_type == 'sf_comment_rating'){
	
		$keepauthorword = (!empty($service_finder_options['keep-author-word'])) ? $service_finder_options['keep-author-word'] : '';
		$authorreplacestring = (!empty($service_finder_options['author-replace-string'])) ? $service_finder_options['author-replace-string'] : '';
		
		if($keepauthorword == 'no'){
			
			$location = str_replace('comment-rating','',$location);
			
		}else{
		
		if($keepauthorword == 'yes' && $authorreplacestring != ""){
			
			$location = str_replace('comment-rating',$authorreplacestring,$location);
			
		}elseif($keepauthorword == 'yes' && $authorreplacestring == ""){
			
			$location = str_replace('comment-rating','author',$location);
		
		}
		}
	
		$tem = explode('comment-page',$location);
		if($tem[1] != ""){
		$base = $tem[0];
		$mid = explode('#',$tem[1]);
			if($mid[1] != ""){
			$end = $mid[1];
			$location = $base.'#'.$end;
			}else{
			$location = $base;
			}
		}
	}

	return $location;
}

add_filter( 'comment_post_redirect', 'service_finder_comment_redirect' );

/*Add Notifications*/
if ( !function_exists( 'service_finder_add_notices' ) ){
function service_finder_add_notices($args) {
global $wpdb, $service_finder_Tables;
$data = array(
		'admin_id' => (!empty($args['admin_id'])) ? $args['admin_id'] : 0,
		'provider_id' => (!empty($args['provider_id'])) ? $args['provider_id'] : 0,
		'customer_id' => (!empty($args['customer_id'])) ? $args['customer_id'] : 0,
		'target_id' => (!empty($args['target_id'])) ? $args['target_id'] : 0,
		'topic' => (!empty($args['topic'])) ? $args['topic'] : '',
		'notice' => (!empty($args['notice'])) ? $args['notice'] : '',
		'extra' => (!empty($args['extra'])) ? $args['extra'] : ''
		);
$wpdb->insert($service_finder_Tables->notifications,wp_unslash($data));

}
}

/*View Notifications*/
add_action('wp_ajax_view_notificaions', 'service_finder_view_notificaions');
add_action('wp_ajax_nopriv_view_notificaions', 'service_finder_view_notificaions');
function service_finder_view_notificaions(){
global $wpdb, $service_finder_Tables;

	$usertype = (isset($_POST['usertype'])) ? esc_html($_POST['usertype']) : '';
	$userid = (isset($_POST['userid'])) ? esc_html($_POST['userid']) : '';
	
	$data = array(
			'read' => 'yes'
			);
	
	$where = '';
	
	if($usertype == 'Provider'){
		$where = array(
				'provider_id' => $userid
				);		
	}elseif($usertype == 'Customer'){
		$where = array(
				'customer_id' => $userid
				);	
	}		

	$wpdb->update($service_finder_Tables->notifications,wp_unslash($data),$where);
	
	exit(0);
}

/*Show contact info at search result page*/
function show_contactinfo_at_search_result($phone,$mobile){
global $service_finder_options;
	if($service_finder_options['show-address-info'] && $service_finder_options['show-contact-number'] && service_finder_check_address_info_access()){
		$contactinfo = '<strong class="sf-provider-phone">'.service_finder_get_contact_info_with_text($phone,$mobile).'</strong>';
		return $contactinfo;
	}
}

/*Show total review at search result page*/
function show_review_at_search_result($providerid){
global $service_finder_options,$wpdb,$service_finder_Tables;
	if($service_finder_options['review-system']){
		if($service_finder_options['review-style'] == 'open-review'){
			$comment_postid = get_user_meta($providerid,'comment_post',true);
			$total_review = get_comments_number( $comment_postid );
			$review = $total_review.' '.esc_html__('Review','service-finder');
			return $review; 
		}elseif($service_finder_options['review-style'] == 'booking-review'){
			$allreviews = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->feedback.' where provider_id = %d',$providerid));
			$total_review = count($allreviews);
			$review = $total_review.' '.esc_html__('Review','service-finder');
			return $review; 
		}	
	}

}

/*Show Request a quote model popup to search result page*/
function show_request_quote_at_search_result($providerid){
global $service_finder_options,$wpdb,$service_finder_Tables;
	$requestquote = (!empty($service_finder_options['requestquote-replace-string'])) ? esc_attr($service_finder_options['requestquote-replace-string']) : esc_html__( 'Request a Quote', 'service-finder' );
	
	if($service_finder_options['request-quote'] && service_finder_request_quote_for_loggedin_user()){
		return '<button data-providerid="'.$providerid.'" data-tool="tooltip" data-toggle="modal" data-target="#quotes-Modal" type="button" class="btn btn-border" data-toggle="tooltip" data-placement="top" title="'.$requestquote.'"> <i class="fa fa-file-o"></i> </button>';
	}

}

/*Identity Check*/
function service_finder_is_varified_user($providerid){
global $wpdb,$service_finder_Tables;

$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' where `identity` = "approved" AND `wp_user_id` = %d',$providerid));
if(!empty($row)){
	return true;
}else{
	return false;
}
}

/*Check if exist for apply limit table*/
function service_finder_is_exist_in_joblimit($providerid){
global $wpdb,$service_finder_Tables;

$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->job_limits.' where `provider_id` = %d',$providerid));
if(!empty($row)){
	return true;
}else{
	return false;
}
}


/*Add class for verified providers*/
function service_finder_check_varified($providerid){
	if(service_finder_is_varified_user($providerid)){
		return 'sf-approved';
	}else{
		return '';
	}
}

/*Add class for verified providers*/
function service_finder_check_varified_icon($providerid){
	if(service_finder_is_varified_user($providerid)){
		if(service_finder_themestyle() == 'style-2'){
		$html = '<span class="sf-featured-approve"><i class="fa fa-check"></i><span>'.esc_html__('Verified Provider', 'service-finder').'</span></span>';
		}else{
		$html = '<span class="sf-average-question" data-tool="tooltip" data-placement="top" title="'.esc_html__('Verified Provider', 'service-finder').'">
               		<i class="fa fa-check-square-o"></i>
              	 </span>';
		}		 
		return $html;
	}else{
		return '';
	}
}

/*Check if is default view for search result style 1*/
function service_finder_is_default_view($view = "grid-4"){
global $service_finder_options;

$defaultview = (!empty($service_finder_options["default-view"])) ? esc_js($service_finder_options["default-view"]) : "grid-4";

	if($defaultview == $view){
		return 'class="active"';
	}else{
		return '';
	}
}

/*Check if is default view for search result style 2*/
function service_finder_is_default_view_style2($view = "grid-2"){
global $service_finder_options;

$defaultview = (!empty($service_finder_options["default-view-2"])) ? esc_js($service_finder_options["default-view-2"]) : "grid-2";

	if($defaultview == $view){
		return 'class="active"';
	}else{
		return '';
	}
}

/*Check if is default view for category page*/
function service_finder_is_default_view_category($view = "grid-4"){
global $service_finder_options;

$defaultview = (!empty($service_finder_options["category-default-view"])) ? esc_js($service_finder_options["category-default-view"]) : "grid-4";

	if($defaultview == $view){
		return 'class="active"';
	}else{
		return '';
	}
}

function service_finder_show_provider_meta($providerid,$phone,$mobile){
	global $service_finder_options;
	$contact = service_finder_get_contact_info_for_toltip($phone,$mobile);
	$reviewcount = show_review_at_search_result($providerid);
	if($contact == ""){
	$contact = esc_html__('Not Available', 'service-finder');
	}
	
	$showphone = '';
	if($service_finder_options['show-address-info'] && $service_finder_options['show-contact-number'] && service_finder_check_address_info_access()){
	$showphone = '<button type="button" class="btn btn-border" data-tool="tooltip" data-placement="top" title="'.$contact.'"> <i class="fa fa-phone"></i> </button>';
	}
	
	$showreview = '';
	if($service_finder_options['review-system']){
	$showreview = '<button type="button" class="btn btn-border" data-tool="tooltip" data-placement="top" title="'.$reviewcount.'"> <i class="fa fa-commenting-o"></i> </button>';
	}
	
	$html = '<div class="btn-group sf-provider-tooltip" role="group" aria-label="Basic example">
			  '.$showphone.'
			  '.$showreview.'
			  '.show_request_quote_at_search_result($providerid).'
			</div>';
			
	return $html;		
}

/*Get available job apply limits*/
function service_finder_get_avl_job_limits($providerid){
global $wpdb, $service_finder_options, $service_finder_Tables;

$availablelimit = 0;
$row = $wpdb->get_row('SELECT * FROM '.$service_finder_Tables->job_limits.' WHERE `provider_id` = "'.$providerid.'"');

if(!empty($row)){
$availablelimit = $row->available_limits;
}
return $availablelimit;
}

/*Get available job apply data*/
function service_finder_get_job_limits_data($providerid){
global $wpdb, $service_finder_options, $service_finder_Tables;

$row = $wpdb->get_row('SELECT * FROM '.$service_finder_Tables->job_limits.' WHERE `provider_id` = "'.$providerid.'"');

if(!empty($row)){
return $row;
}else{
return '';
}

}

/*Get job apply limits current plan*/
function service_finder_get_current_plan($providerid){
global $wpdb, $service_finder_options, $service_finder_Tables;

$current_plan = '';
$planname = esc_html__('No Plans', 'service-finder');
$row = $wpdb->get_row('SELECT * FROM '.$service_finder_Tables->job_limits.' WHERE `provider_id` = "'.$providerid.'"');

if(!empty($row)){
	$current_plan = $row->current_plan;
}

return $current_plan;
}

/**********************
Draw Review Box
**********************/
function service_finder_review_box($author,$totalreview){
	global $service_finder_options, $wpdb, $service_finder_Tables;
	
	$providerreplacestring = (!empty($service_finder_options['provider-replace-string'])) ? $service_finder_options['provider-replace-string'] : esc_html__('Provider', 'service-finder');
	
	$avgrating = service_finder_getAverageRating($author);
	
	$numberofstars = service_finder_number_of_stars($author);
	
	$allbookings = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' where provider_id = %d',$author));
	$totalbookings = count($allbookings);
	
	$completedbookings = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' where status = "Completed" AND provider_id = %d',$author));
	$totalcompleted = count($completedbookings);
	if($totalbookings > 0){
	$completionrate = ($totalcompleted/$totalbookings) * 100;
	}else{
	$completionrate = 0;
	}
	?>
    
    <div class="sf-stats-rating">
    <?php echo service_finder_displayRating($avgrating); ?>
    <div class="sf-average-reviews">
	<?php 
	if($avgrating > 1){
		printf( esc_html__('%d Stars - ', 'service-finder' ), $avgrating );
	}else{
		printf( esc_html__('%d Star - ', 'service-finder' ), $avgrating );
	}
	?>
	</div>
    <div class="sf-average-reviews">
	<?php 
	if($totalreview > 1){
		printf( esc_html__('%d Reviews', 'service-finder' ), $totalreview );
	}else{
		printf( esc_html__('%d Review', 'service-finder' ), $totalreview );
	}
	?>
	</div>
    <div class="sf-completion-rate">
        <div class="sf-rate-persent"><?php echo number_format((float)$completionrate,2,'.','').esc_html__('% Completion Rate', 'service-finder'); ?></div>
        <div class="sf-average-question" id="example" type="button" data-toggle="tooltip" data-placement="top" title="<?php echo sprintf( esc_html__('The percentage of accepted tasks this %s has completed', 'service-finder'), esc_html($providerreplacestring) ); ?>"><i class="fa fa-info-circle"></i></div>
    </div>
    <p class="sf-completed-tasks"><?php echo sprintf( esc_html__('%d Completed Task', 'service-finder'), esc_html($totalcompleted) ); ?></p>
</div>
	<div class="sf-reviews-summary">
    <div class="sf-reviews-row">
        <div class="sf-reviews-star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
        <div class="sf-reviews-star-no"><?php echo esc_html($numberofstars[5]); ?></div>
    </div>
    <div class="sf-reviews-row">
        <div class="sf-reviews-star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
        <div class="sf-reviews-star-no"><?php echo esc_html($numberofstars[4]); ?></div>
    </div>
    <div class="sf-reviews-row">
        <div class="sf-reviews-star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
        <div class="sf-reviews-star-no"><?php echo esc_html($numberofstars[3]); ?></div>
    </div>
    <div class="sf-reviews-row">
        <div class="sf-reviews-star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
        <div class="sf-reviews-star-no"><?php echo esc_html($numberofstars[2]); ?></div>
    </div>
    <div class="sf-reviews-row">
        <div class="sf-reviews-star">
            <i class="fa fa-star"></i>
        </div>
        <div class="sf-reviews-star-no"><?php echo esc_html($numberofstars[1]); ?></div>
    </div>
</div>
	<?php 
	$ratingstyle = (!empty($service_finder_options['rating-style'])) ? $service_finder_options['rating-style'] : '';
	if($ratingstyle == 'custom-rating'){ 
	service_finder_average_review_box($author,$totalreview); 
	}
	?>
	<?php
}	

function service_finder_average_review_box($author,$totalreview){
global $wpdb,$service_finder_Tables;
$post_id = get_the_ID();

	$row = $wpdb->get_row($wpdb->prepare('SELECT `user_id` FROM '.$wpdb->prefix.'usermeta WHERE `meta_value` = %d AND `meta_key` = "comment_post"',$post_id));
	if(!empty($row)){
	$categoryid = get_user_meta($row->user_id,'primary_category',true);
	
	$labels = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->rating_labels.' where category_id = %d',$categoryid));
	$totallevel = count($labels);
	
	if(!empty($labels)){
		foreach($labels as $label){
		$avgrating = service_finder_getSpecialityAverageRating($author);
		$avgrating = $avgrating['avg_rating'.$i];
		?>
		<div class="sf-customer-rating-row clearfix">
        
            <div class="sf-customer-rating-name"><?php echo $label->label_name; ?></div>
            
            <div class="sf-customer-rating-count">
                <?php echo service_finder_displayRating($avgrating); ?>
            </div>
            
            <div class="sf-customer-rating-count-digits">
                <?php echo $avgrating; ?>
            </div>
            
            <div class="sf-customer-rating-smiley star-rating">
            	<?php
                if ($avgrating <= 1) {
					$iconclass = 'aon-icon-angry';
				} elseif($avgrating <= 2){
					$iconclass = 'aon-icon-cry';
				} elseif($avgrating <= 3){
					$iconclass = 'aon-icon-sad';
				} elseif($avgrating <= 4){
					$iconclass = 'aon-icon-happy';
				} elseif($avgrating <= 5){
					$iconclass = 'aon-icon-awesome';
				}
				?>
                <div class="caption"><span class="<?php echo sanitize_html_class($iconclass); ?>"></span></div>
            </div>
            
        </div>
		<?php
		$i++;
		}
		}else{
		$labels = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->rating_labels.' where category_id = 0');
		$i = 1;
		
		$totallevel = count($labels);
		
		echo '<div class="sf-customer-avgrage-rating">';
		if(!empty($labels)){
		foreach($labels as $label){
		$avgrating = service_finder_getSpecialityAverageRating($author);
		$avgrating = $avgrating['avg_rating'.$i];
		?>
		<div class="sf-customer-rating-row clearfix">
        
            <div class="sf-customer-rating-name"><?php echo $label->label_name; ?></div>
            
            <div class="sf-customer-rating-count">
                <?php echo service_finder_displayRating($avgrating); ?>
            </div>
            
            <div class="sf-customer-rating-count-digits">
                <?php echo $avgrating; ?>
            </div>
            
            <div class="sf-customer-rating-smiley star-rating">
            	<?php
                if ($avgrating <= 1) {
					$iconclass = 'aon-icon-angry';
				} elseif($avgrating <= 2){
					$iconclass = 'aon-icon-cry';
				} elseif($avgrating <= 3){
					$iconclass = 'aon-icon-sad';
				} elseif($avgrating <= 4){
					$iconclass = 'aon-icon-happy';
				} elseif($avgrating <= 5){
					$iconclass = 'aon-icon-awesome';
				}
				?>
                <div class="caption"><span class="<?php echo sanitize_html_class($iconclass); ?>"></span></div>
            </div>
            
        </div>
		<?php
		$i++;
		}
		}else{
		echo '<div class="alert alert-danger">';
		echo esc_html__('Please set labels for custom rating','service-finder');
		echo '</div>';
		}
		echo '<input name="totallevel" value="'.$totallevel.'" type="hidden">';
		echo '</div>';
		}
	}
}

/*Get average rating*/
function service_finder_getSpecialityAverageRating($providerid){
global $wpdb,$service_finder_Tables,$service_finder_options;

	if($service_finder_options['review-style'] == 'booking-review'){
		$rating1 = 0;
		$rating2 = 0;
		$rating3 = 0;
		$rating4 = 0;
		$rating5 = 0;
		$avg_rating1 = 0;
		$avg_rating2 = 0;
		$avg_rating3 = 0;
		$avg_rating4 = 0;
		$avg_rating5 = 0;
		
		$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM `'.$service_finder_Tables->custom_rating.'` where `provider_id ` = %d AND `feedbackid_id` > 0',$providerid));
		$total_comments = count($results);
		if(!empty($results)){
			foreach($results as $row){
				if(!empty($row)){
					$rating1 = $rating1 + $row->rating1;
					$rating2 = $rating2 + $row->rating2;
					$rating3 = $rating3 + $row->rating3;
					$rating4 = $rating4 + $row->rating4;
					$rating5 = $rating5 + $row->rating5;
				}
			}
			if($rating1 > 0){
			$avg_rating1 = $rating1/$total_comments;
			}
			if($rating2 > 0){
			$avg_rating2 = $rating2/$total_comments;
			}
			if($rating3 > 0){
			$avg_rating3 = $rating3/$total_comments;
			}
			if($rating4 > 0){
			$avg_rating4 = $rating4/$total_comments;
			}
			if($rating5 > 0){
			$avg_rating5 = $rating5/$total_comments;
			}
		}
		
		$ratingarr = array(
			'avg_rating1' => round($avg_rating1,1),
			'avg_rating2' => round($avg_rating2,1),
			'avg_rating3' => round($avg_rating3,1),
			'avg_rating4' => round($avg_rating4,1),
			'avg_rating5' => round($avg_rating5,1)
		);
		return $ratingarr;
	
	}elseif($service_finder_options['review-style'] == 'open-review'){
		$comment_postid = get_user_meta($providerid,'comment_post',true);
		$rating1 = 0;
		$rating2 = 0;
		$rating3 = 0;
		$rating4 = 0;
		$rating5 = 0;
		$avg_rating1 = 0;
		$avg_rating2 = 0;
		$avg_rating3 = 0;
		$avg_rating4 = 0;
		$avg_rating5 = 0;
		
		$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'comments WHERE `comment_approved` = 1 AND `comment_post_ID` = %d',$comment_postid));
		$total_comments = count($results);
		if(!empty($results)){
			foreach($results as $result){
			$comment_id = $result->comment_ID;
				$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM `'.$service_finder_Tables->custom_rating.'` where `comment_id` = %d',$comment_id));
				if(!empty($row)){
					$rating1 = $rating1 + $row->rating1;
					$rating2 = $rating2 + $row->rating2;
					$rating3 = $rating3 + $row->rating3;
					$rating4 = $rating4 + $row->rating4;
					$rating5 = $rating5 + $row->rating5;
				}
			}
			if($rating1 > 0){
			$avg_rating1 = $rating1/$total_comments;
			}
			if($rating2 > 0){
			$avg_rating2 = $rating2/$total_comments;
			}
			if($rating3 > 0){
			$avg_rating3 = $rating3/$total_comments;
			}
			if($rating4 > 0){
			$avg_rating4 = $rating4/$total_comments;
			}
			if($rating5 > 0){
			$avg_rating5 = $rating5/$total_comments;
			}
		}
		
		$ratingarr = array(
			'avg_rating1' => round($avg_rating1,1),
			'avg_rating2' => round($avg_rating2,1),
			'avg_rating3' => round($avg_rating3,1),
			'avg_rating4' => round($avg_rating4,1),
			'avg_rating5' => round($avg_rating5,1)
		);
		return $ratingarr;
	}

}

/**********************
Captcha Field
**********************/
add_action('wp_ajax_load_captcha_form', 'service_finder_load_captcha_form');
add_action('wp_ajax_nopriv_load_captcha_form', 'service_finder_load_captcha_form');
function service_finder_load_captcha_form(){
$success = array(
			'status' => 'success',
			'providersignup' => service_finder_captcha('providersignup'),
			'customersignup' => service_finder_captcha('customersignup')
			);
echo json_encode($success);
exit;

}

function service_finder_captcha($where){
global $service_finder_options;

if($where == 'requestquote' || $where == 'requestquotepopup'){
	$chkcaptcha = ($service_finder_options['request-quote-captcha']) ? true : false;
}elseif($where == 'customersignup' || $where == 'customersignuppage'){
	$chkcaptcha = ($service_finder_options['customer-signup-captcha']) ? true : false;
}elseif($where == 'providersignup' || $where == 'providersignuppage'){
	$chkcaptcha = ($service_finder_options['provider-signup-captcha']) ? true : false;
}elseif($where == 'claimbusiness'){
	$chkcaptcha = ($service_finder_options['claim-business-captcha']) ? true : false;
}elseif($where == 'contactus'){
	$chkcaptcha = true;
}

$html = '';
if($chkcaptcha){

if(isset($service_finder_options['captcha-style']) && $service_finder_options['captcha-style'] == 'style-1'){
	$label = esc_html__('Can&#8217;t read the image? click %LINKSTART%here%LINKEND% to refresh.', 'service-finder'); 
	$label = str_replace('%LINKSTART%','<a href="javascript:;" data-where="'.$where.'" class="refreshCaptcha">',$label);
	$label = str_replace('%LINKEND%','</a>',$label);
		
	$html = '<div class="col-md-12 margin-b-20"><img src="'.SERVICE_FINDER_BOOKING_LIB_URL.'/captcha.php?where='.$where.'&rand='.rand().'" id="captchaimg_'.$where.'">
	'.$label.'</div>
	<div class="col-md-12">
	<div class="form-group">
	  <div class="input-group"> <i class="input-group-addon fa fa-pencil"></i>
		<input name="captcha_code" id="captcha_code" type="text" class="form-control" placeholder="'.esc_html__("Enter the code above here", "service-finder").'">					
		<input type="hidden" name="captchaon" value="1">
	  </div>
	</div>
	</div>';
}else{
	$captchasitekey = (isset($service_finder_options['captcha-sitekey'])) ? esc_html($service_finder_options['captcha-sitekey']) : '';
	$captchatheme = (isset($service_finder_options['captcha-theme'])) ? esc_html($service_finder_options['captcha-theme']) : 'light';

	if($captchasitekey != ""){
	return '<div class="col-md-12">
	<div class="form-group">
	  <div class="input-group">
		<div class="captchaouter" id="recaptcha_'.$where.'" data-theme="'.$captchatheme.'" data-sitekey="'.$captchasitekey.'"></div>
	  </div>
	</div>
	</div>';
	}
}

}
return $html;
}

/*Run Before User Delete*/
add_action('load-users.php','service_finder_before_delete_user');
function service_finder_before_delete_user(){
	if (isset($_GET['action']) && 'delete' === $_GET['action']) {
	  $userid = (isset($_GET['user'])) ? $_GET['user'] : '';
	  if (isset($_GET['user'])) {
		global $wpdb, $service_finder_Errors, $service_finder_options, $paypal;
		
		$creds = array();
		$paypalCreds['USER'] = (isset($service_finder_options['paypal-username'])) ? $service_finder_options['paypal-username'] : '';
		$paypalCreds['PWD'] = (isset($service_finder_options['paypal-password'])) ? $service_finder_options['paypal-password'] : '';
		$paypalCreds['SIGNATURE'] = (isset($service_finder_options['paypal-signatue'])) ? $service_finder_options['paypal-signatue'] : '';
		$paypalType = (isset($service_finder_options['paypal-type']) && $service_finder_options['paypal-type'] == 'live') ? '' : 'sandbox.';
		
		$paypalTypeBool = (!empty($paypalType)) ? true : false;
		
		$paypal = new Paypal($paypalCreds,$paypalTypeBool);
		
		$subscription_id = get_user_meta($userid,'subscription_id',true);
		$cusID = get_user_meta($userid,'stripe_customer_id',true);
		$payment_mode = get_user_meta($userid,'payment_mode',true);
		$oldProfile = get_user_meta($userid,'recurring_profile_id',true);
		
		$msg = esc_html__('This user cannot be deleted. Due to subscription cancellation failed.', 'service-finder');
		
		
		if($subscription_id != "" && ($payment_mode == 'stripe' || $payment_mode == 'stripe_upgrade')){
		require_once(SERVICE_FINDER_PAYMENT_GATEWAY_DIR.'/stripe/init.php');
		
		if( isset($service_finder_options['stripe-type']) && $service_finder_options['stripe-type'] == 'test' ){
			$secret_key = (!empty($service_finder_options['stripe-test-secret-key'])) ? $service_finder_options['stripe-test-secret-key'] : '';
			$public_key = (!empty($service_finder_options['stripe-test-public-key'])) ? $service_finder_options['stripe-test-public-key'] : '';
		}else{
			$secret_key = (!empty($service_finder_options['stripe-live-secret-key'])) ? $service_finder_options['stripe-live-secret-key'] : '';
			$public_key = (!empty($service_finder_options['stripe-live-public-key'])) ? $service_finder_options['stripe-live-public-key'] : '';
		}
		
			\Stripe\Stripe::setApiKey($secret_key);
			try {			
		
				$currentcustomer = \Stripe\Customer::retrieve($cusID);
				$res = $currentcustomer->subscriptions->retrieve($subscription_id)->cancel();
				if($res->status == 'canceled'){
				
				service_finder_cancel_subscription($userid,'manually');
				}else{
					wp_die($msg);
				}
					
								
			} catch (Exception $e) {
			
				$body = $e->getJsonBody();
				$err  = $body['error'];
			
				wp_die($msg);
			}
		}elseif(!empty($oldProfile)) {
			$cancelParams = array(
				'PROFILEID' => $oldProfile,
				'ACTION' => 'Cancel'
			);
			$res = $paypal -> request('ManageRecurringPaymentsProfileStatus',$cancelParams);
			//echo '<pre>';print_r($res);echo '</pre>';
			if($res['ACK'] == 'Success'){
				service_finder_cancel_subscription($userid,'manually');
			}else{
				wp_die($msg);
			}
		}
	  }
	}
}

/*Update Job Limit*/
function service_finder_update_job_limit($userid){
global $service_finder_options, $wpdb, $service_finder_Tables;
	$role = get_user_meta($userid,'provider_role',true);
	if ($role == "package_1" || $role == "package_2" || $role == "package_3"){
	$packageNum = intval(substr($role, 8));
	
	$allowedjobapply = (!empty($service_finder_options['package'.$packageNum.'-job-apply'])) ? $service_finder_options['package'.$packageNum.'-job-apply'] : '';
	
	$period = (!empty($service_finder_options['job-apply-limit-period'])) ? $service_finder_options['job-apply-limit-period'] : '';
	$numberofweekmonth = (!empty($service_finder_options['job-apply-number-of-week-month'])) ? $service_finder_options['job-apply-number-of-week-month'] : 1;
	
	$startdate = date('Y-m-d h:i:s');
	
	if($period == 'weekly'){
		$freq = 7 * $numberofweekmonth;
		$expiredate = date('Y-m-d h:i:s', strtotime("+".$freq." days"));
	}elseif($period == 'monthly'){
		$freq = 30 * $numberofweekmonth;
		$expiredate = date('Y-m-d h:i:s', strtotime("+".$freq." days"));
	}
	
	$row = $wpdb->get_row('SELECT * FROM '.$service_finder_Tables->job_limits.' WHERE `provider_id` = "'.$userid.'"');

	if(!empty($row)){
	$available_limits = $row->available_limits + $allowedjobapply;
	}else{
	$available_limits = $allowedjobapply;
	}
	
	$data = array(
			'free_limits' => $allowedjobapply,
			'available_limits' => $available_limits,
			'membership_date' => $startdate,
			'start_date' => $startdate,
			'expire_date' => $expiredate,
			);
	$where = array(
			'provider_id' => $userid,
			);		
	
	$wpdb->update($service_finder_Tables->job_limits,wp_unslash($data),$where);
	}
}

/*Get job limit cycle*/
if ( ! function_exists( 'service_finder_get_schedule_cycle' ) ) {
function service_finder_get_schedule_cycle($bookingdate,$selecteddate,$freq = ''){
	
	if(date('Y-m-d',strtotime($bookingdate)) != date('Y-m-d',strtotime($selecteddate))){
		$daysBetween = $freq + 1;
		$start = new DateTime($bookingdate);                        // Meeting origination date
		$target = new DateTime($selecteddate);                       // The given date
		$daysApart = $start->diff($target)->days;
		$nextMultipleOfDaysBetweenAfterDaysApart = ceil($daysApart/$daysBetween) * $daysBetween;
		$dateOfNextMeeting = $start->modify('+' . $nextMultipleOfDaysBetweenAfterDaysApart . 'days');
		$dateOfNextMeeting->modify('-1 day');
		$nextdate = $dateOfNextMeeting->format('Y-m-d');
		
		$fromdate = $nextdate;
		$fromdate = DateTime::createFromFormat('Y-m-d',$fromdate);
		
		$fromdate->modify('-'.$freq.' day');
		$fromdate = $fromdate->format('Y-m-d');
		
		$arr = array(
			'startdate' => $fromdate,
			'expiredate' => $nextdate,
		);
		return $arr;
	}else{
		$fromdate = $selecteddate;
		$fromdate = DateTime::createFromFormat('Y-m-d',$fromdate);
		
		$fromdate->modify('+'.$freq.' day');
		$nextdate = $fromdate->format('Y-m-d');
		
		$arr = array(
			'startdate' => $selecteddate,
			'expiredate' => $nextdate,
		);
		return $arr;
	}
	
}
}

/*Get custom cities*/
function service_finder_get_cities($country = ''){
global $wpdb, $service_finder_Tables; 
	$cities = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->cities.' WHERE `countryname` = "'.$country.'"');
	return $cities;
}

add_action('wp_ajax_load_cities_by_country', 'service_finder_cities_by_country');
add_action('wp_ajax_nopriv_load_cities_by_country', 'service_finder_cities_by_country');
function service_finder_cities_by_country(){
	global $wpdb, $service_finder_Tables; 
	
	$country = (isset($_POST['country'])) ? esc_html($_POST['country']) : '';
	$country = strtolower($country);

	$cities = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->cities.' WHERE `countryname` = "'.$country.'"');
	$citydropdown = '<option value="">'.esc_html__('Select City', 'service-finder').'</option>';
	if(!empty($cities)){
		foreach($cities as $city){
			$citydropdown .= '<option value="'.esc_attr($city->cityname).'">'.$city->cityname.'</option>';
		}
	}
	echo $citydropdown;
	exit;
}

$action = (isset($_POST['action'])) ? esc_html($_POST['action']) : '';

if($action == 'upload_cities'){
	global $wpdb, $service_finder_Tables;
		
	//$filename = SERVICE_FINDER_BOOKING_LIB_DIR.'/cities.csv';
	$filename = $_FILES['citycsv']['tmp_name'];
	$handle = fopen($filename, "r");
	
	$i=1;
	$wpdb->query('DELETE FROM `'.$service_finder_Tables->cities.'`');
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		if($i != 1){
			
		$chkcity = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->cities.' WHERE `cityname` = "%s" AND `countryname` = "%s"',strtolower($data[0]),strtolower($data[1])));
			if(empty($chkcity)){
			$data = array(
					'cityname' => $data[0],
					'countryname' => $data[1], 
					);
			$wpdb->insert($service_finder_Tables->cities,$data);
			}
		}
		$i++;
	}

	fclose($handle);
	
	$cityid = $wpdb->insert_id;
			
	if ($cityid > 0) {
	
		$success = array(
				'status' => 'success',
				'suc_message' => esc_html__('Cities uploaded successfully', 'service-finder'),
				);
		echo json_encode($success);
	}else{
		$error = array(
				'status' => 'error',
				'err_message' => 'Couldn&#8217;t upload cities.'
				);
		echo json_encode($error);
	
	}
	exit(0);
}	

/*Get card by country*/
function service_finder_get_cards($country = 'AR'){
	
	$cards = array();
	
	switch ($country) {
		case 'AR':
			$cards[] = 'MASTERCARD';
			$cards[] = 'AMEX';
			$cards[] = 'ARGENCARD';
			$cards[] = 'CABAL';
			$cards[] = 'NARANJA';
			$cards[] = 'CENCOSUD';
			$cards[] = 'SHOPPING';
			$cards[] = 'VISA';
			break;
		case 'BR':
			$cards[] = 'MASTERCARD';
			$cards[] = 'AMEX';
			$cards[] = 'VISA';
			$cards[] = 'DINERS';
			$cards[] = 'ELO';
			$cards[] = 'HIPERCARD';
			break;
		case 'CO':
			$cards[] = 'MASTERCARD';
			$cards[] = 'AMEX';
			$cards[] = 'CODENSA';
			$cards[] = 'DINERS';
			$cards[] = 'VISA';
			break;
		case 'MX':
			$cards[] = 'MASTERCARD';
			$cards[] = 'AMEX';
			$cards[] = 'VISA';
			break;
		case 'PA':
			$cards[] = 'MASTERCARD';
			break;
		case 'PE':
			$cards[] = 'MASTERCARD';
			$cards[] = 'AMEX';
			$cards[] = 'VISA';
			$cards[] = 'DINERS';
			break;		
	}
	
	return $cards;
}

/*Get Provider default avatar*/
function service_finder_get_default_avatar(){
global $service_finder_options;

$defaultavatar = (!empty($service_finder_options['default-avatar']['url'])) ? $service_finder_options['default-avatar']['url'] : '';

if($defaultavatar != ''){
	return $defaultavatar;
}else{
	return SERVICE_FINDER_BOOKING_IMAGE_URL.'/no_img.jpg';
}

}

/*Add http to url*/
function service_finder_addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

/*Customer Signup*/
add_action( 'user_register', 'service_finder_customer_signup_hook', 10, 1 );
function service_finder_customer_signup_hook( $user_id ) {
global $wpdb, $service_finder_Tables, $service_finder_options;

if(service_finder_getUserRole($user_id) == 'Customer'){

$chkcustomer = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers_data.' where wp_user_id = %d',$user_id));
if(empty($chkcustomer)){
	$data = array(
			'wp_user_id' => $user_id,
			);
	
	$wpdb->insert($service_finder_Tables->customers_data,wp_unslash($data));
	
	$initialamount = 0;
	update_user_meta($userId,'_sf_wallet_amount',$initialamount);
	
	$allowedjobapply = (!empty($service_finder_options['default-job-post-limit'])) ? $service_finder_options['default-job-post-limit'] : '';
	
	$period = (!empty($service_finder_options['job-post-limit-period'])) ? $service_finder_options['job-post-limit-period'] : '';
	$numberofweekmonth = (!empty($service_finder_options['job-post-number-of-week-month'])) ? $service_finder_options['job-post-number-of-week-month'] : 1;
	
	$startdate = date('Y-m-d h:i:s');
	
	$expiredate = '';
	
	if($period == 'weekly'){
		$freq = 7 * $numberofweekmonth;
		$expiredate = date('Y-m-d h:i:s', strtotime("+".$freq." days"));
	}elseif($period == 'monthly'){
		$freq = 30 * $numberofweekmonth;
		$expiredate = date('Y-m-d h:i:s', strtotime("+".$freq." days"));
	}
	
	$data = array(
			'provider_id' => $user_id,
			'free_limits' => $allowedjobapply,
			'available_limits' => $allowedjobapply,
			'membership_date' => $startdate,
			'start_date' => $startdate,
			'expire_date' => $expiredate,
			);
	
	$wpdb->insert($service_finder_Tables->job_limits,wp_unslash($data));
}
}
}

/*Generate OTP*/
add_action('wp_ajax_sendotp', 'service_finder_sendotp');
add_action('wp_ajax_nopriv_sendotp', 'service_finder_sendotp');
function service_finder_sendotp(){
global $wpdb;
		
		$pass = rand(100000, 999999);
		if(service_finder_wpmailer($_POST['emailid'],esc_html__( 'One Time Password for confirm email id', 'service-finder' ),esc_html__( 'Generated OTP is:', 'service-finder' ).$pass)) {

				echo esc_html($pass);
				
				
			} else {
					
				echo esc_html($pass);
			}
		
		
exit;
}

/*Check display basic profile or not after trial package expire*/
function service_finder_check_profile_after_trial_expire($uid){
global $wpdb, $service_finder_options;

$display_profile_trialexpire = (isset($service_finder_options['basic-profile-after-trial-expire'])) ? esc_attr($service_finder_options['basic-profile-after-trial-expire']) : '';		
$trialpackage = get_user_meta($uid, 'trial_package', true);
$providerstatus = get_user_meta($uid, 'current_provider_status', true);		
		
if($trialpackage == 'yes' && $providerstatus == 'expire' && $display_profile_trialexpire == 'no'){
return false;
}else{
return true;
}
}

/*Check display basic profile or not after trial package expire*/
function service_finder_money_format($amount,$tag = ''){
global $service_finder_options;
if($tag != ""){
if($amount != ""){
return '<'.$tag.'>'.service_finder_currencysymbol().'</'.$tag.'> '.number_format((float)$amount,2,'.','');
}else{
return '<'.$tag.'>'.service_finder_currencysymbol().'</'.$tag.'> '.'0.00';
}
}

if($amount != ""){
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){
return service_finder_currencysymbol().number_format((float)$amount,2,'.','');
}else{
$local = (isset($service_finder_options['currency-format'])) ? esc_attr($service_finder_options['currency-format']) : '';
$local = get_locale();
setlocale(LC_MONETARY, $local);
return money_format(service_finder_currencysymbol().'%!.2n', $amount);
}
}else{
return service_finder_currencysymbol().'0.00';
}
}

/*Get percentage format*/
function service_finder_percentage_format($value){

$value = (floatval($value) > 0) ? $value : 0;
$result = $value.'%';

return $result;
}


/*Claim Business*/
add_action('wp_ajax_claim_business', 'service_finder_claim_business');
add_action('wp_ajax_nopriv_claim_business', 'service_finder_claim_business');
function service_finder_claim_business(){
	global $wpdb, $service_finder_Tables, $service_finder_options;
	
	$claim_business = (!empty($service_finder_options['string-claim-business'])) ? esc_html($service_finder_options['string-claim-business']) : esc_html__('Claim Business', 'service-finder');
	
	$provider_id = (!empty($_POST['provider_id'])) ? esc_html($_POST['provider_id']) : '';
	$customer_name = (!empty($_POST['customer_name'])) ? esc_html($_POST['customer_name']) : '';
	$customer_email = (!empty($_POST['customer_email'])) ? esc_html($_POST['customer_email']) : '';
	$description = (!empty($_POST['description'])) ? esc_html($_POST['description']) : '';
	$captchaon = (!empty($_POST['captchaon'])) ? esc_html($_POST['captchaon']) : '';
	$captcha_code = (!empty($_POST['captcha_code'])) ? esc_html($_POST['captcha_code']) : '';

	if($captchaon == 1){

	if((empty($_SESSION['captcha_code_claimbusiness'] ) || strcasecmp($_SESSION['captcha_code_claimbusiness'], $captcha_code) != 0) && (strcasecmp($_SESSION['captcha_code_claimbusiness'], $captcha_code) != 0 || empty($_SESSION['captcha_code_claimbusiness'] ))){  
		$error = array(
				'status' => 'error',
				'err_message' => esc_html__('The Validation code does not match!', 'service-finder'),
				);
		echo json_encode($error);
		exit;
	}

	}
	
	$data = array(
			'provider_id' => $provider_id,
			'date' => date('Y-m-d h:i:s'),
			'fullname' => $customer_name,
			'email' => $customer_email,
			'message' => $description,
			'status' => 'pending',
			);

	$wpdb->insert($service_finder_Tables->claim_business,wp_unslash($data));
	
	$claim_id = $wpdb->insert_id;
	
	$adminemail = get_option( 'admin_email' );
	
	if($service_finder_options['claimbusiness-to-admin-subject'] != ""){
		$subject = $service_finder_options['claimbusiness-to-admin-subject'];
	}else{
		$subject = $claim_business;
	}
	
	if(!empty($service_finder_options['claimbusiness-to-admin'])){
		$message = $service_finder_options['claimbusiness-to-admin'];
	}else{
		$message = $claim_business.' for following profile

		Provider Name: %PROVIDERNAME%
		
		Provider Email: %PROVIDEREMAIL%
		
		Provider Profile: %PROVIDERPROFILELINK%
		
		Customer Name: %CUSTOMERNAME%
		
		Email: %EMAIL%
		
		Description: %DESCRIPTION%';
	}
	
	$getProvider = new SERVICE_FINDER_searchProviders();
	$providerInfo = $getProvider->service_finder_getProviderInfo(esc_attr($provider_id));
	
	$userLink = service_finder_get_author_url($provider_id);
	
	$tokens = array('%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPROFILELINK%','%CUSTOMERNAME%','%EMAIL%','%DESCRIPTION%');
	$replacements = array(service_finder_get_providername_with_link($provider_id),'<a href="mailto:'.$providerInfo->email.'">'.$providerInfo->email.'</a>',$userLink,$customer_name,$customer_email,$description);
	$msg_body = str_replace($tokens,$replacements,$message);
	
	service_finder_wpmailer($adminemail,$subject,$msg_body);
			
	if ( ! $claim_id ) {
		$error = array(
				'status' => 'error',
				'err_message' => sprintf(esc_html__('Couldn&#8217;t %s.', 'service-finder'),$claim_business)
				);
		echo json_encode($error);
	}else{
		$success = array(
				'status' => 'success',
				'suc_message' => sprintf(esc_html__('%s successfully. Pleast wait for approve', 'service-finder'),$claim_business)
				);
		echo json_encode($success);
	}
	exit;
}

/*Check availability method*/
function service_finder_availability_method($provider_id){
global $service_finder_options;

$adminavailabilitybasedon = (!empty($service_finder_options['availability-based-on'])) ? esc_html($service_finder_options['availability-based-on']) : '';

$settings = service_finder_getProviderSettings($provider_id);

$availability_based_on = (!empty($settings['availability_based_on'])) ? $settings['availability_based_on'] : '';

if($adminavailabilitybasedon == 'timeslots' || ($adminavailabilitybasedon == 'both' && $availability_based_on == 'timeslots')){
	return 'timeslots';
}elseif($adminavailabilitybasedon == 'starttime' || ($adminavailabilitybasedon == 'both' && $availability_based_on == 'starttime')){
	return 'starttime';
}else{
	return 'timeslots';
}

}

/*Get offers method*/
function service_finder_offers_method($provider_id){
global $service_finder_options;

$adminoffersbasedon = (!empty($service_finder_options['offers-based-on'])) ? esc_html($service_finder_options['offers-based-on']) : '';

$settings = service_finder_getProviderSettings($provider_id);

$offers_based_on = (!empty($settings['offers_based_on'])) ? $settings['offers_based_on'] : '';

if($adminoffersbasedon == 'services' || ($adminoffersbasedon == 'both' && $offers_based_on == 'services')){
	return 'services';
}elseif($adminoffersbasedon == 'booking' || ($adminoffersbasedon == 'both' && $offers_based_on == 'booking')){
	return 'booking';
}else{
	return 'services';
}

}

/*Check booking date method*/
function service_finder_booking_date_method($provider_id){
global $service_finder_options;

$datestyle = (!empty($service_finder_options['booking-date-style'])) ? esc_html($service_finder_options['booking-date-style']) : '';

$settings = service_finder_getProviderSettings($provider_id);

$booking_date_based_on = (!empty($settings['booking_date_based_on'])) ? $settings['booking_date_based_on'] : '';

if($datestyle == 'singledate' || ($datestyle == 'both' && $booking_date_based_on == 'singledate')){
	return 'singledate';
}elseif($datestyle == 'multidate' || ($datestyle == 'both' && $booking_date_based_on == 'multidate')){
	return 'multidate';
}else{
	return 'singledate';
}

}

/*Get earch radius from given distance*/
function service_finder_radius_search($latitude,$longitude,$d){
global $service_finder_options;

$radiussearchunit = (isset($service_finder_options['radius-search-unit'])) ? esc_attr($service_finder_options['radius-search-unit']) : 'mi';
		
if($radiussearchunit == 'km'){
$r = 6371; //earth's radius in km
}else{
$r = 3959; //earth's radius in miles
}



$latN = rad2deg(asin(sin(deg2rad($latitude)) * cos($d / $r)
        + cos(deg2rad($latitude)) * sin($d / $r) * cos(deg2rad(0))));

$latS = rad2deg(asin(sin(deg2rad($latitude)) * cos($d / $r)
        + cos(deg2rad($latitude)) * sin($d / $r) * cos(deg2rad(180))));

$lonE = rad2deg(deg2rad($longitude) + atan2(sin(deg2rad(90))
        * sin($d / $r) * cos(deg2rad($latitude)), cos($d / $r)
        - sin(deg2rad($latitude)) * sin(deg2rad($latN))));

$lonW = rad2deg(deg2rad($longitude) + atan2(sin(deg2rad(270))
        * sin($d / $r) * cos(deg2rad($latitude)), cos($d / $r)
        - sin(deg2rad($latitude)) * sin(deg2rad($latN))));


$radius = array(
			'latN' => $latN,
			'latS' => $latS,
			'lonE' => $lonE,
			'lonW' => $lonW,
			);
return $radius;			
}

/*Check address info crediantials*/
function service_finder_check_address_info_access(){
global $service_finder_options, $current_user;

$onlyregistereduser = (!empty($service_finder_options['only-registered-user'])) ? esc_html($service_finder_options['only-registered-user']) : '';

if($onlyregistereduser){
	if(is_user_logged_in() && ( service_finder_getUserRole($current_user->ID) == 'administrator' || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'Provider' )){
		return true;
	}else{
		return false;
	}
}else{
	return true;
}
}

/*Translate Static Status Messages*/
function service_finder_translate_static_status_string($status){
global $wpdb;

	switch (strtolower($status)) {
		case 'pending':
			$returnstatus = esc_html__('Pending','service-finder');
			break;
		case 'completed':
			$returnstatus = esc_html__('Completed','service-finder');
			break;
		case 'incomplete':
			$returnstatus = esc_html__('Incomplete','service-finder');
			break;	
		case 'cancel':
			$returnstatus = esc_html__('Cancelled','service-finder');
			break;
		case 'need-approval':
			$returnstatus = esc_html__('Need-Approval','service-finder');
			break;
		case 'free':
			$returnstatus = esc_html__('Free','service-finder');
			break;
		case 'paid':
			$returnstatus = esc_html__('Paid','service-finder');
			break;
		case 'overdue':
			$returnstatus = esc_html__('Overdue','service-finder');
			break;	
		case 'upcoming':
			$returnstatus = esc_html__('Upcoming','service-finder');
			break;	
		case 'past':
			$returnstatus = esc_html__('Past','service-finder');
			break;
		case 'stripe':
			$returnstatus = esc_html__('Stripe','service-finder');
			break;
		case 'paypal':
			$returnstatus = esc_html__('Paypal','service-finder');
			break;
		case 'wired':
			$returnstatus = esc_html__('Wired','service-finder');
			break;
		case 'bacs':
			$returnstatus = esc_html__('Bank Transfer','service-finder');
			break;
		case 'ppec_paypal':
			$returnstatus = esc_html__('Paypal Express Checkout','service-finder');
			break;
		case 'created':
			$returnstatus = esc_html__('Created','service-finder');
			break;	
		case 'failed':
			$returnstatus = esc_html__('Failed','service-finder');
			break;		
		default:
			$returnstatus = ucfirst($status);
			break;												
	}
	
	return $returnstatus;

}

/*Send Booking Reminder mail to provider*/
function service_finder_SendBookingReminderMailToProvider($maildata = ''){
	global $service_finder_options, $service_finder_Tables, $wpdb;
	
	$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$maildata['provider_id']));
	$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$maildata['booking_customer_id']));
	
	$bookingpayment_mode = (!empty($maildata['type'])) ? $maildata['type'] : '';
	
	$payent_mode = ($bookingpayment_mode != '') ? $bookingpayment_mode : 'free';
	$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? $service_finder_options['pay_booking_amount_to'] : '';
	
	$message = '';
	
	if(!empty($service_finder_options['booking-reminder-to-provider'])){
		$message .= $service_finder_options['booking-reminder-to-provider'];
	}else{
		$message .= '
<h4>Booking Details</h4>
Date: %DATE%
			
			Time: %STARTTIME% - %ENDTIME%
			
			Member Name: %MEMBERNAME%
<h4>Provider Details</h4>
Provider Name: %PROVIDERNAME%

			Provider Email: %PROVIDEREMAIL%
			
			Phone: %PROVIDERPHONE%
<h4>Customer Details</h4>
Customer Name: %CUSTOMERNAME%

Customer Email: %CUSTOMEREMAIL%

Phone: %CUSTOMERPHONE%

Alternate Phone: %CUSTOMERPHONE2%

Address: %ADDRESS%

Apt/Suite: %APT%

City: %CITY%

State: %STATE%

Postal Code: %ZIPCODE%

Country: %COUNTRY%

Services: %SERVICES%

<h4>Payment Details</h4>
Pay Via: %PAYMENTMETHOD%
			
			Amount: %AMOUNT%';
	}
		
		$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%SERVICES%','%PAYMENTMETHOD%','%AMOUNT%','%SHORTDESCRIPTION%');
		
		if($maildata['member_id'] > 0){
		$membername = service_finder_getMemberName($maildata['member_id']);
		}else{
		$membername = '-';
		}
		
		$services = service_finder_get_booking_services($maildata['id']);
		
		$charge_admin_fee = (!empty($service_finder_options['charge-admin-fee'])) ? $service_finder_options['charge-admin-fee'] : '';
		$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';
		
		if($charge_admin_fee_from == 'provider' && $pay_booking_amount_to == 'admin' && $charge_admin_fee){
		$bookingamount = $maildata['total'] - $adminfee;
		}elseif($charge_admin_fee_from == 'customer' && $charge_admin_fee && $pay_booking_amount_to == 'admin'){
		$bookingamount = $maildata['total'];
		}else{
		$bookingamount = $maildata['total'];
		}
		
		$replacements = array(date('Y-m-d',strtotime($maildata['date'])),$maildata['start_time'],$maildata['end_time'],$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,$services,ucfirst($payent_mode),service_finder_money_format($bookingamount),$customerInfo->description);
		$msg_body = str_replace($tokens,$replacements,$message);
		
		if($service_finder_options['booking-reminder-to-provider-subject'] != ""){
			$msg_subject = $service_finder_options['booking-reminder-to-provider-subject'];
		}else{
			$msg_subject = esc_html__('Booking Reminder Notification', 'service-finder');
		}
		
		if(service_finder_wpmailer($providerInfo->email,$msg_subject,$msg_body)) {

			$success = array(
					'status' => 'success',
					'suc_message' => esc_html__('Message has been sent', 'service-finder'),
					);
			$service_finder_Success = json_encode($success);
			return $service_finder_Success;
			
			
		} else {
				
			$error = array(
					'status' => 'error',
					'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
					);
			$service_finder_Errors = json_encode($error);
			return $service_finder_Errors;
		}
	
}
/*Send Booking Reminder mail to customer*/
function service_finder_SendBookingReminderMailToCustomer($maildata = ''){
	global $service_finder_options, $service_finder_Tables, $wpdb;
	$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$maildata['provider_id']));
	$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$maildata['booking_customer_id']));
	
	$bookingpayment_mode = (!empty($maildata['type'])) ? $maildata['type'] : '';
	
	$payent_mode = ($bookingpayment_mode != '') ? $bookingpayment_mode : 'free';
	
	$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? $service_finder_options['pay_booking_amount_to'] : '';
	
	$message = '';
	
	if(!empty($service_finder_options['booking-reminder-to-customer'])){
		$message .= $service_finder_options['booking-reminder-to-customer'];
	}else{
		$message .= '
<h4>Booking Details</h4>
Date: %DATE%
			
			Time: %STARTTIME% - %ENDTIME%
			
			Member Name: %MEMBERNAME%
<h4>Provider Details</h4>
Provider Name: %PROVIDERNAME%

			Provider Email: %PROVIDEREMAIL%
			
			Phone: %PROVIDERPHONE%
<h4>Customer Details</h4>
Customer Name: %CUSTOMERNAME%

Customer Email: %CUSTOMEREMAIL%

Phone: %CUSTOMERPHONE%

Alternate Phone: %CUSTOMERPHONE2%

Address: %ADDRESS%

Apt/Suite: %APT%

City: %CITY%

State: %STATE%

Postal Code: %ZIPCODE%

Country: %COUNTRY%

Services: %SERVICES%

<h4>Payment Details</h4>
Pay Via: %PAYMENTMETHOD%
			
			Amount: %AMOUNT%';
	}
	
		$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%SERVICES%','%PAYMENTMETHOD%','%AMOUNT%','%SHORTDESCRIPTION%');
		
		if($maildata['member_id'] > 0){
		$membername = service_finder_getMemberName($maildata['member_id']);
		}else{
		$membername = '-';
		}
		$services = service_finder_get_booking_services($maildata['id']);
		
		$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';
		$charge_admin_fee = (!empty($service_finder_options['charge-admin-fee'])) ? $service_finder_options['charge-admin-fee'] : '';
		
		if($charge_admin_fee_from == 'provider' && $charge_admin_fee && $pay_booking_amount_to == 'admin'){
		$adminfee = '0.0';
		}
		
		$replacements = array(date('Y-m-d',strtotime($maildata['date'])),$maildata['start_time'],$maildata['end_time'],$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,$services,ucfirst($payent_mode),service_finder_money_format($maildata['total']),$customerInfo->description);
		$msg_body = str_replace($tokens,$replacements,$message);

		if($service_finder_options['booking-reminder-to-customer-subject'] != ""){
			$msg_subject = $service_finder_options['booking-reminder-to-customer-subject'];
		}else{
			$msg_subject = esc_html__('Booking Reminder Notification', 'service-finder');
		}
		
		if(service_finder_wpmailer($customerInfo->email,$msg_subject,$msg_body)) {

			$success = array(
					'status' => 'success',
					'suc_message' => esc_html__('Message has been sent', 'service-finder'),
					);
			$service_finder_Success = json_encode($success);
			return $service_finder_Success;
			
			
		} else {
				
			$error = array(
					'status' => 'error',
					'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
					);
			$service_finder_Errors = json_encode($error);
			return $service_finder_Errors;
		}
	
}
/*Send Booking Reminder mail to admin*/
function service_finder_SendBookingReminderMailToAdmin($maildata = ''){
	global $service_finder_options, $wpdb, $service_finder_Tables;
	$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$maildata['provider_id']));
	$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$maildata['booking_customer_id']));
	
	$bookingpayment_mode = (!empty($maildata['type'])) ? $maildata['type'] : '';
	
	$payent_mode = ($bookingpayment_mode != '') ? $bookingpayment_mode : 'free';
	$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? $service_finder_options['pay_booking_amount_to'] : '';
	
	$message = '';
	if(!empty($service_finder_options['booking-reminder-to-admin'])){
		$message .= $service_finder_options['booking-reminder-to-admin'];
	}else{
		$message .= '
<h4>Booking Details</h4>
Date: %DATE%
			
			Time: %STARTTIME% - %ENDTIME%
			
			Member Name: %MEMBERNAME%
<h4>Provider Details</h4>
Provider Name: %PROVIDERNAME%

			Provider Email: %PROVIDEREMAIL%
			
			Phone: %PROVIDERPHONE%
<h4>Customer Details</h4>
Customer Name: %CUSTOMERNAME%

Customer Email: %CUSTOMEREMAIL%

Phone: %CUSTOMERPHONE%

Alternate Phone: %CUSTOMERPHONE2%

Address: %ADDRESS%

Apt/Suite: %APT%

City: %CITY%

State: %STATE%

Postal Code: %ZIPCODE%

Country: %COUNTRY%

Services: %SERVICES%


<h4>Payment Details</h4>
Pay Via: %PAYMENTMETHOD%
			
			Amount: %AMOUNT%';
	}
		
		$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%SERVICES%','%PAYMENTMETHOD%','%AMOUNT%','%SHORTDESCRIPTION%');
		
		if($maildata['member_id'] > 0){
		$membername = service_finder_getMemberName($maildata['member_id']);
		}else{
		$membername = '-';
		}
		$services = service_finder_get_booking_services($maildata['id']);
		
		$charge_admin_fee = (!empty($service_finder_options['charge-admin-fee'])) ? $service_finder_options['charge-admin-fee'] : '';
		$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';
		
		if($charge_admin_fee_from == 'provider' && $charge_admin_fee && $pay_booking_amount_to == 'admin'){
		$bookingamount = $maildata['total'] - $adminfee;
		}elseif($charge_admin_fee_from == 'customer' && $charge_admin_fee && $pay_booking_amount_to == 'admin'){
		$bookingamount = $maildata['total'];
		}else{
		$bookingamount = $maildata['total'];
		$adminfee = '0.0';
		}
		
		$replacements = array(date('Y-m-d',strtotime($maildata['date'])),$maildata['start_time'],$maildata['end_time'],$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,$services,ucfirst($payent_mode),service_finder_money_format($bookingamount),$customerInfo->description);
		$msg_body = str_replace($tokens,$replacements,$message);
		
		if($service_finder_options['booking-reminder-to-admin-subject'] != ""){
			$msg_subject = $service_finder_options['booking-reminder-to-admin-subject'];
		}else{
			$msg_subject = esc_html__('Booking Reminder Notification', 'service-finder');
		}
		
		if(service_finder_wpmailer(get_option('admin_email'),$msg_subject,$msg_body)) {

			$success = array(
					'status' => 'success',
					'suc_message' => esc_html__('Message has been sent', 'service-finder'),
					);
			$service_finder_Success = json_encode($success);
			return $service_finder_Success;
			
			
		} else {
				
			$error = array(
					'status' => 'error',
					'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
					);
			$service_finder_Errors = json_encode($error);
			return $service_finder_Errors;
		}
	
}

/*Set Social Cookie*/
add_action('wp_ajax_set_social_cookie', 'service_finder_set_social_cookie');
add_action('wp_ajax_nopriv_set_social_cookie', 'service_finder_set_social_cookie');
function service_finder_set_social_cookie(){
global $wpdb, $service_finder_Tables;
	unset($_SESSION['social_account_role']);
	$target = (isset($_POST['target'])) ? esc_html($_POST['target']) : '';
	$target = ltrim($target,'#');
	
	if($target == "tab1" || $target == "customertab"){
		$_SESSION['social_account_role'] = "customer";
	}elseif($target == "tab2" || $target == "providertab"){
		$_SESSION['social_account_role'] = "provider";
	}
	exit(0);
}

/*Check display basic feature after social login*/
function service_finder_check_display_features_after_social_login($provider_id){
global $service_finder_options, $current_user;

$socialaccount = get_user_meta($provider_id,'social_provider',true);
$providerrole = get_user_meta($provider_id,'provider_role',true);

if($socialaccount != "" && $providerrole == ""){

$showfeatures = (!empty($service_finder_options['display-basicfeature-after-sociallogin'])) ? esc_html($service_finder_options['display-basicfeature-after-sociallogin']) : '';
	
	if($showfeatures){
		return true;
	}else{
		return false;
	}
}else{
	return true;
}

}

/*Add to google calendar*/
function service_finder_addto_google_calendar($booking_id,$provider_id){
session_start();
global $service_finder_options, $current_user,  $service_finder_Tables, $wpdb;
		$flag = 0;
		require_once SERVICE_FINDER_BOOKING_LIB_DIR.'/google-api-php-client/src/Google/autoload.php';
		
		$google_client_id = get_user_meta($provider_id,'google_client_id',$google_client_id);
		$google_client_secret = get_user_meta($provider_id,'google_client_secret',$google_client_secret);
		$google_calendar_id = get_user_meta($provider_id,'google_calendar_id',$google_calendar_id);
		
		$client = new Google_Client();
		$client->setClientId($google_client_id);
		$client->setClientSecret($google_client_secret);
		$redirect_uri = add_query_arg( array('action' => 'googleoauth-callback'), home_url() );
		$client->setRedirectUri($redirect_uri);
		$client->setScopes('https://www.googleapis.com/auth/calendar');
		
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			$client->setAccessToken($_SESSION['access_token']);
			$flag = 1;
		}elseif(service_finder_get_gcal_access_token($provider_id) != ""){
			$client->setAccessToken(service_finder_get_gcal_access_token($provider_id));
			$flag = 1;
		}
		
		if($client->isAccessTokenExpired()) {
			 try{
			 
			 if(isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			  $newaccesstoken = json_decode($_SESSION['access_token']);
			  $client->refreshToken($newaccesstoken->refresh_token);
			
			 }elseif(service_finder_get_gcal_access_token($provider_id) != ""){
			  $newaccesstoken = json_decode(service_finder_get_gcal_access_token($provider_id));
			  $client->refreshToken($newaccesstoken->refresh_token);
			 }
			 
			 } catch (Exception $e) {
				
			 }
	
		 }
		
		if($flag == 1){
			$bookingdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$booking_id));
			$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$bookingdata->booking_customer_id));
			$offset = 0;
			
			$str_date = strtotime($bookingdata->date.' '.$bookingdata->start_time);
			$dateTimeS = service_finder_date_format_RFC3339($str_date, $offset);
			if($bookingdata->end_time != ""){
			$str_date = strtotime($bookingdata->date.' '.$bookingdata->end_time);
			}else{
			$str_date = strtotime($bookingdata->date.' '.$bookingdata->start_time);
			}
			$dateTimeE = service_finder_date_format_RFC3339($str_date, $offset);
			$address = $customerInfo->apt.' '.$customerInfo->address.' '.$customerInfo->city.' '.$customerInfo->country;
			
			if(get_option('timezone_string') != ""){
			$timezone = get_option('timezone_string');
			}
			
			$bookingtitle = (!empty($service_finder_options['google-calendar-booking-title'])) ? $service_finder_options['google-calendar-booking-title'] : esc_html__('Service Finder Booking', 'service-finder');
			
			$tokens = array('%CUSTOMERNAME%','%CUSTOMEREMAIL%');
			
			$replacements = array($customerInfo->name,$customerInfo->email);
			
			$bookingtitle = str_replace($tokens,$replacements,$bookingtitle);
					
			$event = new Google_Service_Calendar_Event(array(
			  'summary' => $bookingtitle,
			  'location' => $address,
			  'description' => sprintf(esc_html__('Booking Made by %s', 'service-finder'),$customerInfo->name),
			  'start' => array(
				'dateTime' => $dateTimeS,
				'timeZone' => $timezone,
			  ),
			  'end' => array(
				'dateTime' => $dateTimeE,
				'timeZone' => $timezone,
			  ),
			  'attendees' => array(
				array('email' => $customerInfo->email)
			  ),
			));
			
			try{
			$calendarId = $google_calendar_id;
			$cal = new Google_Service_Calendar($client);
			$event = $cal->events->insert($calendarId, $event);
			$bookdata = array(
					'gcal_booking_url' => $event->htmlLink, 
					'gcal_booking_id' => $event->id, 
					);
					
			$where = array(
					'id' => $booking_id 
					);		
	
			$wpdb->update($service_finder_Tables->bookings,wp_unslash($bookdata),$where);

			} catch (Exception $e) {
			//echo '<pre>';print_r($e);
			}
			return true;
		}
}

/*Update to google calendar*/
function service_finder_updateto_google_calendar($booking_id,$provider_id){
session_start();
global $service_finder_options, $current_user,  $service_finder_Tables, $wpdb;
		$flag = 0;
		require_once SERVICE_FINDER_BOOKING_LIB_DIR.'/google-api-php-client/src/Google/autoload.php';
		
		$google_client_id = get_user_meta($provider_id,'google_client_id',$google_client_id);
		$google_client_secret = get_user_meta($provider_id,'google_client_secret',$google_client_secret);
		$google_calendar_id = get_user_meta($provider_id,'google_calendar_id',$google_calendar_id);
		
		$client = new Google_Client();
		$client->setClientId($google_client_id);
		$client->setClientSecret($google_client_secret);
		$redirect_uri = add_query_arg( array('action' => 'googleoauth-callback'), home_url() );
		$client->setRedirectUri($redirect_uri);
		$client->setScopes('https://www.googleapis.com/auth/calendar');
		
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			$client->setAccessToken($_SESSION['access_token']);
			$flag = 1;
		}elseif(service_finder_get_gcal_access_token($provider_id) != ""){
			$client->setAccessToken(service_finder_get_gcal_access_token($provider_id));
			$flag = 1;
		}
		
		if($client->isAccessTokenExpired()) {
			 try{
			 
			 if(isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			  $newaccesstoken = json_decode($_SESSION['access_token']);
			  $client->refreshToken($newaccesstoken->refresh_token);
			
			 }elseif(service_finder_get_gcal_access_token($provider_id) != ""){
			  $newaccesstoken = json_decode(service_finder_get_gcal_access_token($provider_id));
			  $client->refreshToken($newaccesstoken->refresh_token);
			 }
			 
			 } catch (Exception $e) {
				
			 }
	
		 }
		
		if($flag == 1){
			$bookingdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$booking_id));
			$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$bookingdata->booking_customer_id));
			$offset = 0;
			
			$str_date = strtotime($bookingdata->date.' '.$bookingdata->start_time);
			$dateTimeS = service_finder_date_format_RFC3339($str_date, $offset);
			if($bookingdata->end_time != ""){
			$str_date = strtotime($bookingdata->date.' '.$bookingdata->end_time);
			}else{
			$str_date = strtotime($bookingdata->date.' '.$bookingdata->start_time);
			}
			$dateTimeE = service_finder_date_format_RFC3339($str_date, $offset);
			
			if(get_option('timezone_string') != ""){
			$timezone = get_option('timezone_string');
			}
					
			try{
			$calendarId = $google_calendar_id;
			$cal = new Google_Service_Calendar($client);
			$event = $cal->events->get($calendarId,$bookingdata->gcal_booking_id);
			
			$start = new Google_Service_Calendar_EventDateTime();
			$start->setDateTime($dateTimeS);
	        $event->setStart($start);
			
			$end = new Google_Service_Calendar_EventDateTime();
			$end->setDateTime($dateTimeE);
	        $event->setEnd($end);
			
			$updatedEvent = $cal->events->update($calendarId, $event->getId(), $event);

			$updatedEvent->getUpdated();

			} catch (Exception $e) {
			//echo '<pre>';print_r($e);
			}
			return true;
		}
}

/*Cancel to google calendar*/
function service_finder_cancelto_google_calendar($booking_id,$provider_id){
session_start();
global $service_finder_options, $current_user,  $service_finder_Tables, $wpdb;
		$flag = 0;
		require_once SERVICE_FINDER_BOOKING_LIB_DIR.'/google-api-php-client/src/Google/autoload.php';
		
		$google_client_id = get_user_meta($provider_id,'google_client_id',$google_client_id);
		$google_client_secret = get_user_meta($provider_id,'google_client_secret',$google_client_secret);
		$google_calendar_id = get_user_meta($provider_id,'google_calendar_id',$google_calendar_id);
		
		$client = new Google_Client();
		$client->setClientId($google_client_id);
		$client->setClientSecret($google_client_secret);
		$redirect_uri = add_query_arg( array('action' => 'googleoauth-callback'), home_url() );
		$client->setRedirectUri($redirect_uri);
		$client->setScopes('https://www.googleapis.com/auth/calendar');
		
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			$client->setAccessToken($_SESSION['access_token']);
			$flag = 1;
		}elseif(service_finder_get_gcal_access_token($provider_id) != ""){
			$client->setAccessToken(service_finder_get_gcal_access_token($provider_id));
			$flag = 1;
		}
		
		if($client->isAccessTokenExpired()) {
			 try{
			 
			 if(isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			  $newaccesstoken = json_decode($_SESSION['access_token']);
			  $client->refreshToken($newaccesstoken->refresh_token);
			
			 }elseif(service_finder_get_gcal_access_token($provider_id) != ""){
			  $newaccesstoken = json_decode(service_finder_get_gcal_access_token($provider_id));
			  $client->refreshToken($newaccesstoken->refresh_token);
			 }
			 
			 } catch (Exception $e) {
				
			 }
	
		 }
		
		if($flag == 1){
		$bookingdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$booking_id));
			try{
			$calendarId = $google_calendar_id;
			$cal = new Google_Service_Calendar($client);
			$cal->events->delete($calendarId, $bookingdata->gcal_booking_id);
			
			$data = array(
						'gcal_booking_url' => '',
						'gcal_booking_id' => ''
						);
	
			$where = array(
						'id' => $booking_id
						);
						
			$wpdb->update($service_finder_Tables->bookings,wp_unslash($data),$where);
			
			} catch (Exception $e) {
			//echo '<pre>';print_r($e);
			}
			return true;
		}
}

/*google calendar date format*/
function service_finder_date_format_RFC3339($timestamp = 0, $offset = 0) {
        if(get_option('timezone_string') != ""){
		$timezone = get_option('timezone_string');
		}else{
		$timezone = 'Asia/Kolkata';
		}
        $date = new DateTime(date('Y-m-d H:i:s', $timestamp), new DateTimeZone($timezone));
        return $date->format(DateTime::RFC3339);
}

if (isset($_GET['code']) && isset($_GET['action']) && $_GET['action'] == 'googleoauth-callback') {
    session_start();
	require_once SERVICE_FINDER_BOOKING_LIB_DIR.'/google-api-php-client/src/Google/autoload.php';
	
	$providerid = isset($_SESSION['providerid']) ? esc_html($_SESSION['providerid']) : '';
	$code = isset($_GET['code']) ? $_GET['code'] : '';
	
	$client_id = get_user_meta($providerid,'google_client_id',true);
	$client_secret = get_user_meta($providerid,'google_client_secret',true);
	$redirect_uri = add_query_arg( array('action' => 'googleoauth-callback'), home_url() );
	
	$client = new Google_Client();
	$client->setClientId($client_id);
	$client->setClientSecret($client_secret);
	$client->setRedirectUri($redirect_uri);
	$client->setScopes('https://www.googleapis.com/auth/calendar');	
	try{	
    $client->authenticate($_GET['code']);
	} catch (Exception $e) {
	//echo '<pre>';print_r($e);
	}
	
    $_SESSION['access_token'] = $client->getAccessToken();
	update_user_meta($providerid,'gcal_access_token',$_SESSION['access_token']);
	
	$account_url = service_finder_get_url_by_shortcode('[service_finder_my_account]');
	
    header('Location: ' . filter_var($account_url, FILTER_SANITIZE_URL));
	die;
}

/*google calendar date format*/
function service_finder_get_gcal_access_token($providerid) {
	return get_user_meta($providerid,'gcal_access_token',true);
}

/*theme style*/
function service_finder_themestyle() {
	global $service_finder_options;
	
	$themestyle = (isset($service_finder_options['theme-style'])) ? esc_html($service_finder_options['theme-style']) : '';
	return $themestyle;
}

/*Load branch loaction map*/
add_action('wp_ajax_load_branch_marker', 'service_finder_load_branch_marker');
add_action('wp_ajax_nopriv_load_branch_marker', 'service_finder_load_branch_marker');

function service_finder_load_branch_marker(){
global $wpdb,$service_finder_options, $service_finder_Tables;

$branchid = (isset($_POST['branchid'])) ? esc_attr($_POST['branchid']) : '';
$userid = (isset($_POST['userid'])) ? esc_attr($_POST['userid']) : '';

$res = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->branches.' WHERE id = %d',$branchid));

if(!empty($res)){

$getProvider = new SERVICE_FINDER_searchProviders();
$providerInfo = $getProvider->service_finder_getProviderInfo(esc_attr($userid));

$userLink = service_finder_get_author_url($providerInfo->wp_user_id);
						if(!empty($providerInfo->avatar_id) && $providerInfo->avatar_id > 0){
							$src  = wp_get_attachment_image_src( $providerInfo->avatar_id, 'service_finder-provider-thumb' );
							$src  = $src[0];
						}else{
							$src  = '';
						}
						$icon = service_finder_getCategoryIcon(get_user_meta($providerInfo->wp_user_id,'primary_category',true));
						if($icon == ""){
						$icon = (!empty($service_finder_options['default-map-marker-icon']['url'])) ? $service_finder_options['default-map-marker-icon']['url'] : '';
						}
						
						$markeraddress = service_finder_getBranchAddress($res->id);
		
						if($res->zoomlevel != ""){
							$zoom_level = $res->zoomlevel;
						}else{
							$zoom_level = get_user_meta($providerInfo->wp_user_id,'zoomlevel',true);
						
							if($zoom_level == ""){
							$zoom_level = (!empty($service_finder_options['zoom-level'])) ? $service_finder_options['zoom-level'] : 14;
							}
						}
				
						
						$companyname = service_finder_getCompanyName($providerInfo->wp_user_id);
						
						$marker = '[["'.stripcslashes($providerInfo->full_name).'","'.$res->lat.'","'.$res->long.'","'.$src.'","'.$icon.'","'.$userLink.'","'.$providerInfo->wp_user_id.'","'.service_finder_getCategoryName(get_user_meta($providerInfo->wp_user_id,'primary_category',true)).'","'.stripcslashes($markeraddress).'","'.stripcslashes($companyname).'"]]';
						
						//$marker = '["","'.$providerInfo->lat.'","'.$providerInfo->long.'","","","","","","",""]';
						
						$resarr = array(
									'lat' => $res->lat,
									'long' => $res->long,
									'zoomlevel' => $zoom_level,
									'markers' => $marker
								);
						
						echo json_encode($resarr);		

}
exit;
}		

/*Check if request a quote form show to logged in user or without logged in user*/
function service_finder_request_quote_for_loggedin_user(){
global $service_finder_options;

$afterlogin = (!empty($service_finder_options["request-quote-after-login"])) ? esc_html($service_finder_options["request-quote-after-login"]) : "";

	if($afterlogin){
		if(is_user_logged_in()){
			return true;
		}else{
			return false;
		}
		
	}else{
		return true;
	}
}

/*Check is user is login from socail account*/
function service_finder_is_social_user($userid){
global $service_finder_options, $current_user;

	$socialaccount = get_user_meta($userid,'social_provider',true);
	
	if($socialaccount != ""){
	return true;
	}else{
	return false;
	}
}

/*Searched provider services*/
function service_finder_get_searched_services($provider_id,$keyword = '',$minprice = 0,$maxprice = 0){
global $wpdb, $service_finder_Tables, $service_finder_options;

if($minprice != '' && $maxprice != '' && $maxprice > 0 && $keyword == ''){

	$services = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->services.' WHERE `wp_user_id` = '.$provider_id.' AND (cost BETWEEN '.$minprice.' AND '.$minprice.')');

}elseif($minprice == 0 && $maxprice == 0 && $keyword != ''){
	$services = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->services.' WHERE `wp_user_id` = '.$provider_id.' AND (service_name LIKE "%'.$keyword.'%" OR description LIKE "%'.$keyword.'%")');

}elseif($minprice != '' && $maxprice != '' && $maxprice > 0 && $keyword != ''){
	$services = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->services.' WHERE `wp_user_id` = '.$provider_id.' AND (cost BETWEEN '.$minprice.' AND '.$maxprice.') AND (service_name LIKE "%'.$keyword.'%" OR description LIKE "%'.$keyword.'%")');
}else{
	$services = '';
}
	
	return $services;

}


/*Get Provider name with link*/
function service_finder_get_providername_with_link($provider_id){
	global $service_finder_Tables, $wpdb;
		
	$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$provider_id));
		
	if(!empty($providerInfo)){
	$userLink = service_finder_get_author_url($provider_id);
	
	$providerlink = '<a href="'.esc_url($userLink).'" target="_blank">'.esc_html($providerInfo->full_name).'</a>';
		
	return $providerlink;
	}

}

/*Get Provider name with link*/
function service_finder_getServiceGroups($provider_id){
	global $service_finder_Tables, $wpdb;
		
	$groups = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->service_groups.' WHERE `provider_id` = %d',$provider_id));
		
	if(!empty($groups)){	
	return $groups;
	}else{
	return '';
	}

}

/*Get video thumbnail*/
function service_finder_identify_videos($embeded_code,$size = ''){
		$fbfind   = '//www.facebook.com';
		$fbpos = strpos($embeded_code, $fbfind);
		$thumb = '';
		
		if ($fbpos !== false) {
			if (preg_match("~(?:t\.\d+/)?(\d+)~i", $embeded_code, $matches)) {
		   		$videoid = $matches[1];
				
				$xml = file_get_contents('http://graph.facebook.com/' . $videoid); 
			    $result = json_decode($xml); 
				/*if($size == 'full'){
				$thumburl = $result->format[2]->picture; 
				$thumb = "<img src='".$thumburl."' />";
				}else{
				$thumburl = $result->format[1]->picture; 
				$thumb = "<img src='".$thumburl."' width='150' />";
				}*/
				
				if($size == 'full'){
				$thumb = "<img src='//graph.facebook.com/".$videoid."/picture?type=large' />";
				}else{
				$thumb = "<img src='//graph.facebook.com/".$videoid."/picture' width='150' />";
				}
				
				
		    }
		
		}
		
		$ytfind   = 'youtu';
		$ytpos = strpos($embeded_code, $ytfind);
		
		if ($ytpos !== false) {
			$youtubeinfo = service_finder_get_youtube_info($embeded_code);
			if(!empty($youtubeinfo)){
				$thumb = $youtubeinfo['thumbnail_url'];
				$thumb = "<img src='".$thumb."' />";
			}
		
		}
		
		$vmfind   = 'vimeo.com';
		$vmpos = strpos($embeded_code, $vmfind);
		
		if ($vmpos !== false) {
			 if (preg_match("/(?:.*)\/([0-9]*)/i", $embeded_code, $matches)) {
		   		$videoid = $matches[1];
				if($videoid != ""){
				
				$pagedocument = @file_get_contents("https://vimeo.com/api/v2/video/".$videoid.".php");
				
				if ($pagedocument === false) {
					return '';
				}else{
				
				$hash = unserialize(file_get_contents("https://vimeo.com/api/v2/video/".$videoid.".php"));
				
				if($size == 'full'){
				$thumburl = $hash[0]['thumbnail_large'];
				$thumb = "<img src='".$thumburl."' />";
				}else{
				$thumburl = $hash[0]['thumbnail_medium'];
				$thumb = "<img src='".$thumburl."' width='150' />";
				}
				}
				}
		    }
		
		}
		
		return $thumb;
}		

/*Get video type*/
function service_finder_get_video_type($embeded_code){
		$fbfind   = '//www.facebook.com';
		$fbpos = strpos($embeded_code, $fbfind);
		
		if ($fbpos !== false) {
			if (preg_match("~(?:t\.\d+/)?(\d+)~i", $embeded_code, $matches)) {
				$videotype = 'facebook';
			}
		
		}
		
		$ytfind   = 'youtu';
		$ytpos = strpos($embeded_code, $ytfind);
		
		if ($ytpos !== false) {
			$youtubeinfo = service_finder_get_youtube_info($embeded_code);
			if(!empty($youtubeinfo)){
				$videotype = 'youtube';
			}
		}
		
		$vmfind   = 'vimeo.com';
		$vmpos = strpos($embeded_code, $vmfind);
		
		if ($vmpos !== false) {
			 if (preg_match("/(?:.*)\/([0-9]*)/i", $embeded_code, $matches)) {
		   		$videotype = 'vimeo';
		    }
		
		}
		
		return $videotype;
}	

/*Translate week days name*/
function service_finder_trans_weekdays($day){
	$day = strtolower($day);
	switch($day){
	case 'monday':
		$dayname = esc_html__('Monday','service-finder');
		break;
	case 'tuesday':
		$dayname = esc_html__('Tuesday','service-finder');
		break;
	case 'wednesday':
		$dayname = esc_html__('Wednesday','service-finder');
		break;
	case 'thursday':
		$dayname = esc_html__('Thursday','service-finder');
		break;
	case 'friday':
		$dayname = esc_html__('Friday','service-finder');
		break;
	case 'saturday':
		$dayname = esc_html__('Saturday','service-finder');
		break;
	case 'sunday':
		$dayname = esc_html__('Sunday','service-finder');
		break;
	default:
		$dayname = $day;
		break;							
	}
	
	return $dayname;
}

/*Translate am/pm*/
function service_finder_trans_timeunit($timeunit){
	$timeunit = strtolower($timeunit);
	switch($timeunit){
	case 'am':
		$unitname = esc_html__('am','service-finder');
		break;
	case 'pm':
		$unitname = esc_html__('pm','service-finder');
		break;
	default:
		$unitname = $timeunit;
		break;							
	}
	
	return $unitname;
}

/*Load more branches*/
add_action('wp_ajax_load_more_branches', 'service_finder_load_more_branches');
add_action('wp_ajax_nopriv_load_more_branches', 'service_finder_load_more_branches');

function service_finder_load_more_branches(){
global $wpdb,$service_finder_options, $service_finder_Tables;

$userid = (isset($_POST['userid'])) ? esc_attr($_POST['userid']) : '';


$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->branches.' WHERE wp_user_id = %d ORDER BY ID DESC LIMIT 2,10',$userid));

if(!empty($results)){
foreach($results as $res){
?>
	<li class="equal-col">
	   <a href="javascript:;" class="load-branch-address" data-branchid="<?php echo esc_attr($res->id); ?>" data-userid="<?php echo esc_attr($userid); ?>">
	   <?php
	   echo service_finder_getBranches($res->id);
	   ?>
	   </a>
	</li>
<?php
}
}

exit;
}	



/*Custom Comment Rating*/
function service_finder_output_review_fields(){
global $wpdb, $service_finder_Tables, $pixreviews_plugin;

$post_id = get_the_ID();

		
		$row = $wpdb->get_row($wpdb->prepare('SELECT `user_id` FROM '.$wpdb->prefix.'usermeta WHERE `meta_value` = %d AND `meta_key` = "comment_post"',$post_id));
		if(!empty($row)){
		$categoryid = get_user_meta($row->user_id,'primary_category',true);
		
		$labels = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->rating_labels.' where category_id = %d',$categoryid));
		$totallevel = count($labels);
		
		if(!empty($labels)){
		$i = 1;
		echo '<div class="sf-customer-rating">';
		foreach($labels as $label){
		?>
		<div class="sf-customer-rating-row clearfix">
        
            <div class="sf-customer-rating-name pull-left"><?php echo $label->label_name; ?></div>
            
            <div class="sf-customer-rating-count  pull-right">
                <div class="sf-customer-rating-sarts">
                    <input class="add-custom-rating" name="comment-rating-<?php echo $i; ?>" value="" type="number" class="rating" min=0 max=5 step=0.5 data-size="sm">
                    <input name="rating-label-<?php echo $i; ?>" value="<?php echo $label->label_name; ?>" type="hidden">
                </div>
            </div>
            
        </div>
		<?php
		$i++;
		}
		echo '<input name="totallevel" value="'.$totallevel.'" type="hidden">';
		echo '</div>';
		}else{
		$labels = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->rating_labels.' where category_id = 0');
		$i = 1;
		
		$totallevel = count($labels);
		
		echo '<div class="sf-customer-rating">';
		if(!empty($labels)){
		foreach($labels as $label){
		?>
		<div class="sf-customer-rating-row clearfix">
        
            <div class="sf-customer-rating-name pull-left"><?php echo $label->label_name; ?></div>
            
            <div class="sf-customer-rating-count  pull-right">
                <div class="sf-customer-rating-sarts">
                    <input class="add-custom-rating" name="comment-rating-<?php echo $i; ?>" value="" type="number" class="rating" min=0 max=5 step=0.5 data-size="sm">
                    <input name="rating-label-<?php echo $i; ?>" value="<?php echo $label->label_name; ?>" type="hidden">
                </div>
            </div>
            
        </div>
		<?php
		$i++;
		}
		}else{
		echo '<div class="alert alert-danger">';
		echo esc_html__('Please set labels for custom rating','service-finder');
		echo '</div>';
		}
		echo '<input name="totallevel" value="'.$totallevel.'" type="hidden">';
		echo '</div>';
		}
		
		}
?>
    <p class="review-title-form">
        <label for="pixrating_title"><?php echo $pixreviews_plugin->get_plugin_option( 'review_title_label' ); ?></label>
        <input type='text' id='rating_title' name='rating_title' value="" placeholder="<?php echo esc_attr( $pixreviews_plugin->get_plugin_option( 'review_title_placeholder' ) ) ?>" size='25'/>
    </p>
<?php
}

/*Save Custom Comment Rating*/
function service_finder_save_comment($commentID){
global $wpdb, $service_finder_Tables, $current_user;
		
		if ( ! is_numeric( $commentID ) ) {
			return;
		}
		
		$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM `'.$wpdb->prefix.'comments` where comment_ID = %d',$commentID));
		$comment_post_id = $row->comment_post_ID;
		
		$row = $wpdb->get_row($wpdb->prepare('SELECT `user_id` FROM '.$wpdb->prefix.'usermeta WHERE `meta_value` = %d AND `meta_key` = "comment_post"',$comment_post_id));
		
		$rating1 = (!empty($_POST['comment-rating-1'])) ? sanitize_text_field($_POST['comment-rating-1']) : 0;
		$rating2 = (!empty($_POST['comment-rating-2'])) ? sanitize_text_field($_POST['comment-rating-2']) : 0;
		$rating3 = (!empty($_POST['comment-rating-3'])) ? sanitize_text_field($_POST['comment-rating-3']) : 0;
		$rating4 = (!empty($_POST['comment-rating-4'])) ? sanitize_text_field($_POST['comment-rating-4']) : 0;
		$rating5 = (!empty($_POST['comment-rating-5'])) ? sanitize_text_field($_POST['comment-rating-5']) : 0;
		
		$label1 = (!empty($_POST['rating-label-1'])) ? sanitize_text_field($_POST['rating-label-1']) : '';
		$label2 = (!empty($_POST['rating-label-2'])) ? sanitize_text_field($_POST['rating-label-2']) : '';
		$label3 = (!empty($_POST['rating-label-3'])) ? sanitize_text_field($_POST['rating-label-3']) : '';
		$label4 = (!empty($_POST['rating-label-4'])) ? sanitize_text_field($_POST['rating-label-4']) : '';
		$label5 = (!empty($_POST['rating-label-5'])) ? sanitize_text_field($_POST['rating-label-5']) : '';
		
		$totallevel = (!empty($_POST['totallevel'])) ? sanitize_text_field($_POST['totallevel']) : 1;
		
		$avgrating = ($rating1 + $rating2 + $rating3 + $rating4 + $rating5)/$totallevel;
		
		$data = array(
				'provider_id' => $row->user_id,
				'customer_id' => $current_user->ID,
				'comment_id' => $commentID,
				'rating_title' => (!empty($_POST['rating_title'])) ? sanitize_text_field($_POST['rating_title']) : '',
				'rating1' => $rating1,
				'rating2' => $rating2,
				'rating3' => $rating3,
				'rating4' => $rating4,
				'rating5' => $rating5,
				'label1' => $label1,
				'label2' => $label2,
				'label3' => $label3,
				'label4' => $label4,
				'label5' => $label5,
				'avgrating' => $avgrating,
				);
		$wpdb->insert($service_finder_Tables->custom_rating,wp_unslash($data));

}

/*Save Custom Comment Rating*/
function service_finder_display_rating($comment){
global $wpdb, $service_finder_Tables, $current_user;

	//bail if we don't have a valid current comment ID
	if ( ! get_comment_ID() ) {
		return $comment;
	}
	$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM `'.$service_finder_Tables->custom_rating.'` where `comment_id` = %d',get_comment_ID()));

	$rating = '';
	if(!empty($row)){
	
	if($row->label1 != ""){
	$k = 1;
	}
	if($row->label2 != ""){
	$k = 2;
	}
	if($row->label3 != ""){
	$k = 3;
	}
	if($row->label4 != ""){
	$k = 4;
	}
	if($row->label5 != ""){
	$k = 5;
	}
	
	$rating .= '<div class="sf-customer-display-rating">';
	for($i=1;$i<=$k;$i++){
	switch($i){
	case 1:
		$label = $row->label1;
		$ratingnumber = $row->rating1;
		break;
	case 2:
		$label = $row->label2;
		$ratingnumber = $row->rating2;
		break;
	case 3:
		$label = $row->label3;
		$ratingnumber = $row->rating3;
		break;
	case 4:
		$label = $row->label4;
		$ratiratingnumberng = $row->rating4;
		break;
	case 5:
		$label = $row->label5;
		$ratingnumber = $row->rating5;
		break;				
	}
	$rating .= '<div class="sf-customer-rating-row clearfix">';
        
        $rating .= '<div class="sf-customer-rating-name pull-left">'.$label.'</div>';
        
        $rating .= '<div class="sf-customer-rating-count  pull-right">';
        $rating .= service_finder_displayRating($ratingnumber);
        $rating .= '</div>';
	$rating .= '</div>';	
	}
	$rating .= '</div>';
	
	$comment = $rating . $comment;
	
	if(!empty($row->rating_title)){
	$comment = '<h3 class="pixrating_title">' . $row->rating_title . '</h3>' . $comment;
	}
	
	}
	
	return $comment;
}

function service_finder_get_youtube_info($youtubeurl){

$url = "https://www.youtube.com/oembed?url=". $youtubeurl ."&format=json";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$response = curl_exec($ch);
curl_close($ch);

return json_decode($response, true);

}

/*Breadcrumb for provider profile page*/
function service_finder_get_category_breadcrumb($catid){
$texonomy = 'providers-category';
$catdetails = get_term_by('id', $catid, $texonomy);
if(!empty($catdetails)){
$link = get_term_link( $catdetails, $texonomy );
$li = '';
if($catdetails->parent != "" && $catdetails->parent > 0){
$parentcatid = $catdetails->parent;
$parentcatdetails = get_term_by('id', $parentcatid, $texonomy);
$parentlink = get_term_link( $parentcatdetails, $texonomy );
$li .= '<li><a href="'.esc_url($parentlink).'">'.service_finder_getCategoryName($parentcatid).'</a></li>';
}
$li .= '<li><a href="'.esc_url($link).'">'.service_finder_getCategoryName($catid).'</a></li>';
return $li;
}
}

function send_mail_after_joblimit_connect_purchase( $userid ){
		global $wpdb, $service_finder_options, $service_finder_Tables;
		
		$email = service_finder_getProviderEmail($userid);
		
		$providerreplacestring = (!empty($service_finder_options['provider-replace-string'])) ? $service_finder_options['provider-replace-string'] : esc_html__('Provider', 'service-finder');	
		
		$row = $wpdb->get_row('SELECT * FROM '.$service_finder_Tables->job_limits.' WHERE `provider_id` = "'.$userid.'"');
		$payment_method = '';
		$current_plan = '';
		if(!empty($row)){
		$payment_method = $row->payment_method;
		$current_plan = $row->current_plan;
		}
		
		$upgrade_plan = (!empty($service_finder_options['plan'.$current_plan.'-name'])) ? $service_finder_options['plan'.$current_plan.'-name'] : '';
		
		if(!empty($service_finder_options['joblimit-connect-purchase-message'])){
			$message = $service_finder_options['joblimit-connect-purchase-message'];
		}else{
			$message = esc_html__('Dear ', 'service-finder').esc_html($providerreplacestring).',';
			$message .= esc_html__('Congratulations! Your Job Coonect Upgraded Successfully', 'service-finder');
			$message .= esc_html__('Name: ', 'service-finder').'%USERNAME%';
			$message .= esc_html__('Plan Name: ', 'service-finder').'%PLANNAME%';
			$message .= esc_html__('Payment Method: ', 'service-finder').'%PAYMENTMETHOD%';
		}
		
		if($service_finder_options['joblimit-connect-purchase-subject'] != ""){
			$msg_subject = $service_finder_options['joblimit-connect-purchase-subject'];
		}else{
			$msg_subject = esc_html__('Job Connect Approval Notification', 'service-finder');
		}
		
		$tokens = array('%USERNAME%','%PLANNAME%','%PAYMENTMETHOD%');
		$replacements = array(service_finder_getProviderName($userid),$upgrade_plan,service_finder_translate_static_status_string($payment_method));
		$msg_body = str_replace($tokens,$replacements,$message);
		
		if(function_exists('service_finder_add_notices')) {
	
			$noticedata = array(
					'provider_id' => $userid,
					'target_id' => $row->id, 
					'topic' => esc_html__('Job Apply Connect', 'service-finder'),
					'notice' => esc_html__('Your job apply connect plan upgraded.', 'service-finder')
					);
			service_finder_add_notices($noticedata);
		
		}
		
		service_finder_wpmailer($email,$msg_subject,$msg_body);
	}
	
function send_mail_after_jobpost_limit_connect_purchase( $userid ){
		global $wpdb, $service_finder_options, $service_finder_Tables;
		
		$email = service_finder_getCustomerEmail($userid);
			
		$customerreplacestring = (!empty($service_finder_options['customer-replace-string'])) ? $service_finder_options['customer-replace-string'] : esc_html__('Customer', 'service-finder');	
		
		$row = $wpdb->get_row('SELECT * FROM '.$service_finder_Tables->job_limits.' WHERE `provider_id` = "'.$userid.'"');
		$payment_method = '';
		$current_plan = '';
		if(!empty($row)){
		$payment_method = $row->payment_method;
		$current_plan = $row->current_plan;
		}
		
		$upgrade_plan = (!empty($service_finder_options['job-post-plan'.$current_plan.'-name'])) ? $service_finder_options['job-post-plan'.$current_plan.'-name'] : '';
		
		if(!empty($service_finder_options['jobpost-connect-purchase-message'])){
			$message = $service_finder_options['jobpost-connect-purchase-message'];
		}else{
			$message = esc_html__('Dear ', 'service-finder').esc_html($customerreplacestring).',';
			$message .= esc_html__('Congratulations! Your Job Post Connect Upgraded Successfully', 'service-finder');
			$message .= esc_html__('Name: ', 'service-finder').'%USERNAME%';
			$message .= esc_html__('Plan Name: ', 'service-finder').'%PLANNAME%';
			$message .= esc_html__('Payment Method: ', 'service-finder').'%PAYMENTMETHOD%';
		}
		
		if($service_finder_options['jobpost-connect-purchase-subject'] != ""){
			$msg_subject = $service_finder_options['jobpost-connect-purchase-subject'];
		}else{
			$msg_subject = esc_html__('Job Post Connect Approval Notification', 'service-finder');
		}
		
		$tokens = array('%USERNAME%','%PLANNAME%','%PAYMENTMETHOD%');
		$replacements = array(service_finder_getCustomerName($userid),$upgrade_plan,service_finder_translate_static_status_string($payment_method));
		$msg_body = str_replace($tokens,$replacements,$message);
		
		if(function_exists('service_finder_add_notices')) {
	
			$noticedata = array(
					'customer_id' => $userid,
					'target_id' => $row->id, 
					'topic' => esc_html__('Job Post Connect', 'service-finder'),
					'notice' => esc_html__('Your job post connect plan upgraded.', 'service-finder')
					);
			service_finder_add_notices($noticedata);
		
		}
		
		service_finder_wpmailer($email,$msg_subject,$msg_body);
	
	}	
	
add_action( 'admin_menu', 'service_finder_add_menu_bubble' );
function service_finder_add_menu_bubble() {
  global $menu, $submenu;
  
  $totalcount = 0;
  
  if(!empty($submenu['service-finder'])){
  foreach ( $submenu['service-finder'] as $key => $value ) {
      
	  $menuslug = $submenu['service-finder'][$key][2];
	  switch($menuslug){
	  	case 'featured-requests':
			$count = service_finder_get_featured_bubble();
			$totalcount = $totalcount + $count;
			$submenu['service-finder'][$key][0] .= ' <span class="awaiting-mod update-sfservices count-'.$count.'" data-toggle="tooltip" data-placement="top" title="'.esc_html__('Pending Featured Requests', 'service-finder').'"><span class="pending-count">'.$count.'</span></span>';
			break;
		case 'claimbusiness':
			$count = service_finder_get_claimbusiness_bubble();
			$totalcount = $totalcount + $count;
			$submenu['service-finder'][$key][0] .= ' <span class="awaiting-mod update-sfservices count-'.$count.'" data-toggle="tooltip" data-placement="top" title="'.esc_html__('Pending Claimed Business Requests', 'service-finder').'"><span class="pending-count">'.$count.'</span></span>';
			break;
		case 'upgraderequest':
			$count = service_finder_get_upgraderequest_bubble();
			$totalcount = $totalcount + $count;
			$submenu['service-finder'][$key][0] .= ' <span class="awaiting-mod update-sfservices count-'.$count.'" data-toggle="tooltip" data-placement="top" title="'.esc_html__('Pending Account Upgrade Requests via Wire Transfer', 'service-finder').'"><span class="pending-count">'.$count.'</span></span>';
			break;
		case 'jobconnectrequest':
			$count = service_finder_get_jobconnectrequest_bubble();
			$totalcount = $totalcount + $count;
			$submenu['service-finder'][$key][0] .= ' <span class="awaiting-mod update-sfservices count-'.$count.'" data-toggle="tooltip" data-placement="top" title="'.esc_html__('Pending Job Connect Requests via Wire Transfer', 'service-finder').'"><span class="pending-count">'.$count.'</span></span>';
			break;
		case 'wallet-wired-request':
			$count = service_finder_get_walletrequest_bubble();
			$totalcount = $totalcount + $count;
			$submenu['service-finder'][$key][0] .= ' <span class="awaiting-mod update-sfservices count-'.$count.'" data-toggle="tooltip" data-placement="top" title="'.esc_html__('Pending Wallet Amount Requests via Wire Transfer', 'service-finder').'"><span class="pending-count">'.$count.'</span></span>';
			break;				
	  }

    }
	
	foreach ( $menu as $key => $value ) {
      if ( $menu[$key][2] == 'service-finder' ) {
        $menu[$key][0] .= ' <span class="awaiting-mod update-sfservices count-'.$totalcount.'"><span class="pending-count">'.$totalcount.'</span></span>';
        return;
      }
    }
	}
  
  	return;

}

function service_finder_get_featured_bubble(){
	global $wpdb, $service_finder_Tables;
	
	$total = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->feature.' WHERE `status` = "Waiting for Approval"');
	
	$total = count($total);
	
	return $total;
}	

function service_finder_get_claimbusiness_bubble(){
	global $wpdb, $service_finder_Tables;
	
	$total = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->claim_business.' WHERE `status` = "pending"');
	
	$total = count($total);
	
	return $total;
}

function service_finder_get_upgraderequest_bubble(){
	global $wpdb, $service_finder_Tables;
	
	$total = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'usermeta WHERE `meta_key` = "upgrade_request_status" AND `meta_value` = "pending"');
	
	$total = count($total);
	
	return $total;
}	

function service_finder_get_jobconnectrequest_bubble(){
	global $wpdb, $service_finder_Tables;
	
	$total = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'usermeta WHERE `meta_key` = "job_connect_request_status" AND `meta_value` = "pending"');
	
	$total = count($total);
	
	return $total;
}

function service_finder_get_walletrequest_bubble(){
	global $wpdb, $service_finder_Tables;
	
	$total = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->wallet_transaction.' WHERE `payment_status` = "pending"');
	
	$total = count($total);
	
	return $total;
}	

add_shortcode( 'wordpress_social_login', 'wordpress_social_login_fix' );

function wordpress_social_login_fix( $attributes, $content ) {
    ob_start();
    wsl_render_login_form();
    return ob_get_clean();
}

function service_finder_create_user_name($fullname) {
	global $wpdb, $service_finder_Tables;
	
    $slug = sanitize_user($fullname);
	
	return $slug;
	
}

function service_finder_get_admin_id(){
	global $wpdb, $service_finder_Tables;
	
    $users_query = new WP_User_Query( array( 
                'role' => 'administrator', 
                'orderby' => 'display_name'
                ) );
				
    $results = $users_query->get_results();
	
	if(!empty($results)){
    foreach($results as $user)
    {
        return $user->ID;
    }
	}
	
}

function service_finder_check_empty_category($catid){
	global $wpdb, $service_finder_Tables;
	
	$row = $wpdb->get_row('SELECT * FROM '.$service_finder_Tables->providers.' where FIND_IN_SET("'.$catid.'", category_id)');
	
	if(empty($row)){
		return true;
	}else{
		return false;
	}
}

/*Connect Stripe Account*/
if (isset($_GET['code']) && isset($_GET['scope'])) { 

	$service_finder_options = get_option('service_finder_options');
	$current_user = service_finder_plugin_global_vars('current_user');
	
	if( isset($service_finder_options['stripe-type']) && $service_finder_options['stripe-type'] == 'test' ){
		$secret_key = (!empty($service_finder_options['stripe-test-secret-key'])) ? $service_finder_options['stripe-test-secret-key'] : '';
	}else{
		$secret_key = (!empty($service_finder_options['stripe-live-secret-key'])) ? $service_finder_options['stripe-live-secret-key'] : '';
	}

    $code = (isset($_GET['code'])) ? esc_html($_GET['code']) : '';
	$clientid = (!empty($service_finder_options['stripe-connect-client-id'])) ? $service_finder_options['stripe-connect-client-id'] : '';
	define('TOKEN_URI', 'https://connect.stripe.com/oauth/token');
	
    $token_request_body = array(
      'client_secret' => $secret_key,
      'grant_type' => 'authorization_code',
      'client_id' => $clientid,
      'code' => $code,
    );
	
	$req = curl_init(TOKEN_URI);
    curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($req, CURLOPT_POST, true );
    curl_setopt($req, CURLOPT_POSTFIELDS, http_build_query($token_request_body));
	curl_setopt($req, CURLOPT_SSL_VERIFYPEER, false);
    // TODO: Additional error handling
    $respCode = curl_getinfo($req, CURLINFO_HTTP_CODE);
    $resp = json_decode(curl_exec($req), true);
    
	curl_close($req);
	if (!isset($resp['error'])) {
		update_user_meta($current_user->ID, 'provider_connected', 1);
		update_user_meta($current_user->ID, 'admin_client_id', $clientid);
		update_user_meta($current_user->ID, 'access_token', $resp['access_token']);
		update_user_meta($current_user->ID, 'refresh_token', $resp['refresh_token']);
		update_user_meta($current_user->ID, 'stripe_publishable_key', $resp['stripe_publishable_key']);
		update_user_meta($current_user->ID, 'stripe_connect_id', $resp['stripe_user_id']);
		
		$redirect_uri = service_finder_get_url_by_shortcode('[service_finder_my_account]');	
		$redirect_uri = add_query_arg( array('stripe_connect' => 'success'), $redirect_uri );
	}else{
		$redirect_uri = service_finder_get_url_by_shortcode('[service_finder_my_account]');	
		$redirect_uri = add_query_arg( array('stripe_connect' => 'failed'), $redirect_uri );
	}
	
	
	wp_redirect($redirect_uri);
	exit;
	
}

/*Disconnect Stripe Account*/
if (isset($_GET['disconnect_stripe']) && isset($_GET['stripe_connect_id'])) { 

	$service_finder_options = get_option('service_finder_options');
	$current_user = service_finder_plugin_global_vars('current_user');
	
	if( isset($service_finder_options['stripe-type']) && $service_finder_options['stripe-type'] == 'test' ){
		$secret_key = (!empty($service_finder_options['stripe-test-secret-key'])) ? $service_finder_options['stripe-test-secret-key'] : '';
	}else{
		$secret_key = (!empty($service_finder_options['stripe-live-secret-key'])) ? $service_finder_options['stripe-live-secret-key'] : '';
	}
	
	$stripe_connect_id = (isset($_GET['stripe_connect_id'])) ? esc_html($_GET['stripe_connect_id']) : '';
	$client_id = (isset($_GET['client_id'])) ? esc_html($_GET['client_id']) : '';
		
	$token_request_body = array(
		'client_id' => $client_id,
		'stripe_user_id' => $stripe_connect_id,
		'client_secret' => $secret_key
	);
	$req = curl_init('https://connect.stripe.com/oauth/deauthorize');
	curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($req, CURLOPT_POST, true);
	curl_setopt($req, CURLOPT_POSTFIELDS, http_build_query($token_request_body));
	curl_setopt($req, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($req, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($req, CURLOPT_VERBOSE, true);
	
	$respCode = curl_getinfo($req, CURLINFO_HTTP_CODE);
	$resp = json_decode(curl_exec($req), true);
	curl_close($req);
	if (isset($resp['stripe_user_id'])) {
		delete_user_meta($current_user->ID, 'provider_connected');
		delete_user_meta($current_user->ID, 'admin_client_id');
		delete_user_meta($current_user->ID, 'access_token');
		delete_user_meta($current_user->ID, 'refresh_token');
		delete_user_meta($current_user->ID, 'stripe_publishable_key');
		delete_user_meta($current_user->ID, 'stripe_connect_id');
		
		$redirect_uri = service_finder_get_url_by_shortcode('[service_finder_my_account]');	
		$redirect_uri = add_query_arg( array('stripe_disconnect' => 'success'), $redirect_uri );
	} else {
		$redirect_uri = service_finder_get_url_by_shortcode('[service_finder_my_account]');	
		$redirect_uri = add_query_arg( array('stripe_disconnect' => 'failed'), $redirect_uri );
	}
	
	wp_redirect($redirect_uri);
	exit;
	
}

/*Get distance in km/mi*/
function service_finder_getDistance($distance = ''){

if($distance != ""){
$radiussearchunit = (isset($service_finder_options['radius-search-unit'])) ? esc_attr($service_finder_options['radius-search-unit']) : 'mi';
$html = '<div  class="sf-featured-address"><i class="fa fa-road"></i> '.esc_html__( 'Distance', 'service-finder' ).': '.round($distance,2).' '.$radiussearchunit.' </div>';
return $html;
}

}

/*Get Mangopay settings*/
function service_finder_mangopay_settings(){
	$mp_settings = get_option('mangopay_settings');
	return $mp_settings;
}

/*Add vendor role to user*/
function service_finder_meke_user_vendor($user_id){
if( class_exists( 'WC_Vendors' ) && class_exists( 'WooCommerce' ) && class_exists( 'mangopayWCMain' ) ) {
$user = new WP_User( $user_id );
$user->add_role('Provider');
$user->add_role('vendor');

service_finder_make_mp_user($user_id);

update_user_meta( $user_id, 'is_vendor', 'yes' );

$productid = get_user_meta( $user_id, '_vendor_product_id', true );
if($productid == ''){
service_finder_create_wooproduct($user_id);
}
}
}

/*Remove user from vendor role*/
function service_finder_remove_user_vendor($user_id){
if( class_exists( 'WC_Vendors' ) && class_exists( 'WooCommerce' ) ) {
$user = new WP_User( $user_id );
$user->remove_role( 'vendor' );

update_user_meta( $user_id, 'is_vendor', '' );
}
}

/*Create new product for provider booking*/
function service_finder_create_wooproduct($user_id){
global $service_finder_Tables, $wpdb;
		
	$provider = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$user_id));
		
	$post_id = wp_insert_post( array(
		'post_author' => $user_id,
		'post_title' => $provider->full_name,
		'post_content' => esc_html__('Its a provider booking product', 'service-finder'),
		'post_status' => 'publish',
		'post_type' => "product",
	) );
	wp_set_object_terms( $post_id, 'simple', 'product_type' );
	update_post_meta( $post_id, '_visibility', 'visible' );
	update_post_meta( $post_id, '_stock_status', 'instock');
	update_post_meta( $post_id, 'total_sales', '0' );
	update_post_meta( $post_id, '_downloadable', 'no' );
	update_post_meta( $post_id, '_virtual', 'no' );
	update_post_meta( $post_id, '_regular_price', 15 );
	update_post_meta( $post_id, '_sale_price', 10 );
	update_post_meta( $post_id, '_purchase_note', '' );
	update_post_meta( $post_id, '_featured', 'no' );
	update_post_meta( $post_id, '_weight', '' );
	update_post_meta( $post_id, '_length', '' );
	update_post_meta( $post_id, '_width', '' );
	update_post_meta( $post_id, '_height', '' );
	update_post_meta( $post_id, '_sku', '' );
	update_post_meta( $post_id, '_product_attributes', array() );
	update_post_meta( $post_id, '_sale_price_dates_from', '' );
	update_post_meta( $post_id, '_sale_price_dates_to', '' );
	update_post_meta( $post_id, '_price', 10 );
	update_post_meta( $post_id, '_sold_individually', '' );
	update_post_meta( $post_id, '_manage_stock', 'no' );
	update_post_meta( $post_id, '_backorders', 'no' );
	update_post_meta( $post_id, '_stock', '' );
	
	update_user_meta( $user_id, '_vendor_product_id', $post_id );
}

/*Create new product for provider booking*/
function service_finder_make_mp_user($user_id){
global $service_finder_Tables, $wpdb;
		
	try {
		$mp_settings = service_finder_mangopay_settings();
		$prod_or_sandbox = $mp_settings['prod_or_sandbox'];
		
		if( $prod_or_sandbox == 'prod' ){
			$clientid = $mp_settings['prod_client_id'];
			$clientpassphrase = $mp_settings['prod_passphrase'];
		}else{
			$clientid = $mp_settings['sand_client_id'];
			$clientpassphrase = $mp_settings['sand_passphrase'];
		}
		
		$tmp_path = service_finder_get_mp_temp_path();
		
		$api = new MangoPay\MangoPayApi();
		$api->Config->ClientId = $clientid;
		$api->Config->ClientPassword = $clientpassphrase;
		$api->Config->TemporaryFolder = $tmp_path;
		
		$userInfo = service_finder_getUserInfo($user_id);
		$user_birthday = get_user_meta($user_id,'user_birthday',true);
		$user_nationality = get_user_meta($user_id,'user_nationality',true);
		$billing_country = get_user_meta($user_id,'billing_country',true);
		
		// CREATE NATURAL USER
		$naturalUser = new MangoPay\UserNatural();
		$naturalUser->Email = $userInfo['email'];
		$naturalUser->FirstName = $userInfo['fname'];
		$naturalUser->Tag = "wp_user_id:".$user_id;
		$naturalUser->LastName = $userInfo['lname'];
		$naturalUser->Birthday = strtotime($user_birthday);
		$naturalUser->Nationality = $user_nationality;
		$naturalUser->CountryOfResidence = $billing_country;
		$naturalUserResult = $api->Users->Create($naturalUser);

		//MangoPay\Libraries\Logs::Debug('CREATED NATURAL USER', $naturalUserResult);
		$mp_user_id = $naturalUserResult->Id;
		if( $prod_or_sandbox == 'prod' ){
		update_user_meta($user_id,'mp_user_id_prod',$mp_user_id);
		}else{
		update_user_meta($user_id,'mp_user_id_sandbox',$mp_user_id);
		}
		
	} catch (MangoPay\Libraries\ResponseException $e) {
		
		MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
		MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
		MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());
		
	} catch (MangoPay\Libraries\Exception $e) {
		
		MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
	}
}

/*Get mango pay user id*/
function service_finder_get_mp_vendor_id($wp_user_id){

$mp_settings = service_finder_mangopay_settings();
$prod_or_sandbox = $mp_settings['prod_or_sandbox'];

$umeta_key = 'mp_user_id';
if( $prod_or_sandbox == 'sandbox' ){
	$umeta_key .= '_sandbox';
}	

$mp_vendor_id = get_user_meta( $wp_user_id, $umeta_key, true );

return $mp_vendor_id;
}

/*Get mango pay temp path*/
function service_finder_get_mp_temp_path(){

$mp_settings = service_finder_mangopay_settings();
$prod_or_sandbox = $mp_settings['prod_or_sandbox'];

$uploads			= wp_upload_dir();
$uploads_path		= $uploads['basedir'];
$tmp_path			= $uploads_path . '/mp_tmp/' . $prod_or_sandbox;

return $tmp_path;
}

/*Get mango pay vendor bank account id*/
function service_finder_get_mp_account_id($wp_user_id){

$mp_settings = service_finder_mangopay_settings();
$prod_or_sandbox = $mp_settings['prod_or_sandbox'];

$umeta_key = 'mp_account_id';
if( $prod_or_sandbox == 'sandbox' ){
	$umeta_key .= '_sandbox';
}	

$mp_account_id = get_user_meta( $wp_user_id, $umeta_key, true );

return $mp_account_id;
}

//echo '<pre>';print_r(service_finder_get_bank_account_status());echo '</pre>';


/*Get mango pay vendor bank account id*/
function service_finder_get_bank_account_status(){
$mp_settings = service_finder_mangopay_settings();
$prod_or_sandbox = $mp_settings['prod_or_sandbox'];

if( $prod_or_sandbox == 'prod' ){
	$clientid = $mp_settings['prod_client_id'];
	$clientpassphrase = $mp_settings['prod_passphrase'];
}else{
	$clientid = $mp_settings['sand_client_id'];
	$clientpassphrase = $mp_settings['sand_passphrase'];
}

$tmp_path = service_finder_get_mp_temp_path();

$api = new MangoPay\MangoPayApi();
$api->Config->ClientId = $clientid;
$api->Config->ClientPassword = $clientpassphrase;
$api->Config->TemporaryFolder = $tmp_path;

try {

$UserId = '51355364';
$BankAccountId = '51355436';

return $BankAccount = $api->Users->GetBankAccount($UserId, $BankAccountId);

} catch(MangoPay\Libraries\ResponseException $e) {
// handle/log the response exception with code $e->GetCode(), message $e->GetMessage() and error(s) $e->GetErrorDetails()
return $e->GetMessage();

} catch(MangoPay\Libraries\Exception $e) {
// handle/log the exception $e->GetMessage()
return $e->GetMessage();

} 

}

/*Create new product for provider booking*/
function service_finder_get_mp_wallet($mp_user_id){

$mp_settings = service_finder_mangopay_settings();
$prod_or_sandbox = $mp_settings['prod_or_sandbox'];

if( $prod_or_sandbox == 'prod' ){
	$clientid = $mp_settings['prod_client_id'];
	$clientpassphrase = $mp_settings['prod_passphrase'];
}else{
	$clientid = $mp_settings['sand_client_id'];
	$clientpassphrase = $mp_settings['sand_passphrase'];
}

$tmp_path = service_finder_get_mp_temp_path();

$api = new MangoPay\MangoPayApi();
$api->Config->ClientId = $clientid;
$api->Config->ClientPassword = $clientpassphrase;
$api->Config->TemporaryFolder = $tmp_path;

$wallets = $api->Users->GetWallets( $mp_user_id );

foreach( $wallets as $wallet ){
	$mp_vendor_wallet_id = $wallet->Id;
}

return $mp_vendor_wallet_id;
}

function service_finder_get_mp_payout_status( $bookingid, $order_id ){
	global $wpdb,$service_finder_options, $service_finder_Tables;
	
	try {
		
	$PayOutId = get_post_meta($order_id,'mp_payout_id',true);	

	$mp_settings = service_finder_mangopay_settings();
		$prod_or_sandbox = $mp_settings['prod_or_sandbox'];
		
		if( $prod_or_sandbox == 'prod' ){
			$clientid = $mp_settings['prod_client_id'];
			$clientpassphrase = $mp_settings['prod_passphrase'];
		}else{
			$clientid = $mp_settings['sand_client_id'];
			$clientpassphrase = $mp_settings['sand_passphrase'];
		}
		
		$tmp_path = service_finder_get_mp_temp_path();
		
		$api = new MangoPay\MangoPayApi();
		$api->Config->ClientId = $clientid;
		$api->Config->ClientPassword = $clientpassphrase;
		$api->Config->TemporaryFolder = $tmp_path;

	$PayOut = $api->PayOuts->Get($PayOutId);
	
	$oldstatus = get_post_meta($order_id,'mp_payout_status',true);
	
	if($result->Status != $oldstatus){
		if($result->Status == 'SUCCEEDED'){
			
			$payoutstatus = 'paid';
			$notificationmsg = sprintf(esc_html__('Succeed: Payout has been paid to your bank account. Booking Ref id is #%d', 'service-finder'),$bookingid);

		}elseif($result->Status == 'FAILED'){
			
			$payoutstatus = 'failed';
			$responsemsg = $result->ResultMessage;
			$notificationmsg = sprintf(esc_html__('Failed: Payout Failed (%s). Booking Ref id is #%d', 'service-finder'),$responsemsg,$bookingid);
		}else{
			
			$payoutstatus = $result->Status;
			$responsemsg = $result->ResultMessage;
			$notificationmsg = $responsemsg;
		}
		
		$data = array(
					'paid_to_provider' => $payoutstatus,
					);
			
			$where = array(
					'id' => $bookingid,
					);
			
			$booking_id = $wpdb->update($service_finder_Tables->bookings,wp_unslash($data),$where);
			
			update_post_meta($order_id,'mp_payout_due','no');
			
			$data = array(
					'status' => $payoutstatus,
					);
			
			$where = array(
					'order_id' => $order_id,
					);
			
			$commission_id = $wpdb->update($wpdb->prefix.'pv_commission',wp_unslash($data),$where);
			
		if(function_exists('service_finder_add_notices')) {
				$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$bookingid));	
				$noticedata = array(
						'provider_id' => $row->provider_id,
						'target_id' => $row->id, 
						'topic' => esc_html__('Booking Payment', 'service-finder'),
						'notice' => $notificationmsg
						);
				service_finder_add_notices($noticedata);
			
			}	
		
	}
	

	} catch(MangoPay\Libraries\ResponseException $e) {
	// handle/log the response exception with code $e->GetCode(), message $e->GetMessage() and error(s) $e->GetErrorDetails()
	$body = $e->getJsonBody();
	$err  = $body['error'];

	$error = array(
			'status' => 'error',
			'err_message' => sprintf( esc_html__('%s', 'service-finder'), $err['message'] )
			);
	return $service_finder_Errors = json_encode($error);
	} catch(MangoPay\Libraries\Exception $e) {
	// handle/log the exception $e->GetMessage()
	$body = $e->getJsonBody();
	$err  = $body['error'];

	$error = array(
			'status' => 'error',
			'err_message' => sprintf( esc_html__('%s', 'service-finder'), $err['message'] )
			);
	return $service_finder_Errors = json_encode($error);
	} 
	
}

/* Mango pay Payout */
function service_finder_payout(  $wp_user_id, $mp_account_id, $order_id, $currency, $amount, $fees ){
		
		$mp_vendor_id	= service_finder_get_mp_vendor_id( $wp_user_id );
		
		$mp_vendor_wallet_id 		= service_finder_get_mp_wallet( $mp_vendor_id );
		
		if( !$mp_vendor_wallet_id ){
			return false;
		}	
		
		$mp_settings = service_finder_mangopay_settings();
		$prod_or_sandbox = $mp_settings['prod_or_sandbox'];
		
		if( $prod_or_sandbox == 'prod' ){
			$clientid = $mp_settings['prod_client_id'];
			$clientpassphrase = $mp_settings['prod_passphrase'];
		}else{
			$clientid = $mp_settings['sand_client_id'];
			$clientpassphrase = $mp_settings['sand_passphrase'];
		}
		
		$tmp_path = service_finder_get_mp_temp_path();
		
		$api = new MangoPay\MangoPayApi();
		$api->Config->ClientId = $clientid;
		$api->Config->ClientPassword = $clientpassphrase;
		$api->Config->TemporaryFolder = $tmp_path;
		
		$PayOut = new \MangoPay\PayOut();
		$PayOut->AuthorId								= $mp_vendor_id;
		$PayOut->DebitedWalletID						= $mp_vendor_wallet_id;
		$PayOut->DebitedFunds							= new \MangoPay\Money();
		$PayOut->DebitedFunds->Currency					= $currency;
		$PayOut->DebitedFunds->Amount					= round($amount * 100);
		$PayOut->Fees									= new \MangoPay\Money();
		$PayOut->Fees->Currency							= $currency;
		$PayOut->Fees->Amount							= round($fees * 100);
		$PayOut->PaymentType							= "BANK_WIRE";
		$PayOut->MeanOfPaymentDetails					= new \MangoPay\PayOutPaymentDetailsBankWire();
		$PayOut->MeanOfPaymentDetails->BankAccountId	= $mp_account_id;
		$PayOut->MeanOfPaymentDetails->BankWireRef				= 'ID ' . $order_id;
		$PayOut->Tag									= 'Commission for WC Order #' . $order_id . ' - ValidatedBy:' . wp_get_current_user()->user_login;
		
		$result = $api->PayOuts->Create($PayOut);
		
		
		return $result;
	}
	
/* get team members */
function service_finder_get_team_members($user_id){
global $wpdb, $service_finder_Tables;

	$sql = $wpdb->prepare("SELECT * FROM ".$service_finder_Tables->team_members. " WHERE `admin_wp_id` = %d AND `is_admin` = 'no'",$user_id);

	$results = $wpdb->get_results($sql);
	
	return $results;
}	

/* Get total number of days */
function service_finder_get_total_offdays($type,$number) {
	$days = 0;
	switch($type){
		case 'days':
			$days = intval($number);
			break; 
		case 'weeks':
			$days = intval($number) * 7;
			break; 
		case 'months':
			$days = intval($number) * 30;
			break; 	
		default:
			break;		
	}
	
	return $days;
}

/*Get off Days*/
add_action('wp_ajax_get_bookingdays', 'service_finder_get_bookingdays');
add_action('wp_ajax_nopriv_get_bookingdays', 'service_finder_get_bookingdays');
function service_finder_get_bookingdays(){
	$unavl_type = (!empty($_POST['unavl_type'])) ? esc_html($_POST['unavl_type']) : '';
	$numberofdays = (!empty($_POST['numberofdays'])) ? esc_html($_POST['numberofdays']) : '';
	$startdate = (!empty($_POST['startdate'])) ? esc_html($_POST['startdate']) : '';
	$blockdatearr = (!empty($_POST['datearr'])) ? $_POST['datearr'] : '';
	$daynumarr = (!empty($_POST['daynumarr'])) ? $_POST['daynumarr'] : '';
	$bookedarr = (!empty($_POST['bookedarr'])) ? $_POST['bookedarr'] : '';
	
	if(!empty($daynumarr)){
	
		foreach($daynumarr as $daynum){
			$daynumarrmatch[] = intval($daynum);
		}
	}
	
	$bookingdates = array();
		
	if($unavl_type != "" && $numberofdays != ""){
	$totaldays = service_finder_get_total_offdays($unavl_type,$numberofdays);
	$flag = 0;
	for($i = 0; $i < $totaldays; $i++){
		$datenum = date('w', strtotime(date('Y-m-d',strtotime($startdate. ' + '.$i.' days'))));
		$datenum = ($datenum == 0) ? 6 : intval($datenum) - 1;
		$daynumbers[] = intval($datenum);
		
		if(!in_array($datenum,$daynumarrmatch)){
			$flag = 1;
		}
		
		$bookingdates[] = date('Y-m-d',strtotime($startdate. ' + '.$i.' days'));
		$bookingdatesformatch[] = date('Y-n-d',strtotime($startdate. ' + '.$i.' days'));
	}
	
	}
	
	$result = array_intersect($blockdatearr,$bookingdatesformatch);
	$result2 = array_intersect($bookedarr,$bookingdatesformatch);
	
	if(empty($result) && empty($result2) && $flag == 0){
		$success = array(
			'status' => 'success',
			'bookingdates' => $bookingdates
		);
		echo json_encode($success);
	}else{
		$error = array(
			'status' => 'error',
			'err_message' => esc_html__('Please select continue available dates.', 'service-finder'),
			);
		echo json_encode($error);
	}

exit;
}

/*Get off Days*/
add_action('wp_ajax_get_editbookingdays', 'service_finder_get_editbookingdays');
add_action('wp_ajax_nopriv_get_editbookingdays', 'service_finder_get_editbookingdays');
function service_finder_get_editbookingdays(){
	$totalnumber = (!empty($_POST['totalnumber'])) ? esc_html($_POST['totalnumber']) : '';
	$startdate = (!empty($_POST['startdate'])) ? esc_html($_POST['startdate']) : '';
	$blockdatearr = (!empty($_POST['datearr'])) ? $_POST['datearr'] : '';
	
	$bookingdates = array();
		
	if($totalnumber > 0){

	for($i = 0; $i < $totalnumber; $i++){
		$bookingdates[] = date('Y-m-d',strtotime($startdate. ' + '.$i.' days'));
		$bookingdatesformatch[] = date('Y-n-d',strtotime($startdate. ' + '.$i.' days'));
	}
	
	}
	
	$result = array_intersect($blockdatearr,$bookingdatesformatch);
	
	if(empty($result)){
		$success = array(
			'status' => 'success',
			'bookingdates' => $bookingdates
		);
		echo json_encode($success);
	}else{
		$error = array(
			'status' => 'error',
			'err_message' => esc_html__('Please select continue available dates.', 'service-finder'),
			);
		echo json_encode($error);
	}

exit;
}

/*Get service type */
function service_finder_get_service_type($sid){
global $wpdb, $service_finder_Tables;

	$row = $wpdb->get_row($wpdb->prepare('SELECT cost_type FROM '.$service_finder_Tables->services.' where `id` = %d',$sid));
	
	return $row->cost_type;
}

/*Get service name */
function service_finder_get_service_name($sid){
global $wpdb, $service_finder_Tables;

	$row = $wpdb->get_row($wpdb->prepare('SELECT service_name FROM '.$service_finder_Tables->services.' where `id` = %d',$sid));
	
	return $row->service_name;
}

/* Month Dropdown */
function service_finder_month_dropdown($key){

	$html = '<label>'.esc_html__('Select Month', 'service-finder').'</label>';
	$html .= '<select id="'.$key.'_month" name="'.$key.'_month" class="form-control sf-form-control sf-select-box" title="'.esc_html__('Select Month', 'service-finder').'">
    <option value="1">'.esc_html__('January', 'service-finder').'</option>
    <option value="2">'.esc_html__('February', 'service-finder').'</option>
    <option value="3">'.esc_html__('March', 'service-finder').'</option>
    <option value="4">'.esc_html__('April', 'service-finder').'</option>
    <option value="5">'.esc_html__('May', 'service-finder').'</option>
    <option value="6">'.esc_html__('June', 'service-finder').'</option>
    <option value="7">'.esc_html__('July', 'service-finder').'</option>
    <option value="8">'.esc_html__('August', 'service-finder').'</option>
    <option value="9">'.esc_html__('September', 'service-finder').'</option>
    <option value="10">'.esc_html__('October', 'service-finder').'</option>
    <option value="11">'.esc_html__('November', 'service-finder').'</option>
    <option value="12">'.esc_html__('December', 'service-finder').'</option>
    </select>';	
	return $html;
}

/* Month Dropdown */
function service_finder_year_dropdown($key){

	$html = '<label>'.esc_html__('Select Year', 'service-finder').'</label>';
	$html .= '<select id="'.$key.'_year" name="'.$key.'_year" class="form-control sf-form-control sf-select-box"  title="'.esc_html__('Select Year', 'service-finder').'">';
			$year = date('Y');
			for($i = $year;$i<=$year+50;$i++){
				$html .= '<option value="'.esc_attr($i).'">'.$i.'</option>';
			}
    $html .= '</select>';
	return $html;
}

/* Local Payment Gatways */
function service_finder_site_payments($where,$args){
global $wpdb, $service_finder_Tables, $service_finder_options, $paymentsystem, $current_user;

$payment_methods = (!empty($service_finder_options['payment-methods'])) ? $service_finder_options['payment-methods'] : '';
$falg = 0;
$html = '';

if($paymentsystem == 'woocommerce'){
    if(service_finder_getUserRole($current_user->ID) == 'administrator'){
    $html .= '<div class="col-lg-12 clear" id="'.$where.'skipoption">
    <div class="form-group form-inline">';
    $html .= '<div class="checkbox sf-radio-checkbox">
                    <input id="'.$where.'_skipforadmin" type="checkbox" name="'.$where.'_skipforadmin" value="yes">
                    <label for="'.$where.'_skipforadmin">'.esc_html__('Skip Payment','service-finder').'</label>
                    <input id="'.$where.'_skippayment" type="hidden" name="payment_mode" value="skippayment">
                </div>';
    $html .= '</div></div>';						
    }
    $html .= '<div class="col-md-6 clear">';
	if(!empty($args)){
		foreach($args as $key => $value){
			$html .= '<input type="hidden" name="'.$key.'" value="'.$value.'">';	
		}
	}
    $html .= '<input type="submit" class="btn btn-primary btn-block" name="'.$where.'-payment" value="'.esc_html__('Add to Wallet', 'service-finder').'" />';
    $html .= '</div>';
    }else{
    if(!empty($payment_methods)){
    $html .= '<div class="panel-body clear">
      <div class="row"><div class="form-group form-inline">';
    foreach($payment_methods as $key => $value){
    if($key != 'paypal-adaptive' && $key != 'cod' && $key != 'payulatam'){
    if($value){
    $falg = 1;
    }
     if($key == 'stripe'){
	$label = '<img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/mastercard.jpg" title="'.esc_html__('Stripe','service-finder').'" alt="'.esc_html__('mastercard','service-finder').'"><img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/payment.jpg" title="'.esc_html__('Stripe','service-finder').'" alt="'.esc_html__('american express','service-finder').'"><img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/discover.jpg" title="'.esc_html__('Stripe','service-finder').'" alt="'.esc_html__('discover','service-finder').'"><img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/visa.jpg" title="'.esc_html__('Stripe','service-finder').'" alt="'.esc_html__('visa','service-finder').'">';
	}elseif($key == 'twocheckout'){
	 $label = '<img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/twocheckout.jpg" title="'.esc_html__('2Checkout','service-finder').'" alt="'.esc_html__('2Checkout','service-finder').'">';
	}elseif($key == 'wired'){
	$label = '<img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/wired.jpg" title="'.esc_html__('Wire Transfer','service-finder').'" alt="'.esc_html__('Wired','service-finder').'">';
	}elseif($key == 'payumoney'){
	 $label = '<img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/payumoney.jpg" title="'.esc_html__('PayU Money','service-finder').'" alt="'.esc_html__('PayU Money','service-finder').'">';
	}else{
	$label = '<img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/paypal.jpg" title="'.esc_html__('Paypal','service-finder').'" alt="'.esc_html__('Paypal','service-finder').'">';
	}
    if($value == 1){
        $html .= '<div class="radio sf-radio-checkbox">
                    <input id="'.$where.'_'.$key.'" type="radio" name="payment_mode" value="'.$key.'">
                    <label for="'.$where.'_'.esc_attr($key).'">'.$label.'</label>
                </div>';	
    }
    }
    }
    
    if(service_finder_getUserRole($current_user->ID) == 'administrator'){
	$falg = 1;
    $html .= '<div class="radio sf-radio-checkbox">
                    <input id="'.$where.'_skippayment" type="radio" name="payment_mode" value="skippayment">
                    <label for="'.$where.'_skippayment">'.esc_html__('Skip Payment','service-finder').'</label>
                </div>';
    }
    $html .= '</div></div>
      </div>';
    ?>
    <?php if($falg == 1){               
    $html .= '<div id="'.$where.'cardinfo" class="default-hidden">
    <div class="col-md-8">
    <div class="form-group">
    <label>'
    .esc_html__('Card Number', 'service-finder').
    '</label>
    <div class="input-group"> <i class="input-group-addon fa fa-credit-card"></i>
    <input type="text" id="'.$where.'_number" name="'.$where.'_number" class="form-control">
    </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label>'
    .esc_html__('CVC', 'service-finder').
    '</label>
    <div class="input-group"> <i class="input-group-addon fa fa-ellipsis-h"></i>
    <input type="text" id="'.$where.'_cvc" name="'.$where.'_cvc" class="form-control">
    </div>
    </div>
    </div>
    <div class="col-md-6">
    <div class="form-group">'
    .service_finder_month_dropdown('wallet').
    '</div>
    </div>
    <div class="col-md-6">
    <div class="form-group">'
	.service_finder_year_dropdown('wallet').
    '</div>
    </div>
    </div>
    <div id="twocheckout_'.$where.'cardinfo" class="default-hidden">
    <div class="col-md-8">
    <div class="form-group">
    <label>
    '.esc_html__('Card Number', 'service-finder').'
    </label>
    <div class="input-group"> <i class="input-group-addon fa fa-credit-card"></i>
    <input type="text" id="twocheckout_'.$where.'_number" name="twocheckout_'.$where.'_number" class="form-control">
    </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label>
    '.esc_html__('CVC', 'service-finder').'
    </label>
    <div class="input-group"> <i class="input-group-addon fa fa-ellipsis-h"></i>
    <input type="text" id="twocheckout_'.$where.'_cvc" name="twocheckout_'.$where.'_cvc" class="form-control">
    </div>
    </div>
    </div>
    <div class="col-md-6">
    <div class="form-group">
    '.service_finder_month_dropdown('twocheckout_wallet').'
    </div>
    </div>
    <div class="col-md-6">
    <div class="form-group">
	'.service_finder_year_dropdown('twocheckout_wallet').'
    </div>
    </div>
    </div>
    <div id="'.$where.'wiredinfo" class="default-hidden">
    <div class="col-md-12 margin-b-20">';
    $description = (!empty($service_finder_options['wire-transfer-description'])) ? $service_finder_options['wire-transfer-description'] : '';
    $html .= $description;
    $html .= '</div>
    </div>
    <div class="col-md-6">';
	
	if(!empty($args)){
		foreach($args as $key => $value){
			$html .= '<input type="hidden" name="'.$key.'" value="'.$value.'">';	
		}
	}
	
    $html .= '<input type="submit" class="btn btn-primary btn-block" name="'.$where.'-payment" value="'.esc_html__('Add to Wallet', 'service-finder').'" />
    </div>';
	
    }else{
    $html .= '<div class="alert alert-warning">'.esc_html__('There is no payment gateway available.', 'service-finder').' </div>';
    }
    }
    }
    return $html;
}

function service_finder_cashback_amount($transaction_type){
global $service_finder_options;

$applytoall = (!empty($service_finder_options['wallet-cashback-all-transaction'])) ? $service_finder_options['wallet-cashback-all-transaction'] : false;

if($applytoall == true){
$amount = (!empty($service_finder_options['cashback-amount'])) ? $service_finder_options['cashback-amount'] : 0;
$description = (!empty($service_finder_options['cashback-description'])) ? $service_finder_options['cashback-description'] : '';

if($description == ''){
switch($transaction_type){
	case 'upgrade':
			$description = esc_html__('Cashback after upgrade account', 'service-finder');
			break;
	case 'featured':
			$description = esc_html__('Cashback after featured account', 'service-finder');
			break;		
	case 'job-apply-limit':
			$description = esc_html__('Cashback after purchase job connect', 'service-finder');
			break;
	case 'booking':
			$description = esc_html__('Cashback after booking', 'service-finder');
			break;
	case 'invoice':
			$description = esc_html__('Cashback after invoice pay', 'service-finder');
			break;		
	case 'job-post-limit':
			$description = esc_html__('Cashback after purchase job post limits', 'service-finder');
			break;				
}
}

}else{

switch($transaction_type){
	case 'upgrade':
			$amount = (!empty($service_finder_options['upgrade-cashback-amount'])) ? $service_finder_options['upgrade-cashback-amount'] : 0;
			$description = (!empty($service_finder_options['upgrade-cashback-description'])) ? $service_finder_options['upgrade-cashback-description'] : esc_html__('Cashback after upgrade account', 'service-finder');
			break;
	case 'featured':
			$amount = (!empty($service_finder_options['featured-cashback-amount'])) ? $service_finder_options['featured-cashback-amount'] : 0;
			$description = (!empty($service_finder_options['featured-cashback-description'])) ? $service_finder_options['featured-cashback-description'] : esc_html__('Cashback after featured account', 'service-finder');
			break;		
	case 'job-apply-limit':
			$amount = (!empty($service_finder_options['job-apply-limit-cashback-amount'])) ? $service_finder_options['job-apply-limit-cashback-amount'] : 0;
			$description = (!empty($service_finder_options['job-apply-limit-cashback-description'])) ? $service_finder_options['job-apply-limit-cashback-description'] : esc_html__('Cashback after purchase job connect', 'service-finder');
			break;
	case 'booking':
			$amount = (!empty($service_finder_options['booking-cashback-amount'])) ? $service_finder_options['booking-cashback-amount'] : 0;
			$description = (!empty($service_finder_options['booking-cashback-description'])) ? $service_finder_options['booking-cashback-description'] : esc_html__('Cashback after booking', 'service-finder');
			break;
	case 'invoice':
			$amount = (!empty($service_finder_options['invoice-cashback-amount'])) ? $service_finder_options['invoice-cashback-amount'] : 0;
			$description = (!empty($service_finder_options['invoice-cashback-description'])) ? $service_finder_options['invoice-cashback-description'] : esc_html__('Cashback after invoice pay', 'service-finder');
			break;		
	case 'job-post-limit':
			$amount = (!empty($service_finder_options['job-post-limit-cashback-amount'])) ? $service_finder_options['job-post-limit-cashback-amount'] : 0;
			$description = (!empty($service_finder_options['job-post-limit-cashback-description'])) ? $service_finder_options['job-post-limit-cashback-description'] : esc_html__('Cashback after purchase job post limits', 'service-finder');
			break;				
}

}
$return = array(
	'amount' => $amount,
	'description' => $description,
);

return $return;
}

/*Add wallet payment option*/
function service_finder_add_wallet_option($varname,$key){
global $service_finder_options, $current_user;

$walletsystem = (!empty($service_finder_options['wallet-system'])) ? $service_finder_options['wallet-system'] : 0;

$html = '';
if($walletsystem == true){
if(service_finder_getUserRole($current_user->ID) == 'Provider' || service_finder_getUserRole($current_user->ID) == 'Customer'){
$html .= '<div class="radio sf-radio-checkbox sf-payments-outer">
                  <input type="radio" value="wallet" name="'.$varname.'" id="'.$key.'_wallet" >
                  <label for="'.$key.'_wallet">'.esc_html__('Wallet','service-finder').'</label>
				  <img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/wallet.jpg" title="'.esc_html__('Wallet','service-finder').'" alt="'.esc_html__('Wallet','service-finder').'">
                </div>';
}
}				
return $html;
}

/*Add wallet payment option*/
function service_finder_add_skip_option($varname,$key){
global $service_finder_options, $current_user;

$html = '';
if(is_user_logged_in()){
if(service_finder_getUserRole($current_user->ID) == 'Provider' || service_finder_getUserRole($current_user->ID) == 'administrator'){
$html .= '<div class="radio sf-radio-checkbox">
                  <input type="radio" value="skippayment" name="'.$varname.'" id="'.$key.'_skippayment" >
                  <label for="'.$key.'_skippayment">'.esc_html__('Skip Payment','service-finder').'</label>
                </div>';
}				
}
return $html;
}

/*Add woo-commerce payment option*/
function service_finder_add_woo_commerce_option($varname,$key){
global $service_finder_options, $current_user;

$walletsystem = (!empty($service_finder_options['wallet-system'])) ? $service_finder_options['wallet-system'] : 0;

$html = '';
if($walletsystem == true || service_finder_getUserRole($current_user->ID) == 'administrator'){
$html .= '<div class="radio sf-radio-checkbox sf-payments-outer">
                  <input type="radio" value="woopayment" name="'.$varname.'" id="'.$key.'_woopayment" >
                  <label for="'.$key.'_woopayment">'.esc_html__('Checkout','service-finder').'</label>
				  <img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/woopayment.jpg" alt="'.esc_html__('Checkout','service-finder').'">
                </div>';
}				
return $html;
}

/*Dislay wallet amount*/
function service_finder_check_wallet_system(){
global $service_finder_options;

$walletsystem = (!empty($service_finder_options['wallet-system'])) ? $service_finder_options['wallet-system'] : false;

return $walletsystem;
}

/*Dislay wallet amount*/
function service_finder_display_wallet_amount($user_id){
global $service_finder_options, $current_user;

$walletsystem = (!empty($service_finder_options['wallet-system'])) ? $service_finder_options['wallet-system'] : false;

$html = '';
if($walletsystem == true){
if(service_finder_getUserRole($current_user->ID) == 'Provider' || service_finder_getUserRole($current_user->ID) == 'Customer'){
$walletamount = service_finder_get_wallet_amount($user_id);

$html .= '<ul class="list-unstyled clear">
                        <li>
                            <h5>'.esc_html__('Wallet Balance', 'service-finder').'</h5>
                            <strong>
                            '.service_finder_money_format($walletamount).'</strong>
                        </li>
                    </ul>';
}				
}
return $html;
}

/*Check offer system*/
function service_finder_check_offer_system(){
global $service_finder_options;

$offerssystem = (!empty($service_finder_options['offers-system'])) ? $service_finder_options['offers-system'] : false;

return $offerssystem;
}

/*Get My account url*/
function service_finder_get_my_account_url($userid){
global $service_finder_options, $current_user;

if(service_finder_getUserRole($current_user->ID) == 'administrator'){
$url = add_query_arg( array('manageaccountby' => 'admin','manageproviderid' => esc_attr($userid)), service_finder_get_url_by_shortcode('[service_finder_my_account') );
}else{
$url = service_finder_get_url_by_shortcode('[service_finder_my_account]');
}

return $url;
}

/*Get notification link*/
function service_finder_get_notification_link($topic,$target_id = ''){
global $service_finder_options, $current_user;

$url = '';
switch($topic){
	case 'Booking': 	
		$url = service_finder_get_my_account_url($current_user->ID);
		$url = add_query_arg( array('tabname' => 'bookings','bookingid' => esc_attr($target_id)), $url );
		break;
	case 'Booking Edited': 	
		$url = service_finder_get_my_account_url($current_user->ID);
		$url = add_query_arg( array('tabname' => 'bookings','bookingid' => esc_attr($target_id)), $url );
		break;
	case 'Service Complete':
	case 'Booking Complete': 	
		$url = service_finder_get_my_account_url($current_user->ID);
		$url = add_query_arg( array('tabname' => 'bookings','bookingid' => esc_attr($target_id)), $url );
		break;	
	case 'Job Apply Connect': 	
		$url = service_finder_get_my_account_url($current_user->ID);
		$url = add_query_arg( array('tabname' => 'job-limits'), $url );
		break;
	case 'Feature Request Approved': 	
		$url = service_finder_get_my_account_url($current_user->ID);
		$url = add_query_arg( array('tabname' => 'upgrade#feature-req-bx'), $url );
		break;
	case 'Job Post Connect': 	
		$url = service_finder_get_my_account_url($current_user->ID);
		$url = add_query_arg( array('action' => 'job-post-plans'), $url );
		break;
	case 'Generate Invoice': 	
		$url = service_finder_get_my_account_url($current_user->ID);
		$url = add_query_arg( array('action' => 'invoice','invoiceid' => esc_attr($target_id)), $url );
		break;
	case 'Invoice Paid': 	
		$url = service_finder_get_my_account_url($current_user->ID);
		$url = add_query_arg( array('tabname' => 'invoice','invoiceid' => esc_attr($target_id)), $url );
		break;
	case 'Get Quotation': 	
		$url = service_finder_get_my_account_url($current_user->ID);
		$url = add_query_arg( array('tabname' => 'quotation','quoteid' => esc_attr($target_id)), $url );
		break;				
	default: 	
		$url = 'javascript:;';
		break;
					
}

return $url;
}

/*total income from bookings*/
function service_finder_get_booking_earnings($userid){
global $wpdb,$service_finder_Tables;
$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE provider_id = %d AND (status = "Pending" OR status = "Completed") AND paid_to_provider = "paid"',$userid));

$totalincome = 0;
if(!empty($results)){
foreach($results as $row){
$total = $row->total;
$adminfee = $row->adminfee;
$discount = $row->discount;

$income = floatval($total) - (floatval($adminfee) + floatval($discount));

$totalincome = floatval($totalincome) + floatval($income);

}
}

return $totalincome;

}

/*total income from invoice*/
function service_finder_get_invoice_earnings($userid){
global $wpdb,$service_finder_Tables;
$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->invoice.' WHERE provider_id = %d AND status = "paid" AND paid_to_provider = "paid"',$userid));

$totalincome = 0;
if(!empty($results)){
foreach($results as $row){
$total = $row->total;

$totalincome = floatval($totalincome) + floatval($total);

}
}

return $totalincome;

}

/*total total earnings*/
function service_finder_get_total_earnings($userid){

$totalincome = 0;
$bookingincome = service_finder_get_booking_earnings($userid);
$invoiceincome = service_finder_get_invoice_earnings($userid);

$totalincome = floatval($bookingincome) + floatval($invoiceincome);

return $totalincome;

}

/*get booking dues*/
function service_finder_get_booking_dues($userid){
global $wpdb,$service_finder_Tables;
$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE provider_id = %d AND (status = "Need-Approval" OR paid_to_provider = "pending")',$userid));

$totaldues = 0;
if(!empty($results)){
foreach($results as $row){
$total = $row->total;
$adminfee = $row->adminfee;
$discount = $row->discount;

$dues = floatval($total) - (floatval($adminfee) + floatval($discount));

$totaldues = floatval($totaldues) + floatval($dues);

}
}

return $totaldues;

}

/*get invoice dues*/
function service_finder_get_invoice_dues($userid){
global $wpdb,$service_finder_Tables;
$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->invoice.' WHERE provider_id = %d AND (status = "pending" OR paid_to_provider = "pending")',$userid));

$totaldues = 0;
if(!empty($results)){
foreach($results as $row){
$total = $row->total;

$totaldues = floatval($totaldues) + floatval($total);

}
}

return $totaldues;

}

/*total total earnings*/
function service_finder_get_total_dues($userid){

$totaldues = 0;
$bookingdues = service_finder_get_booking_dues($userid);
$invoicedues = service_finder_get_invoice_dues($userid);

$totaldues = floatval($bookingdues) + floatval($invoicedues);

return $totaldues;

}

function service_finder_day_translate($day){
	switch($day){
	case 'monday':
		$dayname = esc_html__('Monday','service-finder');
		break;
	case 'tuesday':
		$dayname = esc_html__('Tuesday','service-finder');
		break;
	case 'wednesday':
		$dayname = esc_html__('Wednesday','service-finder');
		break;
	case 'thursday':
		$dayname = esc_html__('Thursday','service-finder');
		break;
	case 'friday':
		$dayname = esc_html__('Friday','service-finder');
		break;
	case 'saturday':
		$dayname = esc_html__('Saturday','service-finder');
		break;
	case 'sunday':
		$dayname = esc_html__('Sunday','service-finder');
		break;						
	}
	
	return $dayname;
}

/*Get total coupon code used in booking*/
function service_finder_total_service_coupon($couponcode,$userid,$serviceid){
global $wpdb,$service_finder_Tables;

$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `provider_id` = %d',$userid));	
$cnt = 1;
if(!empty($results)){
	foreach($results as $row){
		$services = $row->services;
		$services = explode('%%',$services);
		if($row->multi_date == 'yes'){
			$service = explode('-',$services);
			if($service[0] == $serviceid && $service[3] == $couponcode){
				$cnt++;
			}
		}else{
			$service = explode('||',$services);
			if($services[0] == $serviceid && $services[6] == $couponcode){
				$cnt++;
			}	
		}
	}
}

return $cnt;
}

/*Get total coupon code used in booking*/
function service_finder_total_booking_coupon($couponcode,$userid){
global $wpdb,$service_finder_Tables;

$row = $wpdb->get_row($wpdb->prepare('SELECT count(id) as cnt FROM '.$service_finder_Tables->bookings.' WHERE `provider_id` = %d AND `coupon_code` = %s',$userid,$couponcode));	

return $row->cnt;
}

/*Get total coupon code used in booking*/
function service_finder_check_is_couponcode_used($couponcode,$userid){
global $wpdb,$service_finder_Tables,$current_user;

$row = $wpdb->get_row($wpdb->prepare('SELECT count(`bookings`.`id`) as bookingcount FROM '.$service_finder_Tables->bookings.' as bookings INNER JOIN '.$service_finder_Tables->customers.' as customers on bookings.booking_customer_id = customers.id WHERE `bookings`.`provider_id` = %d AND `bookings`.`coupon_code` = %s AND `customers`.`wp_user_id` = %d',$userid,$couponcode,$current_user->ID));

return $row->bookingcount;
}

/*Get total coupon code used in booking*/
function service_finder_check_is_service_couponcode_used($couponcode,$userid,$serviceid){
global $wpdb,$service_finder_Tables,$current_user;

$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `provider_id` = %d AND `customer_id` = %s',$userid,$current_user->ID));	
$cnt = 0;
if(!empty($results)){
	foreach($results as $row){
		$services = $row->services;
		$services = explode('%%',$services);
		if($row->multi_date == 'yes'){
			$service = explode('-',$services);
			if($service[0] == $serviceid && $service[3] == $couponcode){
				$cnt++;
			}
		}else{
			$service = explode('||',$services);
			if($services[0] == $serviceid && $services[6] == $couponcode){
				$cnt++;
			}	
		}
	}
}

return $cnt;
}


/*Get user image url*/
function service_finder_get_user_profile_image($avatar_id){
$src = '';
if(!empty($avatar_id) && $avatar_id > 0){
$src  = wp_get_attachment_image_src( $avatar_id, 'thumbnail' );
$src  = $src[0];

$src = (!empty($src)) ? $src : '';
}

return $src;
}

/*Get providers customer list*/
function service_finder_get_providers_customer($user_id){
global $wpdb,$service_finder_Tables;

$results = $wpdb->get_results($wpdb->prepare('SELECT `customers`.`wp_user_id` as customerid, `customers`.`name` as customer_name FROM '.$service_finder_Tables->bookings.' as bookings INNER JOIN '.$service_finder_Tables->customers.' as customers on bookings.booking_customer_id = customers.id WHERE `bookings`.`provider_id` = %d GROUP BY `customers`.`email`',$user_id));

return $results;
}

/*Get stripe connection*/
function service_finder_stripe_connection(){
global $wpdb, $service_finder_Errors,$service_finder_options;

require_once(SERVICE_FINDER_PAYMENT_GATEWAY_DIR.'/stripe/init.php');

if( isset($service_finder_options['stripe-type']) && $service_finder_options['stripe-type'] == 'test' ){
	$secret_key = (!empty($service_finder_options['stripe-test-secret-key'])) ? $service_finder_options['stripe-test-secret-key'] : '';
	$public_key = (!empty($service_finder_options['stripe-test-public-key'])) ? $service_finder_options['stripe-test-public-key'] : '';
}else{
	$secret_key = (!empty($service_finder_options['stripe-live-secret-key'])) ? $service_finder_options['stripe-live-secret-key'] : '';
	$public_key = (!empty($service_finder_options['stripe-live-public-key'])) ? $service_finder_options['stripe-live-public-key'] : '';
}

return array(
	'secret_key' => $secret_key,
	'public_key' => $public_key
);
}

/*Get dayname by day number*/
function service_finder_get_dayname_by_daynumber($number){
	$days = array(
        0 => esc_html__('Monday','service-finder'),
        1 => esc_html__('Tuesday','service-finder'),
        2 => esc_html__('Wednesday','service-finder'),
        3 => esc_html__('Thursday','service-finder'),
        4 => esc_html__('Friday','service-finder'),
        5 => esc_html__('Saturday','service-finder'),
		6 => esc_html__('Sunday','service-finder')
    );
	return isset( $days[ $number ] ) ? $days[ $number ] : '';
}

/*Get dayname by day number*/
function service_finder_get_slot_interval($user_id){
	$settings = service_finder_getProviderSettings($user_id);
	$slot_interval = (!empty($settings['slot_interval'])) ? $settings['slot_interval'] : '';
	
	if($slot_interval == '15'){
	$slot_interval = 15;
	}else{
	$slot_interval = 30;
	}
	return $slot_interval;
}

/*Get dayname by day number*/
function service_finder_get_weekdays(){
	
	$days = array('monday','tuesday','wednesday','thursday','friday','saturday','sunday');
	
	return $days;
}

/*Get future booking availabilities*/
function service_finder_get_future_bookings_availabilities(){
	
	$availabilities = array(
			1 => esc_html__('1 Day', 'service-finder'),
			2 => esc_html__('2 Days', 'service-finder'),
			3 => esc_html__('3 Days', 'service-finder'),
			4 => esc_html__('4 Days', 'service-finder'),
			5 => esc_html__('5 Days', 'service-finder'),
			6 => esc_html__('6 Days', 'service-finder'),
			7 => esc_html__('1 Week', 'service-finder'),
			14 => esc_html__('2 Weeks', 'service-finder'),
			21 => esc_html__('3 Weeks', 'service-finder'),
			28 => esc_html__('4 Weeks', 'service-finder'),
			30 => esc_html__('1 Month', 'service-finder'),
			60 => esc_html__('2 Months', 'service-finder'),
			90 => esc_html__('3 Months', 'service-finder'),
			120 => esc_html__('4 Months', 'service-finder'),
			150 => esc_html__('5 Months', 'service-finder'),
			180 => esc_html__('6 Months', 'service-finder'),
			210 => esc_html__('7 Months', 'service-finder'),
			240 => esc_html__('8 Months', 'service-finder'),
			270 => esc_html__('9 Months', 'service-finder'),
			300 => esc_html__('10 Months', 'service-finder'),
			330 => esc_html__('11 Months', 'service-finder'),
			365 => esc_html__('1 Year', 'service-finder'),
	);
	
	return $availabilities;
}

/*Get date range for dates array*/
function service_finder_date_range($startdate, $enddate, $format = "Y-m-d"){

    $begin = new DateTime($startdate);
    $end = new DateTime($enddate);

    $interval = new DateInterval('P1D');
    $dateRange = new DatePeriod($begin, $interval, $end);

    $range = [];
    foreach ($dateRange as $date) {
        $range[] = $date->format($format);
    }

    return $range;
}

/*Get disbaled dates for zabuto calendar*/
function service_finder_get_disabled_dates($userid){

    $settings = service_finder_getProviderSettings($userid);

	$future_bookings_availability = (!empty($settings['future_bookings_availability'])) ? $settings['future_bookings_availability'] : '';
	
	$number_of_months = ($future_bookings_availability/30);
	
	if($number_of_months < 1){
	$lastdate = date('Y-m-d', strtotime("+".$future_bookings_availability." days", time()));
	}else{
	$lastdate = date('Y-m-d', strtotime("+".$number_of_months." months", time()));
	}
	
	$lastdate = date('Y-m-d', strtotime("+1 day", strtotime($lastdate)));
	$monthlastdate = date("Y-m-t", strtotime($lastdate));
	
	$disabledates = service_finder_date_range($lastdate, $monthlastdate, "Y-m-j");

    return $disabledates;
}

/*Get service padding time*/
function service_finder_get_service_paddind_time($serviceid){
global $wpdb, $service_finder_Tables;

	$service = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->services.' WHERE `id` = %d',$serviceid));

	if(!empty($service)){
	$paddingtime = array(
		'before_padding_time' => $service->before_padding_time,
		'after_padding_time'  => $service->after_padding_time,
	); 
	
	return $paddingtime;
	}

}

/*Sort by booking feature*/
function service_finder_sort_by_booking_feature($providers){
global $wpdb, $service_finder_Tables;

$available = array();
$unavailable = array();

if(!empty($providers)){
	foreach($providers as $provider){
		$provider_id = $provider->wp_user_id;
		
		$userCap = service_finder_get_capability($provider_id);
		
		if(!empty($userCap)){
		if(in_array('bookings',$userCap)){
			$settings = service_finder_getProviderSettings($provider_id);
		
			if($settings['booking_process'] == 'on'){
				$available[] = $provider_id;
			}else{
				$unavailable[] = $provider_id;	
			}
			
		}else{
			$unavailable[] = $provider_id;
		}
		}else{
			$unavailable[] = $provider_id;
		}
	}
}

$return = array(
		'available' => $available,
		'unavailable' => $unavailable
	);

return $return;

}

/*Sort by avaialbility*/
function service_finder_sort_by_availability($providers,$date,$starttime,$endtime,$minuts,$srhperiod){
global $wpdb, $service_finder_Tables;

$available = array();
$unavailable = array();

if(!empty($providers)){
	foreach($providers as $provider){
		$provider_id = $provider->wp_user_id;
		
		$userCap = service_finder_get_capability($provider_id);
		
		if(!empty($userCap)){
		if(in_array('bookings',$userCap)){
			$settings = service_finder_getProviderSettings($provider_id);
		
			if($settings['booking_process'] == 'on'){
				
				if(service_finder_availability_method($provider_id) == 'timeslots'){
					$availability = service_finder_sort_by_availability_timeslot($provider_id,$date,$starttime,$endtime,$minuts,$srhperiod);
				}elseif(service_finder_availability_method($provider_id) == 'starttime'){
					$availability = service_finder_sort_by_availability_starttime($provider_id,$date,$starttime,$endtime,$minuts,$srhperiod);
				}else{
					$availability = service_finder_sort_by_availability_timeslot($provider_id,$date,$starttime,$endtime,$minuts,$srhperiod);
				}
				
				if($availability == 1){
					$available[] = $provider_id;
				}elseif($availability == 0){
					$unavailable[] = $provider_id;
				}
				
			}else{
				$unavailable[] = $provider_id;	
			}
			
		}else{
			$unavailable[] = $provider_id;
		}
		}else{
			$unavailable[] = $provider_id;
		}
		
	}
}

$return = array(
		'available' => $available,
		'unavailable' => $unavailable
	);

return $return;

}

/*Sort by avaialbility*/
function service_finder_sort_by_availability_starttime($provider_id,$date,$starttime,$endtime,$minuts,$srhperiod){
global $wpdb, $service_finder_Tables;

$dayname = date('l', strtotime( $date ));
$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->starttime.' AS starttime WHERE `starttime`.`provider_id` = %d AND `starttime`.`day` = "%s"',$provider_id,strtolower($dayname)));

$flag = 0;

if(!empty($results)){
	foreach($results as $row){
	
		$slotendtime = date('H:i:s', strtotime($row->start_time." +".$minuts." minutes"));
		
		$totalbookings = service_finder_get_provider_availability( $provider_id,$date,$row->start_time,$slotendtime );	
		$chkunavailability = service_finder_get_provider_unavailability( $provider_id,$date,$starttime );
		
		if($row->max_bookings > $totalbookings && $chkunavailability == 0) {		
			
			$slotstarttimestamp = strtotime($date.' '.$row->start_time);
			$slotendtimestamp = strtotime($date.' '.$slotendtime);

			$srhstarttimestamp = strtotime($date.' '.$starttime);
			$srhendtimestamp = strtotime($date.' '.$endtime);
			
			if($srhperiod == 'any'){
			if($slotstarttimestamp > current_time( 'timestamp' )){
			$flag = 1;
			}
			}else{
			if($slotstarttimestamp > current_time( 'timestamp' ) && ($srhstarttimestamp <= $slotstarttimestamp && $slotstarttimestamp < $srhendtimestamp) && ($srhstarttimestamp < $slotendtimestamp && $slotendtimestamp <= $srhendtimestamp)){
			$flag = 1;
			}
			}
		}
	}
}

return $flag;

}

/*Get provider avaialbility*/
function service_finder_get_provider_availability($provider_id,$date,$starttime,$endtime){
global $wpdb, $service_finder_Tables;	
	
$result = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings LEFT JOIN '.$service_finder_Tables->booked_services.' as bookedservices on bookings.id = bookedservices.booking_id WHERE `bookings`.`status` != "Cancel" AND `bookings`.`provider_id` = %d AND ((`bookings`.`multi_date` = "yes" AND `bookedservices`.`date` = "%s" AND (`bookedservices`.`start_time` > "%s" AND `bookedservices`.`start_time` < "%s" OR (`bookedservices`.`end_time` > "%s" AND `bookedservices`.`end_time` < "%s") OR (`bookedservices`.`start_time` < "%s" AND `bookedservices`.`end_time` > "%s") OR (`bookedservices`.`start_time` = "%s" OR `bookedservices`.`end_time` = "%s") )) OR (`bookings`.`multi_date` = "no" AND `bookings`.`date` = "%s" AND (`bookings`.`start_time` > "%s" AND `bookings`.`start_time` < "%s" OR (`bookings`.`end_time` > "%s" AND `bookings`.`end_time` < "%s") OR (`bookings`.`start_time` < "%s" AND `bookings`.`end_time` > "%s") OR (`bookings`.`start_time` = "%s" OR `bookings`.`end_time` = "%s") )))',$provider_id,$date,$starttime,$endtime,$starttime,$endtime,$starttime,$endtime,$starttime,$endtime,$date,$starttime,$endtime,$starttime,$endtime,$starttime,$endtime,$starttime,$endtime));

$totalrows = count($result);

return $totalrows;
}

/*Get provider unavaialbility*/
function service_finder_get_provider_unavailability($provider_id,$date,$starttime){
global $wpdb,$service_finder_Tables;

$result = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->unavailability.' AS unavl WHERE `unavl`.`date` = "%s" AND availability_method = "starttime" AND `unavl`.`single_start_time` = "%s" AND `unavl`.`provider_id` = %d',$date,$starttime,$provider_id));

$totalrows = count($result);

return $totalrows;
	
}

/*Sort by avaialbility*/
function service_finder_sort_by_availability_timeslot($provider_id,$date,$starttime,$endtime,$minuts,$srhperiod){
global $wpdb, $service_finder_Tables;

$dayname = date('l', strtotime( $date ));

$flag = 0;

$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->timeslots.' AS timeslots WHERE (SELECT COUNT(*) FROM '.$service_finder_Tables->bookings.' AS bookings LEFT JOIN '.$service_finder_Tables->booked_services.' as bookedservices on bookings.id = bookedservices.booking_id WHERE `bookings`.`status` != "Cancel" AND (`bookings`.`multi_date` = "yes" AND `bookedservices`.`date` = "%s" AND `bookedservices`.`start_time` = `timeslots`.`start_time` AND `bookedservices`.`end_time` = `timeslots`.`end_time`) OR (`bookings`.`multi_date` = "no" AND `bookings`.`date` = "%s" AND `bookings`.`start_time` = `timeslots`.`start_time` AND `bookings`.`end_time` = `timeslots`.`end_time`)) < `timeslots`.`max_bookings` AND (SELECT COUNT(*) FROM '.$service_finder_Tables->unavailability.' AS unavl WHERE `unavl`.`date` = "%s" AND  `unavl`.availability_method = "timeslots" AND `unavl`.`start_time` = `timeslots`.`start_time` AND `unavl`.`end_time` = `timeslots`.`end_time`) = 0 AND `timeslots`.`provider_id` = %d AND `timeslots`.`day` = "%s"',$date,$date,$date,$provider_id,strtolower($dayname)));

if(!empty($results)){
	foreach($results as $slot){
		$qry = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->unavailability.' WHERE `date` = "%s" AND availability_method = "timeslots" AND start_time = "%s" AND end_time = "%s" AND provider_id = %d',$date,$slot->start_time,$slot->end_time,$provider_id));
		
		if(empty($qry)){
		$slotstarttimestamp = strtotime($date.' '.$slot->start_time);
		$slotendtimestamp = strtotime($date.' '.$slot->end_time);
		$diff = $slotendtimestamp - $slotstarttimestamp;
		$diff = abs($diff);
		$slotperiod = floor($diff / 60);

		$srhstarttimestamp = strtotime($date.' '.$starttime);
		$srhendtimestamp = strtotime($date.' '.$endtime);
		
		if($srhperiod == 'any' || $srhperiod == ''){
		if($slotstarttimestamp > current_time( 'timestamp' ) && $slotperiod >= $minuts){
			$flag = 1;
		}
		}else{
		if($slotstarttimestamp > current_time( 'timestamp' ) && ($srhstarttimestamp <= $slotstarttimestamp && $slotstarttimestamp < $srhendtimestamp) && ($srhstarttimestamp < $slotendtimestamp && $slotendtimestamp <= $srhendtimestamp) && $slotperiod >= $minuts){
			$flag = 1;
		}
		}
		}
	}
}

return $flag;

}


/*Get start and end time by search period*/
function service_finder_get_search_period($srhperiod){

	switch($srhperiod){
		case 'morning':
			$starttime = '06:00:00';
			$endtime = '12:00:00';
			break;
		case 'afternoon':
			$starttime = '12:00:00';
			$endtime = '17:00:00';
			break;
		case 'evening':
			$starttime = '17:00:00';
			$endtime = '21:00:00';
			break;
		default:
			$starttime = '';
			$endtime = '';
			break;
	}
	
	$return = array(
		'starttime' => $starttime,
		'endtime' => $endtime
	);
	
	return $return;
}

/*Get start and end time by search period*/
function service_finder_availability_label($providerid,$providersavailability = array()){
	
	$html = '';
	
	if(!empty($providersavailability)){
		$availableproviders = $providersavailability['available'];
		$unavailableproviders = $providersavailability['unavailable'];
		
		if(in_array($providerid,$availableproviders)){
			$html = '<span class="sf-availability-label">'.esc_html__('Available','service-finder').'</span>';
		}
		
		if(in_array($providerid,$unavailableproviders)){
			$html = '<span class="sf-availability-label unavailable">'.esc_html__('Unavailable','service-finder').'</span>';
		}
	}
	
	return $html;
   
}

/*Get start and end time by search period*/
function service_finder_get_wallet_amount($user_id){
	
	$walletamount = get_user_meta($user_id,'_sf_wallet_amount',true);
	if($walletamount == ""){
		$walletamount = 0;
	}
	
	return $walletamount;
}

/*Get provider languages*/
function service_finder_get_languages($user_id){
	
	$userInfo = service_finder_getUserInfo($user_id);
	
	if(!empty($userInfo['languages'])){
	$alllanguages = explode(',',$userInfo['languages']);
	}elseif($userInfo['languages'] != ""){
	$alllanguages[] = $userInfo['languages'];
	}else{
	$alllanguages = array();
	}
	
	return $alllanguages;
}

/*Get provider amenities*/
function service_finder_get_amenities($user_id){
	
	$userInfo = service_finder_getUserInfo($user_id);
	
	if(!empty($userInfo['amenities'])){
	$amenities = explode(',',$userInfo['amenities']);
	}elseif($userInfo['amenities'] != ""){
	$amenities[] = $userInfo['amenities'];
	}else{
	$amenities = array();
	}
	
	return $amenities;
}

/*Check advance search option in on/off*/
function service_finder_check_advance_search(){
global $service_finder_options;

$searchprice = (isset($service_finder_options['search-price'])) ? esc_attr($service_finder_options['search-price']) : '';
$searchradius = (isset($service_finder_options['search-radius'])) ? esc_attr($service_finder_options['search-radius']) : '';

if($searchprice || $searchradius){
	return true;
}else{
	return false;
}
}

/*Check if any experience exist or not*/
function service_finder_experience_exist($author){
global $wpdb,$service_finder_Tables;

$results = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$service_finder_Tables->experience. " WHERE `provider_id` = %d ORDER BY ID ASC",$author));

if(!empty($results)){
	return true;
}else{
	return false;
}
}

/*Check if any certificate exist or not*/
function service_finder_certificate_exist($author){
global $wpdb,$service_finder_Tables;

$results = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$service_finder_Tables->certificates. " WHERE `provider_id` = %d ORDER BY ID ASC",$author));

if(!empty($results)){
	return true;
}else{
	return false;
}
}

/*Check if any certificate exist or not*/
function service_finder_qualification_exist($author){
global $wpdb,$service_finder_Tables;

$results = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$service_finder_Tables->qualification. " WHERE `provider_id` = %d ORDER BY ID ASC",$author));

if(!empty($results)){
	return true;
}else{
	return false;
}
}

/*Check if any amenities exist or not*/
function service_finder_amenities_exist($author){
global $wpdb,$service_finder_Tables;

$results = service_finder_get_amenities($author);

if(!empty($results)){
	return true;
}else{
	return false;
}
}

/*Check if any languages exist or not*/
function service_finder_languages_exist($author){
global $wpdb,$service_finder_Tables;

$results = service_finder_get_languages($author);

if(!empty($results)){
	return true;
}else{
	return false;
}
}

/*Check if any article exist or not*/
function service_finder_article_exist($author){
global $wpdb,$service_finder_Tables;

$args = array(
	'post_type' 	=> 'sf_articles',
	'post_status' 	=> 'publish',
	'posts_per_page' => 5,
	'order' => 'DESC',
	'author' => $author,
);
$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) {
	return true;
}else{
	return false;
}
}

/*Check provider membership status*/
function service_finder_check_provider_membership_status($providerid){
global $wpdb,$service_finder_Tables;

$row = $wpdb->get_row($wpdb->prepare('SELECT status FROM '.$service_finder_Tables->providers.' where wp_user_id = %d',$providerid));

if(!empty($row)){
	return $row->status;
}else{
	return '';
}
}

/*Provider Category Dropdown*/
function service_finder_category_dropdown($texonomy = 'providers-category'){
global $wpdb,$service_finder_Tables;

$limit = 1000;
$categories = service_finder_getCategoryList($limit,'',$texonomy);
$html = '';

$html = '<select name="categoryid" class="form-control sf-form-control sf-select-box" title="'.esc_html__('Category', 'service-finder').'" data-live-search="true" data-header="'.esc_html__('Select a Category', 'service-finder').'">
        <option value="">
        '.esc_html__('Select a Category', 'service-finder').'
        </option>';

if(!empty($categories)){
	foreach($categories as $category){
	$term_id = (!empty($category->term_id)) ? $category->term_id : '';
	$term_name = (!empty($category->name)) ? $category->name : '';
	
	$catimage =  service_finder_getCategoryImage($term_id,'service_finder-category-small');
	$html .= '<option value="'.esc_attr($term_id).'" data-content="<span>'.esc_attr($term_name).'</span>">'. $term_name.'</option>';
	
	$term_children = get_term_children($term_id,$texonomy);
	$namearray = array();
	if(!empty($term_children)){
		foreach ($term_children as $child) {
			$term = get_term_by( 'id', $child, $texonomy );

			$namearray[$term->name]= $child;

		}
		
		if(!empty($namearray)){
		ksort($namearray);
	
		foreach($namearray as $key => $value) {
			$term_child_id = $value;
			$term_child = get_term_by('id',$term_child_id,$texonomy);
			$term_child_name = (!empty($term_child->name)) ? $term_child->name : '';
			
			$catimage =  service_finder_getCategoryImage($term_child_id,'service_finder-category-small');
			if($catimage != ""){
			$html .= '<option value="'.esc_attr($term_child_id).'" data-content="<img class=\'childcat-img\' width=\'50\' height=\'auto\' src=\''. esc_url($catimage).'\'><span class=\'childcat\'>'.esc_attr($term_child_name).'</span>">'. $term_child_name.'</option>';
			}else{
			$html .= '<option value="'.esc_attr($term_child_id).'" data-content="<span class=\'childcat\'>'.esc_attr($term_child_name).'</span>">'. $term_child_name.'</option>';
			}
			
		}
		}
	}
	
	}
}	
$html .= '</select>';

return $html;
}

/*Booked Services Summary for woo commerce cart*/
function service_finder_booking_services_woosummary($serviceitems = array(),$providerid){
$html = '';
if(!empty($serviceitems)){
			$html = '<div class="table-responsive">          
				  <table class="table">
					<thead>
					  <tr>
						<th>'.esc_html__( 'Service Name', 'service-finder' ).'</th>
						<th>'.esc_html__( 'Date', 'service-finder' ).'</th>
						<th>'.esc_html__( 'Start Time', 'service-finder' ).'</th>
						<th>'.esc_html__( 'End Time', 'service-finder' ).'</th>
					  </tr>
					</thead>
					<tbody>';
				foreach($serviceitems as $servicesitem){
					$serviceitem = explode('||',$servicesitem);
				
					$sid = (!empty($serviceitem[0])) ? $serviceitem[0] : '';
					$shours = (!empty($serviceitem[1])) ? $serviceitem[1] : '';
					$sdate = (!empty($serviceitem[2])) ? $serviceitem[2] : '';
					$serslots = (!empty($serviceitem[3])) ? $serviceitem[3] : '';
					$smemberid = (!empty($serviceitem[4])) ? $serviceitem[4] : 0;
					$discount = (!empty($serviceitem[5])) ? $serviceitem[5] : 0;
					$couponcode = (!empty($serviceitem[6])) ? $serviceitem[6] : '';
			
					if(service_finder_get_service_type($sid) == 'days'){
						$sdate = trim($sdate,'##');
						
						$dates = str_replace('##',',',$sdate);
						
						$html .= '<tr>
							<td>'.service_finder_get_service_name($sid).'</td>
							<td>'.$dates.'</td>
							<td>-</td>
							<td>-</td>
						  </tr>';
					}else{
						
						$serslot = explode('-',$serslots);
						
						$paddingtime = service_finder_get_service_paddind_time($sid);
						$before_padding_time = $paddingtime['before_padding_time'];
						$after_padding_time = $paddingtime['after_padding_time'];
						
						$mstarttime = (!empty($serslot[0])) ? $serslot[0] : Null; 
						$mendtime = (!empty($serslot[1])) ? $serslot[1] : Null; 
						$midtime = (!empty($serslot[1])) ? $serslot[1] : Null; 
						
						if(service_finder_availability_method($providerid) == 'timeslots'){
							
							if($shours > 0){
								$tem = number_format($shours, 2);
								$temarr = explode('.',$tem);
								$tem1 = 0;
								$tem2 = 0;
								if(!empty($temarr)){
								
								if(!empty($temarr[0])){
									$tem1 = floatval($temarr[0]) * 60;
								}
								if(!empty($temarr[1])){
									$tem2 = $temarr[1];
								}
								
								}
								
								$totalhours = floatval($tem1) + floatval($tem2);
							
								if($totalhours > 0 && $totalhours != ""){
									$mendtime = date('H:i:s', strtotime($mstarttime." +".$totalhours." minutes"));
									$midtime = date('H:i:s', strtotime($mstarttime." +".$totalhours." minutes"));
								}	
							}
						}
						
						if($before_padding_time > 0 || $after_padding_time > 0){
						if(!empty($serslot[0])){
						$mstarttime = date('H:i:s', strtotime($mstarttime." -".$before_padding_time." minutes"));
						}
						if(!empty($serslot[1])){
						$mendtime = date('H:i:s', strtotime($mendtime." +".$after_padding_time." minutes"));
						}
						}
						
						$stime = (!empty($serslot[0])) ? $mstarttime : '-'; 
						$etime = (!empty($serslot[1])) ? $mendtime : '-'; 
						
						$html .= '<tr>
							<td>'.service_finder_get_service_name($sid).'</td>
							<td>'.$sdate.'</td>
							<td>'.$stime.'</td>
							<td>'.$etime.'</td>
						  </tr>';
								
					}		
				}
				
				$html .= '</tbody>
					  </table>
					  </div>';	
			}
return $html; 			
}

/*Get Languages*/
function service_finder_get_alllanguages(){
	$lng = array();
	$lng['aa'] = "Afar";
	$lng['ab'] = "Abkhazian";
	$lng['ae'] = "Avestan";
	$lng['af'] = "Afrikaans";
	$lng['am'] = "Amharic";
	$lng['ar'] = "Arabic";
	$lng['as'] = "Assamese";
	$lng['ay'] = "Aymara";
	$lng['az'] = "Azerbaijani";
	$lng['ba'] = "Bashkir";
	$lng['be'] = "Belarusian";
	$lng['bg'] = "Bulgarian";
	$lng['bh'] = "Bihari";
	$lng['bi'] = "Bislama";
	$lng['bn'] = "Bengali";
	$lng['bo'] = "Tibetan";
	$lng['br'] = "Breton";
	$lng['bs'] = "Bosnian";
	$lng['ca'] = "Catalan";
	$lng['ce'] = "Chechen";
	$lng['ch'] = "Chamorro";
	$lng['co'] = "Corsican";
	$lng['cs'] = "Czech";
	$lng['cu'] = "Church Slavic";
	$lng['cv'] = "Chuvash";
	$lng['cy'] = "Welsh";
	$lng['da'] = "Danish";
	$lng['de'] = "German";
	$lng['dz'] = "Dzongkha";
	$lng['el'] = "Greek";
	$lng['en'] = "English";
	$lng['eo'] = "Esperanto";
	$lng['es'] = "Spanish";
	$lng['et'] = "Estonian";
	$lng['eu'] = "Basque";
	$lng['fa'] = "Persian";
	$lng['fi'] = "Finnish";
	$lng['fj'] = "Fijian";
	$lng['fo'] = "Faeroese";
	$lng['fr'] = "French";
	$lng['fy'] = "Frisian";
	$lng['ga'] = "Irish";
	$lng['gd'] = "Gaelic (Scots)";
	$lng['gl'] = "Gallegan";
	$lng['gn'] = "Guarani";
	$lng['gu'] = "Gujarati";
	$lng['gv'] = "Manx";
	$lng['ha'] = "Hausa";
	$lng['he'] = "Hebrew";
	$lng['hi'] = "Hindi";
	$lng['ho'] = "Hiri Motu";
	$lng['hr'] = "Croatian";
	$lng['hu'] = "Hungarian";
	$lng['hy'] = "Armenian";
	$lng['hz'] = "Herero";
	$lng['ia'] = "Interlingua";
	$lng['id'] = "Indonesian";
	$lng['ie'] = "Interlingue";
	$lng['ik'] = "Inupiaq";
	$lng['is'] = "Icelandic";
	$lng['it'] = "Italian";
	$lng['iu'] = "Inuktitut";
	$lng['ja'] = "Japanese";
	$lng['jw'] = "Javanese";
	$lng['ka'] = "Georgian";
	$lng['ki'] = "Kikuyu";
	$lng['kj'] = "Kuanyama";
	$lng['kk'] = "Kazakh";
	$lng['kl'] = "Kalaallisut";
	$lng['km'] = "Khmer";
	$lng['kn'] = "Kannada";
	$lng['ko'] = "Korean";
	$lng['ks'] = "Kashmiri";
	$lng['ku'] = "Kurdish";
	$lng['kv'] = "Komi";
	$lng['kw'] = "Cornish";
	$lng['ky'] = "Kirghiz";
	$lng['la'] = "Latin";
	$lng['lb'] = "Letzeburgesch";
	$lng['ln'] = "Lingala";
	$lng['lo'] = "Lao";
	$lng['lt'] = "Lithuanian";
	$lng['lv'] = "Latvian";
	$lng['mg'] = "Malagasy";
	$lng['mh'] = "Marshall";
	$lng['mi'] = "Maori";
	$lng['mk'] = "Macedonian";
	$lng['ml'] = "Malayalam";
	$lng['mn'] = "Mongolian";
	$lng['mo'] = "Moldavian";
	$lng['mr'] = "Marathi";
	$lng['ms'] = "Malay";
	$lng['mt'] = "Maltese";
	$lng['my'] = "Burmese";
	$lng['na'] = "Nauru";
	$lng['nb'] = "Norwegian Bokmal";
	$lng['nd'] = "Ndebele, North";
	$lng['ne'] = "Nepali";
	$lng['ng'] = "Ndonga";
	$lng['nl'] = "Dutch";
	$lng['nn'] = "Norwegian Nynorsk";
	$lng['no'] = "Norwegian";
	$lng['nr'] = "Ndebele, South";
	$lng['nv'] = "Navajo";
	$lng['ny'] = "Chichewa; Nyanja";
	$lng['oc'] = "Occitan (post 1500)";
	$lng['om'] = "Oromo";
	$lng['or'] = "Oriya";
	$lng['os'] = "Ossetian; Ossetic";
	$lng['pa'] = "Panjabi";
	$lng['pi'] = "Pali";
	$lng['pl'] = "Polish";
	$lng['ps'] = "Pushto";
	$lng['pt'] = "Portuguese";
	$lng['pb'] = "Brazilian Portuguese";
	$lng['qu'] = "Quechua";
	$lng['rm'] = "Rhaeto-Romance";
	$lng['rn'] = "Rundi";
	$lng['ro'] = "Romanian";
	$lng['ru'] = "Russian";
	$lng['rw'] = "Kinyarwanda";
	$lng['sa'] = "Sanskrit";
	$lng['sc'] = "Sardinian";
	$lng['sd'] = "Sindhi";
	$lng['se'] = "Sami";
	$lng['sg'] = "Sango";
	$lng['si'] = "Sinhalese";
	$lng['sk'] = "Slovak";
	$lng['sl'] = "Slovenian";
	$lng['sm'] = "Samoan";
	$lng['sn'] = "Shona";
	$lng['so'] = "Somali";
	$lng['sq'] = "Albanian";
	$lng['sr'] = "Serbian";
	$lng['ss'] = "Swati";
	$lng['st'] = "Sotho";
	$lng['su'] = "Sundanese";
	$lng['sv'] = "Swedish";
	$lng['sw'] = "Swahili";
	$lng['ta'] = "Tamil";
	$lng['te'] = "Telugu";
	$lng['tg'] = "Tajik";
	$lng['th'] = "Thai";
	$lng['ti'] = "Tigrinya";
	$lng['tk'] = "Turkmen";
	$lng['tl'] = "Tagalog";
	$lng['tn'] = "Tswana";
	$lng['to'] = "Tonga";
	$lng['tr'] = "Turkish";
	$lng['ts'] = "Tsonga";
	$lng['tt'] = "Tatar";
	$lng['tw'] = "Twi";
	$lng['ug'] = "Uighur";
	$lng['uk'] = "Ukrainian";
	$lng['ur'] = "Urdu";
	$lng['uz'] = "Uzbek";
	$lng['vi'] = "Vietnamese";
	$lng['vo'] = "Volapuk";
	$lng['wo'] = "Wolof";
	$lng['xh'] = "Xhosa";
	$lng['yi'] = "Yiddish";
	$lng['yo'] = "Yoruba";
	$lng['za'] = "Zhuang";
	$lng['zh'] = "Chinese";
	$lng['zu'] = "Zulu";
	return $lng;
}

/*Display package capabilities*/
function service_finder_display_package_capability($packageid){
global $service_finder_options;	
$caps = (!empty($service_finder_options['package'.$packageid.'-capabilities'])) ? $service_finder_options['package'.$packageid.'-capabilities'] : '';
$subcaps = (!empty($service_finder_options['package'.$packageid.'-subcapabilities'])) ? $service_finder_options['package'.$packageid.'-subcapabilities'] : '';

	if(!empty($caps)){
		foreach($caps as $key => $value){
			if($value){
			echo '<li><strong>'.strtoupper(service_finder_get_capability_name_by_key($key)).'</strong> <i class="fa fa-check"></i></li>';
			if($key == 'multiple-categories'){
			echo '<li><strong>'.esc_html__('Number of Categories','service-finder').'</strong> '.service_finder_get_number_of_category($packageid).'</li>';
			}
			}else{
			echo '<li><strong>'.strtoupper(service_finder_get_capability_name_by_key($key)).'</strong> <i class="fa fa-close"></i></li>';
			}
		}
	}
	
	if(!empty($subcaps)){
		foreach($subcaps as $key => $value){
			if($value){
			echo '<li><strong>'.strtoupper(service_finder_get_capability_name_by_key($key)).'</strong> <i class="fa fa-check"></i></li>';
			}else{
			echo '<li><strong>'.strtoupper(service_finder_get_capability_name_by_key($key)).'</strong> <i class="fa fa-close"></i></li>';
			}
		}
	}
	
}

function service_finder_get_capability_name_by_key($key){
	switch ($key) {
		case 'booking':
			$string = esc_html__('Booking','service-finder');
			break;
		case 'cover-image':
			$string = esc_html__('Cover Image','service-finder');
			break;
		case 'gallery-images':
			$string = esc_html__('Gallery Images','service-finder');
			break;
		case 'multiple-categories':
			$string = esc_html__('Multiple Categories','service-finder');
			break;
		case 'apply-for-job':
			$string = esc_html__('Apply for Job','service-finder');
			break;
		case 'job-alerts':
			$string = esc_html__('Job Alerts','service-finder');
			break;
		case 'branches':
			$string = esc_html__('Branches','service-finder');
			break;
		case 'google-calendar':
			$string = esc_html__('Google Calendar','service-finder');
			break;
		case 'invoice':
			$string = esc_html__('Invoice','service-finder');
			break;
		case 'availability':
			$string = esc_html__('Availability','service-finder');
			break;
		case 'staff-members':
			$string = esc_html__('Staff Members','service-finder');
			break;
	}
	return $string;
}

/*Get number of multiple categories in package*/
function service_finder_get_number_of_category($packageid){
global $service_finder_options;	

$numberofcategory = (!empty($service_finder_options['package'.$packageid.'-multiple-categories'])) ? $service_finder_options['package'.$packageid.'-multiple-categories'] : 0;

return $numberofcategory;
}

