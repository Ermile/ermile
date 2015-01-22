<?php
function transtext()
{

	//----------------------------------------------content_account/login/display.html
	echo T_("Click here for recovery your password");                                 // Line 6
	echo T_("Can't access your account?");                                            // Line 6
	echo T_("Don't have an account?");                                                // Line 7
	echo T_("Click here to create an account");                                       // Line 7
	echo T_("Sign Up");                                                               // Line 7

	//---------------------------------------------content_account/signup/display.html
	echo T_("terms of service");                                                      // Line 6
	echo T_("by signing up, you agree to the");                                       // Line 6 Seperate
	echo T_("already have an account?");                                              // Line 7
	echo T_("click here to sign in to your account");                                 // Line 7
	echo T_("Sign In");                                                               // Line 7

	//------------------------------------content_account/verificationsms/display.html
	echo T_("Please send number <b>2015</b> to below number");                        // Line 6 Seperate
	echo T_("Then wait we receive your message and verificate your account");         // Line 8

	//-------------------------------------------content_account/recovery/display.html
	echo T_("click here to login to your account");                                   // Line 6
	echo T_("are you remember your password!?");                                      // Line 6

	//---------------------------------------content_account/verification/display.html
	echo T_("please check your mobile and enter the code");                           // Line 6
	echo T_("don't receive message?");                                                // Line 7

	//-------------------------------------------------------content/home/display.html
	echo T_("Ermile");                                                                // Line 12

	//----------------------------------------------------content_cp/home/display.html
	echo T_("Logout");                                                                // Line 46
	echo T_("Home");                                                                  // Line 47

	//-------------------------------------------------content_cp/main/xhr-layout.html
	echo T_("Options");                                                               // Line 24 Seperate
	echo T_("Go to");                                                                 // Line 71
	echo T_("Does not exist");                                                        // Line 41 Seperate
	echo T_("Add New Record");                                                        // Line 46 Seperate
	echo T_("Actions");                                                               // Line 59
	echo T_("Edit");                                                                  // Line 73
	echo T_("Delete");                                                                // Line 76

	//-----------------------------------------------------content_cp/main/layout.html

	//---------------------------------------------------includes/cls/macro/forms.html
	echo T_("Please select one item");                                                // Line 47 Seperate

	//-------------------------------------------------------includes/mvc/display.html
	echo T_("Home Page");                                                             // Line 42
	echo T_("Admin");                                                                 // Line 43
	echo T_("Control Panel");                                                         // Line 44
	echo T_("Login");                                                                 // Line 48

}
?>