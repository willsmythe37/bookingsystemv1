<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Booking;
use App\Room;
use App\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);

        $superAdminRole = Role::where('name', 'Super Admin')->first();
        $adminRole = Role::where('name', 'Admin')->first();
        $userRole = Role::where('name', 'User')->first();

        $superAdmin = User::create([
            'name' => 'Super Admin',
            'surname' => 'SA',
            'band' => 'N/a',
            'phonenumber' => 'N/a',
            'email' => 'SuperAdmin@email.com',
            'agreetoterms' => '1',
            'email_verified_at' => '2020-08-29 13:30:45',
            'last_login_at' => '2020-04-07 12:43:08',
            'password' => Hash::make('11223344')
        ]);

        $admin = User::create([
            'name' => 'Admin User',
            'surname' => 'BA',
            'band' => 'N/a',
            'phonenumber' => 'N/a',
            'email' => 'Admin@email.com',
            'agreetoterms' => '1',
            'email_verified_at' => '2020-08-29 13:30:45',
            'last_login_at' => '2020-04-07 12:43:08',
            'password' => Hash::make('11223344')
        ]);

        $user = User::create([
            'name' => 'Stan',
            'surname' => 'Wheatley',
            'band' => 'In the moment',
            'phonenumber' => '07814 998877',
            'email' => 'user@email.com',
            'email_verified_at' => '2020-08-29 13:30:45',
            'agreetoterms' => '1',
            'last_login_at' => '2020-04-07 12:43:08',
            'password' => Hash::make('11223344')
        ]);

        $user2 = User::create([
            'name' => 'Gary',
            'surname' => 'Barlow',
            'band' => 'Take That',
            'phonenumber' => '+447814567899',
            'email' => 'user2@email.com',
            'agreetoterms' => '1',
            'email_verified_at' => '2020-08-29 13:30:45',
            'last_login_at' => '2020-04-07 12:43:08',
            'password' => Hash::make('11223344')
        ]);

        $superAdmin->roles()->attach($superAdminRole);
        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);
        $user2->roles()->attach($userRole);

        DB::table('rooms')->insert([
            'id' => '1',
            'roomname' => 'Room 1',
            'shortdescription' => 'Biggest rehearsal space available',
            'longdescription' => 'Approximately 8x10 ft. Features built in lighting and air conditioning.',
            'priceperhour' => '10.00',
            'available' => '1',
            'image1' => 'CB1.jpg',
            'showimage1' => '1',
            'created_at'=> '2020-04-07 12:43:08',
            'updated_at'=> '2020-04-07 12:43:08',
            ]);
        DB::table('rooms')->insert([
            'id' => '2',
            'roomname' => 'Room 2',
            'shortdescription' => 'Medium sized room, suitable for 5 piece acts',
            'longdescription' => 'Approximately 7x8 ft. Medium sized room that has enough space for a full 5 piece act (including Keyboards).',
            'priceperhour' => '10.00',
            'available' => '1',
            'image1' => 'CB1.jpg',
            'showimage1' => '1',
            'created_at'=> '2020-04-07 12:43:08',
            'updated_at'=> '2020-04-07 12:43:08',
            ]);
        DB::table('rooms')->insert([
            'id' => '3',
            'roomname' => 'Room 3',
            'shortdescription' => 'Smallest of our rooms',
            'longdescription' => 'Approximately 6x8 ft. Can be a little tight for large acts, fits a 4 piece act comfortably.',
            'priceperhour' => '10.00',
            'available' => '1',
            'image1' => 'CB1.jpg',
            'showimage1' => '1',
            'created_at'=> '2020-04-07 12:43:08',
            'updated_at'=> '2020-04-07 12:43:08',
            ]);
        DB::table('rooms')->insert([
            'id' => '4',
            'roomname' => 'Room 4',
            'shortdescription' => 'Smallest of our rooms',
            'longdescription' => 'Approximately 6x8 ft. Can be a little tight for large acts, fits a 4 piece act comfortably.',
            'priceperhour' => '10.00',
            'available' => '1',
            'image1' => 'CB1.jpg',
            'showimage1' => '1',
            'created_at'=> '2020-04-07 12:43:08',
            'updated_at'=> '2020-04-07 12:43:08',
            ]);
        DB::table('rooms')->insert([
            'id' => '5',
            'roomname' => 'Room 5',
            'shortdescription' => 'Smallest of our rooms',
            'longdescription' => 'Approximately 6x8 ft. Can be a little tight for large acts, fits a 4 piece act comfortably.',
            'priceperhour' => '10.00',
            'available' => '1',
            'image1' => 'CB1.jpg',
            'showimage1' => '1',
            'created_at'=> '2020-04-07 12:43:08',
            'updated_at'=> '2020-04-07 12:43:08',
            ]);

        DB::table('businessinfos')->insert([
            'id' => '1',
            'copyrightyear' => '2020',
            'phonenumber'=> '+447812 123456',
            'businessname'=> 'Rehearsal Rooms Ltd.',
            'emailaddress' => 'Defaultemail@hotmail.com',
            'housenumber'=> '12a',
            'streetname'=> 'Garrison Road',
            'town'=> 'Demo-ville',
            'county'=> 'Bridgeshire',
            'postcode'=> 'PE29 111',
            'image1' => 'Logo_Example.png',
            'showimage1' => '1',
            'emailnotifications' => 'willsmythe37@hotmail.co.uk',
            'created_at'=> '2019-04-07 12:43:08',
            'updated_at'=> '2019-04-07 12:43:08',
            ]);

        DB::table('businesshours')->insert([
            'id' => '1',
            'Mondaystart' => '09:00:00',
            'Mondayend' => '23:00:00',
            'Tuesdaystart' => '09:00:00',
            'Tuesdayend' => '23:00:00',
            'Wednesdaystart' => '09:00:00',
            'Wednesdayend' => '23:00:00',
            'Thursdaystart' => '09:00:00',
            'Thursdayend' => '23:00:00',
            'Fridaystart' => '09:00:00',
            'Fridayend' => '23:00:00',
            'Saturdaystart' => '09:00:00',
            'Saturdayend' => '23:00:00',
            'Sundaystart' => '09:00:00',
            'Sundayend' => '23:00:00',
            'created_at'=> '2019-04-07 12:43:08',
            'updated_at'=> '2019-04-07 12:43:08',
            ]);

        DB::table('metacontents')->insert([
            'id' => '1',
            'charset' => 'UTF-8',
            'keywords'=> 'HTML, CSS, JavaScript',
            'description'=> 'Rehearsal Rooms Ltd.',
            'author' => 'Will Smythe',
            'refresh'=> '800',
            'viewport'=> 'width=device-width, maximum-scale=1',
            'title'=> 'Rehearsal Room Booking System',
            'customCSS'=> '
/* WARNING - Before making adjustments, copy contents to a text file and save ;) */

/* Sustain height of navbar during collapse */
    .navbar-collapse {
    padding: 1rem;
}

/* Sets a gradient colouration from top to bottom */
.bg-white {
    background-image: linear-gradient(to bottom, #a49de3 30%, #6b5de8 100%);
}

/* Applies style to the burger button */
    .navbar-toggler {
    background-color: white;
    border: 1px solid grey;
}

/* Applies text colour to the NavBar elements */
.navbar-light .navbar-brand {
    color: white;
}

/* Applies text colour to the NavBar elements */
.navbar-light .navbar-nav .nav-link {
    color: white;
}

/* Default text colour for all text */
body {
    color: #6b5de8;
}

/* Basic HTML styling */
html {
    font-family: sans-serif;
    line-height: 1.15;
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: black;
}

/* Styles the Horizontal Rules, that cross the page. */
hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: .1px solid #6b5de8;
}

/* Adjusts the default colour of elements that have the text-muted class. e.g. footer */
.text-muted {
    color: #4e42b7 !important;
}

/* Some more default navbar styling */
.navbar-light .navbar-nav .nav-link:hover, .navbar-light .navbar-nav .nav-link:focus {
    color: white;
}

/* Styles the Pagination links shown below tables, when data spills onto another page */
.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #4e42b7;
    border-color: grey;
}

/* Styles the Pagination links */
.page-link {
    position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #4e42b7;
    background-color: #fff;
    border: 1px solid #dee2e6;
}

/* Styles the DropDowns within the navbar */
.dropdown-item {
    display: block;
    width: 100%;
    padding: 0.25rem 1.5rem;
    clear: both;
    font-weight: 400;
    color: #4e42b7;
    text-align: inherit;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
}

/* Somestyling applied to form inputs that are text typed */
.input-group-text {
    display: flex;
    align-items: center;
    padding: 0.375rem 0.75rem;
    margin-bottom: 0;
    font-size: 0.9rem;
    font-weight: 400;
    line-height: 1.6;
    color: #white;
    text-align: center;
    white-space: nowrap;
    background-color: #6b5de8;
    color:white;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
}

/* Adjusts the styling of buttons with the info class. Not in use*/
.btn-info {
    color: #212529;
    background-color: #b9b5e4;
    border-color: #5345e2;
}

/* Adjusts the styling of buttons with the info class. Not in use*/
.btn-info :hover {
    color: #fff;
    background-color: #4e42b7;
    border-color: #4e42b7;
}

/* Adjusts the styling of buttons with the Primary class. Light Purple, black text*/
.btn-primary {
    color: #212529;
    background-color: #b9b5e4;
    border-color: #b9b5e4;
}

/* On hover, it goes dark purple and white text */
.btn-primary:hover {
    color: #fff;
    background-color: #4e42b7;
    border-color: #4e42b7;
}

/* Changes the colour of the Primary group, when it is considered to disabled */
.btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active, .show > .btn-primary.dropdown-toggle {
    color: #fff;
    background-color: #2f308e;
    border-color: #2f308e;
}

/* Because NavBar larger, padding added at the top to prevent overlap */
body { padding-top: 80px; }

/* Some CSS to stop the page collapsing beyond a certain size. Helps with  */
/* Start */
    body{
        min-width: 576px;
    /* Suppose you want minimum width of 576px*/

        width: auto !important;
    /* Firefox will set width as auto */

        width:576px;
    /* As IE6 ignores !important it will set width as 576px; */
    }
/* End */

/* jQuery styling */

/* Styling to make disabled form inputs appear white, not grey. */
.form-control:disabled, .form-control[readonly] {
    background-color: white;
    opacity: 1;
}

/* Adds padding to the text to make text more visable */
.addpadding {
    padding: 0.2rem 1.7rem;
}

/* Adds padding ut-button elements */
.ui-button {
    padding: 0.0rem 0.5rem;
}

/* Moves the chevron buttons to the left */
.ui-spinner-button {
    right: auto;
}

/* aligns text to the left */
.ui-corner-all{
    text-align: left;
}

/* Colours the header of the card element shown on the dashboard */
.card-header {
    background-color: #6b5de8b0;
    color: white;
}

/* Styles the card border a little */
.card {
    border: 1px solid rgb(132 147 255 / 35%);
}

/* Adds a small space on the right of burger button, iPhone scroll was blocking selection */
.navbar-light .navbar-toggler {
    margin-right: 10px;
}
',
            'created_at'=> '2019-04-07 12:43:08',
            'updated_at'=> '2019-04-07 12:43:08',
            ]);

        DB::table('sitecontents')->insert([
            'id' => '1',
            'pagename' => 'Welcome',
            'title1'=> 'Welcome',
            'body1'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show1' => '1',
            'image1' => 'CB1.jpg',
            'showimage1' => '0',
            'title2' => 'Title 2',
            'body2'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show2' => '0',
            'image2' => 'CB1.jpg',
            'showimage2' => '1',
            'title3'=> 'Title 3',
            'body3'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat ',
            'show3' => '1',
            'image3' => 'CB1.jpg',
            'showimage3' => '1',
            'created_at'=> '2019-04-07 12:43:08',
            'updated_at'=> '2019-04-07 12:43:08',
            ]);


        DB::table('sitecontents')->insert([
            'id' => '2',
            'pagename' => 'About us',
            'title1'=> 'About us',
            'body1'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show1' => '1',
            'image1' => 'CB1.jpg',
            'showimage1' => '0',
            'title2' => 'Title 2',
            'body2'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show2' => '1',
            'image2' => 'CB1.jpg',
            'showimage2' => '1',
            'title3'=> 'Title 3',
            'body3'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat ',
            'show3' => '1',
            'image3' => 'CB1.jpg',
            'showimage3' => '1',
            'created_at'=> '2019-04-07 12:43:08',
            'updated_at'=> '2019-04-07 12:43:08',
            ]);

        DB::table('sitecontents')->insert([
            'id' => '3',
            'pagename' => 'Booking',
            'title1'=> 'Booking',
            'body1'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show1' => '1',
            'image1' => 'CB1.jpg',
            'showimage1' => '0',
            'title2' => 'Title 2',
            'body2'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show2' => '0',
            'image2' => 'CB1.jpg',
            'showimage2' => '0',
            'title3'=> 'Title 3',
            'body3'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat ',
            'show3' => '1',
            'image3' => 'CB1.jpg',
            'showimage3' => '0',
            'created_at'=> '2019-04-07 12:43:08',
            'updated_at'=> '2019-04-07 12:43:08',
            ]);

        DB::table('sitecontents')->insert([
            'id' => '4',
            'pagename' => 'Booking Created',
            'title1'=> 'Booking Created',
            'body1'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show1' => '1',
            'image1' => 'CB1.jpg',
            'showimage1' => '1',
            'title2' => 'Title 2',
            'body2'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show2' => '0',
            'image2' => 'CB1.jpg',
            'showimage2' => '0',
            'title3'=> 'Title 3',
            'body3'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat ',
            'show3' => '0',
            'image3' => 'CB1.jpg',
            'showimage3' => '0',
            'created_at'=> '2019-04-07 12:43:08',
            'updated_at'=> '2019-04-07 12:43:08',
            ]);

        DB::table('sitecontents')->insert([
            'id' => '5',
            'pagename' => 'Booking Info',
            'title1'=> 'Booking Info',
            'body1'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show1' => '1',
            'image1' => 'CB1.jpg',
            'showimage1' => '0',
            'title2' => 'Pricing',
            'body2'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show2' => '1',
            'image2' => 'CB1.jpg',
            'showimage2' => '0',
            'title3'=> 'House rules',
            'body3'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat ',
            'show3' => '1',
            'image3' => 'CB1.jpg',
            'showimage3' => '1',
            'created_at'=> '2019-04-07 12:43:08',
            'updated_at'=> '2019-04-07 12:43:08',
            ]);

        DB::table('sitecontents')->insert([
            'id' => '6',
            'pagename' => 'Home',
            'title1'=> 'Message to all users',
            'body1'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show1' => '0',
            'image1' => 'CB1.jpg',
            'showimage1' => '0',
            'title2' => 'Title 2',
            'body2'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show2' => '0',
            'image2' => 'CB1.jpg',
            'showimage2' => '0',
            'title3'=> 'Title 3',
            'body3'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat ',
            'show3' => '0',
            'image3' => 'CB1.jpg',
            'showimage3' => '0',
            'created_at'=> '2019-04-07 12:43:08',
            'updated_at'=> '2019-04-07 12:43:08',
            ]);

        DB::table('sitecontents')->insert([
            'id' => '7',
            'pagename' => 'How to find us',
            'title1'=> 'How to find us',
            'body1'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show1' => '1',
            'image1' => 'CB1.jpg',
            'showimage1' => '0',
            'title2' => 'Parking info',
            'body2'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show2' => '1',
            'image2' => 'CB1.jpg',
            'showimage2' => '1',
            'title3'=> 'Title 3',
            'body3'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat ',
            'show3' => '1',
            'image3' => 'CB1.jpg',
            'showimage3' => '1',
            'created_at'=> '2019-04-07 12:43:08',
            'updated_at'=> '2019-04-07 12:43:08',
            ]);

        DB::table('sitecontents')->insert([
            'id' => '8',
            'pagename' => 'Privacy policy',
            'title1'=> 'Privacy policy',
            'body1'=> "Your trust is very important to us. This means the BBC is committed to protecting the privacy and security of your personal information. This privacy notice describes how we collect and use personal information about you when you upload your stuff to Upload on the BBC. Find out more about information and privacy. What personal information will we collect from you? The personal data will be your name and contact details, such as phone number email address, postcode, or social media account name, your creation and any personal data you choose to give us within the content of your contribution, such as your PRS ID. What will we do with your personal information? The BBC will only use your personal data provided via this uploader for the purposes of our programmes, digital and social media platforms, and to verify your contribution, should we need to get in touch with you. ",
            'show1' => '1',
            'image1' => 'CB1.jpg',
            'showimage1' => '1',
            'title2' => 'Part 2',
            'body2'=> "When you contribute to the BBC, we may use your contribution in our programmes or content, but we cannot promise to use everything that we receive. Your contribution may be used on our online platforms and on a BBC social media page. If we broadcast your contribution it may be used again in future broadcasts. The BBC is the ‘data controller’ of the personal information you give us. This means that the BBC decides what your personal information is used for, and the ways in which it is processed. The legal basis on which the BBC processes your personal information is the BBC’s legitimate interest in producing journalistic content. Where we process your personal information for our legitimate interests we will carefully consider and balance our interests in processing your data against any impact on your individual rights and freedoms and will not use your personal information where such impact overrides our interests. ",
            'show2' => '1',
            'image2' => 'CB1.jpg',
            'showimage2' => '1',
            'title3'=> 'Part 3',
            'body3'=> "How long will we keep your personal information? For editorial reasons we will keep your contact details data for up to nine months. Content that is not used on air or on our digital platforms will be deleted after nine months. Content which is broadcast / published will be held in archive for 7 years. Broadcast material, such as videos, your voice recordings are retained in the BBC Archives for historical record purposes. Who do we share your information with? We will not share your data or contributions with any other third parties without your consent. Contributions sent to the BBC through other third-party social media services, third-party messaging services, or email are also subject to the terms of conditions of the service you choose to use, and you should refer to their privacy policies for how they process your data and their individual retention policies.",
            'show3' => '1',
            'image3' => 'CB1.jpg',
            'showimage3' => '0',
            'created_at'=> '2019-04-07 12:43:08',
            'updated_at'=> '2019-04-07 12:43:08',
            ]);

        DB::table('sitecontents')->insert([
            'id' => '9',
            'pagename' => 'Rooms available',
            'title1'=> 'Rooms available',
            'body1'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show1' => '1',
            'image1' => 'CB1.jpg',
            'showimage1' => '1',
            'title2' => 'Title 2',
            'body2'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show2' => '0',
            'image2' => 'CB1.jpg',
            'showimage2' => '1',
            'title3'=> 'Title 3',
            'body3'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat ',
            'show3' => '0',
            'image3' => 'CB1.jpg',
            'showimage3' => '1',
            'created_at'=> '2019-04-07 12:43:08',
            'updated_at'=> '2019-04-07 12:43:08',
            ]);


        DB::table('sitecontents')->insert([
            'id' => '11',
            'pagename' => 'Terms and conditions',
            'title1'=> 'Terms and conditions',
            'body1'=> "Interpretation
            4. Consumer 1neans an individual acting tor purposes which are wholly or 111 ainly outside his or her trade, business. craft or profession:
            5. Contract means the legally-binding agree1neot between you and us for the supply of the Services:
            6. Delivery Lo cation 1neans the Supplier's premises or other location where the Services are to be supplied, as set out in the Order;
            7. Goods 111eanas my goods that we supply to you with the Services, of the number and description as set out in the Order:
            8. Order 11e1ans the Custon1er's order for the Services fro111th e Supplier as set out in the Ct1sto111er's order or in the Customer's written
            acceptance of the Supplier's quotation;
            9. Services 1neans the se1vices, including any Goods, of the number and description set out in the Order.

            Services
            I 0. The description of the Services and any Goods is as set out in our website, catalogues, brochures or other form of advertisement. Any
            description is for illustrative purposes only and there nrny be s1nall discrepancies in size or colour of any Goods supplied.
            11. In the case of Services and any Goods made to your special requirement s, it is your responsibility to e11sure that any information or
            specification you provide is accurate.
            12. All Services are subject to availability.
            13. We can make changes to the Services which are necessary to comply with any applicable law or safety requirement. \We will notify you of
            these changes.


            Customer 1·esponsibilities
            14. You n1ust co-operate with 11si n all 111attersre lasting to the Services. provide us and our authorized employees and representatives with access
            to any premises under your control as required, provide us with all information required to perform the Services and obtain any necessary
            licenses all consents (unless otherwise agreed).
            15. Failure to comply with the above is a Customer default which entitles us to suspend pe1formance of the Services until you remedy it or if
            you fail to re1nedy it following our request. we can terminate the Contract with i1nn1edia1e effect on written notice to you.

            Basis of Sale
            16. The description of 1he Services and any Goods in out· website, catalogues, broch11reso r other fonn of advertise1nen1d does not cons1i111tae
            contractual offer to sell the Services or Goods.
            17. When an Order has been made, we can reject it for any reason, altho11hg we will try to tell yo11th e reason witbo11dt delay.
            18. A Contract will be forn1ed for the Services ordered, only upon the Supplier sending an e1nail 10 the Custo1ner saying that the Order has been
            accepted or, if earlier, the Supplier's delive1y of tile Services to the C.11stomer.
            19. Any q11otation or estimate of Fees (as defined below) is valid for a n1axitnum period of 30 days from its date. unless we expressly
            withdraw it at an earlier 1i1ne.
            20. No variation of the Contract. whether about description of the Services, Fees or otherwise, can be 111ade after it has been entered into unless
            the variation is agreed by the C11sto 1ner and the S11pplier in writing.
            21. \Ne intend 1ha1c these Terms and Condi1ions apply only to a Contract entered into by you as a Cons11n1er where we, the Supplier and you the
            Customer, enter the Contract at any of the Supplier's business pre1nises, and where the Contract is not a contract (I) for which an offer was
            n1adeb y the C11ston1er it1t he S11pplier's and the Cus101nel's si1nul!aneous physical presence away fro111th ose premises, or (ii) made
            immediately after the Customer was personally and individually addressed in the Supplier's and the Customer's simultaneous physical
            presence away fro11t1h ose pre11is1es. If this is not the case, yon 111s1t 1tell us, so that we can provide you with a different con1rac1w ith terms
            which are more appropriate to you and, vice 1night.i n so111we ay. be better for yo11e, g by giving cancellation rights pursuant to consumer
            protection Jaw. Business premises means inunovable retail premises where we can on business on a permanent basis or. in the case of
            1novable retail preu1ises, on a usual basis.


            Fees and Payn1ent
            22. The fees (Fees) for the Services. the price of any Goods (if nor included in the Fees) and any additional delivery or other charges is that ser
            out in our price list current at the date of the Order or such other price as we 1nay agree in writing. Prices for Services n1ay be calculated on a
            fD, ed fee or on a standard rate basis.
            23. Fees and charges include VAT are the rare applicable at the ti1ne of the Order.
            24. Payn1ent for Services 1nust be 1nade at least I day in advance of delive1y. You n1ust pay in cash or by submitting your credit or debit card
            details with your Order and we can take payment inunediate ly or otherwise before delivery of the Services.

            Delivery
            , We will deliver the Se1vices, including any Goods, to the Delivery Location by the time or within the agreed period or, failing ru1y
            agreement:
            a. in the case of Se1vices, within a reasonable ti1ne: and
            b. in the case of Goods. without undue delay and, in any event. not n1ore than 30 calendar days fron1 the day on which the Contract is
            entered into.
            26. In any case, regard less of events beyond our control l, if we do not deliver the Se1vices on tiL11ey, you can require us to reduce the. Fees or
            charges by an appropriate an1ount (including the right to receive a refund for anything already paid above the reduced amount). The amount t
            of the reduction can, where appropriate, be up to the full amount of the Fees or charges.
            27. In any case, regardless of events beyond our control l, if we do not deliver the Goods on time, you can (in addition to any other ren1edies)
            treat the Contract at an end if:
            a. we have refused to deliver the Goods, or if delivery on time is essential taking into account all the relevant circumstances at the time the
            Contract was made, or you said to us before the Contract t was 1nade that delivery on ti1ne was essential l: or
            b. after we have failed to deliver on tune, you have specified a later period which is appropriate 10 the circu1nstances and we have not
            delivered within that period.
            ",
            'show1' => '1',
            'image1' => 'CB1.jpg',
            'showimage1' => '0',
            'title2' => 'Part 2',
            'body2'=> "
            28. If you treat the Contract at an end. we will (in addition to other ren1edies) pro1nplly ren1rn all payn1ents made under the Contract.
            29. If you were entitled to trea.t the Contract at an end, but do not do so. you are not prevented fro1u cancelling the Order for any Goods or
            rejecting Goods that have been delivered and, if you do this. we will (in addition to other remedies) without delay return all pay1nems 1nade
            under the Contract for any such cancelled or rejected Goods. If the Goods have been delivered, you must renirn then1 or allow us to collect
            the111 fro111 you and we will pay the costs of this.
            30. If any Goods form a commercial unit (a unit is a commercial unit if division of the unit would 1naterially impair the value of the goods or the
            character of the unit) you cannot cancel or reject the Order for son1e of those Goods without also cancelling or rejecting the Order for the rest
            of then1.
            31., We do not generally deliver to addresses outside England and, Wales, Scotland. No11heru Ireland, the Isle of Man and Channels Islands. If,
            however. we accept an Order for delivery outside that area. you may need to pay i1npo11 dmies or other taxes. as we will not pay the1n.
            32. You agree we 1nay deliver the Goods in instalments if we suffer a sho1tage of stock or other genuine and fair reason, subject to the above
            provisions and provided you are not liable for extra charges.
            33. If you or your nominee fail. through no fault of ours, to take delivery of the Se1vices at the Delivery Location, we 1nay charge the reasonable
            costs of storing and redelivering them.
            34. The Goods will beco1ne your responsibility fro1nt he co1npleriono f delivery or Custo1ner collection. You 1nus1 if reasonably practicable,
            exa1nine the Goods before accepting then1.

            Risk and Title
            35. Risk of damage to. or loss of, any Goods will pass to you when the Goods are delivered to you.
            36. Yon do not own the Goods until we have received pay1nent in full. If full payn1ent is overdue or a step occurs towards your bankruptcy, we
            can choose, by notice to cancel any delivery and end any right to use the Goods still owned by you, if which case you 111ust return them or
            allow us to collect the1n.
            ,vitbdraV1•al and cancellation
            37. You can withdraw the Order by telling us before the Contract is 1nade, if you simply wish to change your 1nind and without giving us a
            reason, and without incurring any liability.
            38. You can cancel the Contract except for any Goods which are made to your spec ail require1ne11tsb y telling us no later than I calendar day
            from the day the Contract was entered into. If you simply wish to change your mind and without giving us a reason, and without liability,
            except in that case. you n1ust return to any of our business pren1ises the Goods in unda1naged condition at your own expense. Then we 1nus t
            without delay refund to you the price for those Goods and Services which have been paid for in advance, but we can retain any separate
            delivery charge. This does not affect your rights when the reason for the cancellation n is any defective Goods or Services.

            Conformity and Guarantee
            39. \We have a legal duty to supply the Goods in conformity with 1he Con1rac1. and will not have conformed if it does nor 1nee1 the following
            obligation.
            40. Upon delivery. tbe Goods will:
            a. be of satisfactory quality:
            b. be reasonably fit for any particular purpose for which you buy the Goods which. before the Contract is 1nade, you made known to us
            (unless you do normally rely. or it is unreasonable for you to rely. on our skill and judg1nent) and be fit for any purpose held out by us
            or set out in the Contract; and
            c. conforms to their description.
            4 1. It is not a failure 10 confonn if the failure has its or igin in your 111aterials.
            42. \We will supply the Services with reasonable skill and care.
            43. \We will immediately, or within a reasonable time, give you the benefit of the. free guarantee given by the manufacturer of the Goods. Detalls
            of the guarantee, including the nan1e and address of the 1nanufacmrer. the duration and territorial scope of the guarantee, are ser out in the
            , manufacturer’s guarantee provided with the Goods. Tl1is guarubtee will take effect at the ti1ne the Goods are delivered, and will not reduce
            your legal rights.

            44. In relation to tbe Services, anything we say or write to you, or anything someone else says or writes to you on our behalf, about us or about
            the Services. is a term of the Contract (which we 1nus t comply, with) if you rake it into account when deciding to enter this Contract. or when
            making any decision abot1t the Services after entering into Ibis Contract. Anything you take into account is subject to anything that qualified
            ii and was said or written to you by us or on behalf of us on the sa1ne occasion, and any change to it that has been expressly agreed between
            us (before entering this Contract or later).
            Duration, tern1ination and suspension
            45. The Comracl continues as long as it takes us to perform the Services.
            46. Either you or we 1nay renninare the Contract or suspend the Services at any ti1ne by a written notice of termination or suspension to the
            other if that other:
            a. commits a serious breach, or series of breaches resulting in a seriot1s breach, of the Contract and the breach either cannot be fixed or is
            not fixed, within 30 days of the. written notice: or
            b. is st1bjecl to any step towards its bankruptcy or liquidation.
            47. On termination of the Contract for any reason. any of our, -respective remaining rights and liabilities will not be affected.
            ",
            'show2' => '1',
            'image2' => 'CB1.jpg',
            'showimage2' => '0',
            'title3'=> 'Part 3',
            'body3'=> "Privacy
            48. Your privacy is critical to us. We respect your privacy and co1nply with 1he General Data Protection Regula1ion with regard to your personal
            information.
            49. These Terms and Condit ions should be read alongside, and are in addition to our policies. including our privacy policy and cookies policy
            which can be found the policy can be found ... '. e.g. 'on our, website'
            50. For the purposes of these Terms and Conditions:
            a. 'Data Protection Laws' means any applicable law relating to the processing of Personal Data, including, but not limited to the Directive
            95/46/EC (Data Protection Directive) or the GDPR.
            b. 'GDPR' means the General Data Protection Regulation (EU) 20 16/679.
            c. 'Data Controller r', 'Personal Data' and 'Processing' shall have the same meaning as in the GDPR.
            51., We are a Dara Controller of the Personal Data we Process in providing the Services and Goods to you.

            52. \Where you supply Personal Data to us so we can provide Services and Goods to you. and we Process that Personal Data in the course of
            providing the Services and Goods to you, \We will co1nply with our obligations imposed by the Data Protection Laws:
            a. before or at the time of collecting Personal Data, we will identify the purposes for which information is being collected;
            b. we will only Process Personal Data for the purposes identified;
            c. we will respect your rights in relation to your Persona l Data: and
            d. we will i1uplen1ent technical and organizational 1neasures to ensure your Personal Dara is secure.
            53. For any enquiries or con1plaints regarding data privacy. you can e-mail: e1nail@e1nail.con1 .
            Successors and our sub-contractors
            54. Either party can rrnosfer the benefit of this Cont1·act to someone else, and will remain liable to the other for its obligations under the
            Contract. The Supplier will be liable for the acts of any sub-contractors who it chooses to help personaits d111ies.

            Cil·cu1nstances beyond the control of either party
            55. In the event of any failure by a party because of so1nething beyond its reasonable control:
            a. the party, wiii advise the other pa1ty as soon as reasonably practicable; and
            b. 1he party's obligations will be suspended so far as is reasonable. provided tha1 tba1 party will act reasonably. and 1be party will 1101 be
            liable for any failure which it could not reasonably avoid, but this will not affect the Customer's above rights relating to delivery and the
            rigb1 10 cancel below.
            Excluding liability
            56. \We do not exclude liability for: (i) any fraudulent act or 01nissio11:o r (ii) death or personal inju1y caused by negligence or breach of the
            Supplier's other legal obligations. Subject to this. we are not liable for (i) loss which was not reasonably foreseeable to both parties at the
            tin1e when the Cootrac1 was n1ade, or (ii) loss (e.g. loss of profit) to your business. trade, craft or profession which would not be suffered by a
            Cons1101e-rb because, we believe you are not buying the Services and Goods wholly or mainly for your business, trade, craft or profession.

            Governing la', jurisdiction and complaints
            57. The Contract (including any non-contractual 1naners) is goven1ed by the law of England and \Vales.
            58. Disputes can be s11bm.it1etod the jurisdiction of the courts of England and \Vales or, where the C11ston1elri ves in Scotland or Northern
            Ireland, in the co11r1osf Scotland Northern Ireland respectively.
            59. We try to avoid any dispute, so we deal with con1plaims as follows:
            Con1plaits procedure etc etc etc. .... If a dispute occurs c11sto111esrhso uld contact us to find a solution. \We will aitn to respond with an
            appropriate solution within 5 days.",
            'show3' => '1',
            'image3' => 'CB1.jpg',
            'showimage3' => '0',
            'created_at'=> '2019-04-07 12:43:08',
            'updated_at'=> '2019-04-07 12:43:08',
            ]);

        DB::table('sitecontents')->insert([
            'id' => '12',
            'pagename' => 'Cookie policy',
            'title1'=> 'Cookie policy',
            'body1'=>
            "We use cookies to help give you the best possible experience on our site.
            Our site is a web based application that relies on the use of cookies to operate, therefore we can't provide the cookie customisation that some other sites may.

            By using this Website you agree to the use of cookies. Please note that certain cookies may be set the moment you start visiting this Website.",
            'show1' => '1',
            'image1' => 'CB1.jpg',
            'showimage1' => '0',
            'title2' => 'What Are Cookies?',
            'body2'=> "Cookies are small text files stored by your device when you access most websites on the internet. We will use two types of cookies:

            •	Session cookies - these expire when you close your browser and do not remain on your computer.
            •	Persistent cookies - these are stored in the longer term on your computer. They are normally used to make sure the site remembers your preferences.

            These cookies support navigation, search, login and control what elements of the website you are allowed to interface with. The are also used to remember what inputs you have entered when filling out our bookings.",
            'show2' => '1',
            'image2' => 'CB1.jpg',
            'showimage2' => '0',
            'title3'=> 'Title 3',
            'body3'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat ',
            'show3' => '0',
            'image3' => 'CB1.jpg',
            'showimage3' => '0',
            'created_at'=> '2019-04-07 12:43:08',
            'updated_at'=> '2019-04-07 12:43:08',
            ]);

        DB::table('sitecontents')->insert([
            'id' => '13',
            'pagename' => 'House rules',
            'title1'=> 'House rules',
            'body1'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show1' => '1',
            'image1' => 'CB1.jpg',
            'showimage1' => '0',
            'title2' => 'Title 2',
            'body2'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat .',
            'show2' => '1',
            'image2' => 'CB1.jpg',
            'showimage2' => '1',
            'title3'=> 'Title 3',
            'body3'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat ',
            'show3' => '1',
            'image3' => 'CB1.jpg',
            'showimage3' => '1',
            'created_at'=> '2019-04-07 12:43:08',
            'updated_at'=> '2019-04-07 12:43:08',
            ]);

        DB::table('hireprices')->insert([
            'id' => '1',
            'guitarhead' => '4.00',
            'guitarcab'=> '4.10',
            'guitarcombo' => '4.20',
            'basshead'=> '4.30',
            'basscab' => '4.40',
            'basscombo'=> '4.50',
            'drumkit' => '5.00',
            'cymbals' => '5.00',
            'guitarheadstock' => '1',
            'guitarcabstock'=> '2',
            'guitarcombostock' => '3',
            'bassheadstock'=> '1',
            'basscabstock' => '2',
            'basscombostock'=> '3',
            'drumkitstock' => '5',
            'cymbalsstock' => '3',
            'created_at'=> '2019-04-07 12:43:08',
            'updated_at'=> '2019-04-07 12:43:08',
            ]);
    }
}
