<?php
/**
 * Template Name: Form Confirmation Page
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

$email = 'shane@fugumedia.com';

if ( !isset($_POST['formtype'] ) ) {
	header('Status:302');
	header('Location: /reservations/');
	die();
}


switch( $_POST['formtype'] ) {
	case 'returnclient':
		$subject = 'Return Client Booking Alert';
		break;
	default:
		$subject = 'New Client Booking Alert';
		break;
}

$message = '';

$message .= 'Client Info:' . "\n\n";

if ( !empty( $_POST['firstname'] ) ) $message .= "First Name: " . $_POST['firstname'] . "\n";
if ( !empty( $_POST['lastname'] ) ) $message .= "Last Name: " . $_POST['lastname'] . "\n";
if ( !empty( $_POST['email'] ) ) $message .= "Email: " . $_POST['email'] . "\n";
if ( !empty( $_POST['address'] ) ) $message .= "Address: " . $_POST['address'] . "\n";
if ( !empty( $_POST['city'] ) ) $message .= "City: " . $_POST['city'] . "\n";
if ( !empty( $_POST['state'] ) ) $message .= "State: " . $_POST['state'] . "\n";
if ( !empty( $_POST['zip'] ) ) $message .= "Postal Code: " . $_POST['zip'] . "\n";
if ( !empty( $_POST['phone'] ) ) $message .= "Phone: " . $_POST['phone'] . "\n";
if ( !empty( $_POST['emergency_name'] ) ) $message .= "Emergency Contact Name: " . $_POST['emergency_name'] . "\n";
if ( !empty( $_POST['emergency_phone'] ) ) $message .= "Emergency Contact Phone: " . $_POST['emergency_phone'] . "\n";
if ( !empty( $_POST['leadsource'] ) ) $message .= "Lead Source: " . $_POST['leadsource'] . "\n";

$message .= "\n" . 'Cat Info:' . "\n\n";

if ( !empty( $_POST['catname'] ) ) $message .= "Cat's Name: " . $_POST['catname'] . "\n";
if ( !empty( $_POST['catbirthday'] ) ) $message .= "Cat's Birthday: " . $_POST['catbirthday'] . "\n";
if ( !empty( $_POST['catbreed'] ) ) $message .= "Cat's Breed: " . $_POST['catbreed'] . "\n";
if ( !empty( $_POST['catcolor'] ) ) $message .= "Cat's Color: " . $_POST['catcolor'] . "\n";
if ( !empty( $_POST['catgender'] ) ) $message .= "Cat's Gender: " . $_POST['catgender'] . "\n";
if ( !empty( $_POST['catfixed'] ) ) $message .= "Is Cat Fixed? " . $_POST['catfixed'] . "\n";
if ( !empty( $_POST['catvet'] ) ) $message .= "Cat's Vet: " . $_POST['catvet'] . "\n";
if ( !empty( $_POST['catvetphone'] ) ) $message .= "Cat's Vet's Phone: " . $_POST['catvetphone'] . "\n";
if ( !empty( $_POST['fvrcpdate'] ) ) $message .= "FVRCP Date: " . $_POST['fvrcpdate'] . "\n";
if ( !empty( $_POST['innvac'] ) ) $message .= "Did Cat's Inn Vaccinate? " . $_POST['innvac'] . "\n";
if ( !empty( $_POST['dryfood'] ) ) $message .= "Dry Food Brand: " . $_POST['dryfood'] . "\n";
if ( !empty( $_POST['wetfood'] ) ) $message .= "Wet Food Brand: " . $_POST['wetfood'] . "\n";
if ( !empty( $_POST['ownerbrought'] ) ) $message .= "Owner Brought? " . $_POST['ownerbrought'] . "\n";
if ( !empty( $_POST['special'] ) ) $message .= "Special Instructions: " . $_POST['special'] . "\n";

$message .= "\n" . 'Service Details:' . "\n\n";

if ( !empty( $_POST['datein'] ) ) $message .= "Date In: " . $_POST['datein'] . "\n";
if ( !empty( $_POST['dateout'] ) ) $message .= "Date Out: " . $_POST['dateout'] . "\n";
if ( !empty( $_POST['service'] ) ) $message .= "Services: " . implode( ', ', $_POST['service'] ) . "\n";
if ( !empty( $_POST['boarding'] ) ) $message .= "Boarding: " . $_POST['boarding'] . "\n";
if ( !empty( $_POST['grooming'] ) ) $message .= "Grooming: " . implode( ', ', $_POST['grooming'] ) . "\n";
if ( !empty( $_POST['softpaws'] ) ) $message .= "Softpaws: " . $_POST['softpaws'] . "\n";
if ( !empty( $_POST['shampoo'] ) ) $message .= "Bath/Shampoo: " . implode( ', ', $_POST['shampoo'] ) . "\n";
if ( !empty( $_POST['groominginst'] ) ) $message .= "Grooming Instructions: " . $_POST['groominginst'] . "\n";
if ( !empty( $_POST['catsit'] ) ) $message .= "In-Home Cat Sitting: " . $_POST['catsit'] . "\n";
if ( !empty( $_POST['catno'] ) ) $message .= "Number of Cats: " . $_POST['catno'] . "\n";
if ( !empty( $_POST['inhome'] ) ) $message .= "In-Home Instructions: " . $_POST['inhome'] . "\n";
if ( !empty( $_POST['transport'] ) ) $message .= "Transportation: " . $_POST['transport'] . "\n";

$headers = 'From: The Cats Inn Website <noreply@thecatsinn.net>' . "\r\n" .
	'Reply-To: noreply@thecatsinn.net' . "\r\n" .
	'X-Mailer: CustomCatForm/1.0';

//mail( $email, $subject, $message, $headers );

wp_mail($email, $subject, $message, $headers );
get_header(); ?>
		<div id="primary">
			<div id="content" role="main">
<?php get_sidebar( 'banner' ); ?>
<?php if ( !is_front_page() ): ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>
<?php endif; ?>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
